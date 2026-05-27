<?php

namespace App\Http\Controllers;

use App\Models\Visite;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    // ── Enregistre une nouvelle visite de page ─────────────────────
    public function track(Request $request)
    {
        $data = $request->validate([
            'session_id'     => 'required|string|max:64',
            'page_url'       => 'required|string|max:500',
            'page_titre'     => 'nullable|string|max:300',
            'referrer'       => 'nullable|string|max:500',
        ]);

        // Détection appareil / navigateur / OS depuis le User-Agent
        $ua       = $request->userAgent() ?? '';
        $parsed   = $this->parseUserAgent($ua);

        // IP anonymisée (suppression du dernier octet — RGPD)
        $ip = $this->anonymizeIp($request->ip());

        // Nouveau visiteur ?
        $estNouveau = ! Visite::where('session_id', $data['session_id'])->exists();

        $visite = Visite::create([
            'session_id'          => $data['session_id'],
            'page_url'            => $data['page_url'],
            'page_titre'          => $data['page_titre'] ?? null,
            'referrer'            => $data['referrer'] ?? null,
            'appareil'            => $parsed['appareil'],
            'navigateur'          => $parsed['navigateur'],
            'os'                  => $parsed['os'],
            'ip_anonyme'          => $ip,
            'est_nouveau_visiteur'=> $estNouveau,
        ]);

        return response()->json(['id' => $visite->id], 201);
    }

    // ── Met à jour temps passé + profondeur scroll à la sortie ─────
    public function update(Request $request)
    {
        $data = $request->validate([
            'visite_id'        => 'required|integer|exists:visites,id',
            'temps_passe'      => 'required|integer|min:0|max:86400',
            'profondeur_scroll'=> 'required|integer|min:0|max:100',
        ]);

        Visite::where('id', $data['visite_id'])->update([
            'temps_passe'       => $data['temps_passe'],
            'profondeur_scroll' => $data['profondeur_scroll'],
        ]);

        return response()->json(['ok' => true]);
    }

    // ── Utilitaires privés ─────────────────────────────────────────

    private function parseUserAgent(string $ua): array
    {
        // Appareil
        $appareil = 'desktop';
        if (preg_match('/Mobile|Android|iPhone|Windows Phone/i', $ua)) {
            $appareil = 'mobile';
        } elseif (preg_match('/iPad|Tablet|PlayBook/i', $ua)) {
            $appareil = 'tablet';
        }

        // Navigateur (ordre important : Edge avant Chrome, OPR avant Chrome)
        $navigateur = 'Autre';
        if (str_contains($ua, 'Edg/') || str_contains($ua, 'Edge/')) {
            $navigateur = 'Edge';
        } elseif (str_contains($ua, 'OPR/') || str_contains($ua, 'Opera/')) {
            $navigateur = 'Opera';
        } elseif (str_contains($ua, 'Chrome/')) {
            $navigateur = 'Chrome';
        } elseif (str_contains($ua, 'Firefox/')) {
            $navigateur = 'Firefox';
        } elseif (str_contains($ua, 'Safari/') && ! str_contains($ua, 'Chrome/')) {
            $navigateur = 'Safari';
        }

        // OS
        $os = 'Autre';
        if (str_contains($ua, 'Windows')) {
            $os = 'Windows';
        } elseif (str_contains($ua, 'Mac OS X') || str_contains($ua, 'Macintosh')) {
            $os = 'macOS';
        } elseif (str_contains($ua, 'Android')) {
            $os = 'Android';
        } elseif (str_contains($ua, 'iPhone') || str_contains($ua, 'iPad') || str_contains($ua, 'iOS')) {
            $os = 'iOS';
        } elseif (str_contains($ua, 'Linux')) {
            $os = 'Linux';
        }

        return compact('appareil', 'navigateur', 'os');
    }

    private function anonymizeIp(?string $ip): ?string
    {
        if (! $ip) return null;

        // IPv4 → masque dernier octet
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return preg_replace('/\.\d+$/', '.xxx', $ip);
        }
        // IPv6 → garde seulement les 3 premiers groupes
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $parts = explode(':', $ip);
            return implode(':', array_slice($parts, 0, 3)) . ':xxxx';
        }

        return null;
    }
}
