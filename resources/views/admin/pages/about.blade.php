@extends('layouts.admin')
@section('title', 'Contenu — Page À Propos')

@php use App\Models\PageSetting; @endphp

@section('content')

{{-- En-tête --}}
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:12px;">
    <div>
        <h2 style="font-family:'Playfair Display',serif;font-size:1.4rem;font-weight:900;color:#f5f5f0;margin:0 0 4px;">Page "À propos"</h2>
        <p style="color:#555;font-size:0.82rem;font-family:'Space Grotesk',sans-serif;margin:0;">Modifiez les textes : histoire, vision, direction et appel à l'action.</p>
    </div>
    <div style="display:flex;gap:10px;">
        <a href="{{ route('admin.pages.home') }}"
           style="display:inline-flex;align-items:center;gap:6px;padding:9px 16px;border-radius:6px;background:#111;border:1px solid #1a1a1a;color:#aaa;font-size:0.8rem;font-family:'Space Grotesk',sans-serif;text-decoration:none;">
            ← Accueil
        </a>
        <a href="{{ route('about') }}" target="_blank"
           style="display:inline-flex;align-items:center;gap:6px;padding:9px 16px;border-radius:6px;background:#111;border:1px solid #1a1a1a;color:#4caf7d;font-size:0.8rem;font-family:'Space Grotesk',sans-serif;text-decoration:none;">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg>
            Voir la page
        </a>
    </div>
</div>

{{-- Onglets --}}
<div style="display:flex;gap:4px;margin-bottom:28px;border-bottom:1px solid #1a1a1a;overflow-x:auto;">
    @foreach(['hero' => 'Hero','histoire' => 'Histoire','vmv' => 'Vision/Mission','direction' => 'Direction','cta' => 'CTA'] as $id => $label)
    <a href="#section-about-{{ $id }}"
       style="padding:10px 16px;font-family:'Space Grotesk',sans-serif;font-size:0.8rem;font-weight:600;color:#666;text-decoration:none;border-bottom:2px solid transparent;white-space:nowrap;"
       onclick="document.getElementById('section-about-{{ $id }}').scrollIntoView({behavior:'smooth',block:'start'});return false;">{{ $label }}</a>
    @endforeach
</div>

