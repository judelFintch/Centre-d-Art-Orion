@extends('layouts.app')

@section('title', __('pages.team.title'))
@section('meta_description', __('pages.team.meta_description'))

@section('content')

{{-- Hero --}}
<section style="padding:100px 0 80px;background:#0a0a0a;border-bottom:1px solid #1a1a1a;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 60% 40%,rgba(212,160,48,0.06),transparent 60%);pointer-events:none;"></div>
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:1;">
        <div class="tag tag-gold" style="margin-bottom:16px;">{{ __('pages.team.hero_tag') }}</div>
        <h1 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2.5rem,5vw,4rem);font-weight:900;color:#f5f5f0;line-height:1.1;margin:0 0 20px;">
            {{ __('pages.team.hero_title_1') }}<br>
            <span style="background:linear-gradient(135deg,#d4a030,#e07030);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">{{ __('pages.team.hero_title_2') }}</span>
        </h1>
        <p style="color:#777;font-size:1rem;max-width:520px;line-height:1.8;">{{ __('pages.team.hero_desc') }}</p>
    </div>
</section>

@foreach($sections as $section)
@php
    $label = $section['label'];
    $sectionColor = $section['color'];
    $group = $section['membres'];
@endphp
<section style="padding:80px 0;background:{{ $loop->index % 2 === 0 ? '#0d0d0d' : '#0a0a0a' }};border-top:1px solid #161616;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">

        <div class="reveal" style="margin-bottom:48px;">
            <div class="tag" style="margin-bottom:16px;background:{{ $sectionColor }}22;color:{{ $sectionColor }};">{{ $label }}</div>
            <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(1.8rem,3.5vw,2.5rem);font-weight:900;color:#f5f5f0;line-height:1.15;margin:0;" class="accent-line">
                {{ $label }}
            </h2>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:28px;">
            @foreach($group as $membre)
            @php
                $color = $membre->role_color;
                $initials = strtoupper(substr($membre->prenom, 0, 1) . substr($membre->nom, 0, 1));
                $photoUrl = $membre->photo_url;
            @endphp
            <div class="reveal hover-lift"
                 style="background:#111;border:1px solid #1a1a1a;border-radius:12px;padding:36px;text-align:center;transition:all 0.3s;position:relative;overflow:hidden;"
                 onmouseover="this.style.borderColor='{{ $color }}44'" onmouseout="this.style.borderColor='#1a1a1a'">

                <div style="position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,{{ $color }},transparent);"></div>

                {{-- Avatar --}}
                @if($photoUrl)
                <img src="{{ $photoUrl }}"
                     alt="{{ $membre->nom_complet }}"
                     style="width:88px;height:88px;border-radius:50%;object-fit:cover;margin:0 auto 20px;display:block;border:3px solid {{ $color }}44;box-shadow:0 8px 30px rgba(0,0,0,0.4);">
                @else
                <div aria-label="{{ $membre->nom_complet }}"
                     style="width:88px;height:88px;border-radius:50%;margin:0 auto 20px;display:flex;align-items:center;justify-content:center;border:3px solid {{ $color }}44;background:rgba(255,255,255,0.04);box-shadow:0 8px 30px {{ $color }}22;color:{{ $color }};font-family:'Space Grotesk',sans-serif;font-weight:800;font-size:1rem;">
                    {{ $initials }}
                </div>
                @endif

                <span class="tag" style="margin-bottom:12px;display:inline-block;background:{{ $color }}22;color:{{ $color }};">{{ $membre->poste }}</span>
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

                <a href="{{ route('equipe.show', $membre) }}"
                   style="display:inline-flex;align-items:center;justify-content:center;margin-top:22px;padding:9px 18px;border:1px solid {{ $color }}55;border-radius:6px;color:{{ $color }};font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:700;text-decoration:none;letter-spacing:0.04em;text-transform:uppercase;transition:all 0.2s;"
                   onmouseover="this.style.background='{{ $color }}18';this.style.borderColor='{{ $color }}'"
                   onmouseout="this.style.background='transparent';this.style.borderColor='{{ $color }}55'">
                    {{ __('pages.team.details') }}
                </a>

            </div>
            @endforeach
        </div>

    </div>
</section>
@endforeach

{{-- Rejoindre l'équipe --}}
<section style="padding:100px 0;background:#0a0a0a;border-top:1px solid #161616;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at center,rgba(76,175,125,0.06),transparent 70%);pointer-events:none;"></div>
    <div style="max-width:700px;margin:0 auto;padding:0 24px;text-align:center;position:relative;z-index:1;" class="reveal">
        <div class="tag tag-green" style="margin-bottom:20px;">{{ __('pages.team.join_tag') }}</div>
        <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,3rem);font-weight:900;color:#f5f5f0;margin:0 0 20px;">
            {{ __('pages.team.join_title_1') }}<br>
            <span style="background:linear-gradient(135deg,#4caf7d,#d4a030);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">{{ __('pages.team.join_title_2') }}</span>
        </h2>
        <p style="color:#777;font-size:0.95rem;line-height:1.8;margin:0 0 36px;">{{ __('pages.team.join_desc') }}</p>
        <a href="{{ route('contact.index') }}?sujet=Candidature+équipe+Orion" class="btn-gold">{{ __('pages.team.apply') }}</a>
    </div>
</section>

@endsection
