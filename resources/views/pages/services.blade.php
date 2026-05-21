@extends('layouts.app')

@section('title', 'Services & Activités — Centre d\'Art Orion')
@section('meta_description', 'Production artistique, création, formation, accompagnement, événements culturels et ateliers. Découvrez tous les services du Centre d\'Art Orion.')

@section('content')

{{-- Hero --}}
<section style="padding:100px 0 80px;background:#0a0a0a;border-bottom:1px solid #1a1a1a;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 80% 50%,rgba(212,160,48,0.07),transparent 60%);pointer-events:none;"></div>
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:1;">
        <div class="tag tag-gold" style="margin-bottom:16px;">Services & Activités</div>
        <h1 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2.5rem,5vw,4rem);font-weight:900;color:#f5f5f0;line-height:1.1;margin:0 0 20px;">
            Un Écosystème<br>
            <span style="background:linear-gradient(135deg,#d4a030,#e07030);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Artistique Complet</span>
        </h1>
        <p style="color:#777;font-size:1rem;max-width:560px;line-height:1.8;">Six axes d'activité pour accompagner chaque artiste, de la création à la scène.</p>
    </div>
</section>

{{-- Services détaillés --}}
@php
$services = [
    [
        'icon' => '🎬',
        'numero' => '01',
        'titre' => 'Production Artistique',
        'couleur' => '#4caf7d',
        'description' => 'Notre pôle production accompagne la naissance de projets artistiques ambitieux. Des studios d\'enregistrement aux espaces de répétition, nous mettons à disposition des ressources professionnelles pour donner vie à vos créations.',
        'points' => ['Studios d\'enregistrement équipés','Espaces de répétition dédiés','Accompagnement technique et artistique','Distribution et promotion des œuvres'],
    ],
    [
        'icon' => '✨',
        'numero' => '02',
        'titre' => 'Création Artistique',
        'couleur' => '#d4a030',
        'description' => 'Un environnement unique pensé pour libérer votre créativité. Ateliers ouverts, espaces de travail lumineux, matériel de qualité et une communauté d\'artistes inspirants vous entourent quotidiennement.',
        'points' => ['Ateliers de création ouverts','Résidences artistiques','Accompagnement de projets personnels','Collaborations inter-disciplines'],
    ],
    [
        'icon' => '🎓',
        'numero' => '03',
        'titre' => 'Formation Artistique',
        'couleur' => '#e07030',
        'description' => 'Des programmes de formation structurés, progressifs et adaptés à chaque niveau. Arts visuels, musique, danse, théâtre, photographie — nos formations transforment la passion en compétence professionnelle.',
        'points' => ['6 disciplines artistiques','Niveaux débutant à avancé','Formateurs professionnels certifiés','Certificats de formation reconnus'],
    ],
    [
        'icon' => '🤝',
        'numero' => '04',
        'titre' => 'Accompagnement des Artistes',
        'couleur' => '#4caf7d',
        'description' => 'Chaque artiste mérite un suivi personnalisé. Notre équipe de mentors expérimentés vous accompagne dans le développement de votre carrière, la gestion de votre image et la concrétisation de vos projets.',
        'points' => ['Mentorat individualisé','Développement de carrière','Aide à la recherche de financement','Mise en réseau professionnel'],
    ],
    [
        'icon' => '🎪',
        'numero' => '05',
        'titre' => 'Organisation d\'Événements',
        'couleur' => '#d4a030',
        'description' => 'Du concert intime à la grande exposition collective, nous concevons et organisons des événements culturels qui valorisent les talents et créent des moments mémorables pour le public.',
        'points' => ['Concerts et spectacles vivants','Expositions et vernissages','Galas et soirées culturelles','Festivals et événements communautaires'],
    ],
    [
        'icon' => '🏛',
        'numero' => '06',
        'titre' => 'Ateliers & Programmes Culturels',
        'couleur' => '#e07030',
        'description' => 'Des ateliers thématiques réguliers ouverts à tous — initiation, perfectionnement, découverte. Des programmes conçus pour rendre l\'art accessible et vivant dans notre communauté.',
        'points' => ['Ateliers hebdomadaires','Programmes pour enfants et jeunes','Ateliers vacances et stages','Programmes communautaires'],
    ],
];
@endphp

