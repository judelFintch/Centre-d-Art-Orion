<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HeroSlide extends Model
{
    use HasTranslations;

    protected $fillable = [
        'label', 'title_one', 'title_two', 'lead',
        'cta_label', 'cta_url', 'accent', 'image',
        'ordre', 'actif',
    ];

    public array $translatable = [
        'label', 'title_one', 'title_two', 'lead', 'cta_label',
    ];

    protected $casts = ['actif' => 'boolean'];

    public static function defaultSlides(): array
    {
        return [
            [
                'label' => ['fr' => 'Production', 'en' => 'Production'],
                'title_one' => ['fr' => 'DONNER VIE', 'en' => 'BRING TO LIFE'],
                'title_two' => ['fr' => "A L'OEUVRE", 'en' => 'THE ARTWORK'],
                'lead' => ['fr' => 'Studios, techniques et savoir-faire pour transformer chaque vision en création aboutie.', 'en' => 'Studios, techniques and expertise to turn every vision into a finished creation.'],
                'cta_label' => ['fr' => 'Voir nos services', 'en' => 'See our services'],
                'cta_url' => '/services', 'accent' => '#e07030', 'ordre' => 1,
            ],
            [
                'label' => ['fr' => 'Formation', 'en' => 'Training'],
                'title_one' => ['fr' => 'APPRENDRE', 'en' => 'LEARN'],
                'title_two' => ['fr' => 'PROGRESSER', 'en' => 'PROGRESS'],
                'lead' => ['fr' => 'Des programmes concrets pour grandir, créer et professionnaliser son talent artistique.', 'en' => 'Practical programs to grow, create and turn artistic talent into a profession.'],
                'cta_label' => ['fr' => 'Voir nos formations', 'en' => 'See our training programs'],
                'cta_url' => '/formations', 'accent' => '#4caf7d', 'ordre' => 2,
            ],
            [
                'label' => ['fr' => 'Création', 'en' => 'Creation'],
                'title_one' => ['fr' => "L'ART NAIT", 'en' => 'ART IS BORN'],
                'title_two' => ['fr' => 'ICI', 'en' => 'HERE'],
                'lead' => ['fr' => 'Résidences, ateliers et collaborations pour faire éclore des œuvres uniques et audacieuses.', 'en' => 'Residencies, workshops and collaborations to bring unique, bold works to life.'],
                'cta_label' => ['fr' => 'Voir la galerie', 'en' => 'See the gallery'],
                'cta_url' => '/galerie', 'accent' => '#d4a030', 'ordre' => 3,
            ],
            [
                'label' => ['fr' => 'Inspiration', 'en' => 'Inspiration'],
                'title_one' => ['fr' => "L'ÉTINCELLE", 'en' => 'THE SPARK'],
                'title_two' => ['fr' => 'EST EN VOUS', 'en' => 'IS WITHIN YOU'],
                'lead' => ['fr' => 'Un espace vivant où chaque artiste puise, partage et rayonne au-delà des frontières.', 'en' => 'A living space where every artist draws inspiration, shares and shines beyond borders.'],
                'cta_label' => ['fr' => 'Notre histoire', 'en' => 'Our story'],
                'cta_url' => '/a-propos', 'accent' => '#4caf7d', 'ordre' => 4,
            ],
        ];
    }

    public static function loadDefaultSlides(): int
    {
        $created = 0;

        foreach (self::defaultSlides() as $slide) {
            $heroSlide = self::firstOrCreate(
                ['label->fr' => $slide['label']['fr'], 'title_one->fr' => $slide['title_one']['fr']],
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
