<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

/**
 * Active la langue portée par le segment {locale} de l'URL et la mémorise
 * en session pour que la redirection depuis "/" propose la dernière langue choisie.
 */
class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale');

        if (! in_array($locale, config('locales.supported'), true)) {
            abort(404);
        }

        App::setLocale($locale);
        Carbon::setLocale($locale);
        URL::defaults(['locale' => $locale]);
        session(['locale' => $locale]);

        return $next($request);
    }
}
