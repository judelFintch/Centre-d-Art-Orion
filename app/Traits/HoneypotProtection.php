<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Protection anti-bot par champ piège (honeypot) + vérification du délai de soumission.
 *
 * Utilisation dans un controller :
 *   use HoneypotProtection;
 *
 *   if ($this->isBot($request)) {
 *       return $this->fakeSuccess($request);
 *   }
 */
trait HoneypotProtection
{
    /**
     * Détecte un bot si :
     *  (1) Le champ honeypot (_hp_website) est rempli, OU
     *  (2) Le formulaire a été soumis en moins de MINIMUM_FILL_SECONDS secondes.
     */
    protected function isBot(Request $request): bool
    {
        // 1. Champ piège — un humain ne le voit/remplit jamais
        if ($request->filled('_hp_website')) {
            return true;
        }

        // 2. Vérification du temps de remplissage (minimum 3 secondes)
        $loadedAt = $request->input('_form_loaded_at');
        if ($loadedAt !== null) {
            $loadedAt = (int) base64_decode($loadedAt, true);
            if ($loadedAt && (time() - $loadedAt) < 3) {
                return true;
            }
        }

        return false;
    }

    /**
     * Retourne une fausse réponse "succès" pour ne pas alerter le bot.
     * Le message est identique à celui d'un vrai succès.
     */
    protected function fakeSuccess(Request $request, string $message = 'Merci ! Votre demande a bien été prise en compte.'): JsonResponse|RedirectResponse
    {
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
            ]);
        }

        return back()->with('success', $message);
    }
}
