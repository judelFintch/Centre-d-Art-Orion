<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $fillable = [
        'titre', 'slug', 'description', 'contenu', 'duree',
        'niveau', 'public_cible', 'prix', 'image', 'categorie',
        'actif', 'ordre',
    ];

    protected $casts = [
        'actif' => 'boolean',
        'prix'  => 'decimal:2',
    ];

    public function scopeActif($query)
    {
        return $query->where('actif', true)->orderBy('ordre');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
