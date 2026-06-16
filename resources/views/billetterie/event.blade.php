@extends('layouts.app')

@section('title', 'Réserver — ' . $evenement->titre)
@section('meta_description', 'Réservez vos billets pour « ' . $evenement->titre . ' » au Centre d\'Art Orion.')

@section('content')

{{-- ══ HERO COMPACT ══ --}}
<section style="background:#0a0a0a;padding:88px 0 36px;border-bottom:1px solid #1a1a1a;">
    <div style="max-width:1080px;margin:0 auto;padding:0 24px;">

        {{-- Breadcrumb + partage --}}
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;gap:10px;flex-wrap:wrap;">
            <a href="{{ route('billetterie.index') }}"
               style="display:inline-flex;align-items:center;gap:5px;color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;text-decoration:none;opacity:0.8;transition:opacity 0.2s;"
               onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0.8">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                Billetterie
            </a>
            {{-- Icônes de partage (compactes) --}}
            <div style="display:flex;align-items:center;gap:6px;">
                <button id="btn-copy-link" onclick="copierLien()" title="Copier le lien"
                        style="display:inline-flex;align-items:center;gap:5px;padding:5px 10px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);color:#888;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:600;border-radius:5px;cursor:pointer;transition:all 0.2s;"
                        onmouseover="this.style.color='#f5f5f0';this.style.borderColor='rgba(255,255,255,0.2)'"
                        onmouseout="this.style.color='#888';this.style.borderColor='rgba(255,255,255,0.1)'">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
                    <span id="copy-label">Lien</span>
                </button>
                @foreach([
                    ['href' => 'https://wa.me/?text='.urlencode('🎭 '.$evenement->titre.' : '.route('billetterie.show',$evenement->slug)), 'title' => 'WhatsApp', 'color' => '#25d166', 'bg' => 'rgba(37,211,102,0.1)', 'svg' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="#25d166"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 2C6.477 2 2 6.477 2 12c0 1.989.518 3.86 1.426 5.486L2 22l4.656-1.397A9.956 9.956 0 0012 22c5.523 0 10-4.477 10-10S17.522 2 12 2z" fill-rule="evenodd"/></svg>'],
                    ['href' => 'https://www.facebook.com/sharer/sharer.php?u='.urlencode(route('billetterie.show',$evenement->slug)), 'title' => 'Facebook', 'color' => '#1877f2', 'bg' => 'rgba(24,119,242,0.1)', 'svg' => '<svg width="13" height="13" viewBox="0 0 24 24" fill="#1877f2"><path d="M24 12.073C24 5.404 18.627 0 12 0S0 5.404 0 12.073C0 18.1 4.388 23.094 10.125 24v-8.437H7.078v-3.49h3.047V9.41c0-3.025 1.792-4.697 4.533-4.697 1.312 0 2.686.236 2.686.236v2.971h-1.514c-1.491 0-1.956.93-1.956 1.886v2.267h3.328l-.532 3.49h-2.796V24C19.612 23.094 24 18.1 24 12.073z"/></svg>'],
                    ['href' => 'https://twitter.com/intent/tweet?text='.urlencode('🎭 '.$evenement->titre).'&url='.urlencode(route('billetterie.show',$evenement->slug)), 'title' => 'X', 'color' => '#aaa', 'bg' => 'rgba(255,255,255,0.06)', 'svg' => '<svg width="12" height="12" viewBox="0 0 24 24" fill="#aaa"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.737-8.835L1.254 2.25H8.08l4.253 5.622L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>'],
                ] as $s)
                <a href="{{ $s['href'] }}" target="_blank" rel="noopener" title="{{ $s['title'] }}"
                   style="display:inline-flex;align-items:center;justify-content:center;width:28px;height:28px;background:{{ $s['bg'] }};border:1px solid {{ $s['bg'] }};border-radius:5px;text-decoration:none;transition:opacity 0.2s;"
                   onmouseover="this.style.opacity=0.75" onmouseout="this.style.opacity=1">
                    {!! $s['svg'] !!}
                </a>
                @endforeach
            </div>
        </div>

        {{-- Titre + méta --}}
        <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:24px;flex-wrap:wrap;">
            <div style="flex:1;min-width:0;">
                @if($evenement->type)
                <span style="display:inline-block;padding:2px 10px;background:rgba(76,175,125,0.12);color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.65rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;border-radius:20px;margin-bottom:10px;">{{ $evenement->type }}</span>
                @endif
                <h1 style="font-family:'Playfair Display',serif;font-size:clamp(1.5rem,3.5vw,2.4rem);font-weight:900;color:#f5f5f0;margin:0 0 10px;line-height:1.2;">{{ $evenement->titre }}</h1>
                <div style="display:flex;flex-wrap:wrap;gap:14px;">
                    <span style="display:flex;align-items:center;gap:5px;color:#888;font-family:'Space Grotesk',sans-serif;font-size:0.8rem;">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#4caf7d" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        {{ $evenement->date_debut->isoFormat('ddd D MMM YYYY [·] HH:mm') }}
                    </span>
                    @if($evenement->lieu)
                    <span style="display:flex;align-items:center;gap:5px;color:#888;font-family:'Space Grotesk',sans-serif;font-size:0.8rem;">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#4caf7d" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        {{ $evenement->lieu }}
                    </span>
                    @endif
                </div>
            </div>
            <div style="text-align:right;flex-shrink:0;">
                @if($evenement->gratuit || ($categories->isEmpty() && (!$evenement->prix || $evenement->prix == 0)))
                <div style="font-family:'Space Grotesk',sans-serif;font-size:1rem;font-weight:700;color:#4caf7d;">Gratuit</div>
                @elseif($categories->isEmpty())
                <div style="font-family:'Space Grotesk',sans-serif;font-size:0.65rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#666;margin-bottom:2px;">/ billet</div>
                <div style="font-family:'Playfair Display',serif;font-size:1.8rem;font-weight:900;color:#d4a030;line-height:1;">{{ number_format($evenement->prix, 0, ',', ' ') }}<span style="font-size:1rem;"> FC</span></div>
                @else
                <div style="font-family:'Space Grotesk',sans-serif;font-size:0.7rem;font-weight:600;color:#888;">{{ $categories->count() }} catégorie{{ $categories->count() > 1 ? 's' : '' }}</div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ══ CORPS ══ --}}
