<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalerieItem extends Model
{
    protected $fillable = [
        'titre', 'description', 'fichier', 'miniature',
        'type', 'categorie', 'url_video', 'actif', 'ordre',
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
