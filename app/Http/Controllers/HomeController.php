<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Evenement;
use App\Models\Temoignage;
use App\Models\GalerieItem;
use App\Models\HeroSlide;

class HomeController extends Controller
{
    public function index()
    {
        $heroSlides  = HeroSlide::actif()->ordonne()->get();
        $formations  = Formation::actif()->take(3)->get();
        $evenements  = Evenement::actif()->aVenir()->take(3)->get();
        $temoignages = Temoignage::actif()->take(4)->get();
        $galerie     = GalerieItem::actif()->take(6)->get();

        return view('pages.home', compact('heroSlides', 'formations', 'evenements', 'temoignages', 'galerie'));
    }
}
