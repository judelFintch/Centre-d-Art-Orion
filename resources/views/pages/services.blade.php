@extends('layouts.app')

@section('title', __('pages.services.title'))
@section('meta_description', __('pages.services.meta_description'))

@section('content')

{{-- Hero --}}
<section style="padding:100px 0 80px;background:#0a0a0a;border-bottom:1px solid #1a1a1a;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 80% 50%,rgba(212,160,48,0.07),transparent 60%);pointer-events:none;"></div>
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:1;">
        <div class="tag tag-gold" style="margin-bottom:16px;">{{ __('pages.services.hero_tag') }}</div>
        <h1 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2.5rem,5vw,4rem);font-weight:900;color:#f5f5f0;line-height:1.1;margin:0 0 20px;">
            {{ __('pages.services.hero_title_1') }}<br>
            <span style="background:linear-gradient(135deg,#d4a030,#e07030);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">{{ __('pages.services.hero_title_2') }}</span>
        </h1>
        <p style="color:#777;font-size:1rem;max-width:560px;line-height:1.8;">{{ __('pages.services.hero_desc') }}</p>
    </div>
</section>

{{-- Services détaillés --}}
@php
$serviceMeta = [
    ['icon' => '🎬', 'numero' => '01', 'couleur' => '#4caf7d'],
    ['icon' => '✨', 'numero' => '02', 'couleur' => '#d4a030'],
    ['icon' => '🎓', 'numero' => '03', 'couleur' => '#e07030'],
    ['icon' => '🤝', 'numero' => '04', 'couleur' => '#4caf7d'],
    ['icon' => '🎪', 'numero' => '05', 'couleur' => '#d4a030'],
    ['icon' => '🏛', 'numero' => '06', 'couleur' => '#e07030'],
];
$services = collect(__('pages.services.items'))
    ->values()
    ->map(fn ($item, $i) => array_merge($serviceMeta[$i], $item))
    ->all();
@endphp

