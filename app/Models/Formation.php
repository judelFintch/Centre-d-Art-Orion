<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Formation extends Model
{
    use HasTranslations;

    protected $fillable = [
        'titre', 'slug', 'description', 'contenu', 'duree',
        'niveau', 'public_cible', 'prix', 'image', 'categorie',
        'actif', 'ordre',
    ];

    public array $translatable = [
        'titre', 'description', 'contenu', 'duree', 'niveau', 'public_cible', 'categorie',
    ];

    protected $casts = [
        'actif' => 'boolean',
        'prix'  => 'decimal:2',
    ];

    public function scopeActif($query)
    {
        return $query->where('actif', true)->orderBy('ordre');
    }

}
