@extends('layouts.admin')
@section('title', 'Analytics')

@section('content')

{{-- ── En-tête + sélecteur de période ─────────────────────────────── --}}
<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;margin-bottom:28px;">
    <div>
        <p style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#555;margin:0 0 4px;">Comportement</p>
        <h2 style="font-family:'Playfair Display',serif;font-size:1.5rem;font-weight:900;color:#f5f5f0;margin:0;">Analytics visiteurs</h2>
    </div>
    <div style="display:flex;gap:6px;background:#0d0d0d;border:1px solid #1a1a1a;border-radius:8px;padding:4px;">
        @foreach([7 => '7 jours', 30 => '30 jours', 90 => '90 jours'] as $p => $label)
        <a href="{{ request()->fullUrlWithQuery(['periode' => $p]) }}"
           style="padding:7px 16px;border-radius:5px;font-family:'Space Grotesk',sans-serif;font-size:0.75rem;font-weight:700;text-decoration:none;transition:all 0.2s;
                  {{ $periode == $p ? 'background:#4caf7d;color:#0a0a0a;' : 'color:#666;' }}"
           {{ $periode != $p ? 'onmouseover="this.style.color=\'#f5f5f0\'" onmouseout="this.style.color=\'#666\'"' : '' }}>
            {{ $label }}
        </a>
        @endforeach
    </div>
</div>

{{-- Note si pas encore de données --}}
@if($visitesTotal === 0)
<div style="background:rgba(76,175,125,0.06);border:1px dashed rgba(76,175,125,0.2);border-radius:10px;padding:48px 32px;text-align:center;margin-bottom:28px;">
    <div style="font-size:2.5rem;margin-bottom:16px;">📊</div>
    <p style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.95rem;color:#f5f5f0;margin:0 0 8px;">En attente de données</p>
    <p style="color:#555;font-size:0.82rem;margin:0;">Les statistiques apparaîtront ici dès que des visiteurs accepteront les cookies analytiques et navigueront sur le site.</p>
</div>
@endif

{{-- ── KPI cards ─────────────────────────────────────────────────────── --}}
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:14px;margin-bottom:28px;">

    @php
    $kpis = [
        ['Visites',          $visites,    '#4caf7d',  '👁', $tendanceVisites],
        ['Visiteurs uniq.',  $visiteurs,  '#d4a030',  '👤', $tendanceVisiteurs],
        ['Nouveaux',         $nouveaux,   '#4a90e2',  '🆕', null],
        ['Durée moy.',       ($dureeMoy >= 60 ? floor($dureeMoy/60).'m '.($dureeMoy%60).'s' : $dureeMoy.'s'), '#e07030', '⏱', null],
        ['Scroll moy.',      $scrollMoy.'%', '#4caf7d', '↕', null],
    ];
    @endphp

    @foreach($kpis as $kpi)
    <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:18px;position:relative;overflow:hidden;">
        <div style="position:absolute;top:0;right:0;width:3px;height:100%;background:{{ $kpi[2] }};opacity:0.5;"></div>
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;">
            <span style="font-size:0.65rem;font-family:'Space Grotesk',sans-serif;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#555;">{{ $kpi[0] }}</span>
            <span style="font-size:0.85rem;">{{ $kpi[4 - 1] ?? $kpi[3] }}</span>
        </div>
        <div style="font-family:'Playfair Display',serif;font-size:1.9rem;font-weight:900;color:{{ $kpi[2] }};line-height:1;margin-bottom:6px;">{{ $kpi[1] }}</div>
        @if($kpi[4])
        <div style="font-size:0.72rem;font-family:'Space Grotesk',sans-serif;color:{{ $kpi[4]['sens']==='up' ? '#4caf7d' : '#e07030' }};">
            {{ $kpi[4]['sens']==='up' ? '▲' : '▼' }} {{ $kpi[4]['pct'] }}% vs période préc.
        </div>
        @endif
    </div>
    @endforeach

