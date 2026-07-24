<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Encapsule le contenu existant (texte français brut) au format JSON attendu par
 * spatie/laravel-translatable : {"fr": "texte existant"}. Sans cette étape, le
 * contenu déjà en base ne serait plus lisible une fois les modèles convertis en
 * champs traduisibles (le JSON invalide est traité comme "aucune traduction").
 */
return new class extends Migration
{
    /** @var array<string, array<int, string>> */
    private array $map = [
        'formations' => ['titre', 'description', 'contenu', 'duree', 'niveau', 'public_cible', 'categorie'],
        'evenements' => ['titre', 'description', 'contenu', 'lieu', 'type'],
        'galerie_items' => ['titre', 'description', 'categorie'],
        'equipe_membres' => ['poste', 'bio'],
        'blog_posts' => ['title', 'category', 'read_time', 'excerpt', 'content', 'quote'],
        'hero_slides' => ['label', 'title_one', 'title_two', 'lead', 'cta_label'],
        'podcast_episodes' => ['title', 'series', 'excerpt', 'description', 'transcript'],
        'temoignages' => ['poste', 'contenu'],
        'billet_categories' => ['nom', 'description'],
        'equipe_roles' => ['nom'],
        'page_settings' => ['value'],
    ];

    public function up(): void
    {
        foreach ($this->map as $table => $columns) {
            if (! DB::getSchemaBuilder()->hasTable($table)) {
                continue;
            }

            DB::table($table)->orderBy('id')->select(array_merge(['id'], $columns))
                ->get()
                ->each(function ($row) use ($table, $columns) {
                    $updates = [];

                    foreach ($columns as $column) {
                        $raw = $row->{$column};

                        if ($raw === null || $raw === '') {
                            continue;
                        }

                        $decoded = json_decode($raw, true);

                        // Déjà un objet JSON de traductions (ex : migration relancée) → on laisse tel quel.
                        if (is_array($decoded)) {
                            continue;
                        }

                        $updates[$column] = json_encode(['fr' => $raw], JSON_UNESCAPED_UNICODE);
                    }

                    if ($updates !== []) {
                        DB::table($table)->where('id', $row->id)->update($updates);
                    }
                });
        }
    }

    public function down(): void
    {
        foreach ($this->map as $table => $columns) {
            if (! DB::getSchemaBuilder()->hasTable($table)) {
                continue;
            }

            DB::table($table)->orderBy('id')->select(array_merge(['id'], $columns))
                ->get()
                ->each(function ($row) use ($table, $columns) {
                    $updates = [];

                    foreach ($columns as $column) {
                        $raw = $row->{$column};

                        if (! $raw) {
                            continue;
                        }

                        $decoded = json_decode($raw, true);

                        if (is_array($decoded) && array_key_exists('fr', $decoded)) {
                            $updates[$column] = $decoded['fr'];
                        }
                    }

                    if ($updates !== []) {
                        DB::table($table)->where('id', $row->id)->update($updates);
                    }
                });
        }
    }
};
