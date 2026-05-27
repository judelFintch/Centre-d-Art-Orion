<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsAdminController extends Controller
{
    public function index(Request $request)
    {
        $periode = (int) $request->get('periode', 30);
        if (! in_array($periode, [7, 30, 90])) {
            $periode = 30;
        }

        $debut = now()->subDays($periode)->startOfDay();
        $debutPrec = now()->subDays($periode * 2)->startOfDay();
        $finPrec   = now()->subDays($periode)->endOfDay();

        // ── KPI période courante ──────────────────────────────────────
        $visites        = Visite::where('created_at', '>=', $debut)->count();
        $visiteurs      = Visite::where('created_at', '>=', $debut)->distinct('session_id')->count();
        $nouveaux       = Visite::where('created_at', '>=', $debut)->where('est_nouveau_visiteur', true)->count();
        $dureeMoy       = (int) Visite::where('created_at', '>=', $debut)->where('temps_passe', '>', 0)->avg('temps_passe');
        $scrollMoy      = (int) Visite::where('created_at', '>=', $debut)->where('profondeur_scroll', '>', 0)->avg('profondeur_scroll');

        // ── KPI période précédente (comparaison tendance) ─────────────
        $visitesPrec    = Visite::whereBetween('created_at', [$debutPrec, $finPrec])->count();
        $visiteursPrecRaw = Visite::whereBetween('created_at', [$debutPrec, $finPrec])->distinct('session_id')->count();

        $tendanceVisites  = $this->tendance($visites, $visitesPrec);
        $tendanceVisiteurs= $this->tendance($visiteurs, $visiteursPrecRaw);

        // ── Visites par jour (graphique barres) ───────────────────────
        $visitesParJour = Visite::selectRaw('DATE(created_at) as jour, COUNT(*) as total')
            ->where('created_at', '>=', $debut)
            ->groupBy('jour')
            ->orderBy('jour')
            ->get()
            ->keyBy('jour');

        $labels = [];
        $valeurs = [];
        for ($i = $periode - 1; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $labels[]  = now()->subDays($i)->locale('fr')->isoFormat($periode <= 7 ? 'ddd D' : 'D MMM');
            $valeurs[] = $visitesParJour->get($date)?->total ?? 0;
        }

        // ── Top pages ─────────────────────────────────────────────────
        $topPages = Visite::selectRaw('page_url, page_titre, COUNT(*) as total, AVG(temps_passe) as duree_moy')
            ->where('created_at', '>=', $debut)
            ->groupBy('page_url', 'page_titre')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        // ── Appareils ─────────────────────────────────────────────────
        $appareils = Visite::selectRaw('appareil, COUNT(*) as total')
            ->where('created_at', '>=', $debut)
            ->whereNotNull('appareil')
            ->groupBy('appareil')
            ->orderByDesc('total')
            ->get();

        // ── Navigateurs ───────────────────────────────────────────────
        $navigateurs = Visite::selectRaw('navigateur, COUNT(*) as total')
            ->where('created_at', '>=', $debut)
            ->whereNotNull('navigateur')
            ->groupBy('navigateur')
            ->orderByDesc('total')
            ->limit(6)
            ->get();

        // ── OS ────────────────────────────────────────────────────────
        $systemesOS = Visite::selectRaw('os, COUNT(*) as total')
            ->where('created_at', '>=', $debut)
            ->whereNotNull('os')
            ->groupBy('os')
            ->orderByDesc('total')
            ->limit(6)
            ->get();

        // ── Top referrers ─────────────────────────────────────────────
        $referrers = Visite::selectRaw('referrer, COUNT(*) as total')
            ->where('created_at', '>=', $debut)
            ->whereNotNull('referrer')
            ->where('referrer', '!=', '')
            ->groupBy('referrer')
            ->orderByDesc('total')
            ->limit(8)
            ->get()
            ->map(function ($r) {
                $host = parse_url($r->referrer, PHP_URL_HOST) ?? $r->referrer;
                return ['host' => $host, 'total' => $r->total];
            })
            ->unique('host')
            ->values();

        // ── Visites totales all-time ───────────────────────────────────
        $visitesTotal = Visite::count();

        return view('admin.analytics.index', compact(
            'periode',
            'visites', 'visiteurs', 'nouveaux', 'dureeMoy', 'scrollMoy',
            'tendanceVisites', 'tendanceVisiteurs',
            'labels', 'valeurs',
            'topPages', 'appareils', 'navigateurs', 'systemesOS',
            'referrers', 'visitesTotal',
        ));
    }

    // ── Calcule la tendance en % (+/-) ────────────────────────────
    private function tendance(int $current, int $previous): array
    {
        if ($previous === 0) {
            return ['pct' => $current > 0 ? 100 : 0, 'sens' => 'up'];
        }
        $pct = round((($current - $previous) / $previous) * 100);
        return ['pct' => abs($pct), 'sens' => $pct >= 0 ? 'up' : 'down'];
    }
}
