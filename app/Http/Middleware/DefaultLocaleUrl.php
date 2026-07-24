<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

/**
 * Fournit une valeur par défaut pour le paramètre {locale} des routes publiques,
 * afin que route('home') (et assimilés) fonctionne aussi depuis des pages
 * hors préfixe de langue (admin, connexion...). SetLocale (sur le groupe
 * {locale}) écrase ensuite cette valeur avec la langue réellement active.
 */
class DefaultLocaleUrl
{
    public function handle(Request $request, Closure $next): Response
    {
        URL::defaults(['locale' => $request->session()->get('locale', config('locales.default'))]);

        return $next($request);
    }
}