<section style="padding:48px 0 72px;background:#faf8f4;">
    <div style="max-width:1080px;margin:0 auto;padding:0 24px;display:grid;grid-template-columns:1fr 400px;gap:48px;align-items:start;">

        {{-- Description --}}
        <div>
            @if($evenement->image_url)
            <div style="border-radius:10px;overflow:hidden;margin-bottom:28px;max-height:360px;">
                <img src="{{ $evenement->image_url }}" alt="{{ $evenement->titre }}" style="width:100%;height:100%;object-fit:cover;">
            </div>
            @endif
            <h2 style="font-family:'Playfair Display',serif;font-size:1.25rem;font-weight:700;color:#1c1510;margin:0 0 12px;">À propos</h2>
            <p style="color:#555;font-size:0.92rem;line-height:1.75;margin:0 0 16px;">{{ $evenement->description }}</p>
            @if($evenement->contenu)
            <div style="color:#555;font-size:0.92rem;line-height:1.75;border-top:1px solid #ede8e0;padding-top:16px;">
                {!! nl2br(e($evenement->contenu)) !!}
            </div>
            @endif
        </div>

        {{-- ══ FORMULAIRE ══ --}}
        <div style="position:sticky;top:96px;">
            <div style="background:#fff;border:1px solid #e8e2da;border-radius:14px;overflow:hidden;box-shadow:0 2px 20px rgba(28,21,16,0.08);">

                {{-- En-tête formulaire --}}
                <div style="padding:18px 22px;border-bottom:1px solid #f0ebe3;background:linear-gradient(135deg,#faf8f5,#f5f0e8);">
                    <h3 style="font-family:'Playfair Display',serif;font-size:1.05rem;font-weight:700;color:#1c1510;margin:0;">Réserver ma place</h3>
                </div>

                <div style="padding:18px 22px;">

                    @if($errors->any())
                    <div style="background:rgba(224,112,48,0.06);border:1px solid rgba(224,112,48,0.25);border-radius:7px;padding:10px 14px;margin-bottom:14px;">
                        @foreach($errors->all() as $err)
                        <p style="color:#c05520;font-size:0.8rem;margin:2px 0;font-family:'Space Grotesk',sans-serif;">{{ $err }}</p>
                        @endforeach
                    </div>
                    @endif

                    <form action="{{ route('billetterie.store', $evenement->slug) }}" method="POST" enctype="multipart/form-data" id="billet-form">
                    @csrf

                    {{-- ── 1. Catégorie ── --}}
                    @if($categories->isNotEmpty())
                    <div style="margin-bottom:16px;">
                        <div style="font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#999;margin-bottom:8px;">Catégorie *</div>
                        <div style="display:flex;flex-direction:column;gap:6px;" id="categorie-list">
                            @foreach($categories as $cat)
                            <label id="cat-label-{{ $cat->id }}"
                                   onclick="selectionnerCategorie({{ $cat->id }}, {{ (float)$cat->prix }})"
                                   style="display:flex;align-items:center;justify-content:space-between;padding:9px 12px;border:1.5px solid {{ old('billet_categorie_id') == $cat->id ? '#4caf7d' : '#e8e2da' }};border-radius:8px;cursor:pointer;background:{{ old('billet_categorie_id') == $cat->id ? 'rgba(76,175,125,0.04)' : '#faf8f4' }};transition:all 0.15s;">
                                <div style="display:flex;align-items:center;gap:8px;">
                                    <input type="radio" name="billet_categorie_id" value="{{ $cat->id }}" id="cat-{{ $cat->id }}"
                                           {{ old('billet_categorie_id') == $cat->id ? 'checked' : '' }} required
                                           style="width:14px;height:14px;accent-color:#4caf7d;flex-shrink:0;">
                                    <div>
                                        <div style="font-family:'Space Grotesk',sans-serif;font-weight:600;font-size:0.85rem;color:#1c1510;line-height:1.2;">{{ $cat->nom }}</div>
                                        @if($cat->description)<div style="font-size:0.72rem;color:#999;margin-top:1px;">{{ $cat->description }}</div>@endif
                                    </div>
                                </div>
                                <span style="font-family:'{{ $cat->prix > 0 ? 'Playfair Display' : 'Space Grotesk' }}',serif;font-size:{{ $cat->prix > 0 ? '0.95rem' : '0.8rem' }};font-weight:700;color:{{ $cat->prix > 0 ? '#d4a030' : '#4caf7d' }};flex-shrink:0;margin-left:8px;">
                                    {{ $cat->prix > 0 ? number_format($cat->prix, 0, ',', ' ').' FC' : 'Gratuit' }}
                                </span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- ── 2. Identité (2 colonnes) ── --}}
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:10px;">
                        <div>
                            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;color:#999;margin-bottom:4px;">Prénom *</label>
                            <input type="text" name="prenom" value="{{ old('prenom') }}" required autocomplete="given-name"
                                   style="width:100%;padding:8px 10px;border:1.5px solid #e2dcd4;border-radius:7px;font-size:0.88rem;font-family:'Inter',sans-serif;color:#1c1510;background:#fafaf8;box-sizing:border-box;outline:none;transition:border 0.15s;"
                                   onfocus="this.style.borderColor='#4caf7d'" onblur="this.style.borderColor='#e2dcd4'">
                        </div>
                        <div>
                            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;color:#999;margin-bottom:4px;">Nom *</label>
                            <input type="text" name="nom" value="{{ old('nom') }}" required autocomplete="family-name"
                                   style="width:100%;padding:8px 10px;border:1.5px solid #e2dcd4;border-radius:7px;font-size:0.88rem;font-family:'Inter',sans-serif;color:#1c1510;background:#fafaf8;box-sizing:border-box;outline:none;transition:border 0.15s;"
                                   onfocus="this.style.borderColor='#4caf7d'" onblur="this.style.borderColor='#e2dcd4'">
                        </div>
                    </div>

                    {{-- Email + Téléphone sur une ligne --}}
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:10px;">
                        <div>
                            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;color:#999;margin-bottom:4px;">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" autocomplete="email"
                                   style="width:100%;padding:8px 10px;border:1.5px solid #e2dcd4;border-radius:7px;font-size:0.88rem;font-family:'Inter',sans-serif;color:#1c1510;background:#fafaf8;box-sizing:border-box;outline:none;transition:border 0.15s;"
                                   onfocus="this.style.borderColor='#4caf7d'" onblur="this.style.borderColor='#e2dcd4'">
                        </div>
                        <div>
                            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;color:#999;margin-bottom:4px;">Téléphone</label>
                            <input type="tel" name="telephone" value="{{ old('telephone') }}" autocomplete="tel"
                                   style="width:100%;padding:8px 10px;border:1.5px solid #e2dcd4;border-radius:7px;font-size:0.88rem;font-family:'Inter',sans-serif;color:#1c1510;background:#fafaf8;box-sizing:border-box;outline:none;transition:border 0.15s;"
                                   onfocus="this.style.borderColor='#4caf7d'" onblur="this.style.borderColor='#e2dcd4'">
                        </div>
                    </div>

                    {{-- ── 3. Quantité (stepper) + Total ── --}}
                    <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 12px;background:#faf8f4;border:1.5px solid #e8e2da;border-radius:8px;margin-bottom:14px;">
                        <span style="font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;color:#444;">Billets</span>
                        <div style="display:flex;align-items:center;gap:0;">
                            <button type="button" onclick="changerQte(-1)"
                                    style="width:28px;height:28px;border:1px solid #ddd;border-radius:5px 0 0 5px;background:#fff;color:#444;font-size:1rem;cursor:pointer;line-height:1;transition:background 0.15s;"
                                    onmouseover="this.style.background='#f0ebe3'" onmouseout="this.style.background='#fff'">−</button>
                            <input type="number" name="nombre_billets" id="nb-billets" value="{{ old('nombre_billets', 1) }}" min="1" max="20" readonly
                                   style="width:40px;height:28px;border-top:1px solid #ddd;border-bottom:1px solid #ddd;border-left:none;border-right:none;text-align:center;font-family:'Space Grotesk',sans-serif;font-size:0.9rem;font-weight:700;color:#1c1510;background:#fff;outline:none;">
                            <button type="button" onclick="changerQte(1)"
                                    style="width:28px;height:28px;border:1px solid #ddd;border-radius:0 5px 5px 0;background:#fff;color:#444;font-size:1rem;cursor:pointer;line-height:1;transition:background 0.15s;"
                                    onmouseover="this.style.background='#f0ebe3'" onmouseout="this.style.background='#fff'">+</button>
                        </div>
                        <div style="text-align:right;">
                            <div id="total-display" style="font-family:'Playfair Display',serif;font-size:1.05rem;font-weight:700;color:#d4a030;">
                                @if($categories->isNotEmpty()) — @elseif($evenement->gratuit) Gratuit @else {{ number_format($evenement->prix, 0, ',', ' ') }} FC @endif
                            </div>
                            @if($categories->isNotEmpty())
                            <div id="recap-categorie" style="font-size:0.68rem;color:#bbb;">choisir catégorie</div>
                            @endif
                        </div>
                    </div>

                    {{-- ── 4. Paiement (si montant > 0) ── --}}
                    @if($categories->isNotEmpty() || (!$evenement->gratuit && $evenement->prix > 0))
                    <div id="section-paiement" style="margin-bottom:14px;display:none;">
                        <div style="font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#999;margin-bottom:8px;">Mode de paiement</div>

                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:6px;margin-bottom:0;" id="methodes-list">
                            @foreach($toutesMethodes as $cle => $methode)
                            @php $estActif = $methode['actif']; @endphp

                            @if($estActif)
                            {{-- Méthode active : sélectionnable --}}
                            <label id="methode-label-{{ $cle }}"
                                   onclick="selectionnerMethode('{{ $cle }}')"
                                   style="display:flex;align-items:flex-start;gap:7px;padding:9px 10px;border:1.5px solid {{ old('methode_paiement') === $cle ? $methode['couleur'] : '#e8e2da' }};border-radius:8px;cursor:pointer;background:{{ old('methode_paiement') === $cle ? $methode['bg'] : '#fafaf8' }};transition:all 0.15s;position:relative;">
                                <input type="radio" name="methode_paiement" value="{{ $cle }}" id="methode-{{ $cle }}"
                                       {{ old('methode_paiement') === $cle ? 'checked' : '' }}
                                       style="width:13px;height:13px;accent-color:{{ $methode['couleur'] }};flex-shrink:0;margin-top:2px;">
                                <div style="min-width:0;">
                                    <div style="display:flex;align-items:center;gap:4px;flex-wrap:wrap;">
                                        <div style="width:6px;height:6px;border-radius:50%;background:{{ $methode['couleur'] }};flex-shrink:0;"></div>
                                        <span style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.78rem;color:#1c1510;line-height:1.2;">{{ $methode['label'] }}</span>
                                    </div>
                                    @if($cle === 'especes')
                                    <div style="font-size:0.67rem;color:#4caf7d;margin-top:2px;font-weight:600;">Disponible</div>
                                    @elseif(!empty($methode['numero']))
                                    <div style="font-size:0.67rem;color:#888;margin-top:2px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $methode['numero'] }}</div>
                                    @endif
                                </div>
                            </label>

                            @else
                            {{-- Méthode inactive : visible mais non sélectionnable --}}
                            <div style="display:flex;align-items:flex-start;gap:7px;padding:9px 10px;border:1.5px dashed #e8e2da;border-radius:8px;background:#fafaf8;opacity:0.65;cursor:not-allowed;position:relative;">
                                <div style="width:13px;height:13px;border:1.5px solid #ddd;border-radius:50%;flex-shrink:0;margin-top:2px;"></div>
                                <div style="min-width:0;">
                                    <div style="display:flex;align-items:center;gap:4px;">
                                        <div style="width:6px;height:6px;border-radius:50%;background:{{ $methode['couleur'] }};flex-shrink:0;"></div>
                                        <span style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.78rem;color:#888;line-height:1.2;">{{ $methode['label'] }}</span>
                                    </div>
                                    <div style="font-size:0.65rem;color:#bbb;margin-top:2px;font-weight:600;letter-spacing:0.03em;">Bientôt disponible</div>
                                </div>
                            </div>
                            @endif

                            @endforeach
                        </div>

                        {{-- Espèces seules actives : message et input caché automatique --}}
                        @php $nbActives = collect($toutesMethodes)->filter(fn($m) => $m['actif'])->count(); @endphp
                        @if($nbActives === 1 && isset($toutesMethodes['especes']) && $toutesMethodes['especes']['actif'])
                        <input type="hidden" name="methode_paiement" value="especes">
                        <div style="margin-top:8px;display:flex;align-items:center;gap:7px;padding:9px 12px;background:rgba(76,175,125,0.05);border:1.5px solid rgba(76,175,125,0.18);border-radius:7px;">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#4caf7d" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 8 12 12 14 14"/></svg>
                            <span style="font-family:'Space Grotesk',sans-serif;font-size:0.78rem;color:#2d7a52;font-weight:500;">
                                {{ !empty($toutesMethodes['especes']['note']) ? $toutesMethodes['especes']['note'] : 'Présentez votre référence à la caisse à l\'entrée.' }}
                            </span>
                        </div>
                        @endif

                        {{-- Bloc référence (Mobile Money actif sélectionné) --}}
                        <div id="bloc-reference" style="margin-top:10px;display:none;">
                            <div style="padding:10px 12px;background:#faf8f4;border:1.5px solid #e8e2da;border-radius:8px;">
                                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;color:#999;margin-bottom:5px;">Référence de transaction *</label>
                                <input type="text" name="reference_paiement" id="reference_paiement"
                                       value="{{ old('reference_paiement') }}" placeholder="Ex : TX123456789"
                                       style="width:100%;padding:7px 10px;border:1.5px solid #e2dcd4;border-radius:6px;font-size:0.88rem;font-family:'Inter',sans-serif;color:#1c1510;background:#fff;box-sizing:border-box;outline:none;transition:border 0.15s;margin-bottom:8px;"
                                       onfocus="this.style.borderColor='#4caf7d'" onblur="this.style.borderColor='#e2dcd4'">
                                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;color:#bbb;margin-bottom:4px;">Preuve (optionnel)</label>
                                <input type="file" name="preuve_paiement" accept="image/*,.pdf"
                                       style="width:100%;font-size:0.8rem;font-family:'Inter',sans-serif;color:#888;cursor:pointer;">
                            </div>
                        </div>

                    </div>
                    @endif

                    {{-- Bouton soumettre --}}
                    <button type="submit"
                            style="width:100%;padding:11px 16px;background:linear-gradient(135deg,#4caf7d,#2d7a52);color:#fff;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;border:none;border-radius:8px;cursor:pointer;transition:box-shadow 0.2s;"
                            onmouseover="this.style.boxShadow='0 6px 20px rgba(76,175,125,0.4)'"
                            onmouseout="this.style.boxShadow=''">
                        Confirmer ma réservation
                    </button>

                    <p style="text-align:center;font-family:'Space Grotesk',sans-serif;font-size:0.7rem;color:#bbb;margin:10px 0 0;">
                        * champs obligatoires
                    </p>

                    </form>
                </div>
            </div>
        </div>

    </div>
