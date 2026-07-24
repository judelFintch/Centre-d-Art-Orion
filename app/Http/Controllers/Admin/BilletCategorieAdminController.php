<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesTranslations;
use App\Http\Controllers\Controller;
use App\Models\BilletCategorie;
use App\Models\Evenement;
use Illuminate\Http\Request;

class BilletCategorieAdminController extends Controller
{
    use HandlesTranslations;

    private const TRANSLATABLE = ['nom', 'description'];

    public function store(Request $request, Evenement $evenement)
    {
        $data = $request->validate([
            'nom'         => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:300'],
            'prix'        => ['required', 'numeric', 'min:0'],
        ]);

        $ordre = $evenement->billetCategories()->max('ordre') + 1;

        $categorie = $evenement->billetCategories()->create([
            'nom'         => $data['nom'],
            'description' => $data['description'] ?? null,
            'prix'        => $data['prix'],
            'actif'       => true,
            'ordre'       => $ordre,
        ]);
        $this->applyEnglishTranslations($categorie, $request, self::TRANSLATABLE);

        return back()->with('success', 'Catégorie « '.$data['nom'].' » ajoutée.');
    }

    public function update(Request $request, BilletCategorie $categorie)
    {
        $data = $request->validate([
            'nom'         => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:300'],
            'prix'        => ['required', 'numeric', 'min:0'],
            'actif'       => ['boolean'],
        ]);

        $categorie->update($data);
        $this->applyEnglishTranslations($categorie, $request, self::TRANSLATABLE);

        return back()->with('success', 'Catégorie mise à jour.');
    }

    public function toggle(BilletCategorie $categorie)
    {
        $categorie->update(['actif' => !$categorie->actif]);
        return back()->with('success', 'Statut de la catégorie mis à jour.');
    }

    public function destroy(BilletCategorie $categorie)
    {
        $evenement = $categorie->evenement;
        $categorie->delete();
        return redirect()
            ->route('admin.billets.by-event', $evenement)
            ->with('success', 'Catégorie supprimée.');
    }

    public function reorder(Request $request)
    {
        $request->validate(['ids' => ['required', 'array'], 'ids.*' => ['integer']]);

        foreach ($request->ids as $ordre => $id) {
            BilletCategorie::where('id', $id)->update(['ordre' => $ordre]);
        }

        return response()->json(['ok' => true]);
    }
}
