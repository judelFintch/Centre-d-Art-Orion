<?php

namespace App\Http\Controllers;

use App\Models\PodcastEpisode;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class PodcastController extends Controller
{
    public function index()
    {
        $episodes = $this->episodes();
        $featured = $episodes->firstWhere('featured', true) ?: $episodes->first();

        return view('pages.podcasts', compact('episodes', 'featured'));
    }

    private function episodes(): Collection
    {
        if (! Schema::hasTable('podcast_episodes')) {
            return collect();
        }

        return PodcastEpisode::published()->get();
    }
}
