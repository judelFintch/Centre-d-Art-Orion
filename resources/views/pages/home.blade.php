@extends('layouts.app')

@section('title', 'Centre d\'Art Orion — Production, Création, Formation')
@section('meta_description', 'Le Centre d\'Art Orion : votre espace de production artistique, création, formation et accompagnement des talents. Découvrez nos programmes et événements.')

@section('content')

<div class="home-biasasa">

{{-- ════════════════════════════════════════════════════════════
     HERO CINÉMATOGRAPHIQUE — Diagonal Wipe
════════════════════════════════════════════════════════════ --}}
<section class="hc-section hero-orion" id="hc-section">

    {{-- Barre colorée top (3 px) --}}
    <div class="hc-accent-bar"></div>

    {{-- ─── 3 Slides ─── --}}
    <div class="hc-slides">
        <div class="hc-slide active" data-accent="#4caf7d" data-label="Arts Visuels">
            <div class="hc-photo" style="background-image:url('{{ asset('images/11.jpg') }}')"></div>
            <div class="hc-overlay"></div>
            <div class="hc-tint" style="background-color:#4caf7d"></div>
        </div>
        <div class="hc-slide" data-accent="#d4a030" data-label="Musique &amp; Scène">
            <div class="hc-photo" style="background-image:url('{{ asset('images/22.jpg') }}')"></div>
            <div class="hc-overlay"></div>
            <div class="hc-tint" style="background-color:#d4a030"></div>
        </div>
        <div class="hc-slide" data-accent="#e07030" data-label="Formation">
            <div class="hc-photo" style="background-image:url('{{ asset('images/5.jpg') }}')"></div>
            <div class="hc-overlay"></div>
            <div class="hc-tint" style="background-color:#e07030"></div>
        </div>
    </div>

    {{-- ─── Lignes diagonales décoratives ─── --}}
    <div class="hc-deco" aria-hidden="true"></div>

    {{-- ─── Filigrane numéro ─── --}}
    <div class="hc-watermark" aria-hidden="true">01</div>

    {{-- ─── Barre supérieure : logo | compteur | localisation ─── --}}
    <div class="hc-top">
        <img src="{{ asset('images/logo.png') }}" alt="Centre d'Art Orion" class="hc-logo">
        <div class="hc-counter" aria-live="polite">
            <span class="hc-counter-cur">01</span>
            <span class="hc-counter-sep"> / 03</span>
        </div>
        <span class="hc-location">Kinshasa — Congo RDC</span>
    </div>

    {{-- ─── Corps centré ─── --}}
    <div class="hc-body">
        <div class="hc-center">
            {{-- Kicker symétrique ──── label ──── --}}
            <div class="hc-kicker">
                <span class="hc-kicker-line"></span>
                <span class="hc-kicker-label">Arts Visuels</span>
                <span class="hc-kicker-line"></span>
            </div>
            <h1 class="hc-title">
                <span class="hc-title-wrap"><span class="hc-title-line">L'Art au cœur</span></span>
                <span class="hc-title-wrap"><span class="hc-title-line hc-title-accent">de votre vie</span></span>
            </h1>
            <p class="hc-lead">Production · Création · Formation</p>
            <a href="{{ route('about') }}" class="hc-cta">
                Découvrir l'univers
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>

    {{-- ─── Barre inférieure : stats + dots ─── --}}
    <div class="hc-bottom-bar">
        <div class="hc-stats">
            @foreach([['100+','Artistes'],['50+','Événements'],['6','Disciplines']] as $st)
            <div class="hc-stat">
                <div class="hc-stat-val">{{ $st[0] }}</div>
                <div class="hc-stat-lbl">{{ $st[1] }}</div>
            </div>
            @if(!$loop->last)<span class="hc-stat-sep"></span>@endif
            @endforeach
        </div>
        <div class="hc-dots" role="tablist" aria-label="Navigation slides">
            <button class="hc-dot active" data-i="0" aria-label="Slide 1" role="tab" aria-selected="true"></button>
            <button class="hc-dot" data-i="1" aria-label="Slide 2" role="tab" aria-selected="false"></button>
            <button class="hc-dot" data-i="2" aria-label="Slide 3" role="tab" aria-selected="false"></button>
        </div>
    </div>

    {{-- ─── Flèche scroll vers le bas ─── --}}
    <button class="hc-scroll-arrow" aria-label="Défiler vers le bas">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="6 9 12 15 18 9"/>
        </svg>
    </button>

    {{-- ─── Barre de progression plein écran (bas) ─── --}}
    <div class="hc-progress"><div class="hc-progress-fill"></div></div>

