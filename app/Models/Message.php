<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'nom', 'email', 'telephone', 'sujet', 'message',
        'statut', 'archiver', 'lu_le',
    ];

    protected $casts = [
        'archiver' => 'boolean',
        'lu_le'    => 'datetime',
    ];

    public function scopeNonLu($query)
    {
        return $query->where('statut', 'non_lu');
    }
}
