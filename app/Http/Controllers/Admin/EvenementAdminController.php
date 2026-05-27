<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evenement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class EvenementAdminController extends Controller
{
    public function index()
    {
        $this->syncStatuts();

        $aVenir = Evenement::where('statut', 'a_venir')->orderBy('date_debut')->get();
        $enCours = Evenement::where('statut', 'en_cours')->orderBy('date_debut')->get();
        $passes  = Evenement::where('statut', 'passe')->orderByDesc('date_debut')->take(20)->get();

        $total = Evenement::count();

        return view('admin.evenements.index', compact('aVenir', 'enCours', 'passes', 'total'));
    }

    public function create()
    {
        return view('admin.evenements.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $data['titre']);
        $data['actif']   = $request->boolean('actif', true);
        $data['gratuit'] = $request->boolean('gratuit');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('evenements', 'public');
        }

        $data['statut'] = $this->computeStatut($data['date_debut'], $data['date_fin'] ?? null);

        Evenement::create($data);

        return redirect()->route('admin.evenements.index')
            ->with('success', 'Événement créé avec succès.');
    }

    public function show(Evenement $evenement)
    {
        return redirect()->route('evenements.show', $evenement);
    }

    public function edit(Evenement $evenement)
    {
        return view('admin.evenements.edit', compact('evenement'));
    }

    public function update(Request $request, Evenement $evenement)
    {
        $data = $this->validatedData($request, $evenement);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $data['titre'], $evenement);
        $data['actif']   = $request->boolean('actif');
        $data['gratuit'] = $request->boolean('gratuit');

        if ($request->hasFile('image')) {
            $this->deleteFile($evenement->image);
            $data['image'] = $request->file('image')->store('evenements', 'public');
        }

        if ($request->boolean('remove_image') && !$request->hasFile('image')) {
            $this->deleteFile($evenement->image);
            $data['image'] = null;
        }

        $data['statut'] = $this->computeStatut($data['date_debut'], $data['date_fin'] ?? null);

        $evenement->update($data);

        return redirect()->route('admin.evenements.index')
            ->with('success', 'Événement mis à jour.');
    }

    public function destroy(Evenement $evenement)
    {
        $this->deleteFile($evenement->image);
        $evenement->delete();

        return redirect()->route('admin.evenements.index')
            ->with('success', 'Événement supprimé.');
    }

    public function toggleActif(Evenement $evenement)
    {
        $evenement->update(['actif' => !$evenement->actif]);

        return back()->with('success', 'Statut mis à jour.');
    }

    // ─── Helpers ───────────────────────────────────────────────────

    private function validatedData(Request $request, ?Evenement $evenement = null): array
    {
        return $request->validate([
            'titre'           => ['required', 'string', 'max:200'],
            'slug'            => ['nullable', 'string', 'max:220', Rule::unique('evenements', 'slug')->ignore($evenement?->id)],
            'description'     => ['required', 'string', 'max:1000'],
            'contenu'         => ['nullable', 'string'],
            'date_debut'      => ['required', 'date'],
            'date_fin'        => ['nullable', 'date', 'after_or_equal:date_debut'],
            'lieu'            => ['nullable', 'string', 'max:200'],
            'type'            => ['nullable', 'string', 'max:80'],
            'prix'            => ['nullable', 'numeric', 'min:0'],
            'lien_inscription'=> ['nullable', 'url', 'max:500'],
            'image'           => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'actif'           => ['nullable', 'boolean'],
            'gratuit'         => ['nullable', 'boolean'],
            'remove_image'    => ['nullable', 'boolean'],
        ]);
    }

    private function uniqueSlug(string $value, ?Evenement $evenement = null): string
    {
        $slug = Str::slug($value) ?: Str::slug(Str::random(8));
        $base = $slug;
        $suffix = 2;

        while (Evenement::where('slug', $slug)
            ->when($evenement, fn ($q) => $q->whereKeyNot($evenement->id))
            ->exists()) {
            $slug = "{$base}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }

    private function computeStatut(string $dateDebut, ?string $dateFin): string
    {
        $now   = now();
        $debut = \Carbon\Carbon::parse($dateDebut);
        $fin   = $dateFin ? \Carbon\Carbon::parse($dateFin) : null;

        if ($fin) {
            if ($now->lt($debut))  return 'a_venir';
            if ($now->gt($fin))    return 'passe';
            return 'en_cours';
        }

        return $now->lt($debut) ? 'a_venir' : 'passe';
    }

    private function syncStatuts(): void
    {
        Evenement::chunk(50, function ($evenements) {
            foreach ($evenements as $ev) {
                $statut = $this->computeStatut(
                    $ev->date_debut->toDateTimeString(),
                    $ev->date_fin?->toDateTimeString()
                );
                if ($ev->statut !== $statut) {
                    $ev->update(['statut' => $statut]);
                }
            }
        });
    }

    private function deleteFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