@foreach($services as $i => $s)
<section style="padding:80px 0;background:{{ $i % 2 === 0 ? '#0d0d0d' : '#0a0a0a' }};border-top:1px solid #161616;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:center;{{ $i % 2 !== 0 ? 'direction:rtl;' : '' }}">

            <div class="reveal" style="{{ $i % 2 !== 0 ? 'direction:ltr;' : '' }}">
                <div style="display:flex;align-items:center;gap:16px;margin-bottom:24px;">
                    <span style="font-family:'Space Grotesk',sans-serif;font-size:0.75rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:#333;">{{ $s['numero'] }}</span>
                    <div style="height:1px;width:40px;background:#333;"></div>
                </div>
                <div class="tag" style="background:{{ $s['couleur'] }}1a;color:{{ $s['couleur'] }};margin-bottom:20px;">{{ $s['titre'] }}</div>
                <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(1.8rem,3vw,2.5rem);font-weight:900;color:#f5f5f0;line-height:1.2;margin:0 0 20px;" class="accent-line">
                    {{ $s['titre'] }}
                </h2>
                <p style="color:#888;font-size:0.95rem;line-height:1.8;margin:0 0 32px;">{{ $s['description'] }}</p>
                <div style="display:flex;flex-direction:column;gap:12px;">
                    @foreach($s['points'] as $pt)
                    <div style="display:flex;align-items:center;gap:12px;">
                        <div style="width:28px;height:28px;background:{{ $s['couleur'] }}1a;border:1px solid {{ $s['couleur'] }}33;border-radius:4px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="{{ $s['couleur'] }}" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        <span style="color:rgba(245,245,240,0.7);font-size:0.9rem;">{{ $pt }}</span>
                    </div>
                    @endforeach
                </div>
                <div style="margin-top:36px;">
                    <a href="{{ route('contact.index') }}" class="btn-primary" style="background:linear-gradient(135deg,{{ $s['couleur'] }},{{ $s['couleur'] }}cc);">
                        En savoir plus →
                    </a>
                </div>
            </div>

            <div class="reveal {{ $i % 2 !== 0 ? 'order-first' : '' }}" style="{{ $i % 2 !== 0 ? 'direction:ltr;' : '' }}">
                <div style="background:linear-gradient(135deg,#161616,#111);border:1px solid {{ $s['couleur'] }}22;border-radius:12px;height:320px;display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden;">
                    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at center,{{ $s['couleur'] }}0d,transparent 70%);"></div>
                    <div style="text-align:center;position:relative;z-index:1;">
                        <div style="font-size:5rem;margin-bottom:16px;">{{ $s['icon'] }}</div>
                        <div style="font-family:'Space Grotesk',sans-serif;font-size:0.85rem;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:{{ $s['couleur'] }};">{{ $s['titre'] }}</div>
                    </div>
                    <div style="position:absolute;top:16px;right:16px;font-family:'Playfair Display',Georgia,serif;font-size:4rem;font-weight:900;color:{{ $s['couleur'] }}0d;line-height:1;">{{ $s['numero'] }}</div>
                </div>
            </div>

        </div>
    </div>
</section>
@endforeach

{{-- CTA --}}
<section style="padding:100px 0;background:#0a0a0a;border-top:1px solid #161616;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at center,rgba(76,175,125,0.06),transparent 70%);pointer-events:none;"></div>
    <div style="max-width:700px;margin:0 auto;padding:0 24px;text-align:center;position:relative;z-index:1;" class="reveal">
        <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,3rem);font-weight:900;color:#f5f5f0;margin:0 0 20px;">
            Un projet ? Une idée ?<br>
            <span style="background:linear-gradient(135deg,#4caf7d,#d4a030);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Parlons-en.</span>
        </h2>
        <p style="color:#777;font-size:0.95rem;line-height:1.8;margin:0 0 36px;">Notre équipe est disponible pour vous accompagner dans votre démarche artistique.</p>
        <div style="display:flex;flex-wrap:wrap;gap:14px;justify-content:center;">
            <a href="{{ route('contact.index') }}" class="btn-gold">Prendre contact</a>
            <a href="{{ route('formations.index') }}" class="btn-outline">Voir les formations</a>
        </div>
    </div>
</section>

<style>
@media(max-width:768px) {
    section > div > div[style*="grid-template-columns:1fr 1fr"] {
        grid-template-columns: 1fr !important;
        direction: ltr !important;
    }
}
</style>

@endsection
