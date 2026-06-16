<?php

namespace App\Http\Controllers;

use App\Models\EquipeMembre;
use App\Models\EquipeRole;

class EquipeController extends Controller
{
    public function index()
    {
        $membres = EquipeMembre::with('roleOption')->actif()->get();
        $roles = EquipeRole::actif()->get();
        $roleSlugs = $roles->pluck('slug');

        $sections = $roles->map(fn ($role) => [
            'label' => $role->nom,
            'color' => $role->couleur,
            'membres' => $membres->where('role', $role->slug)->values(),
        ])->filter(fn ($section) => $section['membres']->isNotEmpty())->values();

        $autres = $membres->reject(fn ($membre) => $roleSlugs->contains($membre->role))->values();

        if ($autres->isNotEmpty()) {
            $sections->push([
                'label' => 'Autres membres',
                'color' => '#4caf7d',
                'membres' => $autres,
            ]);
        }

        return view('pages.equipe', compact('sections'));
    }

    public function show(EquipeMembre $equipe)
    {
        abort_unless($equipe->actif, 404);

        $equipe->load('roleOption');

        return view('pages.equipe-show', compact('equipe'));
    }
}
