<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visite extends Model
{
    protected $fillable = [
        'session_id',
        'page_url',
        'page_titre',
        'referrer',
        'appareil',
        'navigateur',
        'os',
        'ip_anonyme',
        'temps_passe',
        'profondeur_scroll',
        'est_nouveau_visiteur',
    ];

    protected $casts = [
        'est_nouveau_visiteur' => 'boolean',
        'temps_passe'          => 'integer',
        'profondeur_scroll'    => 'integer',
    ];
}