</section>

{{-- ════════════════════════════════════════════════════════════
     NOTRE IDENTITÉ — Manifesto éditorial
════════════════════════════════════════════════════════════ --}}
<section class="ni-section">
    <div class="ni-inner">

        {{-- ── Côté texte ── --}}
        <div class="ni-text reveal">

            {{-- Mot décoratif de fond --}}
            <span class="ni-bg-word" aria-hidden="true">ORION</span>

            {{-- Kicker --}}
            <div class="ni-kicker">
                <span class="ni-kicker-bar"></span>
                <span class="ni-kicker-label">Notre identité</span>
            </div>

            {{-- Titre — italic vert + normal sombre --}}
            <h2 class="ni-title">
                <em>Un espace dédié à</em><br>
                l'excellence artistique
            </h2>

            {{-- Métriques éditoriales --}}
            <div class="ni-strip">
                @foreach([['5+','#4caf7d','Années'],['100+','#d4a030','Artistes'],['6','#e07030','Disciplines']] as $s)
                <div class="ni-strip-item">
                    <span class="ni-strip-val" style="color:{{ $s[1] }}">{{ $s[0] }}</span>
                    <span class="ni-strip-lbl">{{ $s[2] }}</span>
                </div>
                @if(!$loop->last)<span class="ni-strip-dot">·</span>@endif
                @endforeach
            </div>

            {{-- Corps --}}
            <p class="ni-prose">
                Fondé par <strong>Aras M. NGONGO</strong>, le Centre d'Art Orion est bien plus qu'un espace de formation — c'est un écosystème artistique complet où les talents émergent, se développent et rayonnent.
            </p>

            {{-- Points-clés numérotés --}}
            <div class="ni-features">
                @foreach([
                    ['01','#4caf7d','Accompagnement personnalisé de chaque artiste'],
                    ['02','#d4a030','Équipements professionnels de pointe'],
                    ['03','#e07030','Réseau actif de partenaires culturels'],
                ] as $f)
                <div class="ni-feature">
                    <span class="ni-feat-num" style="color:{{ $f[1] }}">{{ $f[0] }}</span>
                    <span class="ni-feat-bar" style="background:{{ $f[1] }}"></span>
                    <span class="ni-feat-text">{{ $f[2] }}</span>
                </div>
                @endforeach
            </div>

            {{-- CTA --}}
            <a href="{{ route('about') }}" class="ni-cta">
                Notre histoire complète
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>

        {{-- ── Côté images ── --}}
        <div class="ni-images reveal">

            {{-- Image principale avec cadre décalé --}}
            <div class="ni-img-main">
                <div class="ni-img-frame"></div>
                <div class="ni-img-clip">
                    <img src="{{ asset('images/1.png') }}" alt="Arts Visuels — Centre d'Art Orion" class="ni-img-photo">
                    <div class="ni-img-gradient"></div>
                    <span class="ni-img-label" style="color:#4caf7d">Arts Visuels</span>
                </div>
            </div>

            {{-- Deux petites images --}}
            <div class="ni-img-row">
                <div class="ni-img-sm">
                    <img src="{{ asset('images/2.jpg') }}" alt="Musique" class="ni-img-photo">
                    <div class="ni-img-gradient"></div>
                    <span class="ni-img-label" style="color:#d4a030">Musique</span>
                </div>
                <div class="ni-img-sm">
                    <img src="{{ asset('images/3.jpg') }}" alt="Danse" class="ni-img-photo">
                    <div class="ni-img-gradient"></div>
                    <span class="ni-img-label" style="color:#e07030">Danse</span>
                </div>
            </div>

            {{-- Label vertical --}}
            <span class="ni-year" aria-hidden="true">Depuis 2019</span>

        </div>

    </div>
