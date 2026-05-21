@extends('layouts.app')

@section('title', 'Centre d\'Art Orion — Production, Création, Formation')
@section('meta_description', 'Le Centre d\'Art Orion : votre espace de production artistique, création, formation et accompagnement des talents. Découvrez nos programmes et événements.')

@section('content')

{{-- ════════════════════════════════════════════════════
     HERO
════════════════════════════════════════════════════ --}}
<section style="position:relative;min-height:100vh;display:flex;align-items:center;overflow:hidden;background:#0a0a0a;">

    {{-- Animated gradient background --}}
    <div style="position:absolute;inset:0;overflow:hidden;">
        <div style="position:absolute;top:-20%;left:-10%;width:60%;height:80%;background:radial-gradient(ellipse,rgba(76,175,125,0.08) 0%,transparent 70%);pointer-events:none;"></div>
        <div style="position:absolute;bottom:-20%;right:-10%;width:60%;height:80%;background:radial-gradient(ellipse,rgba(212,160,48,0.07) 0%,transparent 70%);pointer-events:none;"></div>
        <div style="position:absolute;top:30%;left:50%;width:50%;height:60%;background:radial-gradient(ellipse,rgba(224,112,48,0.05) 0%,transparent 70%);pointer-events:none;transform:translateX(-50%);"></div>
        {{-- Grid pattern --}}
        <div style="position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,0.02) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.02) 1px,transparent 1px);background-size:60px 60px;pointer-events:none;"></div>
    </div>

    <div style="position:relative;z-index:2;max-width:1280px;margin:0 auto;padding:80px 24px;width:100%;">
        <div style="display:grid;grid-template-columns:1fr;gap:60px;align-items:center;">

            {{-- Text content --}}
            <div style="max-width:720px;">

                {{-- Badge --}}
                <div style="display:inline-flex;align-items:center;gap:8px;padding:6px 16px;border:1px solid rgba(76,175,125,0.3);border-radius:100px;background:rgba(76,175,125,0.06);margin-bottom:32px;">
                    <span style="width:6px;height:6px;border-radius:50%;background:#4caf7d;animation:pulse 2s infinite;"></span>
                    <span style="font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:#4caf7d;">Excellence Artistique — Kinshasa</span>
                </div>

                {{-- Headline --}}
                <h1 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2.8rem,7vw,5.5rem);font-weight:900;line-height:1.05;color:#f5f5f0;margin:0 0 28px;">
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

                <p style="color:rgba(245,245,240,0.6);font-size:1.1rem;line-height:1.8;margin:0 0 44px;max-width:560px;">
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
            <div class="stats-section" style="display:grid;grid-template-columns:repeat(2,1fr);gap:16px;max-width:420px;">
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

    {{-- Scroll indicator --}}
    <div style="position:absolute;bottom:32px;left:50%;transform:translateX(-50%);display:flex;flex-direction:column;align-items:center;gap:8px;z-index:2;">
        <span style="font-family:'Space Grotesk',sans-serif;font-size:0.7rem;letter-spacing:0.1em;text-transform:uppercase;color:#444;">Découvrir</span>
        <div style="width:1px;height:40px;background:linear-gradient(to bottom,#4caf7d,transparent);animation:scrollLine 2s infinite;"></div>
    </div>
</section>

