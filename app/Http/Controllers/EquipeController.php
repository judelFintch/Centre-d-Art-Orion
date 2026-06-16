<?php

namespace App\Http\Controllers;

use App\Models\EquipeMembre;

class EquipeController extends Controller
{
    public function index()
    {
        $membres = EquipeMembre::actif()->get()->groupBy('role');
        return view('pages.equipe', compact('membres'));
    }

    public function show(EquipeMembre $equipe)
    {
        abort_unless($equipe->actif, 404);

        return view('pages.equipe-show', compact('equipe'));
    }
}
