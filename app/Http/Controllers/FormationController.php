<?php

namespace App\Http\Controllers;

use App\Models\Formation;

class FormationController extends Controller
{
    public function index()
    {
        $paginator  = Formation::actif()->paginate(9);
        $formations = $paginator->getCollection()->groupBy('categorie');
        return view('pages.formations', compact('formations', 'paginator'));
    }

    public function show(string $locale, Formation $formation)
    {
        $autres = Formation::actif()
            ->where('id', '!=', $formation->id)
            ->take(3)
            ->get();
        return view('pages.formation-detail', compact('formation', 'autres'));
    }
}