</section>

{{-- ════════════════════════════════════════════════════
     SERVICES — Cards photo
════════════════════════════════════════════════════ --}}
<section style="padding:120px 0;background:#faf8f4;border-top:1px solid #ede6da;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">

        {{-- Header --}}
        <div class="reveal" style="display:flex;align-items:flex-end;justify-content:space-between;gap:32px;flex-wrap:wrap;margin-bottom:56px;">
            <div>
                <div class="tag tag-gold" style="margin-bottom:16px;">Ce que nous offrons</div>
                <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2.2rem,4vw,3rem);font-weight:900;color:#1c1510;margin:0;line-height:1.08;" class="accent-line">
                    Nos Services<br>& Activités
                </h2>
            </div>
            <div style="display:flex;flex-direction:column;align-items:flex-end;gap:20px;">
                <p style="color:#8a7e74;font-size:0.92rem;line-height:1.8;margin:0;max-width:360px;text-align:right;">
                    De la création à la scène — un écosystème complet pour chaque artiste, à chaque étape.
                </p>
                <a href="{{ route('services') }}" class="btn-outline">Voir tous les services →</a>
            </div>
        </div>

        {{-- Grille cards --}}
        @php
        $hSPhotos = ['11.jpg','22.jpg','5.jpg','7.jpg','3.jpg','9.jpg'];
        $hServices = [
            ['🎬','Production Artistique','#4caf7d','Studios, accompagnement technique et distribution des œuvres.',route('services')],
            ['✨','Création Artistique','#d4a030','Résidences, ateliers ouverts et collaborations inter-disciplines.',route('services')],
            ['🎓','Formation Artistique','#e07030','6 disciplines, de débutant à avancé, avec certification.',route('formations.index')],
            ['🤝','Accompagnement','#4caf7d','Mentorat, développement de carrière et mise en réseau.',route('services')],
            ['🎪','Événements Culturels','#d4a030','Concerts, expositions et galas qui valorisent les talents.',route('evenements.index')],
            ['🏛','Ateliers & Programmes','#e07030','Programmes ouverts à tous, toute l\'année.',route('services')],
        ];
        @endphp

        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px;">
            @foreach($hServices as $hi => $hs)
            <a href="{{ $hs[4] }}" class="reveal"
               style="display:block;text-decoration:none;border-radius:12px;overflow:hidden;position:relative;height:300px;background:#1a1510;transition:transform 0.35s,box-shadow 0.35s;"
               onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 24px 60px rgba(28,21,16,0.18)';this.querySelector('.sc-img').style.transform='scale(1.07)';this.querySelector('.sc-bar').style.transform='scaleX(1)';"
               onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 20px rgba(28,21,16,0.08)';this.querySelector('.sc-img').style.transform='scale(1)';this.querySelector('.sc-bar').style.transform='scaleX(0)';">

                {{-- Photo --}}
                <img class="sc-img"
                     src="{{ asset('images/' . $hSPhotos[$hi]) }}"
                     alt="{{ $hs[1] }}"
                     style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:block;transition:transform 0.6s ease;">

                {{-- Gradient --}}
                <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.88) 0%,rgba(0,0,0,0.3) 55%,rgba(0,0,0,0.05) 100%);"></div>

                {{-- Barre colorée top (hover) --}}
                <div class="sc-bar" style="position:absolute;top:0;left:0;right:0;height:3px;background:{{ $hs[2] }};transform:scaleX(0);transform-origin:left;transition:transform 0.4s ease;z-index:2;"></div>

                {{-- Badge icône --}}
                <div style="position:absolute;top:20px;left:20px;width:42px;height:42px;border-radius:8px;background:rgba(0,0,0,0.45);border:1px solid rgba(255,255,255,0.12);display:flex;align-items:center;justify-content:center;font-size:1.2rem;backdrop-filter:blur(6px);z-index:1;">{{ $hs[0] }}</div>

                {{-- Numéro filigrane --}}
                <div style="position:absolute;top:12px;right:18px;font-family:'Playfair Display',Georgia,serif;font-size:5rem;font-weight:900;color:rgba(255,255,255,0.06);line-height:1;user-select:none;z-index:1;">0{{ $hi + 1 }}</div>

                {{-- Contenu bas --}}
                <div style="position:absolute;bottom:0;left:0;right:0;padding:22px 24px;z-index:1;">
                    <div style="width:28px;height:2px;background:{{ $hs[2] }};margin-bottom:10px;"></div>
                    <h3 style="font-family:'Playfair Display',Georgia,serif;font-weight:700;font-size:1.15rem;color:#f5f5f0;margin:0 0 6px;line-height:1.25;">{{ $hs[1] }}</h3>
                    <p style="color:rgba(245,245,240,0.6);font-size:0.8rem;line-height:1.6;margin:0;">{{ $hs[3] }}</p>
                </div>

            </a>
            @endforeach
        </div>

    </div>
