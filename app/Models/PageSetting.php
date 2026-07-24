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
        $cacheKey = $key.'|'.app()->getLocale();

        if (!array_key_exists($cacheKey, static::$cache)) {
            $row = static::where('key', $key)->first();
            static::$cache[$cacheKey] = $row ? $row->value : null;
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

        if (is_array($value)) {
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
}
