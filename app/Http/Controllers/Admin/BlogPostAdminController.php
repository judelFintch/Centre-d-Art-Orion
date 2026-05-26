<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BlogPostAdminController extends Controller
{
    public function index()
    {
        $posts = BlogPost::query()
            ->orderByDesc('featured')
            ->orderBy('ordre')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $data['title']);
        $data['actif'] = $request->boolean('actif', true);
        $data['featured'] = $request->boolean('featured');
        $data['ordre'] = $data['ordre'] ?? ((BlogPost::max('ordre') ?? 0) + 1);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blog', 'public');
        }

        $data['gallery'] = $this->storeGallery($request);

        BlogPost::create($data);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Publication créée avec succès.');
    }

    public function show(BlogPost $blog)
    {
        return redirect()->route('blog.show', $blog->slug);
    }

    public function edit(BlogPost $blog)
    {
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(Request $request, BlogPost $blog)
    {
        $data = $this->validatedData($request, $blog);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $data['title'], $blog);
        $data['actif'] = $request->boolean('actif');
        $data['featured'] = $request->boolean('featured');

        if ($request->hasFile('image')) {
            $this->deleteStoredFile($blog->image);
            $data['image'] = $request->file('image')->store('blog', 'public');
        }

        $gallery = collect($blog->gallery ?: []);
        $removed = collect($request->input('remove_gallery', []));

        $removed->each(fn ($path) => $this->deleteStoredFile($path));
        $gallery = $gallery->reject(fn ($path) => $removed->contains($path));

        $data['gallery'] = $gallery
            ->merge($this->storeGallery($request))
            ->values()
            ->all();

        $blog->update($data);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Publication mise à jour.');
    }

    public function destroy(BlogPost $blog)
    {
        $this->deleteStoredFile($blog->image);

        foreach ($blog->gallery ?: [] as $path) {
            $this->deleteStoredFile($path);
        }

        $blog->delete();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Publication supprimée.');
    }

    private function validatedData(Request $request, ?BlogPost $blog = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'slug' => ['nullable', 'string', 'max:200', Rule::unique('blog_posts', 'slug')->ignore($blog?->id)],
            'category' => ['nullable', 'string', 'max:120'],
            'author' => ['nullable', 'string', 'max:120'],
            'read_time' => ['nullable', 'string', 'max:40'],
            'excerpt' => ['required', 'string', 'max:1200'],
            'content' => ['required', 'string'],
            'quote' => ['nullable', 'string', 'max:500'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'gallery_images' => ['nullable', 'array'],
            'gallery_images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'remove_gallery' => ['nullable', 'array'],
            'remove_gallery.*' => ['string'],
            'published_at' => ['nullable', 'date'],
            'ordre' => ['nullable', 'integer', 'min:0'],
            'featured' => ['nullable', 'boolean'],
            'actif' => ['nullable', 'boolean'],
        ]);
    }

    private function uniqueSlug(string $value, ?BlogPost $blog = null): string
    {
        $slug = Str::slug($value) ?: Str::slug(Str::random(8));
        $base = $slug;
        $suffix = 2;

        while (BlogPost::where('slug', $slug)
            ->when($blog, fn ($query) => $query->whereKeyNot($blog->id))
            ->exists()) {
            $slug = "{$base}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }

    private function storeGallery(Request $request): array
    {
        if (!$request->hasFile('gallery_images')) {
            return [];
        }

        return collect($request->file('gallery_images'))
            ->map(fn ($file) => $file->store('blog/gallery', 'public'))
            ->all();
    }

    private function deleteStoredFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