</section>

{{-- ════════════════════════════════════════════════════
     FORMATIONS — Aperçu
════════════════════════════════════════════════════ --}}
@if($formations->count())
<section style="padding:120px 0;background:#f4f0e8;border-top:1px solid #e0d8cc;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">

        <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:20px;margin-bottom:64px;" class="reveal">
            <div>
                <div class="tag tag-green" style="margin-bottom:20px;">Programmes disponibles</div>
                <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,2.8rem);font-weight:900;color:#1c1510;line-height:1.15;margin:0;" class="accent-line">
                    Nos Formations
                </h2>
            </div>
            <a href="{{ route('formations.index') }}" class="btn-outline">
                Voir toutes les formations →
            </a>
        </div>

        @php $fPhotos = ['4.jpg','5.jpg','6.jpg','7.jpg','9.jpg','1.png','2.jpg','3.jpg']; @endphp
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:24px;">
            @foreach($formations as $f)
            <div class="reveal hover-lift"
                 style="background:#ffffff;border:1px solid #e0d8cc;border-radius:10px;overflow:hidden;transition:all 0.3s;">

                {{-- Photo --}}
                <div style="height:180px;overflow:hidden;position:relative;background:#f0ebe0;">
                    <img src="{{ asset('images/' . $fPhotos[$loop->index % count($fPhotos)]) }}"
                         alt="{{ $f->titre }}"
                         style="width:100%;height:100%;object-fit:cover;display:block;transition:transform 0.5s;"
                         onmouseover="this.style.transform='scale(1.06)'" onmouseout="this.style.transform='scale(1)'">
                    <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.35) 0%,transparent 55%);"></div>
                    @if($f->categorie)
                    <div style="position:absolute;top:12px;left:12px;">
                        <span class="tag tag-green">{{ $f->categorie }}</span>
                    </div>
                    @endif
                </div>

                <div style="padding:24px;">
                    <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1.05rem;color:#1c1510;margin:0 0 10px;">{{ $f->titre }}</h3>
                    <p style="color:#78706a;font-size:0.85rem;line-height:1.7;margin:0 0 20px;">{{ Str::limit($f->description, 100) }}</p>

                    <div style="display:flex;flex-wrap:wrap;gap:10px;margin-bottom:20px;">
                        @if($f->duree)
                        <div style="display:flex;align-items:center;gap:6px;color:#888;font-size:0.8rem;">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#4caf7d" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                            {{ $f->duree }}
                        </div>
                        @endif
                        @if($f->niveau)
                        <div style="display:flex;align-items:center;gap:6px;color:#888;font-size:0.8rem;">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#d4a030" stroke-width="2"><path d="M18 20V10M12 20V4M6 20v-6"/></svg>
                            {{ $f->niveau }}
                        </div>
                        @endif
                    </div>

                    <div style="display:flex;align-items:center;justify-content:space-between;">
                        @if($f->prix)
                        <span style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1rem;color:#d4a030;">${{ number_format($f->prix, 0) }}</span>
                        @endif
                        <a href="{{ route('formations.show', $f) }}"
                           style="display:inline-flex;align-items:center;gap:6px;color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.8rem;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;text-decoration:none;">
                            Détails →
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>
@endif

