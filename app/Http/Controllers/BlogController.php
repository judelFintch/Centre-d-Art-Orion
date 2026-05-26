<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $articles = $this->articles();
        $featured = $articles->first();
        $categories = $this->categories($articles);
        $activeCategory = null;

        return view('pages.blog', compact('articles', 'featured', 'categories', 'activeCategory'));
    }

    public function category(string $category)
    {
        $allArticles = $this->articles();
        $categories = $this->categories($allArticles);
        $activeCategory = $categories->firstWhere('slug', $category);

        abort_unless($activeCategory, 404);

        $articles = $allArticles
            ->filter(fn ($article) => Str::slug($article['category']) === $category)
            ->values();

        $featured = $articles->first();

        return view('pages.blog', compact('articles', 'featured', 'categories', 'activeCategory'));
    }

    public function show(string $slug)
    {
        $articles = $this->articles();
        $article = $articles->firstWhere('slug', $slug);

        abort_unless($article, 404);

        $related = $articles
            ->where('slug', '!=', $slug)
            ->where('category', $article['category'])
            ->take(2);

        if ($related->count() < 2) {
            $related = $related->merge(
                $articles->where('slug', '!=', $slug)->whereNotIn('slug', $related->pluck('slug'))->take(2 - $related->count())
            );
        }

        return view('pages.blog-show', compact('article', 'related'));
    }

    private function articles(): Collection
    {
        if (Schema::hasTable('blog_posts')) {
            $posts = BlogPost::published()->get();

            if ($posts->isNotEmpty()) {
                return $posts->map(fn (BlogPost $post) => $post->toArticleArray());
            }
        }

        return collect([
            [
                'slug' => 'dans-les-coulisses-d-un-atelier-orion',
                'title' => "Dans les coulisses d'un atelier Orion",
                'category' => 'Coulisses',
                'date' => '26 mai 2026',
                'read_time' => '5 min',
                'author' => 'Équipe Orion',
                'image' => 'images/10.jpg',
                'excerpt' => "Avant qu'une oeuvre ne rencontre son public, il y a des essais, des silences, des gestes répétés et une équipe qui accompagne chaque détail.",
                'body' => [
                    "Un atelier Orion commence rarement par une réponse. Il commence par une matière posée sur la table, une intuition, une contrainte technique ou une conversation entre artistes. C'est dans cet espace encore fragile que le centre joue son rôle : protéger la recherche tout en donnant un cadre clair à la production.",
                    "Les formateurs observent les gestes, corrigent les habitudes, ouvrent des références et aident chaque participant à formuler une intention. L'objectif n'est pas d'imposer une signature, mais de rendre visible ce qui cherche déjà à apparaître dans le travail.",
                    "Cette attention au processus transforme l'atelier en laboratoire vivant. On y apprend autant à regarder qu'à produire, autant à recommencer qu'à présenter. Le résultat final compte, mais il devient plus fort parce que chaque étape a été traversée avec exigence.",
                ],
                'quote' => "Créer, c'est apprendre à écouter ce que la matière sait déjà murmurer.",
                'gallery' => ['images/4.jpg', 'images/5.jpg', 'images/7.jpg'],
            ],
            [
                'slug' => 'former-un-artiste-c-est-former-un-regard',
                'title' => "Former un artiste, c'est former un regard",
                'category' => 'Formation',
                'date' => '18 mai 2026',
                'read_time' => '4 min',
                'author' => 'Pôle Formation',
                'image' => 'images/6.jpg',
                'excerpt' => "La technique est essentielle, mais elle ne suffit pas. Une formation artistique solide apprend aussi à observer, choisir et défendre une vision.",
                'body' => [
                    "Dans nos formations, la transmission technique reste une base non négociable. Tenir un outil, comprendre une composition, préparer une scène ou enregistrer un son demande de la précision. Mais la technique devient réellement artistique lorsqu'elle sert une lecture personnelle du monde.",
                    "Former un regard signifie apprendre à distinguer ce qui fonctionne, ce qui manque, ce qui mérite d'être approfondi. Cette capacité se construit par la pratique, la critique constructive et la confrontation régulière aux oeuvres des autres.",
                    "À Orion, chaque programme cherche cet équilibre : donner des méthodes fiables et encourager une voix singulière. Le centre devient alors un lieu où l'on progresse sans perdre ce qui rend chaque parcours unique.",
                ],
                'quote' => "Le regard est le premier atelier de l'artiste.",
                'gallery' => ['images/2.jpg', 'images/3.jpg', 'images/9.jpg'],
            ],
            [
                'slug' => 'pourquoi-documenter-la-creation',
                'title' => 'Pourquoi documenter la création ?',
                'category' => 'Pensées',
                'date' => '10 mai 2026',
                'read_time' => '3 min',
                'author' => 'Direction artistique',
                'image' => 'images/22.jpg',
                'excerpt' => "Photographier, écrire et archiver les étapes d'un projet permet de transmettre plus qu'un résultat : une méthode, une mémoire et une culture.",
                'body' => [
                    "Une oeuvre terminée montre une forme. Sa documentation raconte le chemin qui l'a rendue possible. Croquis, photos d'atelier, notes de répétition, extraits sonores et témoignages composent une mémoire précieuse pour les artistes comme pour le public.",
                    "Documenter ne signifie pas interrompre la création. C'est au contraire apprendre à reconnaître les moments importants : une décision technique, un changement de direction, une rencontre qui modifie le projet.",
                    "Pour un centre d'art, cette mémoire devient un outil de transmission. Elle permet aux générations suivantes de comprendre comment une pratique se construit, se partage et s'inscrit dans un territoire.",
                ],
                'quote' => "Une archive bien tenue prolonge la vie d'une oeuvre.",
                'gallery' => ['images/11.jpg', 'images/16.jpg', 'images/1.png'],
            ],
            [
                'slug' => 'residence-artistique-creer-avec-le-temps',
                'title' => 'Résidence artistique : créer avec le temps',
                'category' => 'Création',
                'date' => '2 mai 2026',
                'read_time' => '6 min',
                'author' => 'Centre Orion',
                'image' => 'images/5.jpg',
                'excerpt' => "Une résidence offre aux artistes un luxe rare : du temps concentré, des ressources disponibles et un dialogue constant avec un lieu.",
                'body' => [
                    "La résidence artistique n'est pas seulement une période de travail. C'est une immersion. L'artiste entre dans un rythme où la recherche, l'expérimentation et la production peuvent dialoguer sans être compressées par l'urgence.",
                    "Le centre accompagne cette durée par des espaces, des outils et des retours réguliers. Les échanges avec les formateurs, techniciens et autres créateurs permettent d'ouvrir des pistes que l'artiste n'aurait pas toujours identifiées seul.",
                    "Créer avec le temps, c'est accepter que certaines idées doivent mûrir. C'est aussi apprendre à reconnaître le moment où une forme est prête à sortir de l'atelier pour rencontrer le public.",
                ],
                'quote' => "Le temps n'est pas un décor de la création, c'est une matière.",
                'gallery' => ['images/10.jpg', 'images/7.jpg', 'images/4.jpg'],
            ],
        ]);
    }

    private function categories(Collection $articles): Collection
    {
        return $articles
            ->pluck('category')
            ->unique()
            ->values()
            ->map(fn ($category) => [
                'name' => $category,
                'slug' => Str::slug($category),
                'count' => $articles->where('category', $category)->count(),
            ]);
    }
}
