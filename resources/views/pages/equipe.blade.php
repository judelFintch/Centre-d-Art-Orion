@extends('layouts.app')

@section('title', 'Notre Équipe — Centre d\'Art Orion')
@section('meta_description', 'Découvrez l\'équipe du Centre d\'Art Orion : direction, formateurs et artistes associés qui donnent vie à notre vision artistique.')

@section('content')

{{-- Hero --}}
<section style="padding:100px 0 80px;background:#0a0a0a;border-bottom:1px solid #1a1a1a;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 60% 40%,rgba(212,160,48,0.06),transparent 60%);pointer-events:none;"></div>
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:1;">
        <div class="tag tag-gold" style="margin-bottom:16px;">Les visages d'Orion</div>
        <h1 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2.5rem,5vw,4rem);font-weight:900;color:#f5f5f0;line-height:1.1;margin:0 0 20px;">
            Notre<br>
            <span style="background:linear-gradient(135deg,#d4a030,#e07030);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Équipe</span>
        </h1>
        <p style="color:#777;font-size:1rem;max-width:520px;line-height:1.8;">Une équipe de passionnés au service de l'excellence artistique et du développement des talents.</p>
    </div>
</section>

@php
$roleOrder  = ['ceo' => 0, 'chef_centre' => 1, 'formateur' => 2, 'artiste' => 3];
$roleLabels = ['ceo' => 'Direction', 'chef_centre' => 'Direction', 'formateur' => 'Formateurs', 'artiste' => 'Artistes Associés'];
$roleBadge  = ['ceo' => 'tag-gold', 'chef_centre' => 'tag-gold', 'formateur' => 'tag-green', 'artiste' => 'tag-orange'];
$roleColor  = ['ceo' => '#d4a030', 'chef_centre' => '#d4a030', 'formateur' => '#4caf7d', 'artiste' => '#e07030'];

$sections = [
    'Direction'          => collect(),
    'Formateurs'         => collect(),
    'Artistes Associés'  => collect(),
    'Autres membres'     => collect(),
];

foreach($membres as $role => $group) {
    $label = $roleLabels[$role] ?? 'Autres membres';
    $sections[$label] = $sections[$label]->merge($group);
}
@endphp

@foreach($sections as $label => $group)
@if($group->isNotEmpty())
<section style="padding:80px 0;background:{{ $loop->index % 2 === 0 ? '#0d0d0d' : '#0a0a0a' }};border-top:1px solid #161616;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">

        <div class="reveal" style="margin-bottom:48px;">
            <div class="tag tag-{{ $label === 'Direction' ? 'gold' : ($label === 'Formateurs' ? 'green' : 'orange') }}" style="margin-bottom:16px;">{{ $label }}</div>
            <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(1.8rem,3.5vw,2.5rem);font-weight:900;color:#f5f5f0;line-height:1.15;margin:0;" class="accent-line">
                {{ $label }}
            </h2>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:28px;">
            @foreach($group as $membre)
            @php
                $color = $roleColor[$membre->role] ?? '#4caf7d';
                $badge = $roleBadge[$membre->role] ?? 'tag-green';
                $initials = strtoupper(substr($membre->prenom, 0, 1) . substr($membre->nom, 0, 1));
            @endphp
            <div class="reveal hover-lift"
                 style="background:#111;border:1px solid #1a1a1a;border-radius:12px;padding:36px;text-align:center;transition:all 0.3s;position:relative;overflow:hidden;"
                 onmouseover="this.style.borderColor='{{ $color }}44'" onmouseout="this.style.borderColor='#1a1a1a'">

                <div style="position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,{{ $color }},transparent);"></div>

                {{-- Avatar --}}
                @if($membre->photo && file_exists(public_path('storage/'.$membre->photo)))
                <img src="{{ asset('storage/'.$membre->photo) }}"
                     alt="{{ $membre->nom_complet }}"
                     style="width:88px;height:88px;border-radius:50%;object-fit:cover;margin:0 auto 20px;display:block;border:3px solid {{ $color }}44;box-shadow:0 8px 30px rgba(0,0,0,0.4);">
                @else
                @php $mPhotos = ['4.jpg','9.jpg','5.jpg','7.jpg','3.jpg','6.jpg','2.jpg','1.png']; @endphp
                <img src="{{ asset('images/' . $mPhotos[$loop->index % count($mPhotos)]) }}"
                     alt="{{ $membre->nom_complet }}"
                     style="width:88px;height:88px;border-radius:50%;object-fit:cover;margin:0 auto 20px;display:block;border:3px solid {{ $color }}44;box-shadow:0 8px 30px {{ $color }}44;">
                @endif

                <span class="tag {{ $badge }}" style="margin-bottom:12px;display:inline-block;">{{ $membre->poste }}</span>
                <h3 style="font-family:'Playfair Display',Georgia,serif;font-weight:700;font-size:1.2rem;color:#f5f5f0;margin:0 0 4px;">{{ $membre->prenom }} {{ $membre->nom }}</h3>

                @if($membre->bio)
                <p style="color:#666;font-size:0.84rem;line-height:1.7;margin:16px 0 0;">{{ Str::limit($membre->bio, 130) }}</p>
                @endif

                @if($membre->reseaux_sociaux)
                <div style="display:flex;justify-content:center;gap:8px;margin-top:20px;padding-top:20px;border-top:1px solid #1a1a1a;">
                    @foreach($membre->reseaux_sociaux as $rs => $url)
                    <a href="{{ $url }}" target="_blank"
                       style="width:32px;height:32px;background:rgba(255,255,255,0.05);border:1px solid #222;border-radius:4px;display:flex;align-items:center;justify-content:center;color:#777;font-size:0.65rem;font-weight:700;text-decoration:none;transition:all 0.2s;font-family:'Space Grotesk',sans-serif;text-transform:uppercase;"
                       onmouseover="this.style.borderColor='{{ $color }}';this.style.color='{{ $color }}'"
                       onmouseout="this.style.borderColor='#222';this.style.color='#777'">
                        {{ strtoupper(substr($rs, 0, 2)) }}
                    </a>
                    @endforeach
                </div>
                @endif

            </div>
            @endforeach
        </div>

    </div>
</section>
@endif
@endforeach

{{-- Rejoindre l'équipe --}}
<section style="padding:100px 0;background:#0a0a0a;border-top:1px solid #161616;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at center,rgba(76,175,125,0.06),transparent 70%);pointer-events:none;"></div>
    <div style="max-width:700px;margin:0 auto;padding:0 24px;text-align:center;position:relative;z-index:1;" class="reveal">
        <div class="tag tag-green" style="margin-bottom:20px;">Rejoignez-nous</div>
        <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,3rem);font-weight:900;color:#f5f5f0;margin:0 0 20px;">
            Vous êtes artiste ou formateur ?<br>
            <span style="background:linear-gradient(135deg,#4caf7d,#d4a030);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Rejoignez Orion.</span>
        </h2>
        <p style="color:#777;font-size:0.95rem;line-height:1.8;margin:0 0 36px;">Nous recherchons des talents passionnés pour renforcer notre équipe de formateurs et artistes associés.</p>
        <a href="{{ route('contact.index') }}?sujet=Candidature+équipe+Orion" class="btn-gold">Candidater</a>
    </div>
</section>

@endsection