{{-- ════════════════════════════════════════════════════
     ÉVÉNEMENTS — Aperçu
════════════════════════════════════════════════════ --}}
@if($evenements->count())
@php $evPhotos = ['11.jpg','22.jpg','5.jpg','7.jpg','3.jpg','9.jpg','2.jpg','4.jpg']; @endphp
<section style="padding:120px 0;background:#0d0d0d;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">

        {{-- Header --}}
        <div class="reveal" style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:20px;margin-bottom:56px;">
            <div>
                <div class="tag tag-orange" style="margin-bottom:16px;">À venir</div>
                <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,3rem);font-weight:900;color:#f5f5f0;line-height:1.08;margin:0;" class="accent-line">
                    Prochains<br>Événements
                </h2>
            </div>
            <a href="{{ route('evenements.index') }}" class="btn-outline" style="border-color:#333;color:#888;" onmouseover="this.style.borderColor='#e07030';this.style.color='#e07030'" onmouseout="this.style.borderColor='#333';this.style.color='#888'">
                Voir tous les événements →
            </a>
        </div>

        {{-- Cards --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:20px;">
            @foreach($evenements as $ei => $ev)
            <a href="{{ route('evenements.show', $ev) }}"
               class="reveal"
               style="display:block;text-decoration:none;border-radius:12px;overflow:hidden;position:relative;height:420px;background:#111;transition:transform 0.35s,box-shadow 0.35s;"
               onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 28px 60px rgba(0,0,0,0.5)';this.querySelector('.ev-img').style.transform='scale(1.07)';"
               onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none';this.querySelector('.ev-img').style.transform='scale(1)';">

                {{-- Photo --}}
                <img class="ev-img"
                     src="{{ asset('images/' . $evPhotos[$ei % count($evPhotos)]) }}"
                     alt="{{ $ev->titre }}"
                     style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:block;transition:transform 0.6s ease;">

                {{-- Gradient --}}
                <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.95) 0%,rgba(0,0,0,0.4) 55%,rgba(0,0,0,0.1) 100%);"></div>

                {{-- Date badge --}}
                <div style="position:absolute;top:20px;left:20px;background:rgba(0,0,0,0.6);border:1px solid rgba(224,112,48,0.35);border-radius:8px;padding:10px 16px;text-align:center;backdrop-filter:blur(8px);">
                    <div style="font-family:'Playfair Display',Georgia,serif;font-size:1.8rem;font-weight:900;color:#e07030;line-height:1;">{{ $ev->date_debut->format('d') }}</div>
                    <div style="font-family:'Space Grotesk',sans-serif;font-size:0.65rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#aaa;margin-top:2px;">{{ $ev->date_debut->translatedFormat('M Y') }}</div>
                </div>

                {{-- Prix / Gratuit --}}
                @if($ev->gratuit)
                <div style="position:absolute;top:20px;right:20px;">
                    <span class="tag tag-green">Gratuit</span>
                </div>
                @elseif($ev->prix)
                <div style="position:absolute;top:20px;right:20px;">
                    <span class="tag tag-gold">${{ number_format($ev->prix, 0) }}</span>
                </div>
                @endif

                {{-- Contenu bas --}}
                <div style="position:absolute;bottom:0;left:0;right:0;padding:24px;">
                    @if($ev->type)
                    <span class="tag tag-orange" style="margin-bottom:10px;display:inline-block;">{{ ucfirst($ev->type) }}</span>
                    @endif
                    <h3 style="font-family:'Playfair Display',Georgia,serif;font-weight:700;font-size:1.2rem;color:#f5f5f0;margin:0 0 8px;line-height:1.3;">{{ $ev->titre }}</h3>
                    @if($ev->lieu)
                    <p style="color:rgba(245,245,240,0.55);font-size:0.8rem;margin:0;display:flex;align-items:center;gap:6px;">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#e07030" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        {{ $ev->lieu }}
                    </p>
                    @endif
                </div>

            </a>
            @endforeach
        </div>

    </div>
</section>
@endif

