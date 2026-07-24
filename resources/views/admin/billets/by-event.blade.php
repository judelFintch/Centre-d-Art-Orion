@extends('layouts.admin')
@section('title', 'Billets — ' . $evenement->titre)

@section('content')

<div style="margin-bottom:20px;">
    <a href="{{ route('admin.billets.index') }}" style="color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;">← Retour à la billetterie</a>
</div>

{{-- En-tête événement --}}
<div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px 28px;margin-bottom:24px;display:flex;align-items:flex-start;justify-content:space-between;gap:20px;flex-wrap:wrap;">
    <div>
        @if($evenement->type)
        <span style="display:inline-block;padding:2px 10px;background:rgba(76,175,125,0.12);color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;border-radius:20px;margin-bottom:8px;">{{ $evenement->type }}</span>
        @endif
        <h2 style="font-family:'Playfair Display',serif;font-size:1.5rem;font-weight:900;color:#f5f5f0;margin:0 0 8px;">{{ $evenement->titre }}</h2>
        <div style="display:flex;flex-wrap:wrap;gap:16px;">
            <span style="font-family:'Space Grotesk',sans-serif;font-size:0.82rem;color:#666;">
                📅 {{ $evenement->date_debut->isoFormat('dddd D MMMM YYYY [à] HH:mm') }}
            </span>
            @if($evenement->lieu)
            <span style="font-family:'Space Grotesk',sans-serif;font-size:0.82rem;color:#666;">
                📍 {{ $evenement->lieu }}
            </span>
            @endif
            @if($evenement->gratuit)
            <span style="font-family:'Space Grotesk',sans-serif;font-size:0.82rem;color:#4caf7d;font-weight:600;">Gratuit</span>
            @elseif($evenement->prix)
            <span style="font-family:'Space Grotesk',sans-serif;font-size:0.82rem;color:#d4a030;font-weight:600;">{{ number_format($evenement->prix, 0, ',', ' ') }} FC / billet</span>
            @endif
        </div>
    </div>
    <div style="display:flex;gap:10px;flex-wrap:wrap;">
        <a href="{{ route('admin.billets.create', ['evenement_id' => $evenement->id]) }}"
           style="display:inline-flex;align-items:center;gap:6px;padding:8px 14px;background:linear-gradient(135deg,#4caf7d,#2d7a52);color:#0a0a0a;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:700;border-radius:6px;text-decoration:none;"
           onmouseover="this.style.opacity='0.88'" onmouseout="this.style.opacity='1'">
            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Ajouter
        </a>
        <a href="{{ route('admin.billets.export', ['evenement_id' => $evenement->id]) }}"
           style="display:inline-flex;align-items:center;gap:6px;padding:8px 14px;background:rgba(74,144,226,0.1);border:1px solid rgba(74,144,226,0.25);color:#4a90e2;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;border-radius:6px;text-decoration:none;"
           onmouseover="this.style.background='rgba(74,144,226,0.2)'" onmouseout="this.style.background='rgba(74,144,226,0.1)'">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Exporter CSV
        </a>
        <a href="{{ route('evenements.show', $evenement->slug) }}" target="_blank"
           style="display:inline-flex;align-items:center;gap:6px;padding:8px 14px;background:rgba(255,255,255,0.04);border:1px solid #1a1a1a;color:#888;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;border-radius:6px;text-decoration:none;"
           onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#888'">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg>
            Voir l'événement
        </a>
    </div>
</div>

