<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    protected $fillable = [
        'titre', 'slug', 'description', 'contenu', 'date_debut', 'date_fin',
        'lieu', 'image', 'statut', 'type', 'prix', 'gratuit',
        'lien_inscription', 'actif',
    ];

    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin'   => 'datetime',
        'actif'      => 'boolean',
        'gratuit'    => 'boolean',
        'prix'       => 'decimal:2',
    ];

    public function scopeActif($query)
    {
        return $query->where('actif', true);
    }

    public function scopeAVenir($query)
    {
        return $query->where('statut', 'a_venir')->orderBy('date_debut');
    }

    public function scopePasse($query)
    {
        return $query->where('statut', 'passe')->orderByDesc('date_debut');
    }

    public function billets()
    {
        return $this->hasMany(Billet::class);
    }

    public function billetCategories()
    {
        return $this->hasMany(BilletCategorie::class)->orderBy('ordre');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }

        if (
            str_starts_with($this->image, 'http://')
            || str_starts_with($this->image, 'https://')
            || str_starts_with($this->image, '/')
        ) {
            return $this->image;
        }

        return asset('storage/'.$this->image);
    }
}