{{-- ════════════════════════════════════════════════════
     TÉMOIGNAGES
════════════════════════════════════════════════════ --}}
@if($temoignages->count())
<section style="padding:120px 0;background:#f4f0e8;border-top:1px solid #e0d8cc;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">

        <div class="reveal" style="text-align:center;max-width:540px;margin:0 auto 64px;">
            <div class="tag tag-gold" style="margin-bottom:20px;">Témoignages</div>
            <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,2.8rem);font-weight:900;color:#1c1510;line-height:1.15;margin:0;" class="accent-line accent-line-center">
                Ce qu'ils disent
            </h2>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:24px;">
            @foreach($temoignages as $t)
            <div class="reveal"
                 style="background:#ffffff;border:1px solid #e0d8cc;border-radius:10px;padding:32px;position:relative;overflow:hidden;transition:border-color 0.3s;"
                 onmouseover="this.style.borderColor='#d4a03033'" onmouseout="this.style.borderColor='#e0d8cc'">

                <div style="position:absolute;top:20px;right:24px;font-size:3rem;color:#1a1a1a;font-family:'Playfair Display',serif;line-height:1;">"</div>

                {{-- Stars --}}
                <div style="display:flex;gap:3px;margin-bottom:16px;">
                    @for($i=0;$i<$t->note;$i++)
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="#d4a030" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    @endfor
                </div>

                <p style="color:rgba(28,21,16,0.65);font-size:0.9rem;line-height:1.8;margin:0 0 24px;font-style:italic;">"{{ $t->contenu }}"</p>

                <div style="display:flex;align-items:center;gap:12px;">
                    <div style="width:40px;height:40px;border-radius:50%;background:linear-gradient(135deg,#4caf7d,#d4a030);display:flex;align-items:center;justify-content:center;font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.9rem;color:#0a0a0a;flex-shrink:0;">
                        {{ strtoupper(substr($t->auteur, 0, 1)) }}
                    </div>
                    <div>
                        <div style="font-family:'Space Grotesk',sans-serif;font-weight:600;font-size:0.9rem;color:#1c1510;">{{ $t->auteur }}</div>
                        @if($t->poste)
                        <div style="font-size:0.78rem;color:#78706a;">{{ $t->poste }}</div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>
@endif

