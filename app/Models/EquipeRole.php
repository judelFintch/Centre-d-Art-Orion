<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class EquipeRole extends Model
{
    use HasTranslations;

    protected $fillable = ['nom', 'slug', 'couleur', 'actif', 'ordre'];

    public array $translatable = [
        'nom',
    ];

    protected $casts = [
        'actif' => 'boolean',
        'ordre' => 'integer',
    ];

    public static function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name, '_') ?: 'role';
        $slug = $base;
        $i = 2;

        while (static::where('slug', $slug)->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base.'_'.$i++;
        }

        return $slug;
    }

    public function membres()
    {
        return $this->hasMany(EquipeMembre::class, 'role', 'slug');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('ordre')->orderBy('nom');
    }

    public function scopeActif($query)
    {
        return $query->where('actif', true)->ordered();
    }
}
