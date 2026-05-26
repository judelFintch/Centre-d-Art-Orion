<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PodcastEpisode extends Model
{
    protected $fillable = [
        'title', 'slug', 'series', 'episode_number', 'guest', 'duration',
        'excerpt', 'description', 'transcript', 'audio_url', 'audio_file',
        'cover_image', 'accent', 'featured', 'actif', 'published_at', 'ordre',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'actif' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function scopePublished($query)
    {
        return $query
            ->where('actif', true)
            ->where(fn ($q) => $q->whereNull('published_at')->orWhere('published_at', '<=', now()))
            ->orderByDesc('featured')
            ->orderBy('ordre')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at');
    }

    public function getAudioSourceAttribute(): ?string
    {
        return $this->audio_file ? Storage::url($this->audio_file) : $this->audio_url;
    }

    public function getCoverSourceAttribute(): string
    {
        return $this->cover_image ? Storage::url($this->cover_image) : asset('images/11.jpg');
    }
}
