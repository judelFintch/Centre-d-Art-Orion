<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PageSetting extends Model
{
    use HasTranslations;

    protected $fillable = ['key', 'value'];

    public array $translatable = ['value'];

    /** Cache en mémoire pour éviter les requêtes répétées (clé + locale) */
    protected static array $cache = [];

    /**
     * Lire un paramètre dans la langue courante (avec cache + valeur par défaut).
     */
    public static function get(string $key, string $default = ''): string
    {
        $sharedImage = static::isSharedHomeImage($key);
        $cacheKey = $key.'|'.($sharedImage ? 'shared-image' : app()->getLocale());

        if (!array_key_exists($cacheKey, static::$cache)) {
            $row = static::where('key', $key)->first();

            if ($row && $sharedImage) {
                $translations = $row->getTranslations('value');
                static::$cache[$cacheKey] = $translations['fr']
                    ?? $translations['en']
                    ?? collect($translations)->first(fn ($value) => filled($value));
            } else {
                static::$cache[$cacheKey] = $row ? $row->value : null;
            }
        }

        return static::$cache[$cacheKey] ?: $default;
    }

    /**
     * Écrire / mettre à jour un paramètre (vide le cache).
     * $value peut être une chaîne (langue courante uniquement) ou un tableau ['fr' => ..., 'en' => ...].
     */
    public static function set(string $key, array|string $value): void
    {
        $setting = static::firstOrNew(['key' => $key]);

        if (static::isSharedHomeImage($key) && is_string($value)) {
            // Les médias sont communs aux versions française et anglaise.
            $setting->setTranslations('value', ['fr' => $value, 'en' => $value]);
        } elseif (is_array($value)) {
            $setting->setTranslations('value', array_merge($setting->getTranslations('value'), $value));
        } else {
            $setting->setTranslation('value', app()->getLocale(), $value);
        }

        $setting->save();
        static::clearCache();
    }

    /**
     * Sauvegarder en masse un tableau ['key' => 'value'] (chaîne ou tableau de traductions).
     */
    public static function saveMany(array $data): void
    {
        foreach ($data as $key => $value) {
            static::set($key, is_array($value) ? $value : (string) ($value ?? ''));
        }
    }

    /**
     * Retourner tous les paramètres d'une page, localisés, sous forme ['key' => 'value'].
     */
    public static function forPage(string $prefix): array
    {
        return static::where('key', 'like', $prefix . '.%')
            ->get()
            ->mapWithKeys(fn (self $row) => [$row->key => $row->value])
            ->toArray();
    }

    /**
     * Retourner toutes les traductions brutes d'une page : ['key' => ['fr' => ..., 'en' => ...]].
     * Utile pour préremplir un formulaire d'admin bilingue.
     */
    public static function forPageRaw(string $prefix): array
    {
        return static::where('key', 'like', $prefix . '.%')
            ->get()
            ->mapWithKeys(fn (self $row) => [$row->key => $row->getTranslations('value')])
            ->toArray();
    }

    /**
     * Vider le cache (utile en tests).
     */
    public static function clearCache(): void
    {
        static::$cache = [];
    }

    /**
     * Les images administrables de la page d'accueil sont des médias partagés :
     * seule leur légende éventuelle varie selon la langue.
     */
    private static function isSharedHomeImage(string $key): bool
    {
        return str_starts_with($key, 'home.')
            && preg_match('/(?:_file|_img|_photo)$/', $key) === 1;
    }
}
