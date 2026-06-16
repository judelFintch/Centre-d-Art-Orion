<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EquipeRole;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EquipeRoleAdminController extends Controller
{
    public function index(): View
    {
        $roles = EquipeRole::withCount('membres')->ordered()->get();

        return view('admin.equipe-roles.index', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['slug'] = EquipeRole::uniqueSlug($data['nom']);
        $data['actif'] = $request->boolean('actif', true);
        $data['ordre'] = $data['ordre'] ?? ((EquipeRole::max('ordre') ?? 0) + 1);

        EquipeRole::create($data);

        return back()->with('success', 'Rôle ajouté avec succès.');
    }

    public function update(Request $request, EquipeRole $role): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['actif'] = $request->boolean('actif');

        $role->update($data);

        return back()->with('success', 'Rôle mis à jour.');
    }

    public function toggle(EquipeRole $role): RedirectResponse
    {
        $role->update(['actif' => ! $role->actif]);

        return back()->with('success', 'Visibilité du rôle mise à jour.');
    }

    public function destroy(EquipeRole $role): RedirectResponse
    {
        if ($role->membres()->exists()) {
            return back()->with('error', 'Impossible de supprimer ce rôle : il est encore utilisé par des membres.');
        }

        $role->delete();

        return back()->with('success', 'Rôle supprimé.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'nom' => ['required', 'string', 'max:120'],
            'couleur' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'ordre' => ['nullable', 'integer', 'min:0'],
            'actif' => ['nullable', 'boolean'],
        ], [
            'couleur.regex' => 'La couleur doit être au format hexadécimal, par exemple #4caf7d.',
        ]);
    }
}
