<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    protected $fillable = [
        'label', 'title_one', 'title_two', 'lead',
        'cta_label', 'cta_url', 'accent', 'image',
        'ordre', 'actif',
    ];

    protected $casts = ['actif' => 'boolean'];

    public static function defaultSlides(): array
    {
        return [
            ['label' => 'Production', 'title_one' => 'DONNER VIE', 'title_two' => "A L'OEUVRE", 'lead' => 'Studios, techniques et savoir-faire pour transformer chaque vision en création aboutie.', 'cta_label' => 'Voir nos services', 'cta_url' => '/services', 'accent' => '#e07030', 'ordre' => 1],
            ['label' => 'Formation', 'title_one' => 'APPRENDRE', 'title_two' => 'PROGRESSER', 'lead' => 'Des programmes concrets pour grandir, créer et professionnaliser son talent artistique.', 'cta_label' => 'Voir nos formations', 'cta_url' => '/formations', 'accent' => '#4caf7d', 'ordre' => 2],
            ['label' => 'Création', 'title_one' => "L'ART NAIT", 'title_two' => 'ICI', 'lead' => 'Résidences, ateliers et collaborations pour faire éclore des œuvres uniques et audacieuses.', 'cta_label' => 'Voir la galerie', 'cta_url' => '/galerie', 'accent' => '#d4a030', 'ordre' => 3],
            ['label' => 'Inspiration', 'title_one' => "L'ÉTINCELLE", 'title_two' => 'EST EN VOUS', 'lead' => 'Un espace vivant où chaque artiste puise, partage et rayonne au-delà des frontières.', 'cta_label' => 'Notre histoire', 'cta_url' => '/a-propos', 'accent' => '#4caf7d', 'ordre' => 4],
        ];
    }

    public static function loadDefaultSlides(): int
    {
        $created = 0;

        foreach (self::defaultSlides() as $slide) {
            $heroSlide = self::firstOrCreate(
                ['label' => $slide['label'], 'title_one' => $slide['title_one']],
                array_merge($slide, ['actif' => true])
            );

            if ($heroSlide->wasRecentlyCreated) {
                $created++;
            }
        }

        return $created;
    }

    public function scopeActif($q)  { return $q->where('actif', true); }
    public function scopeOrdonne($q){ return $q->orderBy('ordre')->orderBy('id'); }
}