</section>

@push('scripts')
<script>
// ── Quantité (stepper) ────────────────────────────────────────
function changerQte(delta) {
    const input = document.getElementById('nb-billets');
    const val   = Math.min(20, Math.max(1, parseInt(input.value) + delta));
    input.value = val;
    majTotal(val);
}

// ── Prix / catégories ─────────────────────────────────────────
const categoriesData = @json($categories->keyBy('id')->map(fn($c) => ['nom' => $c->nom, 'prix' => (float)$c->prix]));
const prixDefaut     = {{ $evenement->gratuit ? 0 : (float)($evenement->prix ?? 0) }};
let   prixActuel     = Object.keys(categoriesData).length === 0 ? prixDefaut : null;

function selectionnerCategorie(id, prix) {
    prixActuel = prix;
    document.querySelectorAll('#categorie-list label').forEach(l => { l.style.borderColor='#e8e2da'; l.style.background='#faf8f4'; });
    const lbl = document.getElementById('cat-label-' + id);
    if (lbl) { lbl.style.borderColor='#4caf7d'; lbl.style.background='rgba(76,175,125,0.04)'; }
    document.getElementById('cat-' + id).checked = true;
    const recap = document.getElementById('recap-categorie');
    if (recap) recap.textContent = categoriesData[id]?.nom ?? '';
    afficherTotal(prix * parseInt(document.getElementById('nb-billets').value));
}