{{-- ════════════════════════════════════════════════════
     PRÉSENTATION — Ce que nous faisons
════════════════════════════════════════════════════ --}}
<section style="padding:120px 0;background:#0d0d0d;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:center;">

            {{-- Left: text --}}
            <div class="reveal">
                <div class="tag tag-green" style="margin-bottom:20px;">Notre identité</div>
                <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,3rem);font-weight:900;color:#f5f5f0;line-height:1.15;margin:0 0 24px;" class="accent-line">
                    Un espace dédié à<br>l'excellence artistique
                </h2>
                <p class="prose-dark" style="margin-bottom:20px;">
                    Fondé par <strong style="color:#f5f5f0;">Aras M. NGONGO</strong>, le Centre d'Art Orion est bien plus qu'un espace de formation — c'est un écosystème artistique complet où les talents émergent, se développent et rayonnent.
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
                        <span style="color:rgba(245,245,240,0.75);font-size:0.92rem;">{{ $pt[1] }}</span>
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
                    <div style="grid-row:span 2;background:linear-gradient(135deg,#1a1a1a,#111);border:1px solid #222;border-radius:8px;height:320px;display:flex;align-items:center;justify-content:center;overflow:hidden;position:relative;">
                        <div style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(76,175,125,0.1),rgba(212,160,48,0.05));"></div>
                        <div style="text-align:center;position:relative;z-index:1;">
                            <div style="font-size:3.5rem;margin-bottom:12px;">🎨</div>
                            <div style="font-family:'Space Grotesk',sans-serif;font-size:0.8rem;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:#4caf7d;">Arts Visuels</div>
                        </div>
                    </div>
                    <div style="background:linear-gradient(135deg,#1a1a1a,#111);border:1px solid #222;border-radius:8px;height:150px;display:flex;align-items:center;justify-content:center;overflow:hidden;position:relative;">
                        <div style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(212,160,48,0.1),rgba(224,112,48,0.05));"></div>
                        <div style="text-align:center;position:relative;z-index:1;">
                            <div style="font-size:2.5rem;margin-bottom:8px;">🎵</div>
                            <div style="font-family:'Space Grotesk',sans-serif;font-size:0.75rem;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:#d4a030;">Musique</div>
                        </div>
                    </div>
                    <div style="background:linear-gradient(135deg,#1a1a1a,#111);border:1px solid #222;border-radius:8px;height:150px;display:flex;align-items:center;justify-content:center;overflow:hidden;position:relative;">
                        <div style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(224,112,48,0.1),rgba(212,160,48,0.05));"></div>
                        <div style="text-align:center;position:relative;z-index:1;">
                            <div style="font-size:2.5rem;margin-bottom:8px;">💃</div>
                            <div style="font-family:'Space Grotesk',sans-serif;font-size:0.75rem;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:#e07030;">Danse</div>
                        </div>
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
     SERVICES — 6 piliers
