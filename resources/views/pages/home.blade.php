@extends('layouts.app')

@section('title', 'Centre d\'Art Orion — Production, Création, Formation')
@section('meta_description', 'Le Centre d\'Art Orion : votre espace de production artistique, création, formation et accompagnement des talents. Découvrez nos programmes et événements.')

@section('content')

<div class="home-biasasa">

@php
    $firstHeroSlide = $heroSlides->first();
@endphp

{{-- ════════════════════════════════════════════════════════════
     HERO CINÉMATOGRAPHIQUE — Diagonal Wipe
════════════════════════════════════════════════════════════ --}}
<section class="hc-section hero-orion" id="hc-section">

    {{-- Barre colorée top (3 px) --}}
    <div class="hc-accent-bar"></div>

    {{-- ─── Slides ─── --}}
    <div class="hc-slides">
        @foreach($heroSlides as $slide)
        @php
            $imgUrl = $slide->image
                ? Storage::url($slide->image)
                : asset('images/10.jpg');
        @endphp
        <div class="hc-slide {{ $loop->first ? 'active' : '' }}"
             data-accent="{{ $slide->accent }}"
             data-label="{{ $slide->label }}"
             data-title-one="{{ $slide->title_one }}"
             data-title-two="{{ $slide->title_two }}"
             data-lead="{{ $slide->lead }}"
             data-cta-label="{{ $slide->cta_label }}"
             data-cta-url="{{ $slide->cta_url }}">
            <div class="hc-photo" style="background-image:url('{{ $imgUrl }}')"></div>
            <div class="hc-overlay"></div>
            <div class="hc-tint" style="background-color:{{ $slide->accent }}"></div>
        </div>
        @endforeach
    </div>

    {{-- ─── Lignes diagonales décoratives ─── --}}
    <div class="hc-deco" aria-hidden="true"></div>

    {{-- ─── Constellation Orion — Hero : figure complète, étoiles blanches ─── --}}
    <div class="orion-c orion-c--hero" aria-hidden="true">
        <svg viewBox="0 0 320 450" fill="none" xmlns="http://www.w3.org/2000/svg" overflow="visible">
            <defs>
                <filter id="ocGH" x="-120%" y="-120%" width="340%" height="340%">
                    <feGaussianBlur stdDeviation="3.5" result="b"/><feMerge><feMergeNode in="b"/><feMergeNode in="SourceGraphic"/></feMerge>
                </filter>
                <filter id="ocGLH" x="-160%" y="-160%" width="420%" height="420%">
                    <feGaussianBlur stdDeviation="6" result="b"/><feMerge><feMergeNode in="b"/><feMergeNode in="SourceGraphic"/></feMerge>
                </filter>
            </defs>
            <g class="oc-lines" stroke="white" stroke-linecap="round" stroke-width="0.7">
                <line x1="160" y1="48"  x2="96"  y2="132"/><line x1="160" y1="48"  x2="222" y2="118"/>
                <line x1="96"  y1="132" x2="126" y2="232"/><line x1="222" y1="118" x2="193" y2="230"/>
                <line x1="126" y1="232" x2="160" y2="238"/><line x1="160" y1="238" x2="193" y2="230"/>
                <line x1="126" y1="232" x2="102" y2="360"/><line x1="193" y1="230" x2="208" y2="365"/>
            </g>
            <line class="oc-sword" x1="160" y1="245" x2="156" y2="322" stroke="white" stroke-width="0.55" stroke-linecap="round" stroke-dasharray="4 5"/>
            <g class="oc-faint" fill="white">
                <circle cx="78" cy="82" r="1.1"/><circle cx="248" cy="66" r="0.9"/>
                <circle cx="58" cy="215" r="1.1"/><circle cx="68" cy="318" r="1.3"/>
                <circle cx="132" cy="176" r="1.1"/><circle cx="196" cy="166" r="0.9"/>
                <circle cx="86" cy="260" r="0.9"/><circle cx="236" cy="272" r="1.1"/>
            </g>
            <g class="oc-sword-stars" fill="white">
                <circle cx="160" cy="266" r="1.8"/><circle cx="158" cy="292" r="2.8"/><circle cx="156" cy="318" r="1.5"/>
            </g>
            <g class="oc-belt" fill="white">
                <circle cx="126" cy="232" r="3.2"/><circle cx="160" cy="238" r="3.6"/><circle cx="193" cy="230" r="3.0"/>
            </g>
            <g class="oc-med" fill="white">
                <circle cx="160" cy="48" r="2.8"/><circle cx="222" cy="118" r="3.2"/><circle cx="102" cy="360" r="3.5"/>
            </g>
            <g class="oc-betel-anim" filter="url(#ocGH)"><circle cx="96" cy="132" r="5" fill="#ffe0a0"/></g>
            <g class="oc-rigel-anim" filter="url(#ocGLH)"><circle cx="208" cy="365" r="6" fill="white"/></g>
        </svg>
    </div>

    {{-- ─── Filigrane numéro ─── --}}
    <div class="hc-watermark" aria-hidden="true">01</div>


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
                <span class="hc-title-wrap"><span class="hc-title-line">{{ $firstHeroSlide->title_one ?? "CENTRE D'ART" }}</span></span>
                <span class="hc-title-wrap"><span class="hc-title-line hc-title-accent">{{ $firstHeroSlide->title_two ?? 'ORION' }}</span></span>
            </h1>
            <p class="hc-lead">{{ $firstHeroSlide->lead ?? 'Production · Création · Formation.' }}</p>
            <a href="{{ $firstHeroSlide->cta_url ?? route('about') }}" class="hc-cta">
                <span class="hc-cta-text">{{ $firstHeroSlide->cta_label ?? 'Découvrir' }}</span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>

    {{-- ─── Barre inférieure : stats + dots ─── --}}
    <div class="hc-bottom-bar">
        <div class="hc-stats">
            @foreach([['100+','Artistes accompagnés'],['50+','Événements'],['6','Disciplines']] as $st)
            <div class="hc-stat">
                <div class="hc-stat-val">{{ $st[0] }}</div>
                <div class="hc-stat-lbl">{{ $st[1] }}</div>
            </div>
            @if(!$loop->last)<span class="hc-stat-sep"></span>@endif
            @endforeach
        </div>
        <div class="hc-dots" role="tablist" aria-label="Navigation slides">
            @foreach($heroSlides as $slide)
            <button class="hc-dot {{ $loop->first ? 'active' : '' }}" data-i="{{ $loop->index }}" aria-label="Slide {{ $loop->iteration }}" role="tab" aria-selected="{{ $loop->first ? 'true' : 'false' }}"></button>
            @endforeach
        </div>
    </div>

    {{-- ─── Barre de progression plein écran (bas) ─── --}}
    <div class="hc-progress"><div class="hc-progress-fill"></div></div>

