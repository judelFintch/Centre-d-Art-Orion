@extends('layouts.app')

@section('title', 'Centre d\'Art Orion — Production, Création, Formation')
@section('meta_description', 'Le Centre d\'Art Orion : votre espace de production artistique, création, formation et accompagnement des talents. Découvrez nos programmes et événements.')

@section('content')

<div class="home-biasasa">

{{-- ════════════════════════════════════════════════════
     HERO
════════════════════════════════════════════════════ --}}
<section id="hero-slider-section" class="biasasa-inspired hero-orion" style="position:relative;min-height:100vh;display:flex;align-items:center;overflow:hidden;background:#0a0a0a;">

    {{-- ─── Slider Background ─── --}}
    <div id="hero-slides-container" style="position:absolute;inset:0;">

        {{-- Slide 1 — photo 11 --}}
        <div class="hero-slide"
             style="position:absolute;inset:0;background-image:url('{{ asset('images/11.jpg') }}');background-size:cover;background-position:center;opacity:1;transition:opacity 1.2s ease-in-out;will-change:opacity;">
        </div>

        {{-- Slide 2 — photo 22 --}}
        <div class="hero-slide"
             style="position:absolute;inset:0;background-image:url('{{ asset('images/22.jpg') }}');background-size:cover;background-position:center;opacity:0;transition:opacity 1.2s ease-in-out;will-change:opacity;">
        </div>

        {{-- Dark overlay for text readability --}}
        <div style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(10,10,10,0.78) 0%,rgba(10,10,10,0.55) 50%,rgba(10,10,10,0.70) 100%);"></div>

        {{-- Subtle color tints (lighter than before since photo provides texture) --}}
        <div style="position:absolute;top:-20%;left:-10%;width:60%;height:80%;background:radial-gradient(ellipse,rgba(76,175,125,0.06) 0%,transparent 70%);pointer-events:none;"></div>
        <div style="position:absolute;bottom:-20%;right:-10%;width:50%;height:70%;background:radial-gradient(ellipse,rgba(212,160,48,0.05) 0%,transparent 70%);pointer-events:none;"></div>
    </div>

    {{-- ─── Slider Nav Arrows ─── --}}
    <button id="hero-prev" aria-label="Slide précédente"
            style="position:absolute;left:20px;top:50%;transform:translateY(-50%);z-index:4;width:44px;height:44px;border-radius:50%;background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.14);color:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all 0.2s;backdrop-filter:blur(4px);"
            onmouseover="this.style.background='rgba(76,175,125,0.25)';this.style.borderColor='rgba(76,175,125,0.5)'"
            onmouseout="this.style.background='rgba(255,255,255,0.08)';this.style.borderColor='rgba(255,255,255,0.14)'">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
    </button>
    <button id="hero-next" aria-label="Slide suivante"
            style="position:absolute;right:20px;top:50%;transform:translateY(-50%);z-index:4;width:44px;height:44px;border-radius:50%;background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.14);color:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all 0.2s;backdrop-filter:blur(4px);"
            onmouseover="this.style.background='rgba(76,175,125,0.25)';this.style.borderColor='rgba(76,175,125,0.5)'"
            onmouseout="this.style.background='rgba(255,255,255,0.08)';this.style.borderColor='rgba(255,255,255,0.14)'">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
    </button>

    <div class="hero-orion-inner" style="position:relative;z-index:2;max-width:1280px;margin:0 auto;padding:80px 24px;width:100%;">
        <div class="hero-orion-grid" style="display:grid;grid-template-columns:1fr;gap:60px;align-items:center;">

            {{-- Text content --}}
            <div class="hero-orion-copy" style="max-width:720px;">

                {{-- Badge --}}
                <div class="hero-orion-kicker" style="display:inline-flex;align-items:center;gap:8px;padding:6px 16px;border:1px solid rgba(76,175,125,0.3);border-radius:100px;background:rgba(76,175,125,0.06);margin-bottom:32px;">
                    <span style="width:6px;height:6px;border-radius:50%;background:#4caf7d;animation:pulse 2s infinite;"></span>
                    <span style="font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:#4caf7d;">Excellence Artistique — Kinshasa</span>
                </div>

                {{-- Headline --}}
                <h1 class="hero-orion-title" style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2.8rem,7vw,5.5rem);font-weight:900;line-height:1.05;color:#f5f5f0;margin:0 0 28px;">
                    L'Art au cœur<br>
                    <span style="background:linear-gradient(135deg,#4caf7d,#d4a030,#e07030);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">de votre vie</span>
                </h1>

                {{-- Tagline --}}
                <div style="display:flex;align-items:center;gap:16px;margin-bottom:28px;flex-wrap:wrap;">
                    @foreach(['Production','Création','Formation'] as $tag)
                    <div style="display:flex;align-items:center;gap:8px;">
                        <span style="width:8px;height:8px;border-radius:50%;background:linear-gradient(135deg,#4caf7d,#d4a030);"></span>
                        <span style="font-family:'Space Grotesk',sans-serif;font-size:1rem;font-weight:600;letter-spacing:0.06em;color:#f5f5f0;">{{ $tag }}</span>
                    </div>
                    @endforeach
                </div>

                <p class="hero-orion-lead" style="color:rgba(245,245,240,0.6);font-size:1.1rem;line-height:1.8;margin:0 0 44px;max-width:560px;">
                    Le Centre d'Art Orion est votre espace de création, de formation et d'expression. Nous accompagnons les artistes de tous horizons vers l'excellence, à travers des programmes pensés pour révéler chaque talent.
                </p>

                {{-- CTA Buttons --}}
                <div style="display:flex;flex-wrap:wrap;gap:14px;align-items:center;">
                    <a href="{{ route('about') }}" class="btn-gold">
                        Découvrir le centre
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                    <a href="{{ route('formations.index') }}" class="btn-outline">
                        Voir les formations
                    </a>
                    <a href="{{ route('contact.index') }}" class="btn-primary">
                        Nous contacter
                    </a>
                </div>

            </div>

            {{-- Stats cards --}}
            <div class="stats-section hero-orion-stats" style="display:grid;grid-template-columns:repeat(2,1fr);gap:16px;max-width:420px;">
                @foreach([
                    ['100+', 'Artistes formés',   '#4caf7d'],
                    ['50+',  'Événements organisés','#d4a030'],
                    ['6',    'Disciplines artistiques','#e07030'],
                    ['5+',   'Années d\'excellence','#4caf7d'],
                ] as $stat)
                <div style="padding:24px;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.06);border-radius:8px;text-align:center;transition:all 0.3s;"
                     onmouseover="this.style.borderColor='{{ $stat[2] }}44';this.style.background='rgba(255,255,255,0.05)'"
                     onmouseout="this.style.borderColor='rgba(255,255,255,0.06)';this.style.background='rgba(255,255,255,0.03)'">
                    <div style="font-family:'Playfair Display',Georgia,serif;font-size:2.2rem;font-weight:900;color:{{ $stat[2] }};line-height:1;">{{ $stat[0] }}</div>
                    <div style="font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:500;color:#777;letter-spacing:0.04em;margin-top:6px;">{{ $stat[1] }}</div>
                </div>
                @endforeach
            </div>

        </div>
    </div>

    {{-- ─── Slider Dots ─── --}}
    <div id="hero-dots" style="position:absolute;bottom:52px;left:50%;transform:translateX(-50%);display:flex;gap:10px;z-index:4;align-items:center;">
        <button class="hero-dot active" data-index="0" aria-label="Slide 1"
                style="width:28px;height:4px;border-radius:2px;background:#4caf7d;border:none;cursor:pointer;transition:all 0.3s;padding:0;position:relative;overflow:hidden;">
            <span class="dot-progress" style="position:absolute;inset:0;background:rgba(255,255,255,0.4);transform:scaleX(0);transform-origin:left;transition:transform 6s linear;border-radius:2px;"></span>
        </button>
        <button class="hero-dot" data-index="1" aria-label="Slide 2"
                style="width:12px;height:4px;border-radius:2px;background:rgba(255,255,255,0.25);border:none;cursor:pointer;transition:all 0.3s;padding:0;position:relative;overflow:hidden;">
            <span class="dot-progress" style="position:absolute;inset:0;background:rgba(255,255,255,0.4);transform:scaleX(0);transform-origin:left;transition:transform 6s linear;border-radius:2px;"></span>
        </button>
    </div>

    {{-- Scroll indicator --}}
    <div style="position:absolute;bottom:16px;left:50%;transform:translateX(-50%);display:flex;flex-direction:column;align-items:center;gap:6px;z-index:2;">
        <span style="font-family:'Space Grotesk',sans-serif;font-size:0.65rem;letter-spacing:0.1em;text-transform:uppercase;color:#444;">Découvrir</span>
        <div style="width:1px;height:32px;background:linear-gradient(to bottom,#4caf7d,transparent);animation:scrollLine 2s infinite;"></div>
    </div>
