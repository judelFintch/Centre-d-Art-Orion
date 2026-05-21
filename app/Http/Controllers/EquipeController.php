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
}
