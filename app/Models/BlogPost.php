<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BlogPost extends Model
{
    protected $fillable = [
        'title', 'slug', 'category', 'author', 'read_time',
        'excerpt', 'content', 'quote', 'image', 'gallery',
        'featured', 'actif', 'published_at', 'ordre', 'views',
    ];

    protected $casts = [
        'gallery' => 'array',
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

    public function toArticleArray(): array
    {
        return [
            'admin_id' => $this->id,
            'views' => $this->views ?? 0,
            'slug' => $this->slug,
            'title' => $this->title,
            'category' => $this->category ?: 'Blog',
            'date' => optional($this->published_at ?: $this->created_at)->translatedFormat('j F Y'),
            'read_time' => $this->read_time ?: '4 min',
            'author' => $this->author ?: 'Équipe Orion',
            'image' => $this->image ? Storage::url($this->image) : 'images/10.jpg',
            'excerpt' => $this->excerpt,
            'content_html' => $this->formattedContent(),
            'body' => collect(preg_split("/\R{2,}/", trim($this->content)))
                ->filter()
                ->values()
                ->all(),
            'quote' => $this->quote,
            'gallery' => collect($this->gallery ?: [])
                ->map(fn ($path) => Storage::url($path))
                ->values()
                ->all(),
        ];
    }

    private function formattedContent(): string
    {
        $allowedTags = '<p><br><strong><b><em><i><u><h2><h3><h4><blockquote><ul><ol><li><a>';

        if ($this->content !== strip_tags($this->content)) {
            return strip_tags($this->content, $allowedTags);
        }

        return collect(preg_split("/\R{2,}/", trim($this->content)))
            ->filter()
            ->map(fn ($paragraph) => '<p>'.e($paragraph).'</p>')
            ->implode('');
    }
}