</section>

{{-- ════════════════════════════════════════════════════
     PRÉSENTATION — Ce que nous faisons
════════════════════════════════════════════════════ --}}
<section style="padding:120px 0;background:#f4f0e8;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:center;">

            {{-- Left: text --}}
            <div class="reveal">
                <div class="tag tag-green" style="margin-bottom:20px;">Notre identité</div>
                <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,3rem);font-weight:900;color:#1c1510;line-height:1.15;margin:0 0 24px;" class="accent-line">
                    Un espace dédié à<br>l'excellence artistique
                </h2>
                <p class="prose-dark" style="margin-bottom:20px;">
                    Fondé par <strong style="color:#1c1510;">Aras M. NGONGO</strong>, le Centre d'Art Orion est bien plus qu'un espace de formation — c'est un écosystème artistique complet où les talents émergent, se développent et rayonnent.
                </p>
                <p class="prose-dark">
                    Situé au 380, Avenue Changalele dans le Quartier Gambela, le centre accueille chaque année des dizaines d'artistes de tous horizons dans un cadre professionnel, inspirant et bienveillant.
                </p>

                <div style="margin-top:40px;display:flex;flex-direction:column;gap:16px;">
                    @foreach([
                        ['#4caf7d','Accompagnement personnalisé de chaque artiste'],
                        ['#d4a030','Équipements professionnels de pointe'],
                        ['#e07030','Réseau actif de partenaires culturels'],
                    ] as $pt)
                    <div style="display:flex;align-items:center;gap:14px;">
                        <div style="width:32px;height:32px;border-radius:4px;background:{{ $pt[0] }}1a;border:1px solid {{ $pt[0] }}33;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="{{ $pt[0] }}" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        <span style="color:rgba(28,21,16,0.70);font-size:0.92rem;">{{ $pt[1] }}</span>
                    </div>
                    @endforeach
                </div>

                <div style="margin-top:40px;">
                    <a href="{{ route('about') }}" class="btn-primary">
                        Notre histoire complète
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            {{-- Right: image mosaic --}}
            <div class="reveal" style="position:relative;">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">

                    {{-- Photo principale — portrait 853×1280 --}}
                    <div style="grid-row:span 2;border-radius:8px;height:320px;overflow:hidden;position:relative;background:#ffffff;">
                        <img src="{{ asset('images/1.png') }}"
                             alt="Centre d'Art Orion — arts visuels"
                             style="width:100%;height:100%;object-fit:cover;display:block;transition:transform 0.5s ease;"
                             onmouseover="this.style.transform='scale(1.04)'"
                             onmouseout="this.style.transform='scale(1)'">
                        <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.55) 0%,transparent 60%);"></div>
                        <div style="position:absolute;bottom:14px;left:14px;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:#4caf7d;">Arts Visuels</div>
                    </div>

                    {{-- Photo secondaire --}}
                    <div style="border-radius:8px;height:150px;overflow:hidden;position:relative;background:#ffffff;">
                        <img src="{{ asset('images/2.jpg') }}"
                             alt="Centre d'Art Orion — musique"
                             style="width:100%;height:100%;object-fit:cover;display:block;transition:transform 0.5s ease;"
                             onmouseover="this.style.transform='scale(1.06)'"
                             onmouseout="this.style.transform='scale(1)'">
                        <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.55) 0%,transparent 60%);"></div>
                        <div style="position:absolute;bottom:10px;left:12px;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:#d4a030;">Musique</div>
                    </div>

                    {{-- Photo tertiaire --}}
                    <div style="border-radius:8px;height:150px;overflow:hidden;position:relative;background:#ffffff;">
                        <img src="{{ asset('images/3.jpg') }}"
                             alt="Centre d'Art Orion — danse"
                             style="width:100%;height:100%;object-fit:cover;display:block;transition:transform 0.5s ease;"
                             onmouseover="this.style.transform='scale(1.06)'"
                             onmouseout="this.style.transform='scale(1)'">
                        <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.55) 0%,transparent 60%);"></div>
                        <div style="position:absolute;bottom:10px;left:12px;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:#e07030;">Danse</div>
                    </div>

                </div>

                {{-- Floating badge --}}
                <div style="position:absolute;bottom:-20px;left:-20px;background:linear-gradient(135deg,#4caf7d,#2d7a52);padding:16px 20px;border-radius:8px;box-shadow:0 20px 40px rgba(76,175,125,0.3);">
                    <div style="font-family:'Playfair Display',Georgia,serif;font-size:1.8rem;font-weight:900;color:#fff;line-height:1;">5+</div>
                    <div style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:rgba(255,255,255,0.8);">Années d'art</div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════════════
     SERVICES — Index éditorial
