@extends('layouts.admin')
@section('title', 'Billetterie — Réservations')

@section('content')

{{-- ═══ STATS 6 cartes ═══ --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:28px;">
    @foreach([
        ['label' => 'Réservations totales', 'value' => $stats['total'],         'color' => '#4caf7d',  'sub' => ''],
        ['label' => 'En attente',            'value' => $stats['en_attente'],    'color' => '#d4a030',  'sub' => ''],
        ['label' => 'Confirmées',            'value' => $stats['confirmes'],     'color' => '#4a90e2',  'sub' => ''],
        ['label' => 'Annulées',              'value' => $stats['annules'],       'color' => '#e07030',  'sub' => ''],
        ['label' => 'Billets vendus',        'value' => $stats['total_billets'], 'color' => '#b07aff',  'sub' => 'toutes réservations actives'],
        ['label' => 'Revenus estimés',       'value' => number_format($stats['revenus'],0,',',' ').' FC', 'color' => '#d4a030', 'sub' => 'hors annulées'],
    ] as $s)
    <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:18px 20px;">
        <p style="font-family:'Space Grotesk',sans-serif;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#555;margin:0 0 8px;">{{ $s['label'] }}</p>
        <p style="font-family:'Playfair Display',serif;font-size:1.7rem;font-weight:900;color:{{ $s['color'] }};margin:0 0 4px;line-height:1;">{{ $s['value'] }}</p>
        @if($s['sub'])<p style="font-family:'Space Grotesk',sans-serif;font-size:0.68rem;color:#444;margin:0;">{{ $s['sub'] }}</p>@endif
    </div>
    @endforeach
</div>

{{-- ═══ BARRE D'OUTILS ═══ --}}
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;gap:12px;flex-wrap:wrap;">
    <h2 style="font-family:'Playfair Display',serif;font-size:1.2rem;font-weight:900;color:#f5f5f0;margin:0;">Toutes les réservations</h2>
    <div style="display:flex;gap:10px;flex-wrap:wrap;">
        {{-- Export CSV (reprend les filtres actifs) --}}
        <a href="{{ route('admin.billets.export', request()->query()) }}"
           style="display:inline-flex;align-items:center;gap:7px;padding:8px 16px;background:rgba(74,144,226,0.1);border:1px solid rgba(74,144,226,0.25);color:#4a90e2;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;border-radius:6px;text-decoration:none;transition:background 0.2s;"
           onmouseover="this.style.background='rgba(74,144,226,0.2)'" onmouseout="this.style.background='rgba(74,144,226,0.1)'">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Exporter CSV
        </a>
    </div>
</div>

{{-- ═══ FILTRES AVANCÉS ═══ --}}
<form method="GET" id="filter-form" style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:18px 20px;margin-bottom:20px;">
    <div style="display:grid;grid-template-columns:2fr 1fr 1fr 1fr 1fr auto;gap:12px;align-items:end;">

        {{-- Recherche --}}
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;margin-bottom:5px;">Recherche</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Nom, email, référence…"
                   style="width:100%;padding:8px 12px;background:#0d0d0d;border:1px solid #1a1a1a;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;outline:none;box-sizing:border-box;"
                   onfocus="this.style.borderColor='#4caf7d'" onblur="this.style.borderColor='#1a1a1a'">
        </div>

        {{-- Événement --}}
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;margin-bottom:5px;">Événement</label>
            <select name="evenement_id" style="width:100%;padding:8px 12px;background:#0d0d0d;border:1px solid #1a1a1a;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;outline:none;cursor:pointer;box-sizing:border-box;">
                <option value="">Tous</option>
                @foreach($evenements as $evt)
                <option value="{{ $evt->id }}" {{ request('evenement_id') == $evt->id ? 'selected' : '' }}>
                    {{ Str::limit($evt->titre, 28) }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- Statut --}}
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;margin-bottom:5px;">Statut</label>
            <select name="statut" style="width:100%;padding:8px 12px;background:#0d0d0d;border:1px solid #1a1a1a;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;outline:none;cursor:pointer;box-sizing:border-box;">
                <option value="">Tous</option>
                <option value="en_attente" {{ request('statut') === 'en_attente' ? 'selected' : '' }}>En attente</option>
                <option value="confirme"   {{ request('statut') === 'confirme'   ? 'selected' : '' }}>Confirmé</option>
                <option value="annule"     {{ request('statut') === 'annule'     ? 'selected' : '' }}>Annulé</option>
            </select>
        </div>

        {{-- Date début --}}
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;margin-bottom:5px;">Du</label>
            <input type="date" name="date_debut" value="{{ request('date_debut') }}"
                   style="width:100%;padding:8px 12px;background:#0d0d0d;border:1px solid #1a1a1a;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;outline:none;box-sizing:border-box;"
                   onfocus="this.style.borderColor='#4caf7d'" onblur="this.style.borderColor='#1a1a1a'">
        </div>

        {{-- Date fin --}}
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;margin-bottom:5px;">Au</label>
            <input type="date" name="date_fin" value="{{ request('date_fin') }}"
                   style="width:100%;padding:8px 12px;background:#0d0d0d;border:1px solid #1a1a1a;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;outline:none;box-sizing:border-box;"
                   onfocus="this.style.borderColor='#4caf7d'" onblur="this.style.borderColor='#1a1a1a'">
        </div>

        {{-- Boutons --}}
        <div style="display:flex;gap:8px;">
            <button type="submit" style="padding:8px 16px;background:rgba(76,175,125,0.1);border:1px solid rgba(76,175,125,0.25);color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;border-radius:6px;cursor:pointer;white-space:nowrap;">Filtrer</button>
            @if(request()->hasAny(['search','statut','evenement_id','date_debut','date_fin']))
            <a href="{{ route('admin.billets.index') }}"
               style="padding:8px 12px;background:rgba(224,112,48,0.08);border:1px solid rgba(224,112,48,0.2);color:#e07030;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;border-radius:6px;text-decoration:none;white-space:nowrap;">✕ Reset</a>
            @endif
        </div>
    </div>
</form>

{{-- ═══ TABLEAU + BULK ACTIONS ═══ --}}
<form id="bulk-form" action="{{ route('admin.billets.bulk') }}" method="POST">
@csrf

{{-- Barre d'actions en lot (cachée par défaut) --}}
<div id="bulk-bar" style="display:none;background:rgba(76,175,125,0.06);border:1px solid rgba(76,175,125,0.2);border-radius:8px;padding:12px 16px;margin-bottom:12px;align-items:center;gap:14px;flex-wrap:wrap;">
    <span id="bulk-count" style="font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;color:#4caf7d;">0 sélectionné(s)</span>
    <select name="statut" style="padding:7px 12px;background:#0d0d0d;border:1px solid #1a1a1a;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;outline:none;cursor:pointer;">
        <option value="en_attente">→ En attente</option>
        <option value="confirme">→ Confirmer</option>
        <option value="annule">→ Annuler</option>
    </select>
    <button type="submit"
            onclick="return confirm('Modifier le statut des réservations sélectionnées ?')"
            style="padding:7px 16px;background:rgba(76,175,125,0.15);border:1px solid rgba(76,175,125,0.3);color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;border-radius:6px;cursor:pointer;">
        Appliquer
    </button>
    <button type="button" onclick="clearSelection()"
            style="padding:7px 12px;background:transparent;border:1px solid #1a1a1a;color:#555;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;border-radius:6px;cursor:pointer;">
        Désélectionner
    </button>
</div>

<div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;overflow:hidden;">
    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="border-bottom:1px solid #1a1a1a;">
                <th style="padding:12px 16px;width:36px;">
                    <input type="checkbox" id="select-all" title="Tout sélectionner"
                           style="width:15px;height:15px;cursor:pointer;accent-color:#4caf7d;">
                </th>
                @foreach(['Référence','Participant','Événement','Billets','Montant','Date','Statut','Actions'] as $h)
                <th style="padding:12px 16px;text-align:left;font-family:'Space Grotesk',sans-serif;font-size:0.7rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;">{{ $h }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse($billets as $billet)
            <tr class="billet-row" style="border-bottom:1px solid #161616;transition:background 0.2s;"
                onmouseover="this.style.background='rgba(255,255,255,0.025)'" onmouseout="this.style.background=this.dataset.selected==='1'?'rgba(76,175,125,0.04)':''">
                <td style="padding:12px 16px;">
                    <input type="checkbox" name="ids[]" value="{{ $billet->id }}" class="billet-check"
                           style="width:15px;height:15px;cursor:pointer;accent-color:#4caf7d;">
                </td>
                <td style="padding:12px 16px;">
                    <span style="font-family:'Space Grotesk',sans-serif;font-size:0.8rem;font-weight:700;color:#4caf7d;letter-spacing:0.04em;">{{ $billet->reference }}</span>
                </td>
                <td style="padding:12px 16px;">
                    <div style="font-family:'Space Grotesk',sans-serif;font-weight:600;font-size:0.84rem;color:#f5f5f0;">{{ $billet->prenom }} {{ $billet->nom }}</div>
                    <div style="color:#555;font-size:0.74rem;">{{ $billet->email }}</div>
                    @if($billet->telephone)<div style="color:#444;font-size:0.72rem;">{{ $billet->telephone }}</div>@endif
                </td>
                <td style="padding:12px 16px;max-width:160px;">
                    <div style="color:#888;font-size:0.84rem;">{{ Str::limit($billet->evenement?->titre ?? '—', 32) }}</div>
                    <div style="color:#555;font-size:0.73rem;">{{ $billet->evenement?->date_debut?->format('d/m/Y') ?? '' }}</div>
                    @if($billet->categorie)
                    <span style="display:inline-block;margin-top:3px;padding:1px 7px;background:rgba(176,122,255,0.1);border:1px solid rgba(176,122,255,0.2);color:#b07aff;font-size:0.65rem;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;border-radius:20px;">{{ $billet->categorie->nom }}</span>
                    @endif
                </td>
                <td style="padding:12px 16px;color:#aaa;font-size:0.84rem;text-align:center;font-weight:600;">{{ $billet->nombre_billets }}</td>
                <td style="padding:12px 16px;font-family:'Playfair Display',serif;font-size:0.9rem;white-space:nowrap;{{ $billet->montant_total > 0 ? 'color:#d4a030' : 'color:#4caf7d' }}">
                    {{ $billet->montant_total > 0 ? number_format($billet->montant_total, 0, ',', ' ').' FC' : 'Gratuit' }}
                </td>
                <td style="padding:12px 16px;color:#555;font-size:0.77rem;white-space:nowrap;">{{ $billet->created_at->format('d/m/Y') }}<br>{{ $billet->created_at->format('H:i') }}</td>
                <td style="padding:12px 16px;">
                    <div style="display:flex;flex-direction:column;gap:4px;">
                    @if($billet->statut === 'confirme')
                    <span class="tag tag-green">Confirmé</span>
                    @elseif($billet->statut === 'annule')
                    <span class="tag tag-orange">Annulé</span>
                    @else
                    <span class="tag tag-white">En attente</span>
                    @endif
                    @if($billet->montant_total > 0)
                        @if($billet->paiement_verifie)
                        <span style="font-family:'Space Grotesk',sans-serif;font-size:0.65rem;font-weight:700;color:#4caf7d;">✓ Payé</span>
                        @else
                        <span style="font-family:'Space Grotesk',sans-serif;font-size:0.65rem;font-weight:700;color:#d4a030;">⏳ Paiement en attente</span>
                        @endif
                    @endif
                    </div>
                </td>
                <td style="padding:12px 16px;">
                    <div style="display:flex;gap:7px;align-items:center;">
                        <a href="{{ route('admin.billets.show', $billet) }}"
                           style="padding:5px 11px;background:rgba(76,175,125,0.1);border:1px solid rgba(76,175,125,0.2);color:#4caf7d;font-size:0.73rem;font-family:'Space Grotesk',sans-serif;font-weight:600;text-decoration:none;border-radius:4px;"
                           onmouseover="this.style.background='rgba(76,175,125,0.2)'" onmouseout="this.style.background='rgba(76,175,125,0.1)'">
                            Voir
                        </a>
                        <a href="mailto:{{ $billet->email }}?subject=Votre réservation {{ $billet->reference }}"
                           title="Envoyer un email"
                           style="padding:5px 8px;background:rgba(74,144,226,0.08);border:1px solid rgba(74,144,226,0.2);color:#4a90e2;font-size:0.73rem;font-family:'Space Grotesk',sans-serif;font-weight:600;text-decoration:none;border-radius:4px;"
                           onmouseover="this.style.background='rgba(74,144,226,0.2)'" onmouseout="this.style.background='rgba(74,144,226,0.08)'">
                            ✉
                        </a>
                        <form action="{{ route('admin.billets.destroy', $billet) }}" method="POST" style="margin:0;"
                              onsubmit="return confirm('Supprimer cette réservation ?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    style="padding:5px 10px;background:rgba(224,112,48,0.08);border:1px solid rgba(224,112,48,0.2);color:#e07030;font-size:0.73rem;font-family:'Space Grotesk',sans-serif;font-weight:600;cursor:pointer;border-radius:4px;"
                                    onmouseover="this.style.background='rgba(224,112,48,0.2)'" onmouseout="this.style.background='rgba(224,112,48,0.08)'">
                                ✕
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" style="padding:56px;text-align:center;color:#555;font-size:0.88rem;">Aucune réservation trouvée.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
</form>

@if($billets->hasPages())
<div style="margin-top:20px;">{{ $billets->links() }}</div>
@endif

{{-- ═══ BREAKDOWN PAR ÉVÉNEMENT ═══ --}}
@if($parEvenement->isNotEmpty())
<div style="margin-top:40px;">
    <h3 style="font-family:'Playfair Display',serif;font-size:1.1rem;font-weight:900;color:#f5f5f0;margin:0 0 16px;">Réservations par événement</h3>
    <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;overflow:hidden;">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="border-bottom:1px solid #1a1a1a;">
                    @foreach(['Événement','Date','Réservations','Billets vendus','Revenus','Actions'] as $h)
                    <th style="padding:12px 16px;text-align:left;font-family:'Space Grotesk',sans-serif;font-size:0.7rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;">{{ $h }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($parEvenement as $row)
                <tr style="border-bottom:1px solid #161616;transition:background 0.2s;"
                    onmouseover="this.style.background='rgba(255,255,255,0.025)'" onmouseout="this.style.background=''">
                    <td style="padding:12px 16px;">
                        <div style="font-family:'Space Grotesk',sans-serif;font-weight:600;font-size:0.85rem;color:#f5f5f0;">{{ Str::limit($row->evenement?->titre ?? '—', 40) }}</div>
                    </td>
                    <td style="padding:12px 16px;color:#555;font-size:0.78rem;white-space:nowrap;">{{ $row->evenement?->date_debut?->format('d/m/Y') ?? '—' }}</td>
                    <td style="padding:12px 16px;font-family:'Playfair Display',serif;font-size:1rem;font-weight:700;color:#4caf7d;">{{ $row->nb_reservations }}</td>
                    <td style="padding:12px 16px;color:#aaa;font-size:0.85rem;font-weight:600;">{{ $row->nb_billets }}</td>
                    <td style="padding:12px 16px;font-family:'Playfair Display',serif;font-size:0.9rem;color:#d4a030;">
                        {{ $row->revenus > 0 ? number_format($row->revenus, 0, ',', ' ').' FC' : 'Gratuit' }}
                    </td>
                    <td style="padding:12px 16px;">
                        @if($row->evenement)
                        <div style="display:flex;gap:7px;align-items:center;">
                            <a href="{{ route('admin.billets.by-event', $row->evenement) }}"
                               style="padding:5px 11px;background:rgba(76,175,125,0.1);border:1px solid rgba(76,175,125,0.2);color:#4caf7d;font-size:0.73rem;font-family:'Space Grotesk',sans-serif;font-weight:600;text-decoration:none;border-radius:4px;"
                               onmouseover="this.style.background='rgba(76,175,125,0.2)'" onmouseout="this.style.background='rgba(76,175,125,0.1)'">
                                Voir tout
                            </a>
                            <button onclick="copierLienEvenement('{{ route('billetterie.show', $row->evenement->slug) }}', this)"
                                    title="Copier le lien billetterie"
                                    style="padding:5px 10px;background:rgba(255,255,255,0.04);border:1px solid #1a1a1a;color:#555;font-size:0.7rem;font-family:'Space Grotesk',sans-serif;font-weight:600;border-radius:4px;cursor:pointer;transition:all 0.2s;"
                                    onmouseover="this.style.color='#f5f5f0';this.style.borderColor='#333'" onmouseout="this.style.color='#555';this.style.borderColor='#1a1a1a'">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
                                Lien
                            </button>
                        </div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@push('scripts')
<script>
// ── Sélection en lot ──────────────────────────────────────────
const selectAll   = document.getElementById('select-all');
const checks      = () => document.querySelectorAll('.billet-check');
const bulkBar     = document.getElementById('bulk-bar');
const bulkCount   = document.getElementById('bulk-count');

function refreshBulkBar() {
    const selected = document.querySelectorAll('.billet-check:checked');
    const n = selected.length;
    if (n > 0) {
        bulkBar.style.display = 'flex';
        bulkCount.textContent = n + ' sélectionné' + (n > 1 ? 's' : '');
    } else {
        bulkBar.style.display = 'none';
    }
    // highlight rows
    checks().forEach(cb => {
        const row = cb.closest('tr');
        row.style.background = cb.checked ? 'rgba(76,175,125,0.04)' : '';
        row.dataset.selected = cb.checked ? '1' : '0';
    });
}

selectAll.addEventListener('change', () => {
    checks().forEach(cb => { cb.checked = selectAll.checked; });
    refreshBulkBar();
});
document.addEventListener('change', e => {
    if (e.target.classList.contains('billet-check')) {
        selectAll.checked = [...checks()].every(c => c.checked);
        selectAll.indeterminate = !selectAll.checked && [...checks()].some(c => c.checked);
        refreshBulkBar();
    }
});

function clearSelection() {
    checks().forEach(cb => { cb.checked = false; });
    selectAll.checked = false;
    selectAll.indeterminate = false;
    refreshBulkBar();
}

function copierLienEvenement(url, btn) {
    navigator.clipboard.writeText(url).then(() => {
        const orig = btn.innerHTML;
        btn.innerHTML = '✓ Copié !';
        btn.style.color       = '#4caf7d';
        btn.style.borderColor = 'rgba(76,175,125,0.3)';
        setTimeout(() => {
            btn.innerHTML        = orig;
            btn.style.color      = '#555';
            btn.style.borderColor = '#1a1a1a';
        }, 2500);
    });
}
</script>
@endpush

@endsection
