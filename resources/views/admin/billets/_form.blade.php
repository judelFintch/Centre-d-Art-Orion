@php
    $billet     ??= null;
    $isEdit      = $billet !== null;
    $meta        = \App\Models\Billet::METHODES;
    // Charger les catégories de l'événement sélectionné (pour pré-remplissage)
    $categoriesEvt = collect();
    $evtIdActif    = old('evenement_id', $billet?->evenement_id ?? $preEvenement?->id ?? '');
    if ($evtIdActif) {
        $categoriesEvt = \App\Models\BilletCategorie::where('evenement_id', $evtIdActif)->orderBy('ordre')->get();
    }
@endphp

{{-- ── Événement ── --}}
<div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:22px;margin-bottom:16px;">
    <h4 style="font-family:'Space Grotesk',sans-serif;font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#555;margin:0 0 16px;">Événement</h4>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;color:#666;margin-bottom:6px;">Événement *</label>
            <select name="evenement_id" id="sel-evenement" required onchange="chargerCategories(this.value)"
                    style="width:100%;padding:9px 12px;background:#0d0d0d;border:1px solid #1a1a1a;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;outline:none;cursor:pointer;box-sizing:border-box;">
                <option value="">— Choisir un événement —</option>
                @foreach($evenements as $evt)
                <option value="{{ $evt->id }}"
                        data-prix="{{ $evt->gratuit ? 0 : (float)$evt->prix }}"
                        data-gratuit="{{ $evt->gratuit ? '1' : '0' }}"
                        {{ old('evenement_id', $billet?->evenement_id ?? $preEvenement?->id) == $evt->id ? 'selected' : '' }}>
                    {{ $evt->titre }} — {{ $evt->date_debut->format('d/m/Y') }}
                </option>
                @endforeach
            </select>
            @error('evenement_id')<p style="color:#e07030;font-size:0.72rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>

        <div id="wrap-categorie" style="{{ $categoriesEvt->isEmpty() ? 'opacity:0.4;pointer-events:none;' : '' }}">
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;color:#666;margin-bottom:6px;">
                Catégorie <span id="cat-hint" style="color:#444;text-transform:none;font-weight:400;">({{ $categoriesEvt->isEmpty() ? 'aucune pour cet événement' : 'optionnel' }})</span>
            </label>
            <select name="billet_categorie_id" id="sel-categorie"
                    style="width:100%;padding:9px 12px;background:#0d0d0d;border:1px solid #1a1a1a;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;outline:none;cursor:pointer;box-sizing:border-box;">
                <option value="">— Sans catégorie —</option>
                @foreach($categoriesEvt as $cat)
                <option value="{{ $cat->id }}" data-prix="{{ (float)$cat->prix }}"
                        {{ old('billet_categorie_id', $billet?->billet_categorie_id) == $cat->id ? 'selected' : '' }}>
                    {{ $cat->nom }} — {{ $cat->prix > 0 ? number_format($cat->prix,0,',',' ').' FC' : 'Gratuit' }}
                </option>
                @endforeach
            </select>
            @error('billet_categorie_id')<p style="color:#e07030;font-size:0.72rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>
    </div>
</div>

{{-- ── Participant ── --}}
<div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:22px;margin-bottom:16px;">
    <h4 style="font-family:'Space Grotesk',sans-serif;font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#555;margin:0 0 16px;">Participant</h4>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px;">
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;color:#666;margin-bottom:6px;">Prénom *</label>
            <input type="text" name="prenom" value="{{ old('prenom', $billet?->prenom) }}" required
                   style="width:100%;padding:9px 12px;background:#0d0d0d;border:1px solid #1a1a1a;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;outline:none;box-sizing:border-box;transition:border 0.2s;"
                   onfocus="this.style.borderColor='#4caf7d'" onblur="this.style.borderColor='#1a1a1a'">
            @error('prenom')<p style="color:#e07030;font-size:0.72rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;color:#666;margin-bottom:6px;">Nom *</label>
            <input type="text" name="nom" value="{{ old('nom', $billet?->nom) }}" required
                   style="width:100%;padding:9px 12px;background:#0d0d0d;border:1px solid #1a1a1a;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;outline:none;box-sizing:border-box;transition:border 0.2s;"
                   onfocus="this.style.borderColor='#4caf7d'" onblur="this.style.borderColor='#1a1a1a'">
            @error('nom')<p style="color:#e07030;font-size:0.72rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;color:#666;margin-bottom:6px;">Email</label>
            <input type="email" name="email" value="{{ old('email', $billet?->email) }}"
                   style="width:100%;padding:9px 12px;background:#0d0d0d;border:1px solid #1a1a1a;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;outline:none;box-sizing:border-box;transition:border 0.2s;"
                   onfocus="this.style.borderColor='#4caf7d'" onblur="this.style.borderColor='#1a1a1a'">
            @error('email')<p style="color:#e07030;font-size:0.72rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;color:#666;margin-bottom:6px;">Téléphone</label>
            <input type="tel" name="telephone" value="{{ old('telephone', $billet?->telephone) }}"
                   style="width:100%;padding:9px 12px;background:#0d0d0d;border:1px solid #1a1a1a;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;outline:none;box-sizing:border-box;transition:border 0.2s;"
                   onfocus="this.style.borderColor='#4caf7d'" onblur="this.style.borderColor='#1a1a1a'">
        </div>
    </div>

    <div>
        <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;color:#666;margin-bottom:6px;">Notes</label>
        <textarea name="notes" rows="2"
                  style="width:100%;padding:9px 12px;background:#0d0d0d;border:1px solid #1a1a1a;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;outline:none;box-sizing:border-box;resize:vertical;line-height:1.6;transition:border 0.2s;"
                  onfocus="this.style.borderColor='#4caf7d'" onblur="this.style.borderColor='#1a1a1a'">{{ old('notes', $billet?->notes) }}</textarea>
    </div>