</div>

{{-- ── Graphique visites par jour ──────────────────────────────────── --}}
<div style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:24px;margin-bottom:24px;">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
        <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.82rem;letter-spacing:0.08em;text-transform:uppercase;color:#f5f5f0;margin:0;">Visites par jour</h3>
        <span style="font-size:0.72rem;color:#444;font-family:'Space Grotesk',sans-serif;">{{ $periode }} derniers jours</span>
    </div>
    <div style="height:200px;position:relative;">
        <canvas id="chart-visites"></canvas>
    </div>
</div>

{{-- ── Top pages + Appareils ────────────────────────────────────────── --}}
<div style="display:grid;grid-template-columns:1fr 340px;gap:20px;margin-bottom:24px;">

    {{-- Top pages --}}
    <div style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:24px;">
        <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.82rem;letter-spacing:0.08em;text-transform:uppercase;color:#f5f5f0;margin:0 0 18px;">Top pages</h3>
        @forelse($topPages as $i => $page)
        <div style="display:flex;align-items:center;gap:12px;padding:10px 0;{{ !$loop->last ? 'border-bottom:1px solid #161616;' : '' }}">
            <span style="font-family:'Space Grotesk',sans-serif;font-size:0.7rem;font-weight:700;color:#333;width:18px;text-align:center;flex-shrink:0;">{{ $i + 1 }}</span>
            <div style="flex:1;min-width:0;">
                <p style="font-size:0.82rem;color:#f5f5f0;margin:0 0 2px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{{ $page->page_url }}">
                    {{ $page->page_titre ?: $page->page_url }}
                </p>
                <p style="font-size:0.72rem;color:#444;margin:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $page->page_url }}</p>
            </div>
            <div style="text-align:right;flex-shrink:0;">
                <div style="font-family:'Space Grotesk',sans-serif;font-size:0.85rem;font-weight:700;color:#4caf7d;">{{ $page->total }}</div>
                @if($page->duree_moy > 0)
                <div style="font-size:0.68rem;color:#444;">{{ round($page->duree_moy) }}s moy.</div>
                @endif
            </div>
        </div>
        @empty
        <p style="color:#444;font-size:0.82rem;text-align:center;padding:20px 0;">Aucune donnée</p>
        @endforelse
    </div>

    {{-- Appareils --}}
    <div style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:24px;">
        <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.82rem;letter-spacing:0.08em;text-transform:uppercase;color:#f5f5f0;margin:0 0 18px;">Appareils</h3>

        @php
        $totalAppareils = $appareils->sum('total') ?: 1;
        $iconeAppareil  = ['desktop' => '🖥', 'mobile' => '📱', 'tablet' => '📋'];
        $couleurAppareil = ['desktop' => '#4caf7d', 'mobile' => '#d4a030', 'tablet' => '#4a90e2'];
        @endphp

        @forelse($appareils as $a)
        @php $pct = round(($a->total / $totalAppareils) * 100); @endphp
        <div style="margin-bottom:14px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:5px;">
                <span style="font-size:0.82rem;color:#ccc;font-family:'Space Grotesk',sans-serif;display:flex;align-items:center;gap:6px;">
                    <span>{{ $iconeAppareil[$a->appareil] ?? '❓' }}</span>
                    {{ ucfirst($a->appareil) }}
                </span>
                <span style="font-size:0.78rem;font-weight:700;color:{{ $couleurAppareil[$a->appareil] ?? '#666' }};font-family:'Space Grotesk',sans-serif;">{{ $pct }}%</span>
            </div>
            <div style="height:5px;background:#1a1a1a;border-radius:3px;overflow:hidden;">
                <div style="height:100%;width:{{ $pct }}%;background:{{ $couleurAppareil[$a->appareil] ?? '#666' }};border-radius:3px;transition:width 0.6s;"></div>
            </div>
        </div>
        @empty
        <p style="color:#444;font-size:0.82rem;text-align:center;padding:20px 0;">Aucune donnée</p>
        @endforelse

        {{-- Séparateur --}}
        <div style="border-top:1px solid #1a1a1a;margin:20px 0;"></div>

        <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.82rem;letter-spacing:0.08em;text-transform:uppercase;color:#f5f5f0;margin:0 0 14px;">Navigateurs</h3>

        @php
        $totalNav = $navigateurs->sum('total') ?: 1;
        $couleurNav = ['Chrome' => '#4285F4', 'Firefox' => '#FF7139', 'Safari' => '#006CFF', 'Edge' => '#0078D7', 'Opera' => '#FF1B2D', 'Autre' => '#666'];
        @endphp

        @forelse($navigateurs as $n)
        @php $pct = round(($n->total / $totalNav) * 100); @endphp
        <div style="display:flex;align-items:center;gap:10px;padding:6px 0;{{ !$loop->last ? 'border-bottom:1px solid #161616;' : '' }}">
            <div style="width:8px;height:8px;border-radius:50%;background:{{ $couleurNav[$n->navigateur] ?? '#666' }};flex-shrink:0;"></div>
            <span style="flex:1;font-size:0.8rem;color:#ccc;font-family:'Space Grotesk',sans-serif;">{{ $n->navigateur }}</span>
            <span style="font-size:0.78rem;font-weight:700;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;">{{ $n->total }}</span>
            <span style="font-size:0.7rem;color:#444;font-family:'Space Grotesk',sans-serif;width:32px;text-align:right;">{{ $pct }}%</span>
        </div>
        @empty
        <p style="color:#444;font-size:0.82rem;text-align:center;padding:12px 0;">Aucune donnée</p>
        @endforelse
    </div>

