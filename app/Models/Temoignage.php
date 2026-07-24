<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Temoignage extends Model
{
    use HasTranslations;

    protected $fillable = [
        'auteur', 'poste', 'photo', 'contenu', 'note', 'actif', 'ordre',
    ];

    public array $translatable = [
        'poste', 'contenu',
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