</div>

{{-- ── Billets & Montant ── --}}
<div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:22px;margin-bottom:16px;">
    <h4 style="font-family:'Space Grotesk',sans-serif;font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#555;margin:0 0 16px;">Billets & Montant</h4>

    <div style="display:grid;grid-template-columns:120px 1fr 1fr;gap:14px;align-items:end;">
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;color:#666;margin-bottom:6px;">Nb billets *</label>
            <input type="number" name="nombre_billets" id="nb-billets" min="1" max="200"
                   value="{{ old('nombre_billets', $billet?->nombre_billets ?? 1) }}" required
                   style="width:100%;padding:9px 12px;background:#0d0d0d;border:1px solid #1a1a1a;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;outline:none;box-sizing:border-box;transition:border 0.2s;"
                   onfocus="this.style.borderColor='#4caf7d'" onblur="this.style.borderColor='#1a1a1a'"
                   oninput="recalcMontant()">
            @error('nombre_billets')<p style="color:#e07030;font-size:0.72rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;color:#666;margin-bottom:6px;">Montant total (FC) *</label>
            <input type="number" name="montant_total" id="montant-total" min="0" step="100"
                   value="{{ old('montant_total', $billet?->montant_total ?? 0) }}" required
                   style="width:100%;padding:9px 12px;background:#0d0d0d;border:1px solid #1a1a1a;border-radius:6px;color:#d4a030;font-family:'Playfair Display',serif;font-size:0.95rem;font-weight:700;outline:none;box-sizing:border-box;transition:border 0.2s;"
                   onfocus="this.style.borderColor='#d4a030'" onblur="this.style.borderColor='#1a1a1a'">
            @error('montant_total')<p style="color:#e07030;font-size:0.72rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>
        <div style="padding-bottom:1px;">
            <p style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;color:#444;margin:0 0 6px;">Le montant est calculé automatiquement mais modifiable manuellement.</p>
            <button type="button" onclick="recalcMontant()"
                    style="padding:7px 14px;background:rgba(76,175,125,0.1);border:1px solid rgba(76,175,125,0.2);color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.75rem;font-weight:600;border-radius:5px;cursor:pointer;transition:background 0.2s;"
                    onmouseover="this.style.background='rgba(76,175,125,0.2)'" onmouseout="this.style.background='rgba(76,175,125,0.1)'">
                ↻ Recalculer
            </button>
        </div>
    </div>
</div>

{{-- ── Paiement ── --}}
<div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:22px;margin-bottom:16px;">
    <h4 style="font-family:'Space Grotesk',sans-serif;font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#555;margin:0 0 16px;">Paiement</h4>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px;">
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;color:#666;margin-bottom:6px;">Mode de paiement</label>
            <select name="methode_paiement"
                    style="width:100%;padding:9px 12px;background:#0d0d0d;border:1px solid #1a1a1a;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;outline:none;cursor:pointer;box-sizing:border-box;">
                <option value="">— Non spécifié —</option>
                @foreach($meta as $cle => $m)
                <option value="{{ $cle }}" {{ old('methode_paiement', $billet?->methode_paiement) === $cle ? 'selected' : '' }}>
                    {{ $m['label'] }}
                </option>
                @endforeach
            </select>
        </div>
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;color:#666;margin-bottom:6px;">Référence transaction</label>
            <input type="text" name="reference_paiement" value="{{ old('reference_paiement', $billet?->reference_paiement) }}"
                   placeholder="Ex : TX123456789"
                   style="width:100%;padding:9px 12px;background:#0d0d0d;border:1px solid #1a1a1a;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;outline:none;box-sizing:border-box;transition:border 0.2s;"
                   onfocus="this.style.borderColor='#4caf7d'" onblur="this.style.borderColor='#1a1a1a'">
        </div>
    </div>

    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;width:fit-content;">
        <input type="checkbox" name="paiement_verifie" value="1"
               {{ old('paiement_verifie', $billet?->paiement_verifie) ? 'checked' : '' }}
               style="width:15px;height:15px;accent-color:#4caf7d;cursor:pointer;">
        <span style="font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;color:#888;">Marquer le paiement comme vérifié</span>
    </label>
