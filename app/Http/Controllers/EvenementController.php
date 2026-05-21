<?php

namespace App\Http\Controllers;

use App\Models\Evenement;

class EvenementController extends Controller
{
    public function index()
    {
        $aVenir = Evenement::actif()->aVenir()->get();
        $passes = Evenement::actif()->passe()->take(6)->get();
        return view('pages.evenements', compact('aVenir', 'passes'));
    }

    public function show(Evenement $evenement)
    {
        $autres = Evenement::actif()
            ->where('id', '!=', $evenement->id)
            ->aVenir()
            ->take(3)
            ->get();
        return view('pages.evenement-detail', compact('evenement', 'autres'));
    }
}