function majTotal(nb) {
    if (prixActuel === null) return;
    afficherTotal(prixActuel * parseInt(nb));
}

function afficherTotal(montant) {
    const el = document.getElementById('total-display');
    if (!el) return;
    el.textContent = montant === 0 ? 'Gratuit' : montant.toLocaleString('fr-FR') + ' FC';
    el.style.color = montant === 0 ? '#4caf7d' : '#d4a030';
    afficherSectionPaiement(montant);
}

// ── Paiement ──────────────────────────────────────────────────
const methodesMM   = ['mpesa', 'airtel', 'orange'];
const methodeMeta  = @json(\App\Models\Billet::METHODES);

function selectionnerMethode(cle) {
    document.querySelectorAll('#methodes-list label').forEach(l => { l.style.borderColor='#e8e2da'; l.style.background='#fafaf8'; });
    const lbl = document.getElementById('methode-label-' + cle);
    if (lbl && methodeMeta[cle]) { lbl.style.borderColor=methodeMeta[cle].couleur; lbl.style.background=methodeMeta[cle].bg; }
    document.getElementById('methode-' + cle).checked = true;
    const bloc   = document.getElementById('bloc-reference');
    const refInp = document.getElementById('reference_paiement');
    if (bloc)   bloc.style.display = methodesMM.includes(cle) ? 'block' : 'none';
    if (refInp) refInp.required    = methodesMM.includes(cle);
}