</div>

{{-- ── OS + Referrers ────────────────────────────────────────────────── --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:24px;">

    {{-- Systèmes d'exploitation --}}
    <div style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:24px;">
        <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.82rem;letter-spacing:0.08em;text-transform:uppercase;color:#f5f5f0;margin:0 0 16px;">Systèmes d'exploitation</h3>

        @php
        $totalOS = $systemesOS->sum('total') ?: 1;
        $iconeOS = ['Windows' => '🪟', 'macOS' => '🍎', 'Linux' => '🐧', 'Android' => '🤖', 'iOS' => '📱', 'Autre' => '💻'];
        $couleurOS = ['Windows' => '#0078D7', 'macOS' => '#999', 'Linux' => '#e07030', 'Android' => '#4caf7d', 'iOS' => '#4a90e2', 'Autre' => '#555'];
        @endphp

        @forelse($systemesOS as $sys)
        @php $pct = round(($sys->total / $totalOS) * 100); @endphp
        <div style="margin-bottom:12px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:4px;">
                <span style="font-size:0.8rem;color:#ccc;display:flex;align-items:center;gap:7px;font-family:'Space Grotesk',sans-serif;">
                    {{ $iconeOS[$sys->os] ?? '💻' }} {{ $sys->os }}
                </span>
                <span style="font-size:0.75rem;color:#888;font-family:'Space Grotesk',sans-serif;">{{ $sys->total }} ({{ $pct }}%)</span>
            </div>
            <div style="height:4px;background:#1a1a1a;border-radius:2px;">
                <div style="height:100%;width:{{ $pct }}%;background:{{ $couleurOS[$sys->os] ?? '#555' }};border-radius:2px;"></div>
            </div>
        </div>
        @empty
        <p style="color:#444;font-size:0.82rem;text-align:center;padding:20px 0;">Aucune donnée</p>
        @endforelse
    </div>

    {{-- Referrers --}}
    <div style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:24px;">
        <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.82rem;letter-spacing:0.08em;text-transform:uppercase;color:#f5f5f0;margin:0 0 16px;">Sources de trafic</h3>
        @forelse($referrers as $ref)
        <div style="display:flex;align-items:center;gap:10px;padding:9px 0;{{ !$loop->last ? 'border-bottom:1px solid #161616;' : '' }}">
            <div style="width:28px;height:28px;border-radius:4px;background:#1a1a1a;display:flex;align-items:center;justify-content:center;font-size:0.65rem;color:#555;flex-shrink:0;overflow:hidden;">
                <img src="https://www.google.com/s2/favicons?domain={{ $ref['host'] }}&sz=28"
                     alt="" width="14" height="14"
                     style="opacity:0.6;"
                     onerror="this.style.display='none'">
            </div>
            <span style="flex:1;font-size:0.8rem;color:#ccc;font-family:'Space Grotesk',sans-serif;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $ref['host'] }}</span>
            <span style="font-size:0.82rem;font-weight:700;color:#d4a030;font-family:'Space Grotesk',sans-serif;">{{ $ref['total'] }}</span>
        </div>
        @empty
        <div style="text-align:center;padding:28px 0;">
            <p style="color:#444;font-size:0.82rem;margin:0 0 6px;">Aucun referrer enregistré</p>
            <p style="color:#333;font-size:0.75rem;margin:0;">Le trafic direct et les accès sans referrer ne sont pas comptabilisés ici.</p>
        </div>
        @endforelse
    </div>

</div>

{{-- ── Note RGPD ─────────────────────────────────────────────────────── --}}
<div style="background:rgba(76,175,125,0.04);border:1px solid rgba(76,175,125,0.1);border-radius:8px;padding:16px 20px;display:flex;align-items:flex-start;gap:12px;">
    <span style="color:#4caf7d;font-size:1rem;flex-shrink:0;margin-top:1px;">🔒</span>
    <p style="color:#555;font-size:0.78rem;line-height:1.6;margin:0;font-family:'Space Grotesk',sans-serif;">
        <strong style="color:#4caf7d;">Données RGPD-conformes</strong> —
        Les adresses IP sont anonymisées (dernier octet masqué). Aucune donnée personnelle n'est collectée.
        Le suivi s'active uniquement pour les visiteurs ayant accepté les <em>cookies analytiques</em> via la bannière de consentement.
    </p>
</div>

{{-- ── Chart.js ──────────────────────────────────────────────────────── --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
(function () {
    var labels  = @json($labels);
    var valeurs = @json($valeurs);

    var ctx = document.getElementById('chart-visites');
    if (!ctx) return;

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Visites',
                data: valeurs,
                backgroundColor: 'rgba(76,175,125,0.25)',
                borderColor: '#4caf7d',
                borderWidth: 1.5,
                borderRadius: 3,
                hoverBackgroundColor: 'rgba(76,175,125,0.45)',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#111',
                    borderColor: '#222',
                    borderWidth: 1,
                    titleColor: '#f5f5f0',
                    bodyColor: '#4caf7d',
                    titleFont: { family: 'Space Grotesk', size: 11 },
                    bodyFont:  { family: 'Space Grotesk', size: 13, weight: 'bold' },
                    padding: 10,
                    callbacks: {
                        label: function(ctx) { return ' ' + ctx.raw + ' visite' + (ctx.raw > 1 ? 's' : ''); }
                    }
                }
            },
            scales: {
                x: {
                    grid: { color: 'rgba(255,255,255,0.04)' },
                    ticks: { color: '#555', font: { family: 'Space Grotesk', size: 10 } },
                    border: { color: '#1a1a1a' },
                },
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(255,255,255,0.04)' },
                    ticks: {
                        color: '#555',
                        font: { family: 'Space Grotesk', size: 10 },
                        stepSize: 1,
                        precision: 0,
                    },
                    border: { color: '#1a1a1a' },
                }
            }
        }
    });
})();
</script>

@endsection