</section>

{{-- ════════════════════════════════════════════════════════════
     NOTRE IDENTITÉ — Cinématique
════════════════════════════════════════════════════════════ --}}
<section class="ni-section">

    {{-- ─── Constellation Orion — Identité : couronne (Meissa + épaules) ─── --}}
    {{-- Symbolise l'identité, la tête, le sommet de soi --}}
    <div class="orion-c orion-c--ni" aria-hidden="true">
        <svg viewBox="0 0 220 170" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g class="oc-lines" stroke="#1e4d2f" stroke-linecap="round" stroke-width="0.8">
                <line x1="110" y1="22" x2="22" y2="148"/>
                <line x1="110" y1="22" x2="198" y2="136"/>
                <line x1="22" y1="148" x2="198" y2="136" stroke-dasharray="5 7"/>
            </g>
            <g class="oc-faint" fill="#1e4d2f">
                <circle cx="55" cy="70" r="1.2"/><circle cx="172" cy="58" r="1.0"/>
                <circle cx="85" cy="128" r="1.0"/><circle cx="148" cy="118" r="0.9"/>
                <circle cx="38" cy="108" r="0.8"/><circle cx="185" cy="96" r="0.8"/>
            </g>
            <circle cx="110" cy="22" r="3.2" fill="#1e4d2f" class="oc-med"/>
            <circle cx="198" cy="136" r="4.2" fill="#1e4d2f" class="oc-med"/>
            <circle cx="22" cy="148" r="5.5" fill="#1e4d2f" class="oc-betel"/>
        </svg>
    </div>

    {{-- Barre d'accent top --}}
    <div class="ni-accent-bar"></div>

    {{-- Watermark numéro --}}
    <span class="ni-watermark" aria-hidden="true">02</span>

    {{-- Mandala géométrique Art Déco --}}
    <svg class="ni-mandala" viewBox="0 0 500 500" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">

        {{-- Anneau extérieur pointillé --}}
        <circle cx="250" cy="250" r="238" stroke="rgba(28,21,16,0.05)" stroke-width="0.6" stroke-dasharray="3 11.5"/>

        {{-- Cercles concentriques alternés sombre / or --}}
        <circle cx="250" cy="250" r="218" stroke="rgba(212,160,48,0.16)"  stroke-width="1.2"/>
        <circle cx="250" cy="250" r="175" stroke="rgba(28,21,16,0.06)"    stroke-width="0.6"/>
        <circle cx="250" cy="250" r="132" stroke="rgba(212,160,48,0.18)"  stroke-width="1.0"/>
        <circle cx="250" cy="250" r="90"  stroke="rgba(28,21,16,0.06)"    stroke-width="0.6"/>
        <circle cx="250" cy="250" r="50"  stroke="rgba(212,160,48,0.24)"  stroke-width="0.9"/>
        <circle cx="250" cy="250" r="22"  stroke="rgba(28,21,16,0.09)"    stroke-width="0.8"/>

        {{-- 6 diamètres complets = 12 rayons --}}
        <g stroke="rgba(28,21,16,0.05)" stroke-width="0.7">
            <line x1="32" y1="250" x2="468" y2="250"/>
            <line x1="32" y1="250" x2="468" y2="250" transform="rotate(30,250,250)"/>
            <line x1="32" y1="250" x2="468" y2="250" transform="rotate(60,250,250)"/>
            <line x1="32" y1="250" x2="468" y2="250" transform="rotate(90,250,250)"/>
            <line x1="32" y1="250" x2="468" y2="250" transform="rotate(120,250,250)"/>
            <line x1="32" y1="250" x2="468" y2="250" transform="rotate(150,250,250)"/>
        </g>

        {{-- Diamants aux 4 points cardinaux sur r=218 --}}
        <g fill="rgba(212,160,48,0.34)">
            <polygon points="250,24 258,32 250,40 242,32"/>
            <polygon points="460,250 468,242 476,250 468,258"/>
            <polygon points="250,460 258,468 250,476 242,468"/>
            <polygon points="24,250 32,242 40,250 32,258"/>
        </g>

        {{-- Petits cercles aux 4 points intermédiaires (45°) --}}
        <g fill="rgba(28,21,16,0.12)">
            <circle cx="404.1" cy="404.1" r="3"/>
            <circle cx="95.9"  cy="404.1" r="3"/>
            <circle cx="95.9"  cy="95.9"  r="3"/>
            <circle cx="404.1" cy="95.9"  r="3"/>
        </g>

        {{-- Arcs décoratifs Art Déco sur r=132 (alternés) --}}
        <g stroke="rgba(212,160,48,0.13)" stroke-width="1.2" fill="none">
            <path d="M 382,250 A 132,132 0 0,1 316.1,366.1"/>
            <path d="M 183.9,366.1 A 132,132 0 0,1 118,250"/>
            <path d="M 183.9,133.9 A 132,132 0 0,1 316.1,133.9"/>
        </g>

        {{-- Étoile centrale à 8 branches --}}
        <polygon
            points="250,228 252.8,247.2 272,250 252.8,252.8 250,272 247.2,252.8 228,250 247.2,247.2"
            fill="rgba(212,160,48,0.32)"/>

        {{-- Point central --}}
        <circle cx="250" cy="250" r="5" fill="rgba(212,160,48,0.60)"/>
        <circle cx="250" cy="250" r="2" fill="rgba(28,21,16,0.35)"/>

    </svg>

    {{-- Lignes diagonales déco --}}
    <div class="ni-deco" aria-hidden="true"></div>

    <div class="ni-inner">

        {{-- ── Côté texte ── --}}
        <div class="ni-text reveal">

            {{-- Kicker symétrique --}}
            <div class="ni-kicker">
                <span class="ni-kicker-line"></span>
                <span class="ni-kicker-label">Notre identité</span>
                <span class="ni-kicker-line"></span>
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
                    <img src="{{ asset('images/10.jpg') }}" alt="Production — Centre d'Art Orion" class="ni-img-photo">
                    <div class="ni-img-gradient"></div>
                    <span class="ni-img-label" style="color:#4caf7d">Arts Visuels</span>
                </div>
            </div>

            {{-- Deux petites images --}}
            <div class="ni-img-row">
                <div class="ni-img-sm">
                    <img src="{{ asset('images/5.jpg') }}" alt="Formation" class="ni-img-photo">
                    <div class="ni-img-gradient"></div>
                    <span class="ni-img-label" style="color:#d4a030">Musique</span>
                </div>
                <div class="ni-img-sm">
                    <img src="{{ asset('images/11.jpg') }}" alt="Inspiration" class="ni-img-photo">
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
<section style="position:relative;overflow:hidden;padding:120px 0;background:#ffffff;border-top:1px solid rgba(28,21,16,0.08);">
    {{-- ─── Constellation Orion — Services : ceinture + épée ─── --}}
    {{-- La ceinture = les 3 piliers (Production / Création / Formation). L'épée pointe vers les services --}}
    <div class="orion-c orion-c--services" aria-hidden="true">
        <svg viewBox="0 0 320 260" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g class="oc-lines" stroke="#1e4d2f" stroke-linecap="round" stroke-width="0.9">
                <line x1="55" y1="78" x2="160" y2="86"/><line x1="160" y1="86" x2="265" y2="76"/>
            </g>
            <line class="oc-sword" x1="160" y1="86" x2="155" y2="248" stroke="#1e4d2f" stroke-width="0.6" stroke-linecap="round" stroke-dasharray="4 5"/>
            <g class="oc-faint" fill="#1e4d2f">
                <circle cx="95" cy="38" r="1.2"/><circle cx="228" cy="32" r="1.0"/>
                <circle cx="108" cy="168" r="1.1"/><circle cx="212" cy="162" r="0.9"/>
                <circle cx="22" cy="55" r="0.9"/><circle cx="298" cy="48" r="0.8"/>
            </g>
            <g class="oc-sword-stars" fill="#1e4d2f">
                <circle cx="158" cy="140" r="2.5"/><circle cx="156" cy="188" r="3.2"/><circle cx="155" cy="242" r="2.0"/>
            </g>
            <g class="oc-belt" fill="#1e4d2f">
                <circle cx="55" cy="78" r="3.8"/><circle cx="160" cy="86" r="4.5"/><circle cx="265" cy="76" r="3.6"/>
            </g>
        </svg>
    </div>
    <div style="max-width:1440px;margin:0 auto;padding:0 24px;">

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
        $hSPhotos = ['10.jpg','5.jpg','13','11.jpg','10.jpg','5.jpg'];
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
     PODCASTS — Promotion
════════════════════════════════════════════════════ --}}
<section class="podcast-section" style="position:relative;overflow:hidden;padding:110px 0;background:#0a0a0a;border-top:1px solid rgba(28,21,16,0.08);">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 20% 30%,rgba(76,175,125,0.18),transparent 34%),radial-gradient(ellipse at 82% 70%,rgba(212,160,48,0.15),transparent 38%);pointer-events:none;"></div>
    <div style="position:absolute;inset:0;opacity:0.13;background-image:linear-gradient(90deg,rgba(255,255,255,0.08) 1px,transparent 1px),linear-gradient(rgba(255,255,255,0.08) 1px,transparent 1px);background-size:64px 64px;mask-image:linear-gradient(to bottom,#000,transparent 86%);"></div>

    <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:1;">
        <div class="podcast-grid" style="display:grid;grid-template-columns:minmax(0,0.9fr) minmax(360px,0.8fr);gap:52px;align-items:center;">
            <div class="reveal">
                <div class="tag tag-green" style="margin-bottom:18px;">Podcasts Orion</div>
                <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2.4rem,5vw,4rem);font-weight:900;color:#f5f5f0;line-height:1.02;margin:0 0 22px;">
                    Écouter les voix<br>
                    <span style="background:linear-gradient(135deg,#4caf7d,#d4a030);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">de la création</span>
                </h2>
                <p style="color:#aaa19a;font-size:1rem;line-height:1.85;max-width:620px;margin:0 0 30px;">
                    Conversations avec artistes, formateurs et créateurs du centre : coulisses d'ateliers, parcours, résidences et réflexions sur les métiers de l'art.
                </p>
                <div style="display:flex;gap:14px;flex-wrap:wrap;">
                    <a href="{{ route('podcasts.index') }}" class="btn-gold">Découvrir les podcasts</a>
                    <a href="{{ route('contact.index') }}?sujet=Proposition+Podcast" class="btn-outline" style="color:#f5f5f0;border-color:rgba(255,255,255,0.28);">Proposer un invité</a>
                </div>
            </div>

            <a href="{{ route('podcasts.index') }}" class="reveal podcast-visual" style="display:block;text-decoration:none;position:relative;min-height:380px;border-radius:14px;overflow:hidden;background:#111;border:1px solid rgba(255,255,255,0.1);box-shadow:0 30px 100px rgba(0,0,0,0.35);">
                <img src="{{ asset('images/11.jpg') }}" alt="Podcasts Orion" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
                <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.92),rgba(0,0,0,0.12));"></div>
                <div style="position:absolute;left:50%;top:46%;transform:translate(-50%,-50%);width:92px;height:92px;border-radius:50%;background:rgba(212,160,48,0.22);border:2px solid rgba(212,160,48,0.55);display:flex;align-items:center;justify-content:center;">
                    <svg width="34" height="34" viewBox="0 0 24 24" fill="#d4a030"><polygon points="7 4 19 12 7 20 7 4"/></svg>
                </div>
                <div style="position:absolute;left:28px;right:28px;bottom:26px;">
                    <div style="color:#d4a030;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:800;letter-spacing:0.1em;text-transform:uppercase;margin-bottom:8px;">Série audio</div>
                    <h3 style="font-family:'Playfair Display',Georgia,serif;color:#f5f5f0;font-size:2rem;line-height:1.05;margin:0 0 8px;">Dans l'atelier</h3>
                    <p style="color:rgba(245,245,240,0.72);font-size:0.88rem;line-height:1.65;margin:0;">Une immersion dans les gestes, les voix et les idées qui précèdent l'oeuvre.</p>
                </div>
            </a>
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════════════
     FORMATIONS — Aperçu
