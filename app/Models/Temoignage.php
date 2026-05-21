<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temoignage extends Model
{
    protected $fillable = [
        'auteur', 'poste', 'photo', 'contenu', 'note', 'actif', 'ordre',
    ];

    protected $casts = [
        'actif' => 'boolean',
        'note'  => 'integer',
    ];

    public function scopeActif($query)
    {
        return $query->where('actif', true)->orderBy('ordre');
    }
}