════════════════════════════════════════════════════ --}}
<section style="padding:120px 0;background:#faf8f4;border-top:1px solid #ede6da;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">

        {{-- Header --}}
        <div class="reveal" style="display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:flex-end;margin-bottom:64px;">
            <div>
                <div class="tag tag-gold" style="margin-bottom:16px;">Ce que nous offrons</div>
                <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2.2rem,4vw,3.2rem);font-weight:900;color:#1c1510;margin:0;line-height:1.05;" class="accent-line">
                    Nos Services<br>& Activités
                </h2>
            </div>
            <p style="color:#8a7e74;font-size:0.95rem;line-height:1.85;margin:0;">
                De la première idée à la scène, un écosystème complet — production, formation, accompagnement et événements — pour chaque artiste, à chaque étape.
            </p>
        </div>

        {{-- Liste éditoriale --}}
        @php
        $hSPhotos = ['11.jpg','22.jpg','5.jpg','7.jpg','3.jpg','9.jpg'];
        $hServices = [
            ['🎬','Production Artistique','#4caf7d','Studios, espaces de répétition, accompagnement technique et distribution des œuvres.',route('services')],
            ['✨','Création Artistique','#d4a030','Ateliers ouverts, résidences et collaborations inter-disciplines pour libérer votre créativité.',route('services')],
            ['🎓','Formation Artistique','#e07030','6 disciplines, niveaux débutant à avancé, formateurs certifiés et certificats reconnus.',route('formations.index')],
            ['🤝','Accompagnement','#4caf7d','Mentorat personnalisé, développement de carrière et mise en réseau professionnel.',route('services')],
            ['🎪','Événements Culturels','#d4a030','Concerts, expositions, galas et festivals qui valorisent les talents locaux.',route('evenements.index')],
            ['🏛','Ateliers & Programmes','#e07030','Programmes ouverts à tous — enfants, adultes, communauté — tout au long de l\'année.',route('services')],
        ];
        @endphp

        <div style="border-top:1px solid #ddd6c8;">
            @foreach($hServices as $hi => $hs)
            <a href="{{ $hs[4] }}"
               style="display:grid;grid-template-columns:80px 1fr auto auto;align-items:center;gap:28px;padding:22px 0;border-bottom:1px solid #ddd6c8;text-decoration:none;position:relative;transition:background 0.25s;border-radius:4px;"
               onmouseover="
                   this.style.background='{{ $hs[2] }}08';
                   this.querySelector('.si-num').style.color='{{ $hs[2] }}';
                   this.querySelector('.si-thumb').style.opacity='1';
                   this.querySelector('.si-thumb').style.transform='scale(1) translateX(0)';
                   this.querySelector('.si-arrow').style.color='{{ $hs[2] }}';
                   this.querySelector('.si-arrow').style.transform='translateX(6px)';
               "
               onmouseout="
                   this.style.background='transparent';
                   this.querySelector('.si-num').style.color='#ddd6c8';
                   this.querySelector('.si-thumb').style.opacity='0';
                   this.querySelector('.si-thumb').style.transform='scale(0.88) translateX(12px)';
                   this.querySelector('.si-arrow').style.color='#c8bfb4';
                   this.querySelector('.si-arrow').style.transform='translateX(0)';
               ">

                {{-- Numéro --}}
                <div class="si-num"
                     style="font-family:'Playfair Display',Georgia,serif;font-size:2.2rem;font-weight:900;color:#ddd6c8;line-height:1;transition:color 0.25s;padding-left:12px;">
                    0{{ $hi + 1 }}
                </div>

                {{-- Icône + titre + description --}}
                <div>
                    <div style="display:flex;align-items:center;gap:12px;margin-bottom:4px;">
                        <span style="font-size:1.1rem;">{{ $hs[0] }}</span>
                        <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1rem;color:#1c1510;margin:0;letter-spacing:0.02em;">{{ $hs[1] }}</h3>
                    </div>
                    <p style="color:#9a8e84;font-size:0.82rem;line-height:1.6;margin:0;max-width:480px;">{{ $hs[3] }}</p>
                </div>

                {{-- Vignette photo --}}
                <div class="si-thumb"
                     style="width:88px;height:68px;border-radius:6px;overflow:hidden;flex-shrink:0;opacity:0;transform:scale(0.88) translateX(12px);transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1);">
                    <img src="{{ asset('images/' . $hSPhotos[$hi]) }}"
                         alt="{{ $hs[1] }}"
                         style="width:100%;height:100%;object-fit:cover;display:block;">
                </div>

                {{-- Flèche --}}
                <div class="si-arrow"
                     style="color:#c8bfb4;font-size:1.1rem;transition:all 0.25s;padding-right:8px;">→</div>

            </a>
            @endforeach
        </div>

        {{-- CTA --}}
        <div class="reveal" style="margin-top:40px;display:flex;justify-content:flex-end;">
            <a href="{{ route('services') }}" class="btn-outline">Découvrir tous nos services →</a>
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
<section style="padding:120px 0;background:#fafaf6;border-top:1px solid #e0d8cc;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">

        <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:20px;margin-bottom:64px;" class="reveal">
            <div>
                <div class="tag tag-orange" style="margin-bottom:20px;">À venir</div>
                <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,2.8rem);font-weight:900;color:#1c1510;line-height:1.15;margin:0;" class="accent-line">
                    Prochains Événements
                </h2>
            </div>
            <a href="{{ route('evenements.index') }}" class="btn-outline">
                Voir tous les événements →
            </a>
        </div>

        <div style="display:flex;flex-direction:column;gap:20px;">
            @foreach($evenements as $ev)
            <div class="reveal"
                 style="background:#ffffff;border:1px solid #e0d8cc;border-radius:10px;padding:28px 32px;display:flex;align-items:center;gap:32px;transition:all 0.3s;flex-wrap:wrap;"
                 onmouseover="this.style.borderColor='#e0703033';this.style.background='#f6f2ec'"
                 onmouseout="this.style.borderColor='#e0d8cc';this.style.background='#ffffff'">

                {{-- Date block --}}
                <div style="min-width:70px;text-align:center;flex-shrink:0;">
                    <div style="font-family:'Playfair Display',Georgia,serif;font-size:2rem;font-weight:900;color:#e07030;line-height:1;">{{ $ev->date_debut->format('d') }}</div>
                    <div style="font-family:'Space Grotesk',sans-serif;font-size:0.75rem;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:#78706a;">{{ $ev->date_debut->translatedFormat('M') }}</div>
                </div>

                <div style="width:1px;height:50px;background:#1f1f1f;flex-shrink:0;display:none;" class="md:block"></div>

                {{-- Info --}}
                <div style="flex:1;min-width:200px;">
                    @if($ev->type)
                    <span class="tag tag-orange" style="margin-bottom:10px;display:inline-block;">{{ ucfirst($ev->type) }}</span>
                    @endif
                    <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1.05rem;color:#1c1510;margin:0 0 8px;">{{ $ev->titre }}</h3>
                    <p style="color:#78706a;font-size:0.85rem;margin:0;display:flex;align-items:center;gap:6px;">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#777" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        {{ $ev->lieu ?? 'Centre d\'Art Orion' }}
                    </p>
                </div>

                {{-- Price & CTA --}}
                <div style="display:flex;flex-direction:column;align-items:flex-end;gap:10px;flex-shrink:0;">
                    @if($ev->gratuit)
                        <span style="font-family:'Space Grotesk',sans-serif;font-size:0.9rem;font-weight:700;color:#4caf7d;">Gratuit</span>
                    @elseif($ev->prix)
                        <span style="font-family:'Space Grotesk',sans-serif;font-size:0.9rem;font-weight:700;color:#d4a030;">${{ number_format($ev->prix, 0) }}</span>
                    @endif
                    <a href="{{ route('evenements.show', $ev) }}" class="btn-outline" style="padding:8px 18px;font-size:0.78rem;">
                        En savoir plus
                    </a>
                </div>
            </div>
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