{{-- ─── Lien de partage billetterie ─── --}}
<div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:18px 20px;margin-bottom:24px;display:flex;align-items:center;gap:14px;flex-wrap:wrap;">
    <div style="display:flex;align-items:center;gap:6px;flex-shrink:0;">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4caf7d" stroke-width="2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
        <span style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#555;">Lien de billetterie</span>
    </div>
    <div style="flex:1;min-width:260px;display:flex;align-items:center;gap:8px;">
        <input id="share-url" type="text" readonly
               value="{{ route('billetterie.show', $evenement->slug) }}"
               style="flex:1;padding:8px 12px;background:#0d0d0d;border:1px solid #1a1a1a;border-radius:6px;color:#888;font-family:'Space Grotesk',sans-serif;font-size:0.8rem;outline:none;cursor:text;"
               onclick="this.select()">
        <button id="admin-copy-btn" onclick="adminCopierLien()"
                style="padding:8px 14px;background:rgba(76,175,125,0.1);border:1px solid rgba(76,175,125,0.2);color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.75rem;font-weight:600;border-radius:6px;cursor:pointer;white-space:nowrap;transition:all 0.2s;"
                onmouseover="this.style.background='rgba(76,175,125,0.2)'" onmouseout="this.style.background='rgba(76,175,125,0.1)'">
            <span id="admin-copy-label">Copier</span>
        </button>
        <a href="{{ route('billetterie.show', $evenement->slug) }}" target="_blank"
           style="display:inline-flex;align-items:center;gap:5px;padding:8px 12px;background:rgba(255,255,255,0.04);border:1px solid #1a1a1a;color:#666;font-family:'Space Grotesk',sans-serif;font-size:0.75rem;font-weight:600;border-radius:6px;text-decoration:none;white-space:nowrap;transition:color 0.2s;"
           onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#666'">
            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg>
            Ouvrir
        </a>
    </div>
    {{-- Réseaux --}}
    <div style="display:flex;gap:6px;flex-shrink:0;">
        <a href="https://wa.me/?text={{ urlencode('🎭 '.$evenement->titre.' — Réservez vos billets : '.route('billetterie.show', $evenement->slug)) }}"
           target="_blank" rel="noopener" title="WhatsApp"
           style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;background:rgba(37,211,102,0.08);border:1px solid rgba(37,211,102,0.2);border-radius:5px;"
           onmouseover="this.style.background='rgba(37,211,102,0.2)'" onmouseout="this.style.background='rgba(37,211,102,0.08)'">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="#25d166"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M11.999 2C6.477 2 2 6.477 2 12c0 1.989.518 3.86 1.426 5.486L2 22l4.656-1.397A9.956 9.956 0 0012 22c5.523 0 10-4.477 10-10S17.522 2 12 2z" fill-rule="evenodd" clip-rule="evenodd"/></svg>
        </a>
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('billetterie.show', $evenement->slug)) }}"
           target="_blank" rel="noopener" title="Facebook"
           style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;background:rgba(24,119,242,0.08);border:1px solid rgba(24,119,242,0.2);border-radius:5px;"
           onmouseover="this.style.background='rgba(24,119,242,0.2)'" onmouseout="this.style.background='rgba(24,119,242,0.08)'">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="#1877f2"><path d="M24 12.073C24 5.404 18.627 0 12 0S0 5.404 0 12.073C0 18.1 4.388 23.094 10.125 24v-8.437H7.078v-3.49h3.047V9.41c0-3.025 1.792-4.697 4.533-4.697 1.312 0 2.686.236 2.686.236v2.971h-1.514c-1.491 0-1.956.93-1.956 1.886v2.267h3.328l-.532 3.49h-2.796V24C19.612 23.094 24 18.1 24 12.073z"/></svg>
        </a>
        <a href="https://twitter.com/intent/tweet?text={{ urlencode('🎭 '.$evenement->titre) }}&url={{ urlencode(route('billetterie.show', $evenement->slug)) }}"
           target="_blank" rel="noopener" title="X / Twitter"
           style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;background:rgba(255,255,255,0.04);border:1px solid #1a1a1a;border-radius:5px;"
           onmouseover="this.style.background='rgba(255,255,255,0.12)'" onmouseout="this.style.background='rgba(255,255,255,0.04)'">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="#aaa"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.737-8.835L1.254 2.25H8.08l4.253 5.622L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
        </a>
    </div>
</div>

