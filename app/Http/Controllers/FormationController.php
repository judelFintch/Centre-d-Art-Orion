<?php

namespace App\Http\Controllers;

use App\Models\Formation;

class FormationController extends Controller
{
    public function index()
    {
        $formations = Formation::actif()->get()->groupBy('categorie');
        return view('pages.formations', compact('formations'));
    }

    public function show(Formation $formation)
    {
        $autres = Formation::actif()
            ->where('id', '!=', $formation->id)
            ->take(3)
            ->get();
        return view('pages.formation-detail', compact('formation', 'autres'));
    }
}
