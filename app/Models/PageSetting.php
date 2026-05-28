<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSetting extends Model
{
    protected $fillable = ['key', 'value'];

    /** Cache en mémoire pour éviter les requêtes répétées */
    protected static array $cache = [];

    /**
     * Lire un paramètre (avec cache + valeur par défaut).
     */
    public static function get(string $key, string $default = ''): string
    {
        if (!array_key_exists($key, static::$cache)) {
            $row = static::where('key', $key)->first();
            static::$cache[$key] = $row ? $row->value : null;
        }

        return static::$cache[$key] ?? $default;
    }

    /**
     * Écrire / mettre à jour un paramètre (vide le cache).
     */
    public static function set(string $key, string $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        static::$cache[$key] = $value;
    }

    /**
     * Sauvegarder en masse un tableau ['key' => 'value'].
     */
    public static function saveMany(array $data): void
    {
        foreach ($data as $key => $value) {
            static::set($key, (string) ($value ?? ''));
        }
    }

    /**
     * Retourner tous les paramètres d'une page sous forme ['key' => 'value'].
     */
    public static function forPage(string $prefix): array
    {
        return static::where('key', 'like', $prefix . '.%')
            ->pluck('value', 'key')
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
