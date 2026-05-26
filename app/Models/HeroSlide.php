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

    public function scopeActif($q)  { return $q->where('actif', true); }
    public function scopeOrdonne($q){ return $q->orderBy('ordre')->orderBy('id'); }
}