{{-- ═══ CATÉGORIES DE BILLETS ═══ --}}
<div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px 28px;margin-bottom:24px;">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;gap:12px;flex-wrap:wrap;">
        <h3 style="font-family:'Playfair Display',serif;font-size:1.05rem;font-weight:900;color:#f5f5f0;margin:0;">Catégories de billets</h3>
        <button id="btn-toggle-add-cat"
                onclick="document.getElementById('form-add-cat').style.display = document.getElementById('form-add-cat').style.display === 'none' ? 'grid' : 'none'"
                style="display:inline-flex;align-items:center;gap:6px;padding:7px 14px;background:rgba(76,175,125,0.1);border:1px solid rgba(76,175,125,0.25);color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;border-radius:6px;cursor:pointer;">
            + Ajouter une catégorie
        </button>
    </div>

    {{-- Formulaire d'ajout --}}
    <form id="form-add-cat" action="{{ route('admin.billets.categories.store', $evenement) }}" method="POST"
          style="display:none;grid-template-columns:1fr 1fr 120px auto;gap:12px;align-items:end;background:#0d0d0d;border:1px solid #1a1a1a;border-radius:8px;padding:16px;margin-bottom:18px;">
        @csrf
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;margin-bottom:5px;">Nom *</label>
            <input type="text" name="nom" required placeholder="VIP, Standard, Étudiant…"
                   style="width:100%;padding:8px 12px;background:#111;border:1px solid #1a1a1a;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;outline:none;box-sizing:border-box;"
                   onfocus="this.style.borderColor='#4caf7d'" onblur="this.style.borderColor='#1a1a1a'">
        </div>
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;margin-bottom:5px;">Description</label>
            <input type="text" name="description" placeholder="Accès salon VIP, boisson offerte…"
                   style="width:100%;padding:8px 12px;background:#111;border:1px solid #1a1a1a;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;outline:none;box-sizing:border-box;"
                   onfocus="this.style.borderColor='#4caf7d'" onblur="this.style.borderColor='#1a1a1a'">
        </div>
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;margin-bottom:5px;">Prix (FC) *</label>
            <input type="number" name="prix" required min="0" step="500" value="0" placeholder="0"
                   style="width:100%;padding:8px 12px;background:#111;border:1px solid #1a1a1a;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;outline:none;box-sizing:border-box;"
                   onfocus="this.style.borderColor='#4caf7d'" onblur="this.style.borderColor='#1a1a1a'">
        </div>
        <div>
            <button type="submit"
                    style="width:100%;padding:8px 16px;background:rgba(76,175,125,0.15);border:1px solid rgba(76,175,125,0.3);color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.8rem;font-weight:600;border-radius:6px;cursor:pointer;white-space:nowrap;">
                Ajouter
            </button>
        </div>
        <div style="grid-column:1/3;">
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#4caf7d;margin-bottom:5px;">Name / Description (EN) — optionnel</label>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                <input type="text" name="nom_en" placeholder="VIP, Standard, Student…"
                       style="width:100%;padding:8px 12px;background:#111;border:1px solid #1a1a1a;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;outline:none;box-sizing:border-box;">
                <input type="text" name="description_en" placeholder="VIP lounge access, free drink…"
                       style="width:100%;padding:8px 12px;background:#111;border:1px solid #1a1a1a;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;outline:none;box-sizing:border-box;">
            </div>
        </div>
    </form>

    {{-- Liste des catégories --}}
    @php $categoriesEvt = $evenement->billetCategories()->orderBy('ordre')->get(); @endphp

    @if($categoriesEvt->isEmpty())
    <div style="text-align:center;padding:28px;color:#444;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;">
        Aucune catégorie définie — le prix de l'événement ({{ $evenement->gratuit ? 'Gratuit' : number_format($evenement->prix,0,',',' ').' FC' }}) s'applique par défaut.
    </div>
    @else
    <div id="cat-sortable" style="display:flex;flex-direction:column;gap:8px;">
        @foreach($categoriesEvt as $cat)
        <div data-id="{{ $cat->id }}"
             style="display:flex;align-items:center;gap:14px;background:#0d0d0d;border:1px solid #1a1a1a;border-radius:8px;padding:12px 16px;transition:border 0.2s;">

            {{-- Poignée drag --}}
            <div class="drag-handle" style="color:#333;cursor:grab;flex-shrink:0;font-size:1rem;line-height:1;" title="Réordonner">⠿</div>

            {{-- Infos --}}
            <div style="flex:1;min-width:0;">
                <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                    <span style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.9rem;color:#f5f5f0;">{{ $cat->nom }}</span>
                    @if(!$cat->actif)
                    <span style="padding:1px 8px;background:rgba(224,112,48,0.1);border:1px solid rgba(224,112,48,0.2);color:#e07030;font-size:0.65rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;border-radius:20px;">Inactif</span>
                    @endif
                </div>
                @if($cat->description)
                <div style="font-size:0.78rem;color:#555;margin-top:2px;">{{ $cat->description }}</div>
                @endif
            </div>

            {{-- Prix --}}
            <div style="flex-shrink:0;text-align:right;min-width:80px;">
                @if($cat->prix == 0)
                <span style="font-family:'Space Grotesk',sans-serif;font-size:0.88rem;font-weight:700;color:#4caf7d;">Gratuit</span>
                @else
                <span style="font-family:'Playfair Display',serif;font-size:1rem;font-weight:700;color:#d4a030;">{{ number_format($cat->prix, 0, ',', ' ') }} FC</span>
                @endif
                <div style="font-size:0.7rem;color:#444;margin-top:1px;">{{ $cat->billets()->count() }} résa</div>
            </div>

            {{-- Actions --}}
            <div style="display:flex;gap:6px;flex-shrink:0;">
                {{-- Toggle actif --}}
                <form action="{{ route('admin.billets.categories.toggle', $cat) }}" method="POST" style="margin:0;">
                    @csrf @method('PATCH')
                    <button type="submit" title="{{ $cat->actif ? 'Désactiver' : 'Activer' }}"
                            style="padding:5px 10px;background:{{ $cat->actif ? 'rgba(76,175,125,0.08)' : 'rgba(255,255,255,0.04)' }};border:1px solid {{ $cat->actif ? 'rgba(76,175,125,0.2)' : '#1a1a1a' }};color:{{ $cat->actif ? '#4caf7d' : '#555' }};font-size:0.72rem;font-family:'Space Grotesk',sans-serif;font-weight:600;border-radius:4px;cursor:pointer;">
                        {{ $cat->actif ? '✓ Actif' : '○ Inactif' }}
                    </button>
                </form>

                {{-- Modifier (inline) --}}
                <button onclick="toggleEditCat({{ $cat->id }})"
                        style="padding:5px 10px;background:rgba(74,144,226,0.08);border:1px solid rgba(74,144,226,0.2);color:#4a90e2;font-size:0.72rem;font-family:'Space Grotesk',sans-serif;font-weight:600;border-radius:4px;cursor:pointer;">
                    Éditer
                </button>

                {{-- Supprimer --}}
                <form action="{{ route('admin.billets.categories.destroy', $cat) }}" method="POST" style="margin:0;"
                      onsubmit="return confirm('Supprimer la catégorie « {{ $cat->nom }} » ?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            style="padding:5px 10px;background:rgba(224,112,48,0.08);border:1px solid rgba(224,112,48,0.2);color:#e07030;font-size:0.72rem;font-family:'Space Grotesk',sans-serif;font-weight:600;border-radius:4px;cursor:pointer;">✕</button>
                </form>
            </div>
        </div>

        {{-- Formulaire d'édition inline (caché) --}}
        <form id="edit-cat-{{ $cat->id }}" action="{{ route('admin.billets.categories.update', $cat) }}" method="POST"
              style="display:none;grid-template-columns:1fr 1fr 120px auto;gap:10px;align-items:end;background:#0d0d0d;border:1px solid rgba(74,144,226,0.2);border-radius:8px;padding:14px 16px;margin-top:-4px;">
            @csrf @method('PATCH')
            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.66rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;margin-bottom:4px;">Nom</label>
                <input type="text" name="nom" value="{{ $cat->nom }}" required
                       style="width:100%;padding:7px 10px;background:#111;border:1px solid #1a1a1a;border-radius:5px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.83rem;outline:none;box-sizing:border-box;"
                       onfocus="this.style.borderColor='#4a90e2'" onblur="this.style.borderColor='#1a1a1a'">
            </div>
            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.66rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;margin-bottom:4px;">Description</label>
                <input type="text" name="description" value="{{ $cat->description }}"
                       style="width:100%;padding:7px 10px;background:#111;border:1px solid #1a1a1a;border-radius:5px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.83rem;outline:none;box-sizing:border-box;"
                       onfocus="this.style.borderColor='#4a90e2'" onblur="this.style.borderColor='#1a1a1a'">
            </div>
            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.66rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;margin-bottom:4px;">Prix (FC)</label>
                <input type="number" name="prix" value="{{ $cat->prix }}" required min="0" step="500"
                       style="width:100%;padding:7px 10px;background:#111;border:1px solid #1a1a1a;border-radius:5px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.83rem;outline:none;box-sizing:border-box;"
                       onfocus="this.style.borderColor='#4a90e2'" onblur="this.style.borderColor='#1a1a1a'">
            </div>
            <div style="display:flex;gap:6px;">
                <button type="submit" style="padding:7px 14px;background:rgba(74,144,226,0.12);border:1px solid rgba(74,144,226,0.3);color:#4a90e2;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;border-radius:5px;cursor:pointer;white-space:nowrap;">Enregistrer</button>
                <button type="button" onclick="toggleEditCat({{ $cat->id }})" style="padding:7px 10px;background:transparent;border:1px solid #1a1a1a;color:#555;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;border-radius:5px;cursor:pointer;">✕</button>
            </div>
            <div style="grid-column:1/3;">
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.66rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#4caf7d;margin-bottom:4px;">Name / Description (EN)</label>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">
                    <input type="text" name="nom_en" value="{{ $cat->getTranslation('nom', 'en', false) }}"
                           style="width:100%;padding:7px 10px;background:#111;border:1px solid #1a1a1a;border-radius:5px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.83rem;outline:none;box-sizing:border-box;">
                    <input type="text" name="description_en" value="{{ $cat->getTranslation('description', 'en', false) }}"
                           style="width:100%;padding:7px 10px;background:#111;border:1px solid #1a1a1a;border-radius:5px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.83rem;outline:none;box-sizing:border-box;">
                </div>
            </div>
        </form>
        @endforeach
    </div>
    @endif
</div>

{{-- Stats --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:24px;">
    @foreach([
        ['label' => 'Réservations',   'value' => $stats['total'],         'color' => '#4caf7d'],
        ['label' => 'En attente',     'value' => $stats['en_attente'],    'color' => '#d4a030'],
        ['label' => 'Confirmées',     'value' => $stats['confirmes'],     'color' => '#4a90e2'],
        ['label' => 'Annulées',       'value' => $stats['annules'],       'color' => '#e07030'],
        ['label' => 'Billets vendus', 'value' => $stats['total_billets'], 'color' => '#b07aff'],
        ['label' => 'Revenus',        'value' => number_format($stats['revenus'],0,',',' ').' FC', 'color' => '#d4a030'],
    ] as $s)
    <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:18px 20px;">
        <p style="font-family:'Space Grotesk',sans-serif;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#555;margin:0 0 8px;">{{ $s['label'] }}</p>
        <p style="font-family:'Playfair Display',serif;font-size:1.7rem;font-weight:900;color:{{ $s['color'] }};margin:0;line-height:1;">{{ $s['value'] }}</p>
    </div>
    @endforeach
</div>

{{-- Tableau des réservations --}}
<form action="{{ route('admin.billets.bulk') }}" method="POST" id="bulk-form">
@csrf

<div id="bulk-bar" style="display:none;background:rgba(76,175,125,0.06);border:1px solid rgba(76,175,125,0.2);border-radius:8px;padding:12px 16px;margin-bottom:12px;align-items:center;gap:14px;flex-wrap:wrap;">
    <span id="bulk-count" style="font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;color:#4caf7d;">0 sélectionné(s)</span>
    <select name="statut" style="padding:7px 12px;background:#0d0d0d;border:1px solid #1a1a1a;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;outline:none;cursor:pointer;">
        <option value="en_attente">→ En attente</option>
        <option value="confirme">→ Confirmer</option>
        <option value="annule">→ Annuler</option>
    </select>
    <button type="submit" onclick="return confirm('Modifier le statut des réservations sélectionnées ?')"
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
                    <input type="checkbox" id="select-all" style="width:15px;height:15px;cursor:pointer;accent-color:#4caf7d;">
                </th>
                @foreach(['Référence','Participant','Billets','Montant','Réservé le','Statut','Actions'] as $h)
                <th style="padding:12px 16px;text-align:left;font-family:'Space Grotesk',sans-serif;font-size:0.7rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;">{{ $h }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse($billets as $billet)
            <tr style="border-bottom:1px solid #161616;transition:background 0.2s;"
                onmouseover="this.style.background='rgba(255,255,255,0.025)'" onmouseout="this.style.background=''">
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
                <td style="padding:12px 16px;color:#aaa;font-size:0.84rem;text-align:center;font-weight:600;">{{ $billet->nombre_billets }}</td>
                <td style="padding:12px 16px;font-family:'Playfair Display',serif;font-size:0.9rem;{{ $billet->montant_total > 0 ? 'color:#d4a030' : 'color:#4caf7d' }}">
                    {{ $billet->montant_total > 0 ? number_format($billet->montant_total, 0, ',', ' ').' FC' : 'Gratuit' }}
                </td>
                <td style="padding:12px 16px;color:#555;font-size:0.77rem;white-space:nowrap;">{{ $billet->created_at->format('d/m/Y H:i') }}</td>
                <td style="padding:12px 16px;">
                    @if($billet->statut === 'confirme')
                    <span class="tag tag-green">Confirmé</span>
                    @elseif($billet->statut === 'annule')
                    <span class="tag tag-orange">Annulé</span>
                    @else
                    <span class="tag tag-white">En attente</span>
                    @endif
                </td>
                <td style="padding:12px 16px;">
                    <div style="display:flex;gap:7px;">
                        <a href="{{ route('admin.billets.show', $billet) }}"
                           style="padding:5px 11px;background:rgba(76,175,125,0.1);border:1px solid rgba(76,175,125,0.2);color:#4caf7d;font-size:0.73rem;font-family:'Space Grotesk',sans-serif;font-weight:600;text-decoration:none;border-radius:4px;"
                           onmouseover="this.style.background='rgba(76,175,125,0.2)'" onmouseout="this.style.background='rgba(76,175,125,0.1)'">Voir</a>
                        <a href="mailto:{{ $billet->email }}?subject=Votre réservation {{ $billet->reference }}" title="Email"
                           style="padding:5px 8px;background:rgba(74,144,226,0.08);border:1px solid rgba(74,144,226,0.2);color:#4a90e2;font-size:0.73rem;text-decoration:none;border-radius:4px;"
                           onmouseover="this.style.background='rgba(74,144,226,0.2)'" onmouseout="this.style.background='rgba(74,144,226,0.08)'">✉</a>
                        <form action="{{ route('admin.billets.destroy', $billet) }}" method="POST" style="margin:0;"
                              onsubmit="return confirm('Supprimer cette réservation ?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    style="padding:5px 10px;background:rgba(224,112,48,0.08);border:1px solid rgba(224,112,48,0.2);color:#e07030;font-size:0.73rem;font-family:'Space Grotesk',sans-serif;font-weight:600;cursor:pointer;border-radius:4px;"
                                    onmouseover="this.style.background='rgba(224,112,48,0.2)'" onmouseout="this.style.background='rgba(224,112,48,0.08)'">✕</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="padding:56px;text-align:center;color:#555;font-size:0.88rem;">Aucune réservation pour cet événement.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
</form>

@if($billets->hasPages())
<div style="margin-top:20px;">{{ $billets->links() }}</div>
@endif

@push('scripts')
<script>
const selectAll = document.getElementById('select-all');
const checks    = () => document.querySelectorAll('.billet-check');
const bulkBar   = document.getElementById('bulk-bar');
const bulkCount = document.getElementById('bulk-count');
function refreshBulkBar() {
    const n = document.querySelectorAll('.billet-check:checked').length;
    bulkBar.style.display = n > 0 ? 'flex' : 'none';
    bulkCount.textContent = n + ' sélectionné' + (n > 1 ? 's' : '');
    checks().forEach(cb => { cb.closest('tr').style.background = cb.checked ? 'rgba(76,175,125,0.04)' : ''; });
}
selectAll.addEventListener('change', () => { checks().forEach(cb => cb.checked = selectAll.checked); refreshBulkBar(); });
document.addEventListener('change', e => {
    if (e.target.classList.contains('billet-check')) {
        selectAll.checked = [...checks()].every(c => c.checked);
        selectAll.indeterminate = !selectAll.checked && [...checks()].some(c => c.checked);
        refreshBulkBar();
    }
});
function clearSelection() { checks().forEach(cb => cb.checked = false); selectAll.checked = false; selectAll.indeterminate = false; refreshBulkBar(); }

function toggleEditCat(id) {
    const form = document.getElementById('edit-cat-' + id);
    form.style.display = form.style.display === 'none' ? 'grid' : 'none';
}

// Drag-and-drop réordonnancement des catégories
const catSortable = document.getElementById('cat-sortable');
if (catSortable && typeof Sortable !== 'undefined') {
    Sortable.create(catSortable, {
        handle: '.drag-handle',
        animation: 150,
        onEnd: () => {
            const ids = [...catSortable.querySelectorAll('[data-id]')].map(el => el.dataset.id);
            fetch('{{ route('admin.billets.categories.reorder') }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content },
                body: JSON.stringify({ ids }),
            });
        },
    });
}

function adminCopierLien() {
    const url = document.getElementById('share-url').value;
    navigator.clipboard.writeText(url).then(() => {
        const label = document.getElementById('admin-copy-label');
        const btn   = document.getElementById('admin-copy-btn');
        label.textContent     = '✓ Copié !';
        btn.style.borderColor = 'rgba(76,175,125,0.5)';
        btn.style.color       = '#4caf7d';
        setTimeout(() => {
            label.textContent     = 'Copier';
            btn.style.borderColor = 'rgba(76,175,125,0.2)';
        }, 2500);
    });
}
</script>
@endpush

@endsection
