<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesTranslations;
use App\Http\Controllers\Controller;
use App\Models\GalerieItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class GalerieAdminController extends Controller
{
    use HandlesTranslations;

    private const TRANSLATABLE = ['titre', 'description', 'categorie'];

    public function index()
    {
        $items = GalerieItem::query()
            ->orderBy('ordre')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.galerie.index', compact('items'));
    }

    public function create()
    {
        return view('admin.galerie.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['actif'] = $request->boolean('actif', true);
        $data['ordre'] = $data['ordre'] ?? ((GalerieItem::max('ordre') ?? 0) + 1);

        if ($request->hasFile('fichier')) {
            $data['fichier'] = $request->file('fichier')->store('galerie', 'public');
        }

        if ($request->hasFile('miniature')) {
            $data['miniature'] = $request->file('miniature')->store('galerie/miniatures', 'public');
        }

        if ($data['type'] === 'video') {
            $data['fichier'] = $data['fichier'] ?? $data['miniature'] ?? 'galerie/video-externe';
        }

        $item = GalerieItem::create($data);
        $this->applyEnglishTranslations($item, $request, self::TRANSLATABLE);

        return redirect()->route('admin.galerie.index')
            ->with('success', 'Élément ajouté à la galerie.');
    }

    public function show(GalerieItem $galerie)
    {
        return redirect()->route('galerie.index');
    }

    public function edit(GalerieItem $galerie)
    {
        return view('admin.galerie.edit', compact('galerie'));
    }

    public function update(Request $request, GalerieItem $galerie)
    {
        $data = $this->validatedData($request, $galerie);
        $data['actif'] = $request->boolean('actif');

        if ($request->hasFile('fichier')) {
            $this->deleteStoredFile($galerie->fichier);
            $data['fichier'] = $request->file('fichier')->store('galerie', 'public');
        }

        if ($request->hasFile('miniature')) {
            $this->deleteStoredFile($galerie->miniature);
            $data['miniature'] = $request->file('miniature')->store('galerie/miniatures', 'public');
        }

        if ($data['type'] === 'video' && empty($data['fichier']) && empty($galerie->fichier)) {
            $data['fichier'] = $data['miniature'] ?? $galerie->miniature ?? 'galerie/video-externe';
        }

        $galerie->update($data);
        $this->applyEnglishTranslations($galerie, $request, self::TRANSLATABLE);

        return redirect()->route('admin.galerie.index')
            ->with('success', 'Élément de galerie mis à jour.');
    }

    public function destroy(GalerieItem $galerie)
    {
        $this->deleteStoredFile($galerie->fichier);
        $this->deleteStoredFile($galerie->miniature);

        $galerie->delete();

        return redirect()->route('admin.galerie.index')
            ->with('success', 'Élément supprimé de la galerie.');
    }

    private function validatedData(Request $request, ?GalerieItem $galerie = null): array
    {
        $type = $request->input('type', $galerie?->type ?? 'photo');

        return $request->validate([
            'titre'       => ['required', 'string', 'max:160'],
            'description' => ['nullable', 'string', 'max:1200'],
            'type'        => ['required', Rule::in(['photo', 'video'])],
            'categorie'   => ['nullable', 'string', 'max:120'],
            'url_video'   => [$type === 'video' ? 'required' : 'nullable', 'url', 'max:255'],
            'fichier'     => [$type === 'photo' && !$galerie ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'miniature'   => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'ordre'       => ['nullable', 'integer', 'min:0'],
            'actif'       => ['nullable', 'boolean'],
        ]);
    }

    private function deleteStoredFile(?string $path): void
    {
        if ($path && $path !== 'galerie/video-externe' && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
