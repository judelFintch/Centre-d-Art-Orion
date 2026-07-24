<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Applique les traductions anglaises soumises via des champs `{champ}_en`
 * en plus des champs français gérés normalement par le formulaire.
 * L'admin reste en français ; ces champs optionnels alimentent la version EN du site public.
 */
trait HandlesTranslations
{
    protected function applyEnglishTranslations(Model $model, Request $request, array $fields): void
    {
        $dirty = false;

        foreach ($fields as $field) {
            $value = $request->input($field.'_en');

            if ($value !== null) {
                $model->setTranslation($field, 'en', $value);
                $dirty = true;
            }
        }

        if ($dirty) {
            $model->save();
        }
    }
}