function afficherSectionPaiement(montant) {
    const s = document.getElementById('section-paiement');
    if (s) s.style.display = montant > 0 ? 'block' : 'none';
}

// Init pré-sélections (old())
@if(old('billet_categorie_id') && $categories->isNotEmpty())
(function(){ const id={{ (int)old('billet_categorie_id') }}; if(categoriesData[id]) selectionnerCategorie(id,categoriesData[id].prix); })();
@elseif($categories->isEmpty())
document.getElementById('nb-billets').addEventListener('change', e => majTotal(e.target.value));
@endif

@if($categories->isEmpty() && !$evenement->gratuit && $evenement->prix > 0)
afficherSectionPaiement({{ (float)$evenement->prix }});
@endif

@if(old('methode_paiement'))
selectionnerMethode('{{ old('methode_paiement') }}');
@endif

// ── Copie lien ────────────────────────────────────────────────
function copierLien() {
    navigator.clipboard.writeText('{{ route('billetterie.show', $evenement->slug) }}').then(() => {
        const l = document.getElementById('copy-label');
        const b = document.getElementById('btn-copy-link');
        l.textContent = '✓ Copié'; b.style.color='#4caf7d'; b.style.borderColor='rgba(76,175,125,0.4)';
        setTimeout(() => { l.textContent='Lien'; b.style.color='#888'; b.style.borderColor='rgba(255,255,255,0.1)'; }, 2200);
    });
}
</script>
@endpush

@endsection