{{-- ════════════════════════════════════════════════════
     GALERIE — Aperçu
════════════════════════════════════════════════════ --}}
<section style="padding:120px 0;background:#fafaf6;border-top:1px solid #e0d8cc;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">

        <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:20px;margin-bottom:64px;" class="reveal">
            <div>
                <div class="tag tag-green" style="margin-bottom:20px;">Nos réalisations</div>
                <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,2.8rem);font-weight:900;color:#1c1510;line-height:1.15;margin:0;" class="accent-line">
                    Galerie
                </h2>
            </div>
            <a href="{{ route('galerie.index') }}" class="btn-outline">Voir la galerie complète →</a>
        </div>

        {{--
            Mosaic 3 colonnes × 3 rangées :
            Rangée 1-2 : [  BIG  ][BIG] | [sm1]
                         [  BIG  ][BIG] | [sm2]
            Rangée 3   : [sm3]   | [sm4] | [sm5]
            → 6 items, grille parfaitement remplie
        --}}
        @php
            $galerieItems = $galerie->take(6);
            $total = $galerieItems->count();
            $gPhotos = ['2.jpg','5.jpg','7.jpg','3.jpg','6.jpg','9.jpg'];
            $gExtraPhotos = ['4.jpg','1.png','22.jpg','11.jpg','2.jpg','7.jpg'];
        @endphp
        <div style="display:grid;grid-template-columns:repeat(3,1fr);grid-template-rows:200px 200px 180px;gap:12px;">

            @foreach($galerieItems as $i => $item)
            @php
                $isFirst = ($i === 0);
                $spanStyle = $isFirst ? 'grid-column:span 2;grid-row:span 2;' : '';
                $gSrc = ($item->fichier && file_exists(public_path('storage/'.$item->fichier)))
                    ? asset('storage/'.$item->fichier)
                    : asset('images/' . $gPhotos[$i % count($gPhotos)]);
            @endphp
            <div class="reveal"
                 style="background:#f0ebe0;border:0;border-radius:0;overflow:hidden;position:relative;cursor:pointer;{{ $spanStyle }}transition:transform 0.3s,box-shadow 0.3s;"
                 data-lightbox data-src="{{ $gSrc }}" data-caption="{{ $item->titre }}"
                 onmouseover="var o=this.querySelector('.galerie-overlay');if(o)o.style.opacity='1';this.style.transform='scale(1.02)'"
                 onmouseout="var o=this.querySelector('.galerie-overlay');if(o)o.style.opacity='0';this.style.transform='scale(1)'">

                <img src="{{ $gSrc }}"
                     alt="{{ $item->titre }}"
                     style="width:100%;height:100%;object-fit:cover;display:block;">

                <div class="galerie-overlay"
                     style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.80) 0%,rgba(0,0,0,0.15) 55%,transparent 100%);opacity:0;transition:opacity 0.3s;display:flex;align-items:flex-end;padding:16px;">
                    <div>
                        <p style="font-family:'Space Grotesk',sans-serif;font-weight:600;font-size:0.85rem;color:#fff;margin:0 0 4px;">{{ $item->titre }}</p>
                        @if($item->categorie)
                        <span class="tag tag-green">{{ $item->categorie }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach

            {{-- Cellules supplémentaires avec vraies photos --}}
            @for($p = $total; $p < 6; $p++)
            <div style="overflow:hidden;position:relative;cursor:pointer;transition:transform 0.3s;"
                 onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
                <img src="{{ asset('images/' . $gExtraPhotos[$p % count($gExtraPhotos)]) }}"
                     style="width:100%;height:100%;object-fit:cover;display:block;">
            </div>
            @endfor

        </div>

    </div>
</section>

{{-- ════════════════════════════════════════════════════
     CTA FINAL
════════════════════════════════════════════════════ --}}
<section style="padding:100px 0;background:#f4f0e8;border-top:1px solid #e0d8cc;position:relative;overflow:hidden;">

    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at center,rgba(76,175,125,0.06) 0%,transparent 70%);pointer-events:none;"></div>

    <div style="max-width:800px;margin:0 auto;padding:0 24px;text-align:center;position:relative;z-index:1;">
        <div class="reveal">
            <div class="tag tag-gold" style="margin-bottom:24px;">Rejoignez-nous</div>
            <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,5vw,3.5rem);font-weight:900;color:#1c1510;line-height:1.1;margin:0 0 20px;">
                Prêt à révéler votre
                <span style="background:linear-gradient(135deg,#4caf7d,#d4a030);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">talent ?</span>
            </h2>
            <p style="color:#6b6258;font-size:1rem;line-height:1.8;margin:0 0 44px;max-width:500px;margin-left:auto;margin-right:auto;">
                Rejoignez une communauté d'artistes passionnés et bénéficiez d'un accompagnement professionnel pour concrétiser vos projets artistiques.
            </p>
            <div style="display:flex;flex-wrap:wrap;gap:14px;justify-content:center;">
                <a href="{{ route('formations.index') }}" class="btn-gold">S'inscrire à une formation</a>
                <a href="{{ route('contact.index') }}" class="btn-outline">Nous contacter</a>
            </div>
        </div>
    </div>
</section>

</div>

<style>
@keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50%       { opacity: 0.5; transform: scale(0.8); }
}
@keyframes scrollLine {
    0%   { opacity: 1; transform: scaleY(0); transform-origin: top; }
    50%  { opacity: 1; transform: scaleY(1); transform-origin: top; }
    100% { opacity: 0; transform: scaleY(1); transform-origin: top; }
}

@media(max-width:768px) {
    section > div > div[style*="grid-template-columns:1fr 1fr"] {
        grid-template-columns: 1fr !important;
    }
    section > div > div[style*="grid-template-columns:repeat(3,1fr)"] {
        grid-template-columns: repeat(2,1fr) !important;
        grid-template-rows: auto !important;
    }
}
</style>

@endsection
