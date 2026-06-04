<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BilletCategorie extends Model
{
    protected $table = 'billet_categories';

    protected $fillable = ['evenement_id', 'nom', 'description', 'prix', 'actif', 'ordre'];

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