════════════════════════════════════════════════════ --}}
<section style="padding:120px 0;background:#0a0a0a;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">

        {{-- Header --}}
        <div class="reveal" style="text-align:center;max-width:600px;margin:0 auto 64px;">
            <div class="tag tag-gold" style="margin-bottom:20px;">Ce que nous offrons</div>
            <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,2.8rem);font-weight:900;color:#f5f5f0;line-height:1.15;margin:0 0 16px;" class="accent-line accent-line-center">
                Nos Services & Activités
            </h2>
            <p style="color:#777;font-size:0.95rem;line-height:1.8;">Un écosystème artistique complet pour développer votre potentiel créatif.</p>
        </div>

        {{-- Services grid --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:24px;">
            @foreach([
                ['🎬','Production Artistique','#4caf7d','Nous accompagnons la naissance de projets artistiques de qualité — de l\'idée initiale jusqu\'à la réalisation finale, avec des ressources et expertises professionnelles.',route('services')],
                ['✨','Création Artistique','#d4a030','Un environnement stimulant pour libérer votre créativité. Espaces de travail dédiés, matériel de qualité et une communauté d\'artistes passionnés pour vous inspirer.',route('services')],
                ['🎓','Formation','#e07030','Des programmes de formation structurés couvrant les arts visuels, la musique, la danse, le théâtre et bien plus. Niveaux débutant à avancé.',route('formations.index')],
                ['🤝','Accompagnement','#4caf7d','Un suivi individualisé pour chaque artiste : mentorat, développement de carrière, mise en réseau et aide à la concrétisation de projets personnels.',route('services')],
                ['🎪','Événements Culturels','#d4a030','Organisation de concerts, expositions, galas, showcases et événements culturels qui valorisent les talents locaux et créent des ponts entre artistes et publics.',route('evenements.index')],
                ['🏛','Ateliers & Programmes','#e07030','Des ateliers thématiques ouverts à tous, des résidences artistiques et des programmes intensifs pour approfondir vos compétences dans un cadre bienveillant.',route('services')],
            ] as $s)
            <div class="reveal hover-lift"
                 style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:36px;position:relative;overflow:hidden;cursor:default;transition:all 0.3s;"
                 onmouseover="this.style.borderColor='{{ $s[2] }}33';this.style.background='#141414'"
                 onmouseout="this.style.borderColor='#1a1a1a';this.style.background='#111'">

                {{-- Accent top line --}}
                <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,{{ $s[2] }},transparent);"></div>

                {{-- Icon --}}
                <div style="width:52px;height:52px;background:{{ $s[2] }}1a;border:1px solid {{ $s[2] }}33;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;margin-bottom:20px;">
                    {{ $s[0] }}
                </div>

                <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1.05rem;color:#f5f5f0;margin:0 0 12px;letter-spacing:0.02em;">{{ $s[1] }}</h3>
                <p style="color:#666;font-size:0.88rem;line-height:1.75;margin:0 0 24px;">{{ $s[2] === '#4caf7d' ? $s[3] : $s[3] }}</p>
                <p style="color:#555;font-size:0.88rem;line-height:1.75;margin:0 0 24px;">{{ $s[3] }}</p>

                <a href="{{ $s[4] }}"
                   style="display:inline-flex;align-items:center;gap:6px;color:{{ $s[2] }};font-family:'Space Grotesk',sans-serif;font-size:0.8rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;text-decoration:none;transition:gap 0.2s;"
                   onmouseover="this.querySelector('span').style.marginLeft='4px'"
                   onmouseout="this.querySelector('span').style.marginLeft='0'">
                    En savoir plus <span style="transition:margin 0.2s;">→</span>
                </a>
            </div>
            @endforeach
        </div>

    </div>
</section>

{{-- ════════════════════════════════════════════════════
     FORMATIONS — Aperçu
════════════════════════════════════════════════════ --}}
@if($formations->count())
<section style="padding:120px 0;background:#0d0d0d;border-top:1px solid #161616;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">

        <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:20px;margin-bottom:64px;" class="reveal">
            <div>
                <div class="tag tag-green" style="margin-bottom:20px;">Programmes disponibles</div>
                <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,2.8rem);font-weight:900;color:#f5f5f0;line-height:1.15;margin:0;" class="accent-line">
                    Nos Formations
                </h2>
            </div>
            <a href="{{ route('formations.index') }}" class="btn-outline">
                Voir toutes les formations →
            </a>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:24px;">
            @foreach($formations as $f)
            <div class="reveal hover-lift"
                 style="background:#111;border:1px solid #1a1a1a;border-radius:10px;overflow:hidden;transition:all 0.3s;">

                {{-- Image placeholder --}}
                <div style="height:180px;background:linear-gradient(135deg,#161616,#111);display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden;">
                    <div style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(76,175,125,0.08),rgba(212,160,48,0.06));"></div>
                    <div style="font-size:3rem;position:relative;z-index:1;">🎨</div>
                    @if($f->categorie)
                    <div style="position:absolute;top:12px;left:12px;">
                        <span class="tag tag-green">{{ $f->categorie }}</span>
                    </div>
                    @endif
                </div>

                <div style="padding:24px;">
                    <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1.05rem;color:#f5f5f0;margin:0 0 10px;">{{ $f->titre }}</h3>
                    <p style="color:#666;font-size:0.85rem;line-height:1.7;margin:0 0 20px;">{{ Str::limit($f->description, 100) }}</p>

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
<section style="padding:120px 0;background:#0a0a0a;border-top:1px solid #161616;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">

        <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:20px;margin-bottom:64px;" class="reveal">
            <div>
                <div class="tag tag-orange" style="margin-bottom:20px;">À venir</div>
                <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,2.8rem);font-weight:900;color:#f5f5f0;line-height:1.15;margin:0;" class="accent-line">
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
                 style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:28px 32px;display:flex;align-items:center;gap:32px;transition:all 0.3s;flex-wrap:wrap;"
                 onmouseover="this.style.borderColor='#e0703033';this.style.background='#141414'"
                 onmouseout="this.style.borderColor='#1a1a1a';this.style.background='#111'">

                {{-- Date block --}}
                <div style="min-width:70px;text-align:center;flex-shrink:0;">
                    <div style="font-family:'Playfair Display',Georgia,serif;font-size:2rem;font-weight:900;color:#e07030;line-height:1;">{{ $ev->date_debut->format('d') }}</div>
                    <div style="font-family:'Space Grotesk',sans-serif;font-size:0.75rem;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:#666;">{{ $ev->date_debut->translatedFormat('M') }}</div>
                </div>

                <div style="width:1px;height:50px;background:#1f1f1f;flex-shrink:0;display:none;" class="md:block"></div>

                {{-- Info --}}
                <div style="flex:1;min-width:200px;">
                    @if($ev->type)
                    <span class="tag tag-orange" style="margin-bottom:10px;display:inline-block;">{{ ucfirst($ev->type) }}</span>
                    @endif
                    <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1.05rem;color:#f5f5f0;margin:0 0 8px;">{{ $ev->titre }}</h3>
                    <p style="color:#666;font-size:0.85rem;margin:0;display:flex;align-items:center;gap:6px;">
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
<section style="padding:120px 0;background:#0d0d0d;border-top:1px solid #161616;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">

        <div class="reveal" style="text-align:center;max-width:540px;margin:0 auto 64px;">
            <div class="tag tag-gold" style="margin-bottom:20px;">Témoignages</div>
            <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,2.8rem);font-weight:900;color:#f5f5f0;line-height:1.15;margin:0;" class="accent-line accent-line-center">
                Ce qu'ils disent
            </h2>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:24px;">
            @foreach($temoignages as $t)
            <div class="reveal"
                 style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:32px;position:relative;overflow:hidden;transition:border-color 0.3s;"
                 onmouseover="this.style.borderColor='#d4a03033'" onmouseout="this.style.borderColor='#1a1a1a'">

                <div style="position:absolute;top:20px;right:24px;font-size:3rem;color:#1a1a1a;font-family:'Playfair Display',serif;line-height:1;">"</div>

                {{-- Stars --}}
                <div style="display:flex;gap:3px;margin-bottom:16px;">
                    @for($i=0;$i<$t->note;$i++)
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="#d4a030" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    @endfor
                </div>

                <p style="color:rgba(245,245,240,0.7);font-size:0.9rem;line-height:1.8;margin:0 0 24px;font-style:italic;">"{{ $t->contenu }}"</p>

                <div style="display:flex;align-items:center;gap:12px;">
                    <div style="width:40px;height:40px;border-radius:50%;background:linear-gradient(135deg,#4caf7d,#d4a030);display:flex;align-items:center;justify-content:center;font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.9rem;color:#0a0a0a;flex-shrink:0;">
                        {{ strtoupper(substr($t->auteur, 0, 1)) }}
                    </div>
                    <div>
                        <div style="font-family:'Space Grotesk',sans-serif;font-weight:600;font-size:0.9rem;color:#f5f5f0;">{{ $t->auteur }}</div>
                        @if($t->poste)
                        <div style="font-size:0.78rem;color:#666;">{{ $t->poste }}</div>
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
<section style="padding:120px 0;background:#0a0a0a;border-top:1px solid #161616;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">

        <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:20px;margin-bottom:64px;" class="reveal">
            <div>
                <div class="tag tag-green" style="margin-bottom:20px;">Nos réalisations</div>
                <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,2.8rem);font-weight:900;color:#f5f5f0;line-height:1.15;margin:0;" class="accent-line">
                    Galerie
                </h2>
            </div>
            <a href="{{ route('galerie.index') }}" class="btn-outline">Voir la galerie complète →</a>
        </div>

        <div style="display:grid;grid-template-columns:repeat(3,1fr);grid-template-rows:repeat(2,200px);gap:12px;">
            @foreach($galerie->take(6) as $i => $item)
            @php
                $spans = [
                    0 => 'grid-column:span 2;grid-row:span 2;',
                    1 => '', 2 => '', 3 => '', 4 => '', 5 => '',
                ];
                $style = $spans[$i] ?? '';
            @endphp
            <div class="reveal"
                 style="background:linear-gradient(135deg,#161616,#111);border:1px solid #1e1e1e;border-radius:8px;overflow:hidden;position:relative;cursor:pointer;{{ $style }}transition:all 0.3s;"
                 onmouseover="this.querySelector('.galerie-overlay').style.opacity='1'"
                 onmouseout="this.querySelector('.galerie-overlay').style.opacity='0'">

                @if($item->fichier && file_exists(public_path('storage/'.$item->fichier)))
                <img src="{{ asset('storage/'.$item->fichier) }}"
                     alt="{{ $item->titre }}"
                     style="width:100%;height:100%;object-fit:cover;">
                @else
                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,rgba(76,175,125,0.05),rgba(212,160,48,0.05));">
                    <span style="font-size:2.5rem;">🖼</span>
                </div>
                @endif

                <div class="galerie-overlay"
                     style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.8),transparent);opacity:0;transition:opacity 0.3s;display:flex;align-items:flex-end;padding:20px;">
                    <div>
                        <p style="font-family:'Space Grotesk',sans-serif;font-weight:600;font-size:0.88rem;color:#f5f5f0;margin:0;">{{ $item->titre }}</p>
                        @if($item->categorie)
                        <span class="tag tag-green" style="margin-top:6px;display:inline-block;">{{ $item->categorie }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach

            {{-- Placeholder si galerie vide --}}
            @if($galerie->isEmpty())
            @foreach(range(1,6) as $i)
            <div style="background:linear-gradient(135deg,#161616,#111);border:1px solid #1e1e1e;border-radius:8px;display:flex;align-items:center;justify-content:center;{{ $i===1?'grid-column:span 2;grid-row:span 2;':'' }}">
                <span style="font-size:{{ $i===1?'3rem':'2rem' }};">🖼</span>
            </div>
            @endforeach
            @endif
        </div>

    </div>
</section>

{{-- ════════════════════════════════════════════════════
     CTA FINAL
════════════════════════════════════════════════════ --}}
<section style="padding:100px 0;background:#0d0d0d;border-top:1px solid #161616;position:relative;overflow:hidden;">

    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at center,rgba(76,175,125,0.06) 0%,transparent 70%);pointer-events:none;"></div>

    <div style="max-width:800px;margin:0 auto;padding:0 24px;text-align:center;position:relative;z-index:1;">
        <div class="reveal">
            <div class="tag tag-gold" style="margin-bottom:24px;">Rejoignez-nous</div>
            <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,5vw,3.5rem);font-weight:900;color:#f5f5f0;line-height:1.1;margin:0 0 20px;">
                Prêt à révéler votre
                <span style="background:linear-gradient(135deg,#4caf7d,#d4a030);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">talent ?</span>
            </h2>
            <p style="color:#777;font-size:1rem;line-height:1.8;margin:0 0 44px;max-width:500px;margin-left:auto;margin-right:auto;">
                Rejoignez une communauté d'artistes passionnés et bénéficiez d'un accompagnement professionnel pour concrétiser vos projets artistiques.
            </p>
            <div style="display:flex;flex-wrap:wrap;gap:14px;justify-content:center;">
                <a href="{{ route('formations.index') }}" class="btn-gold">S'inscrire à une formation</a>
                <a href="{{ route('contact.index') }}" class="btn-outline">Nous contacter</a>
            </div>
        </div>
    </div>
</section>

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
