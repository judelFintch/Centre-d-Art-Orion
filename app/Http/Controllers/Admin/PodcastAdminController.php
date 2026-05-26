<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PodcastEpisode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PodcastAdminController extends Controller
{
    public function index()
    {
        $episodes = PodcastEpisode::query()
            ->orderByDesc('featured')
            ->orderBy('ordre')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.podcasts.index', compact('episodes'));
    }

    public function create()
    {
        return view('admin.podcasts.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $data['title']);
        $data['actif'] = $request->boolean('actif', true);
        $data['featured'] = $request->boolean('featured');
        $data['ordre'] = $data['ordre'] ?? ((PodcastEpisode::max('ordre') ?? 0) + 1);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('podcasts/covers', 'public');
        }

        if ($request->hasFile('audio_file')) {
            $data['audio_file'] = $request->file('audio_file')->store('podcasts/audio', 'public');
        }

        PodcastEpisode::create($data);

        return redirect()->route('admin.podcasts.index')
            ->with('success', 'Épisode podcast créé avec succès.');
    }

    public function show(PodcastEpisode $podcast)
    {
        return redirect()->route('podcasts.index');
    }

    public function edit(PodcastEpisode $podcast)
    {
        return view('admin.podcasts.edit', compact('podcast'));
    }

    public function update(Request $request, PodcastEpisode $podcast)
    {
        $data = $this->validatedData($request, $podcast);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $data['title'], $podcast);
        $data['actif'] = $request->boolean('actif');
        $data['featured'] = $request->boolean('featured');

        if ($request->hasFile('cover_image')) {
            $this->deleteStoredFile($podcast->cover_image);
            $data['cover_image'] = $request->file('cover_image')->store('podcasts/covers', 'public');
        }

        if ($request->hasFile('audio_file')) {
            $this->deleteStoredFile($podcast->audio_file);
            $data['audio_file'] = $request->file('audio_file')->store('podcasts/audio', 'public');
        }

        $podcast->update($data);

        return redirect()->route('admin.podcasts.index')
            ->with('success', 'Épisode podcast mis à jour.');
    }

    public function destroy(PodcastEpisode $podcast)
    {
        $this->deleteStoredFile($podcast->cover_image);
        $this->deleteStoredFile($podcast->audio_file);
        $podcast->delete();

        return redirect()->route('admin.podcasts.index')
            ->with('success', 'Épisode podcast supprimé.');
    }

    private function validatedData(Request $request, ?PodcastEpisode $podcast = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'slug' => ['nullable', 'string', 'max:200', Rule::unique('podcast_episodes', 'slug')->ignore($podcast?->id)],
            'series' => ['nullable', 'string', 'max:120'],
            'episode_number' => ['nullable', 'string', 'max:20'],
            'guest' => ['nullable', 'string', 'max:160'],
            'duration' => ['nullable', 'string', 'max:40'],
            'excerpt' => ['required', 'string', 'max:1000'],
            'description' => ['nullable', 'string'],
            'transcript' => ['nullable', 'string'],
            'audio_url' => ['nullable', 'url', 'max:255'],
            'audio_file' => ['nullable', 'file', 'mimes:mp3,wav,m4a,ogg,aac', 'max:51200'],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'accent' => ['required', 'string', 'max:20'],
            'published_at' => ['nullable', 'date'],
            'ordre' => ['nullable', 'integer', 'min:0'],
            'featured' => ['nullable', 'boolean'],
            'actif' => ['nullable', 'boolean'],
        ]);
    }

    private function uniqueSlug(string $value, ?PodcastEpisode $podcast = null): string
    {
        $slug = Str::slug($value) ?: Str::slug(Str::random(8));
        $base = $slug;
        $suffix = 2;

        while (PodcastEpisode::where('slug', $slug)
            ->when($podcast, fn ($query) => $query->whereKeyNot($podcast->id))
            ->exists()) {
            $slug = "{$base}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }

    private function deleteStoredFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
