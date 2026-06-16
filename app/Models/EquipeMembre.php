<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipeMembre extends Model
{
    protected $fillable = [
        'nom', 'prenom', 'poste', 'role', 'bio', 'photo',
        'email', 'telephone', 'reseaux_sociaux', 'competences',
        'actif', 'ordre',
    ];

    protected $casts = [
        'actif'          => 'boolean',
        'reseaux_sociaux' => 'array',
        'competences'    => 'array',
    ];

    public function scopeActif($query)
    {
        return $query->where('actif', true)->orderBy('ordre');
    }

    public function getNomCompletAttribute(): string
    {
        return "{$this->prenom} {$this->nom}";
    }

    public function roleOption()
    {
        return $this->belongsTo(EquipeRole::class, 'role', 'slug');
    }

    public function getRoleLabelAttribute(): string
    {
        return $this->roleOption?->nom ?: ucfirst(str_replace('_', ' ', $this->role));
    }

    public function getRoleColorAttribute(): string
    {
        return $this->roleOption?->couleur ?: '#4caf7d';
    }

    public function getPhotoUrlAttribute(): ?string
    {
        if (! $this->photo) {
            return null;
        }

        if (
            str_starts_with($this->photo, 'http://')
            || str_starts_with($this->photo, 'https://')
            || str_starts_with($this->photo, '/')
        ) {
            return $this->photo;
        }

        return asset('storage/'.$this->photo);
    }
}
