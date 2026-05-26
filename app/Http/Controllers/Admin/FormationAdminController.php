<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class FormationAdminController extends Controller
{
    public function index()
    {
        $formations = Formation::query()
            ->orderBy('ordre')
            ->orderBy('titre')
            ->get();

        return view('admin.formations.index', compact('formations'));
    }

    public function create()
    {
        return view('admin.formations.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $data['titre']);
        $data['actif'] = $request->boolean('actif', true);
        $data['ordre'] = $data['ordre'] ?? ((Formation::max('ordre') ?? 0) + 1);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('formations', 'public');
        }

        Formation::create($data);

        return redirect()->route('admin.formations.index')
            ->with('success', 'Formation créée avec succès.');
    }

    public function show(Formation $formation)
    {
        return redirect()->route('formations.show', $formation->slug);
    }

    public function edit(Formation $formation)
    {
        return view('admin.formations.edit', compact('formation'));
    }

    public function update(Request $request, Formation $formation)
    {
        $data = $this->validatedData($request, $formation);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $data['titre'], $formation);
        $data['actif'] = $request->boolean('actif');

        if ($request->hasFile('image')) {
            if ($formation->image) {
                Storage::disk('public')->delete($formation->image);
            }

            $data['image'] = $request->file('image')->store('formations', 'public');
        }

        $formation->update($data);

        return redirect()->route('admin.formations.index')
            ->with('success', 'Formation mise à jour.');
    }

    public function destroy(Formation $formation)
    {
        if ($formation->image) {
            Storage::disk('public')->delete($formation->image);
        }

        $formation->delete();

        return redirect()->route('admin.formations.index')
            ->with('success', 'Formation supprimée.');
    }

    private function validatedData(Request $request, ?Formation $formation = null): array
    {
        return $request->validate([
            'titre'        => ['required', 'string', 'max:160'],
            'slug'         => ['nullable', 'string', 'max:180', Rule::unique('formations', 'slug')->ignore($formation?->id)],
            'description'  => ['required', 'string', 'max:1200'],
            'contenu'      => ['nullable', 'string'],
            'duree'        => ['nullable', 'string', 'max:80'],
            'niveau'       => ['nullable', 'string', 'max:80'],
            'public_cible' => ['nullable', 'string', 'max:160'],
            'prix'         => ['nullable', 'numeric', 'min:0', 'max:999999.99'],
            'image'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'categorie'    => ['nullable', 'string', 'max:120'],
            'ordre'        => ['nullable', 'integer', 'min:0'],
            'actif'        => ['nullable', 'boolean'],
        ]);
    }

    private function uniqueSlug(string $value, ?Formation $formation = null): string
    {
        $slug = Str::slug($value);
        $slug = $slug !== '' ? $slug : Str::slug(Str::random(8));
        $base = $slug;
        $suffix = 2;

        while (Formation::where('slug', $slug)
            ->when($formation, fn ($query) => $query->whereKeyNot($formation->id))
            ->exists()) {
            $slug = "{$base}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }
}