════════════════════════════════════════════════════ --}}
@if($formations->count())
<section style="position:relative;overflow:hidden;padding:120px 0;background:#ffffff;border-top:1px solid rgba(28,21,16,0.08);">
    {{-- ─── Constellation Orion — Formations : Orion inversé, ascension ─── --}}
    {{-- Rigel monte au sommet = le but à atteindre. L'épée pointe vers le haut = progression --}}
    <div class="orion-c orion-c--formations" aria-hidden="true">
        <svg viewBox="0 0 320 450" fill="none" xmlns="http://www.w3.org/2000/svg" overflow="visible">
            <defs>
                <filter id="ocGF" x="-120%" y="-120%" width="340%" height="340%">
                    <feGaussianBlur stdDeviation="4" result="b"/><feMerge><feMergeNode in="b"/><feMergeNode in="SourceGraphic"/></feMerge>
                </filter>
            </defs>
            {{-- scale(1,-1) translate(0,-450) = y → 450-y (Rigel monte, Meissa descend) --}}
            <g transform="translate(0,450) scale(1,-1)">
                <g class="oc-lines" stroke="#1e4d2f" stroke-linecap="round" stroke-width="0.7">
                    <line x1="160" y1="48"  x2="96"  y2="132"/><line x1="160" y1="48"  x2="222" y2="118"/>
                    <line x1="96"  y1="132" x2="126" y2="232"/><line x1="222" y1="118" x2="193" y2="230"/>
                    <line x1="126" y1="232" x2="160" y2="238"/><line x1="160" y1="238" x2="193" y2="230"/>
                    <line x1="126" y1="232" x2="102" y2="360"/><line x1="193" y1="230" x2="208" y2="365"/>
                </g>
                <line class="oc-sword" x1="160" y1="245" x2="156" y2="322" stroke="#1e4d2f" stroke-width="0.55" stroke-linecap="round" stroke-dasharray="4 5"/>
                <g class="oc-faint" fill="#1e4d2f">
                    <circle cx="78" cy="82" r="1.0"/><circle cx="248" cy="66" r="0.9"/>
                    <circle cx="132" cy="176" r="1.0"/><circle cx="196" cy="168" r="0.8"/>
                    <circle cx="68" cy="318" r="1.1"/><circle cx="252" cy="305" r="0.9"/>
                </g>
                <g class="oc-sword-stars" fill="#1e4d2f">
                    <circle cx="160" cy="266" r="1.8"/><circle cx="158" cy="292" r="2.8"/><circle cx="156" cy="318" r="1.5"/>
                </g>
                <g class="oc-belt" fill="#1e4d2f">
                    <circle cx="126" cy="232" r="3.2"/><circle cx="160" cy="238" r="3.6"/><circle cx="193" cy="230" r="3.0"/>
                </g>
                <g class="oc-med" fill="#1e4d2f">
                    <circle cx="160" cy="48" r="2.8"/><circle cx="222" cy="118" r="3.2"/><circle cx="102" cy="360" r="3.5"/>
                </g>
                <circle cx="96" cy="132" r="5" fill="#1e4d2f" class="oc-betel"/>
                <g filter="url(#ocGF)" class="oc-rigel"><circle cx="208" cy="365" r="6.5" fill="#1e4d2f"/></g>
            </g>
        </svg>
    </div>
    <div style="max-width:1440px;margin:0 auto;padding:0 24px;">

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

        @php $fPhotos = ['10.jpg','5.jpg','13','11.jpg','10.jpg','5.jpg','13','11.jpg']; @endphp
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:24px;">
            @foreach($formations as $f)
            <div class="reveal hover-lift"
                 style="background:#ffffff;border:1px solid rgba(28,21,16,0.08);border-radius:10px;overflow:hidden;transition:all 0.3s;">

                {{-- Photo --}}
                <div style="height:180px;overflow:hidden;position:relative;background:#f0eeec;">
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
@php $evPhotos = ['10.jpg','5.jpg','13','11.jpg','10.jpg','5.jpg','13','11.jpg']; @endphp
<section style="position:relative;overflow:hidden;padding:120px 0;background:#ffffff;border-top:1px solid rgba(28,21,16,0.08);">
    {{-- ─── Constellation Orion — Événements : incliné -22°, énergie de scène ─── --}}
    {{-- Orion en mouvement, comme un artiste en pleine performance --}}
    <div class="orion-c orion-c--events" aria-hidden="true">
        <svg viewBox="0 0 380 480" fill="none" xmlns="http://www.w3.org/2000/svg" overflow="visible">
            <g transform="rotate(-22, 190, 240)">
                <g class="oc-lines" stroke="#1e4d2f" stroke-linecap="round" stroke-width="0.7">
                    <line x1="190" y1="68"  x2="126" y2="152"/><line x1="190" y1="68"  x2="252" y2="138"/>
                    <line x1="126" y1="152" x2="156" y2="252"/><line x1="252" y1="138" x2="223" y2="250"/>
                    <line x1="156" y1="252" x2="190" y2="258"/><line x1="190" y1="258" x2="223" y2="250"/>
                    <line x1="156" y1="252" x2="132" y2="380"/><line x1="223" y1="250" x2="238" y2="385"/>
                </g>
                <line class="oc-sword" x1="190" y1="265" x2="186" y2="342" stroke="#1e4d2f" stroke-width="0.55" stroke-dasharray="4 5"/>
                <g class="oc-faint" fill="#1e4d2f">
                    <circle cx="108" cy="102" r="1.0"/><circle cx="278" cy="88" r="0.9"/>
                    <circle cx="162" cy="196" r="1.0"/><circle cx="226" cy="188" r="0.9"/>
                </g>
                <g class="oc-sword-stars" fill="#1e4d2f">
                    <circle cx="189" cy="288" r="2.0"/><circle cx="188" cy="312" r="2.8"/><circle cx="186" cy="338" r="1.5"/>
                </g>
                <g class="oc-belt" fill="#1e4d2f">
                    <circle cx="156" cy="252" r="3.2"/><circle cx="190" cy="258" r="3.6"/><circle cx="223" cy="250" r="3.0"/>
                </g>
                <g class="oc-med" fill="#1e4d2f">
                    <circle cx="190" cy="68" r="2.8"/><circle cx="252" cy="138" r="3.2"/><circle cx="132" cy="380" r="3.5"/>
                </g>
                <circle cx="126" cy="152" r="5" fill="#1e4d2f" class="oc-betel"/>
                <circle cx="238" cy="385" r="6" fill="#1e4d2f" class="oc-rigel"/>
            </g>
        </svg>
    </div>
    <div style="max-width:1440px;margin:0 auto;padding:0 24px;">

        {{-- Header --}}
        <div class="reveal" style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:20px;margin-bottom:56px;">
            <div>
                <div class="tag tag-orange" style="margin-bottom:16px;">À venir</div>
                <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,3rem);font-weight:900;color:#1c1510;line-height:1.08;margin:0;" class="accent-line">
                    Prochains<br>Événements
                </h2>
            </div>
            <a href="{{ route('evenements.index') }}" class="btn-outline">
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
<section style="position:relative;overflow:hidden;padding:120px 0;background:#ffffff;border-top:1px solid rgba(28,21,16,0.08);">
    {{-- ─── Constellation Orion — Témoignages : étoiles éparses, sans lignes ─── --}}
    {{-- Chaque étoile = une voix, une histoire. Pas de connexion : autonomie de chaque témoignage --}}
    <div class="orion-c orion-c--temoignages" aria-hidden="true">
        <svg viewBox="0 0 1200 100" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g class="oc-faint" fill="#1e4d2f">
                <circle cx="175" cy="42" r="1.0"/><circle cx="338" cy="72" r="0.8"/>
                <circle cx="580" cy="28" r="0.9"/><circle cx="755" cy="65" r="1.0"/>
                <circle cx="918" cy="35" r="0.8"/><circle cx="1058" cy="58" r="0.9"/>
            </g>
            <g class="oc-med" fill="#1e4d2f">
                <circle cx="450" cy="55" r="3.5"/><circle cx="820" cy="40" r="3.2"/>
            </g>
            <g class="oc-belt" fill="#1e4d2f">
                <circle cx="248" cy="60" r="3.8"/><circle cx="600" cy="48" r="4.2"/><circle cx="950" cy="58" r="3.6"/>
            </g>
            <circle cx="68" cy="55" r="6" fill="#1e4d2f" class="oc-rigel"/>
            <circle cx="1135" cy="45" r="5" fill="#1e4d2f" class="oc-betel"/>
        </svg>
    </div>
    <div style="max-width:1440px;margin:0 auto;padding:0 24px;">

        <div class="reveal" style="text-align:center;max-width:540px;margin:0 auto 64px;">
            <div class="tag tag-gold" style="margin-bottom:20px;">Témoignages</div>
            <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,2.8rem);font-weight:900;color:#1c1510;line-height:1.15;margin:0;" class="accent-line accent-line-center">
                Ce qu'ils disent
            </h2>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:24px;">
            @foreach($temoignages as $t)
            <div class="reveal"
                 style="background:#ffffff;border:1px solid rgba(28,21,16,0.08);border-radius:10px;padding:32px;position:relative;overflow:hidden;transition:border-color 0.3s;"
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
<section style="position:relative;overflow:hidden;padding:120px 0;background:#ffffff;border-top:1px solid rgba(28,21,16,0.08);">
    {{-- ─── Constellation Orion — Galerie : ceinture verticale + épée ─── --}}
    {{-- La ceinture pivotée à 90° = un pinceau ou un objectif photo, l'outil créateur --}}
    <div class="orion-c orion-c--galerie" aria-hidden="true">
        <svg viewBox="0 0 80 360" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g class="oc-lines" stroke="#1e4d2f" stroke-linecap="round" stroke-width="0.9">
                <line x1="40" y1="40" x2="40" y2="120"/><line x1="40" y1="120" x2="40" y2="200"/>
            </g>
            <line class="oc-sword" x1="40" y1="200" x2="40" y2="348" stroke="#1e4d2f" stroke-width="0.6" stroke-linecap="round" stroke-dasharray="4 5"/>
            <g class="oc-faint" fill="#1e4d2f">
                <circle cx="18" cy="80" r="1.1"/><circle cx="62" cy="62" r="0.9"/>
                <circle cx="20" cy="162" r="1.0"/><circle cx="60" cy="148" r="0.9"/>
            </g>
            <g class="oc-sword-stars" fill="#1e4d2f">
                <circle cx="40" cy="250" r="2.5"/><circle cx="40" cy="295" r="3.2"/><circle cx="40" cy="342" r="2.0"/>
            </g>
            <g class="oc-belt" fill="#1e4d2f">
                <circle cx="40" cy="40" r="4.2"/><circle cx="40" cy="120" r="4.6"/><circle cx="40" cy="200" r="4.0"/>
            </g>
        </svg>
    </div>
    <div style="max-width:1440px;margin:0 auto;padding:0 24px;">

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
            $gPhotos = ['10.jpg','5.jpg','13','11.jpg','10.jpg','5.jpg'];
            $gExtraPhotos = ['13','11.jpg','10.jpg','5.jpg','13','11.jpg'];
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
                 style="background:#f0eeec;border:0;border-radius:0;overflow:hidden;position:relative;cursor:pointer;{{ $spanStyle }}transition:transform 0.3s,box-shadow 0.3s;"
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
     CTA FINAL — Rejoignez-nous
════════════════════════════════════════════════════ --}}
<section class="rj-section">

    {{-- ─── Constellation Orion — CTA : diagonale Betelgeuse ↔ Rigel ─── --}}
    {{-- Deux étoiles brillantes en coins opposés, reliées via la ceinture = invitation à traverser --}}
    <div class="orion-c orion-c--cta" aria-hidden="true">
        <svg viewBox="0 0 600 380" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice">
            <defs>
                <filter id="ocGC" x="-100%" y="-100%" width="300%" height="300%">
                    <feGaussianBlur stdDeviation="5" result="b"/><feMerge><feMergeNode in="b"/><feMergeNode in="SourceGraphic"/></feMerge>
                </filter>
            </defs>
            <g class="oc-lines" stroke="#1e4d2f" stroke-linecap="round" stroke-width="0.7" stroke-dasharray="3 9">
                <line x1="62" y1="58" x2="185" y2="148"/>
                <line x1="185" y1="148" x2="300" y2="192"/>
                <line x1="300" y1="192" x2="415" y2="232"/>
                <line x1="415" y1="232" x2="538" y2="322"/>
            </g>
            <g class="oc-faint" fill="#1e4d2f">
                <circle cx="125" cy="35" r="1.0"/><circle cx="478" cy="290" r="1.0"/>
                <circle cx="240" cy="118" r="0.9"/><circle cx="365" cy="210" r="0.9"/>
            </g>
            <g class="oc-belt" fill="#1e4d2f">
                <circle cx="185" cy="148" r="4.0"/><circle cx="300" cy="192" r="4.5"/><circle cx="415" cy="232" r="4.0"/>
            </g>
            <g class="oc-betel" filter="url(#ocGC)"><circle cx="62" cy="58" r="6.5" fill="#1e4d2f"/></g>
            <g class="oc-rigel" filter="url(#ocGC)"><circle cx="538" cy="322" r="9" fill="#1e4d2f"/></g>
        </svg>
    </div>

    {{-- Filigrane mot --}}
    <span class="rj-bgword" aria-hidden="true">ORION</span>

    {{-- Ornements SVG --}}
    <svg class="rj-ornament rj-orn-tl" viewBox="0 0 160 160" fill="none" aria-hidden="true">
        <g stroke="rgba(212,160,48,0.18)" stroke-width="0.8">
            <line x1="0" y1="0" x2="90" y2="90"/>
            <line x1="0" y1="20" x2="70" y2="90"/>
            <line x1="0" y1="40" x2="50" y2="90"/>
            <line x1="20" y1="0" x2="90" y2="70"/>
            <line x1="40" y1="0" x2="90" y2="50"/>
        </g>
        <path d="M 0,52 L 0,0 L 52,0" stroke="rgba(28,21,16,0.12)" stroke-width="1.2" fill="none"/>
        <circle cx="0" cy="0" r="5" fill="rgba(212,160,48,0.35)"/>
        <circle cx="0" cy="0" r="2.5" fill="rgba(212,160,48,0.65)"/>
    </svg>

    <svg class="rj-ornament rj-orn-br" viewBox="0 0 160 160" fill="none" aria-hidden="true">
        <g stroke="rgba(212,160,48,0.14)" stroke-width="0.8">
            <line x1="70" y1="70" x2="160" y2="160"/>
            <line x1="90" y1="70" x2="160" y2="140"/>
            <line x1="110" y1="70" x2="160" y2="120"/>
            <line x1="70" y1="90" x2="140" y2="160"/>
            <line x1="70" y1="110" x2="120" y2="160"/>
        </g>
        <path d="M 160,108 L 160,160 L 108,160" stroke="rgba(28,21,16,0.12)" stroke-width="1.2" fill="none"/>
        <circle cx="160" cy="160" r="5" fill="rgba(212,160,48,0.30)"/>
        <circle cx="160" cy="160" r="2.5" fill="rgba(212,160,48,0.55)"/>
    </svg>

    {{-- Contenu centré --}}
    <div class="rj-inner reveal">

        {{-- Filet + kicker --}}
        <div class="rj-kicker">
            <span class="rj-kicker-line"></span>
            <span class="ni-kicker-label">Rejoignez-nous</span>
            <span class="rj-kicker-line"></span>
        </div>

        {{-- Titre --}}
        <h2 class="rj-title">
            Prêt à révéler<br>
            <em>votre talent ?</em>
        </h2>

        {{-- Filet doré --}}
        <div class="rj-rule"></div>

        {{-- Prose --}}
        <p class="rj-prose">
            Rejoignez une communauté d'artistes passionnés et bénéficiez d'un accompagnement professionnel pour concrétiser vos projets artistiques.
        </p>

        {{-- Boutons --}}
        <div class="rj-actions">
            <a href="{{ route('formations.index') }}" class="btn-gold">S'inscrire à une formation</a>
            <a href="{{ route('contact.index') }}" class="btn-outline">Nous contacter</a>
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
    .podcast-section {
        padding: 64px 0 !important;
    }
    section > div > div[style*="grid-template-columns:1fr 1fr"] {
        grid-template-columns: 1fr !important;
    }
    section > div > div[style*="grid-template-columns:repeat(3,1fr)"] {
        grid-template-columns: repeat(2,1fr) !important;
        grid-template-rows: auto !important;
    }
    .podcast-grid {
        grid-template-columns: 1fr !important;
        gap: 32px !important;
    }
    .podcast-visual {
        min-height: 280px !important;
        order: -1;
    }
}
@media(max-width:480px) {
    .podcast-visual {
        min-height: 240px !important;
    }
}
</style>

@endsection