{{-- Bento grid --}}
<section style="padding:80px 0 100px;background:#0a0a0a;">
    <div style="max-width:1400px;margin:0 auto;padding:0 32px;">

        {{-- Header --}}
        <div class="reveal" style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:52px;gap:24px;flex-wrap:wrap;">
            <div>
                <div class="tag tag-gold" style="margin-bottom:16px;">{{ __('pages.services.section_tag') }}</div>
                <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,3rem);font-weight:900;color:#f5f5f0;margin:0;line-height:1.1;" class="accent-line">
                    {!! __('pages.services.section_title') !!}
                </h2>
            </div>
            <p style="color:#555;font-size:0.88rem;max-width:340px;line-height:1.8;margin:0;">
                {{ __('pages.services.section_desc') }}
            </p>
        </div>

        {{-- Grille bento --}}
        @php
        $sPhotos = ['11.jpg','22.jpg','5.jpg','7.jpg','3.jpg','9.jpg'];
        $gridPos = [
            'grid-column:1/3;grid-row:1',
            'grid-column:3;grid-row:1',
            'grid-column:4;grid-row:1',
            'grid-column:1;grid-row:2',
            'grid-column:2/4;grid-row:2',
            'grid-column:4;grid-row:2',
        ];
        @endphp

        <div style="display:grid;grid-template-columns:repeat(4,1fr);grid-template-rows:380px 300px;gap:14px;">

            @foreach($services as $i => $s)
            @php $isLarge = in_array($i, [0, 4]); @endphp

            <div class="bento-cell reveal"
                 style="{{ $gridPos[$i] }};position:relative;overflow:hidden;border-radius:10px;cursor:pointer;"
                 onmouseover="this.querySelector('.bento-bar').style.transform='scaleX(1)';this.querySelector('.bento-img').style.transform='scale(1.06)'"
                 onmouseout="this.querySelector('.bento-bar').style.transform='scaleX(0)';this.querySelector('.bento-img').style.transform='scale(1)'">

                {{-- Photo --}}
                <img class="bento-img"
                     src="{{ asset('images/' . $sPhotos[$i]) }}"
                     alt="{{ $s['titre'] }}"
                     style="width:100%;height:100%;object-fit:cover;display:block;transition:transform 0.7s ease;">

                {{-- Gradient overlay --}}
                <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.92) 0%,rgba(0,0,0,0.35) 50%,rgba(0,0,0,0.1) 100%);"></div>

                {{-- Barre colorée (hover) --}}
                <div class="bento-bar" style="position:absolute;top:0;left:0;right:0;height:3px;background:{{ $s['couleur'] }};transform:scaleX(0);transform-origin:left;transition:transform 0.4s ease;"></div>

                {{-- Icône --}}
                <div style="position:absolute;top:18px;left:20px;font-size:{{ $isLarge ? '1.8rem' : '1.3rem' }};opacity:0.85;">{{ $s['icon'] }}</div>

                {{-- Numéro filigrane --}}
                <div style="position:absolute;top:10px;right:16px;font-family:'Playfair Display',Georgia,serif;font-size:{{ $isLarge ? '6rem' : '4rem' }};font-weight:900;color:rgba(255,255,255,0.06);line-height:1;user-select:none;">{{ $s['numero'] }}</div>

                {{-- Contenu bas --}}
                <div style="position:absolute;bottom:0;left:0;right:0;padding:{{ $isLarge ? '28px' : '18px 20px' }};">
                    <span style="font-family:'Space Grotesk',sans-serif;font-size:0.65rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:{{ $s['couleur'] }};display:block;margin-bottom:6px;">{{ $s['numero'] }}</span>
                    <h3 style="font-family:'Playfair Display',Georgia,serif;font-weight:700;font-size:{{ $isLarge ? '1.45rem' : '0.95rem' }};color:#f5f5f0;margin:0 0 {{ $isLarge ? '10px' : '0' }};line-height:1.25;">{{ $s['titre'] }}</h3>
                    @if($isLarge)
                    <p style="color:rgba(245,245,240,0.62);font-size:0.82rem;line-height:1.7;margin:0 0 16px;">{{ Str::limit($s['description'], 110) }}</p>
                    <a href="{{ route('contact.index') }}"
                       style="display:inline-flex;align-items:center;gap:6px;color:{{ $s['couleur'] }};font-size:0.75rem;font-weight:700;text-decoration:none;font-family:'Space Grotesk',sans-serif;letter-spacing:0.08em;text-transform:uppercase;">
                        {{ __('pages.services.learn_more') }}
                    </a>
                    @endif
                </div>

            </div>
            @endforeach

        </div>

    </div>
</section>

{{-- CTA --}}
<section style="padding:100px 0;background:#0a0a0a;border-top:1px solid #161616;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at center,rgba(76,175,125,0.06),transparent 70%);pointer-events:none;"></div>
    <div style="max-width:700px;margin:0 auto;padding:0 24px;text-align:center;position:relative;z-index:1;" class="reveal">
        <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,3rem);font-weight:900;color:#f5f5f0;margin:0 0 20px;">
            {{ __('pages.services.cta_title_1') }}<br>
            <span style="background:linear-gradient(135deg,#4caf7d,#d4a030);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">{{ __('pages.services.cta_title_2') }}</span>
        </h2>
        <p style="color:#777;font-size:0.95rem;line-height:1.8;margin:0 0 36px;">{{ __('pages.services.cta_desc') }}</p>
        <div style="display:flex;flex-wrap:wrap;gap:14px;justify-content:center;">
            <a href="{{ route('contact.index') }}" class="btn-gold">{{ __('pages.services.cta_contact') }}</a>
            <a href="{{ route('formations.index') }}" class="btn-outline">{{ __('pages.about.cta_view_formations') }}</a>
        </div>
    </div>
</section>

<style>
@media(max-width:900px) {
    .bento-cell[style*="grid-column:1/3"] { grid-column: 1 / -1 !important; }
    .bento-cell[style*="grid-column:2/4"] { grid-column: 1 / -1 !important; }
    section > div > div[style*="grid-template-columns:repeat(4"] {
        grid-template-columns: repeat(2, 1fr) !important;
        grid-template-rows: unset !important;
    }
    .bento-cell { grid-column: unset !important; grid-row: unset !important; height: 260px; }
}
@media(max-width:520px) {
    section > div > div[style*="grid-template-columns:repeat(4"] {
        grid-template-columns: 1fr !important;
    }
    .bento-cell { height: 240px; }
}
</style>

@endsection
