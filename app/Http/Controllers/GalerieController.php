<?php

namespace App\Http\Controllers;

use App\Models\GalerieItem;

class GalerieController extends Controller
{
    public function index()
    {
        $items     = GalerieItem::actif()->get();
        $photos    = $items->where('type', 'photo');
        $videos    = $items->where('type', 'video');
        $categories = $items->pluck('categorie')->unique()->filter()->values();

        return view('pages.galerie', compact('items', 'photos', 'videos', 'categories'));
    }
}
