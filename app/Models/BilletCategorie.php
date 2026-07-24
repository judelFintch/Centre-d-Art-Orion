<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class BilletCategorie extends Model
{
    use HasTranslations;

    protected $table = 'billet_categories';

    protected $fillable = ['evenement_id', 'nom', 'description', 'prix', 'actif', 'ordre'];

    public array $translatable = [
        'nom', 'description',
    ];

    protected $casts = [
        'prix'  => 'decimal:2',
        'actif' => 'boolean',
        'ordre' => 'integer',
    ];

    public function evenement()
    {
        return $this->belongsTo(Evenement::class);
    }

    public function billets()
    {
        return $this->hasMany(Billet::class);
    }

    public function scopeActif($query)
    {
        return $query->where('actif', true)->orderBy('ordre');
    }
}
