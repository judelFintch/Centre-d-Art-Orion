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
        if (Schema::hasTable('podcast_episodes')) {
            $episodes = PodcastEpisode::published()->get();

            if ($episodes->isNotEmpty()) {
                return $episodes;
            }
        }

        return collect([
            (object) [
                'title' => "Dans les coulisses d'un atelier",
                'series' => "Dans l'atelier",
                'episode_number' => '01',
                'guest' => 'Équipe Orion',
                'duration' => '38 min',
                'excerpt' => "Comment naît une oeuvre entre intuition, technique et accompagnement.",
                'description' => "Une immersion dans les gestes et les voix de la création.",
                'audio_source' => null,
                'cover_source' => asset('images/10.jpg'),
                'accent' => '#4caf7d',
                'featured' => true,
            ],
            (object) [
                'title' => 'Former un regard artistique',
                'series' => 'Transmission',
                'episode_number' => '02',
                'guest' => 'Pôle Formation',
                'duration' => '31 min',
                'excerpt' => "La formation comme discipline du geste, de l'écoute et du regard.",
                'description' => "Une conversation sur la pédagogie artistique et la progression.",
                'audio_source' => null,
                'cover_source' => asset('images/6.jpg'),
                'accent' => '#d4a030',
                'featured' => false,
            ],
            (object) [
                'title' => 'Résidence : créer avec le temps',
                'series' => 'Création',
                'episode_number' => '03',
                'guest' => 'Centre Orion',
                'duration' => '44 min',
                'excerpt' => "Pourquoi le temps long change la qualité d'une recherche artistique.",
                'description' => "Une discussion sur les résidences et les processus longs.",
                'audio_source' => null,
                'cover_source' => asset('images/5.jpg'),
                'accent' => '#e07030',
                'featured' => false,
            ],
        ]);
    }
}
