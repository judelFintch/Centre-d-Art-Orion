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
        $heroSlides = HeroSlide::actif()->ordonne()->get();

        if ($heroSlides->isEmpty()) {
            $heroSlides = collect([(object)[
                'image'     => null,
                'accent'    => '#4caf7d',
                'label'     => 'Bienvenue',
                'title_one' => "CENTRE D'ART",
                'title_two' => 'ORION',
                'lead'      => 'Production · Création · Formation.',
                'cta_label' => 'Découvrir',
                'cta_url'   => route('about'),
            ]]);
        }
        $formations  = Formation::actif()->take(3)->get();
        $evenements  = Evenement::actif()->aVenir()->take(3)->get();
        $temoignages = Temoignage::actif()->take(4)->get();
        $galerie     = GalerieItem::actif()->take(6)->get();

        return view('pages.home', compact('heroSlides', 'formations', 'evenements', 'temoignages', 'galerie'));
    }
}
