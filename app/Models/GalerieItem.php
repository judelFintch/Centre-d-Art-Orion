<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class GalerieItem extends Model
{
    use HasTranslations;

    protected $fillable = [
        'titre', 'description', 'fichier', 'miniature',
        'type', 'categorie', 'url_video', 'actif', 'ordre',
    ];

    public array $translatable = [
        'titre', 'description', 'categorie',
    ];

    protected $casts = [
        'actif' => 'boolean',
    ];

    public function scopeActif($query)
    {
        return $query->where('actif', true)->orderBy('ordre');
    }

    public function scopePhotos($query)
    {
        return $query->where('type', 'photo');
    }

    public function scopeVideos($query)
    {
        return $query->where('type', 'video');
    }
}
