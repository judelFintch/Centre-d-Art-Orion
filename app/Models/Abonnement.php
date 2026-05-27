<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Abonnement extends Model
{
    protected $fillable = ['email', 'nom', 'type', 'token', 'unsubscribed_at'];

    protected $casts = [
        'unsubscribed_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Abonnement $model) {
            if (empty($model->token)) {
                $model->token = Str::random(64);
            }
        });
    }

    public function scopeActifs($query)
    {
        return $query->whereNull('unsubscribed_at');
    }

    public function scopeNewsletter($query)
    {
        return $query->where('type', 'newsletter');
    }

    public function scopeBlog($query)
    {
        return $query->where('type', 'blog');
    }

    public function isActif(): bool
    {
        return is_null($this->unsubscribed_at);
    }
}