<form method="POST" action="{{ route('admin.pages.about.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- ═══════════════════════════════ HERO ═════════════════════════════ --}}
    <div id="section-about-hero" class="ps-section">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
            <div style="width:4px;height:36px;background:linear-gradient(180deg,#4caf7d,#2d7a52);border-radius:2px;"></div>
            <div>
                <h3 style="font-family:'Space Grotesk',sans-serif;font-size:0.95rem;font-weight:700;color:#f5f5f0;margin:0;">Bannière Hero</h3>
                <p style="color:#555;font-size:0.78rem;margin:0;">Titre et description en tête de page</p>
            </div>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:12px;">
            @include('admin.pages._field', ['name' => 'about[hero][titre_1]', 'key' => 'about.hero.titre_1', 'label' => 'Titre ligne 1', 'default' => 'Notre Histoire,'])
            @include('admin.pages._field', ['name' => 'about[hero][titre_2]', 'key' => 'about.hero.titre_2', 'label' => 'Titre ligne 2 (dégradé vert/or)', 'default' => 'Notre Passion'])
        </div>
        @include('admin.pages._textarea', ['name' => 'about[hero][desc]', 'key' => 'about.hero.desc', 'label' => 'Description', 'default' => "Découvrez l'histoire et les valeurs qui font du Centre d'Art Orion un espace unique dédié à l'excellence artistique.", 'rows' => 2])
    </div>

    <div style="height:1px;background:#161616;margin:32px 0;"></div>

    {{-- ═══════════════════════════════ HISTOIRE ═════════════════════════════ --}}
    <div id="section-about-histoire" class="ps-section">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
            <div style="width:4px;height:36px;background:linear-gradient(180deg,#d4a030,#c08020);border-radius:2px;"></div>
            <div>
                <h3 style="font-family:'Space Grotesk',sans-serif;font-size:0.95rem;font-weight:700;color:#f5f5f0;margin:0;">Section Histoire</h3>
                <p style="color:#555;font-size:0.78rem;margin:0;">Genèse du centre : titre, 3 paragraphes + 4 items</p>
            </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:16px;">
            @include('admin.pages._field', ['name' => 'about[histoire][kicker]', 'key' => 'about.histoire.kicker', 'label' => 'Étiquette', 'default' => 'Notre genèse'])
            @include('admin.pages._field', ['name' => 'about[histoire][titre]', 'key' => 'about.histoire.titre', 'label' => 'Titre principal', 'default' => "L'Histoire du Centre d'Art Orion"])
        </div>

        <div style="display:grid;grid-template-columns:1fr;gap:12px;margin-bottom:20px;">
            @include('admin.pages._textarea', ['name' => 'about[histoire][para1]', 'key' => 'about.histoire.para1', 'label' => 'Paragraphe 1', 'default' => "Né de la vision de son fondateur Aras M. NGONGO, le Centre d'Art Orion a été créé avec une ambition claire : offrir aux artistes congolais un espace professionnel, structuré et inspirant pour développer leur art.", 'rows' => 3])
            @include('admin.pages._textarea', ['name' => 'about[histoire][para2]', 'key' => 'about.histoire.para2', 'label' => 'Paragraphe 2', 'default' => "Implanté au cœur du Quartier Gambela, au 380, Avenue Changalele — derrière le nouveau bâtiment de l'INPP — le centre s'est rapidement imposé comme un pilier incontournable de la scène artistique locale.", 'rows' => 3])
            @include('admin.pages._textarea', ['name' => 'about[histoire][para3]', 'key' => 'about.histoire.para3', 'label' => 'Paragraphe 3', 'default' => "Sous la direction opérationnelle de Magellan KAHOZI, Chef de Centre, Orion a su construire des programmes de formation rigoureux, accueillir des artistes en résidence et organiser des événements culturels qui ont marqué la communauté.", 'rows' => 3])
        </div>

        {{-- 4 items --}}
        <p style="color:#888;font-size:0.78rem;font-family:'Space Grotesk',sans-serif;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;margin:0 0 14px;">4 blocs informatifs (Fondation, Localisation, Mission, Vision)</p>
        @php
        $histItems = [
            ['📅','Fondation',"Une vision née de la passion pour l'art et les artistes congolais"],
            ['📍','Localisation','380, Av. Changalele, Q. Gambela — au cœur de la ville'],
            ['🎯','Mission','Former, produire, créer et accompagner les talents artistiques'],
            ['🌟','Vision','Faire d\'Orion le centre de référence artistique en Afrique centrale'],
        ];
        @endphp
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
            @foreach($histItems as $i => $hi)
            @php $n = $i + 1; @endphp
            <div style="background:#0d0d0d;border:1px solid #1a1a1a;border-radius:8px;padding:16px;">
                <p style="color:#d4a030;font-family:'Space Grotesk',sans-serif;font-size:0.75rem;font-weight:700;text-transform:uppercase;margin:0 0 10px;">Bloc {{ $n }}</p>
                <div style="display:grid;grid-template-columns:50px 1fr;gap:8px;margin-bottom:8px;">
                    @include('admin.pages._field', ['name' => 'about[histoire][item'.$n.'_emoji]', 'key' => 'about.histoire.item'.$n.'_emoji', 'label' => 'Emoji', 'default' => $hi[0]])
                    @include('admin.pages._field', ['name' => 'about[histoire][item'.$n.'_titre]', 'key' => 'about.histoire.item'.$n.'_titre', 'label' => 'Titre', 'default' => $hi[1]])
                </div>
                @include('admin.pages._field', ['name' => 'about[histoire][item'.$n.'_desc]', 'key' => 'about.histoire.item'.$n.'_desc', 'label' => 'Description', 'default' => $hi[2]])
            </div>
            @endforeach
        </div>
    </div>

    <div style="height:1px;background:#161616;margin:32px 0;"></div>

    {{-- ═══════════════════════════════ VISION / MISSION / VALEURS ═════════════════════════════ --}}
    <div id="section-about-vmv" class="ps-section">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
            <div style="width:4px;height:36px;background:linear-gradient(180deg,#e07030,#b04820);border-radius:2px;"></div>
            <div>
                <h3 style="font-family:'Space Grotesk',sans-serif;font-size:0.95rem;font-weight:700;color:#f5f5f0;margin:0;">Vision · Mission · Valeurs</h3>
                <p style="color:#555;font-size:0.78rem;margin:0;">Les 3 piliers de l'identité du centre</p>
            </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px;">
            <div style="background:#0d0d0d;border:1px solid #1a1a1a;border-left:3px solid #4caf7d;border-radius:8px;padding:18px;">
                <p style="color:#4caf7d;font-size:0.75rem;font-family:'Space Grotesk',sans-serif;font-weight:700;text-transform:uppercase;margin:0 0 12px;">🔭 Notre Vision</p>
                @include('admin.pages._textarea', ['name' => 'about[vision][texte]', 'key' => 'about.vision.texte', 'label' => 'Texte', 'default' => "Devenir le centre artistique de référence en Afrique centrale, reconnu pour l'excellence de ses formations, la qualité de ses productions et son rôle de catalyseur culturel dans la région.", 'rows' => 4])
            </div>
            <div style="background:#0d0d0d;border:1px solid #1a1a1a;border-left:3px solid #d4a030;border-radius:8px;padding:18px;">
                <p style="color:#d4a030;font-size:0.75rem;font-family:'Space Grotesk',sans-serif;font-weight:700;text-transform:uppercase;margin:0 0 12px;">🎯 Notre Mission</p>
                @include('admin.pages._textarea', ['name' => 'about[mission][texte]', 'key' => 'about.mission.texte', 'label' => 'Texte', 'default' => "Former, accompagner et promouvoir les artistes à travers des programmes de qualité, un environnement créatif stimulant et un réseau de partenaires engagés dans le développement des arts et de la culture.", 'rows' => 4])
            </div>
        </div>

        <div style="background:#0d0d0d;border:1px solid #1a1a1a;border-left:3px solid #e07030;border-radius:8px;padding:18px;">
            <p style="color:#e07030;font-size:0.75rem;font-family:'Space Grotesk',sans-serif;font-weight:700;text-transform:uppercase;margin:0 0 14px;">💎 Nos Valeurs (5 items)</p>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                @php
                $valeursDefaults = [
                    "Excellence — Qualité sans compromis",
                    "Créativité — Encourager l'expression unique",
                    "Inclusion — Art pour tous, sans distinction",
                    "Intégrité — Éthique professionnelle constante",
                    "Communauté — Tisser des liens durables",
                ];
                @endphp
                @foreach($valeursDefaults as $i => $vd)
                @php $n = $i + 1; @endphp
                @include('admin.pages._field', ['name' => 'about[valeurs][item'.$n.']', 'key' => 'about.valeurs.item'.$n, 'label' => 'Valeur '.$n, 'default' => $vd])
                @endforeach
            </div>
        </div>
    </div>

    <div style="height:1px;background:#161616;margin:32px 0;"></div>

    {{-- ═══════════════════════════════ DIRECTION ═════════════════════════════ --}}
    <div id="section-about-direction" class="ps-section">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
            <div style="width:4px;height:36px;background:linear-gradient(180deg,#4caf7d,#d4a030);border-radius:2px;"></div>
            <div>
                <h3 style="font-family:'Space Grotesk',sans-serif;font-size:0.95rem;font-weight:700;color:#f5f5f0;margin:0;">Section Direction</h3>
                <p style="color:#555;font-size:0.78rem;margin:0;">Profils du CEO et du Chef de Centre</p>
            </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">

            {{-- CEO --}}
            <div style="background:#0d0d0d;border:1px solid #1a1a1a;border-top:3px solid #4caf7d;border-radius:8px;padding:20px;">
                <p style="color:#4caf7d;font-size:0.75rem;font-family:'Space Grotesk',sans-serif;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;margin:0 0 14px;">CEO & Fondateur</p>
                {{-- Photo CEO --}}
                <div style="margin-bottom:14px;">
                    @include('admin.pages._image', [
                        'name'    => 'about[direction][ceo_photo]',
                        'key'     => 'about.direction.ceo_photo',
                        'label'   => 'Photo de profil (remplace le cercle AN)',
                        'width'   => '80px',
                        'height'  => '80px',
                    ])
                </div>
                <div style="display:grid;grid-template-columns:60px 1fr;gap:10px;margin-bottom:10px;">
                    @include('admin.pages._field', ['name' => 'about[direction][ceo_initiales]', 'key' => 'about.direction.ceo_initiales', 'label' => 'Initiales (si pas de photo)', 'default' => 'AN'])
                    @include('admin.pages._field', ['name' => 'about[direction][ceo_nom]', 'key' => 'about.direction.ceo_nom', 'label' => 'Nom complet', 'default' => 'Aras M. NGONGO'])
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:10px;">
                    @include('admin.pages._field', ['name' => 'about[direction][ceo_role]', 'key' => 'about.direction.ceo_role', 'label' => 'Badge / Rôle', 'default' => 'CEO & Fondateur'])
                    @include('admin.pages._field', ['name' => 'about[direction][ceo_sous_titre]', 'key' => 'about.direction.ceo_sous_titre', 'label' => 'Sous-titre', 'default' => 'Visionnaire — Fondateur'])
                </div>
                @include('admin.pages._textarea', ['name' => 'about[direction][ceo_bio]', 'key' => 'about.direction.ceo_bio', 'label' => 'Biographie', 'default' => "Visionnaire et fondateur du Centre d'Art Orion, Aras M. NGONGO a consacré sa vie à la promotion des arts et des talents émergents en RDC. Sa vision : faire d'Orion un pilier de la culture africaine contemporaine.", 'rows' => 4])
            </div>

            {{-- Chef de Centre --}}
            <div style="background:#0d0d0d;border:1px solid #1a1a1a;border-top:3px solid #d4a030;border-radius:8px;padding:20px;">
                <p style="color:#d4a030;font-size:0.75rem;font-family:'Space Grotesk',sans-serif;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;margin:0 0 14px;">Chef de Centre</p>
                {{-- Photo Chef --}}
                <div style="margin-bottom:14px;">
                    @include('admin.pages._image', [
                        'name'    => 'about[direction][chef_photo]',
                        'key'     => 'about.direction.chef_photo',
                        'label'   => 'Photo de profil (remplace le cercle MK)',
                        'width'   => '80px',
                        'height'  => '80px',
                    ])
                </div>
                <div style="display:grid;grid-template-columns:60px 1fr;gap:10px;margin-bottom:10px;">
                    @include('admin.pages._field', ['name' => 'about[direction][chef_initiales]', 'key' => 'about.direction.chef_initiales', 'label' => 'Initiales (si pas de photo)', 'default' => 'MK'])
                    @include('admin.pages._field', ['name' => 'about[direction][chef_nom]', 'key' => 'about.direction.chef_nom', 'label' => 'Nom complet', 'default' => 'Magellan KAHOZI'])
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:10px;">
                    @include('admin.pages._field', ['name' => 'about[direction][chef_role]', 'key' => 'about.direction.chef_role', 'label' => 'Badge / Rôle', 'default' => 'Chef de Centre'])
                    @include('admin.pages._field', ['name' => 'about[direction][chef_sous_titre]', 'key' => 'about.direction.chef_sous_titre', 'label' => 'Sous-titre', 'default' => 'Direction opérationnelle'])
                </div>
                @include('admin.pages._textarea', ['name' => 'about[direction][chef_bio]', 'key' => 'about.direction.chef_bio', 'label' => 'Biographie', 'default' => "Magellan KAHOZI dirige les opérations quotidiennes du Centre d'Art Orion avec passion et rigueur. Fort d'une expérience solide dans la gestion culturelle, il veille à l'excellence de chaque programme.", 'rows' => 4])
            </div>

        </div>
    </div>

    <div style="height:1px;background:#161616;margin:32px 0;"></div>

    {{-- ═══════════════════════════════ CTA FINAL ═════════════════════════════ --}}
    <div id="section-about-cta" class="ps-section">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
            <div style="width:4px;height:36px;background:linear-gradient(180deg,#e07030,#c05020);border-radius:2px;"></div>
            <div>
                <h3 style="font-family:'Space Grotesk',sans-serif;font-size:0.95rem;font-weight:700;color:#f5f5f0;margin:0;">CTA Final</h3>
                <p style="color:#555;font-size:0.78rem;margin:0;">Dernier bloc d'appel à l'action en bas de page</p>
            </div>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:12px;">
            @include('admin.pages._field', ['name' => 'about[cta][titre_1]', 'key' => 'about.cta.titre_1', 'label' => "Titre (avant le dégradé)", 'default' => "Rejoignez l'aventure"])
            @include('admin.pages._field', ['name' => 'about[cta][titre_gradient]', 'key' => 'about.cta.titre_gradient', 'label' => 'Mot en dégradé (vert/or)', 'default' => 'Orion'])
        </div>
        @include('admin.pages._textarea', ['name' => 'about[cta][desc]', 'key' => 'about.cta.desc', 'label' => 'Description', 'default' => "Découvrez nos formations, participez à nos événements ou rejoignez notre équipe de passionnés.", 'rows' => 2])
    </div>

    {{-- Barre de sauvegarde sticky --}}
    <div style="position:sticky;bottom:0;left:0;right:0;background:#0d0d0d;border-top:1px solid #1a1a1a;padding:16px 0;margin-top:32px;display:flex;align-items:center;justify-content:space-between;z-index:20;">
        <p style="color:#555;font-size:0.78rem;font-family:'Space Grotesk',sans-serif;margin:0;">
            <svg style="vertical-align:middle;margin-right:4px;" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#555" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            Les modifications sont immédiatement visibles sur le site.
        </p>
        <button type="submit"
            style="display:inline-flex;align-items:center;gap:8px;padding:11px 28px;background:linear-gradient(135deg,#4caf7d,#2d7a52);border:none;border-radius:6px;color:#0a0a0a;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;font-weight:700;cursor:pointer;transition:opacity 0.2s;"
            onmouseover="this.style.opacity='0.88'" onmouseout="this.style.opacity='1'">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            Enregistrer toutes les modifications
        </button>
    </div>

</form>

@endsection