</div>

{{-- ── Statut ── --}}
<div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:22px;margin-bottom:24px;">
    <h4 style="font-family:'Space Grotesk',sans-serif;font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#555;margin:0 0 16px;">Statut de la réservation</h4>

    <div style="display:flex;gap:10px;flex-wrap:wrap;">
        @foreach(['en_attente' => ['En attente', '#d4a030', 'rgba(212,160,48,0.1)'], 'confirme' => ['Confirmé', '#4caf7d', 'rgba(76,175,125,0.1)'], 'annule' => ['Annulé', '#e07030', 'rgba(224,112,48,0.1)']] as $val => [$lbl, $col, $bg])
        <label style="display:flex;align-items:center;gap:7px;padding:9px 14px;border:1.5px solid {{ old('statut', $billet?->statut ?? 'en_attente') === $val ? $col : '#1a1a1a' }};border-radius:7px;cursor:pointer;background:{{ old('statut', $billet?->statut ?? 'en_attente') === $val ? $bg : 'transparent' }};transition:all 0.15s;">
            <input type="radio" name="statut" value="{{ $val }}"
                   {{ old('statut', $billet?->statut ?? 'en_attente') === $val ? 'checked' : '' }} required
                   style="width:14px;height:14px;accent-color:{{ $col }};cursor:pointer;">
            <span style="font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;color:{{ old('statut', $billet?->statut ?? 'en_attente') === $val ? $col : '#888' }};">{{ $lbl }}</span>
        </label>
        @endforeach
    </div>
    @error('statut')<p style="color:#e07030;font-size:0.72rem;margin:8px 0 0;">{{ $message }}</p>@enderror
</div>

@push('scripts')
<script>
// Données de tous les événements avec leurs catégories (chargées au rendu Blade)
const eventsData = @json($evenements->load('billetCategories')->mapWithKeys(fn($e) => [$e->id => [
    'prix'    => $e->gratuit ? 0 : (float)$e->prix,
    'gratuit' => $e->gratuit,
    'categories' => $e->billetCategories->map(fn($c) => ['id' => $c->id, 'nom' => $c->nom, 'prix' => (float)$c->prix])->values(),
]]));

function chargerCategories(evtId) {
    const sel   = document.getElementById('sel-categorie');
    const wrap  = document.getElementById('wrap-categorie');
    const hint  = document.getElementById('cat-hint');
    const evt   = eventsData[evtId];

    // Vider
    sel.innerHTML = '<option value="">— Sans catégorie —</option>';

    if (!evt || !evt.categories.length) {
        wrap.style.opacity         = '0.4';
        wrap.style.pointerEvents   = 'none';
        hint.textContent           = '(aucune pour cet événement)';
        recalcMontant();
        return;
    }

    evt.categories.forEach(c => {
        const opt  = document.createElement('option');
        opt.value  = c.id;
        opt.dataset.prix = c.prix;
        opt.textContent  = c.nom + ' — ' + (c.prix > 0 ? c.prix.toLocaleString('fr-FR') + ' FC' : 'Gratuit');
        sel.appendChild(opt);
    });

    wrap.style.opacity       = '1';
    wrap.style.pointerEvents = 'auto';
    hint.textContent         = '(optionnel)';
    recalcMontant();
}

function recalcMontant() {
    const evtId  = document.getElementById('sel-evenement')?.value;
    const catId  = document.getElementById('sel-categorie')?.value;
    const nb     = parseInt(document.getElementById('nb-billets')?.value) || 1;
    const evt    = eventsData[evtId];
    if (!evt) return;

    let prix = evt.prix;
    if (catId) {
        const opt = document.querySelector('#sel-categorie option[value="' + catId + '"]');
        if (opt) prix = parseFloat(opt.dataset.prix) || 0;
    }

    const input = document.getElementById('montant-total');
    if (input) input.value = prix * nb;
}

// Recalcul auto quand catégorie change
document.getElementById('sel-categorie')?.addEventListener('change', recalcMontant);
</script>
@endpush
