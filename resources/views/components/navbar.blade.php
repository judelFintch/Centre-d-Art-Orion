@php
$links = [
    ['url' => route('home'),             'label' => 'Accueil'],
    ['url' => route('about'),            'label' => 'À Propos'],
    ['url' => route('services'),         'label' => 'Services'],
    ['url' => route('formations.index'), 'label' => 'Formations'],
    ['url' => route('galerie.index'),    'label' => 'Galerie'],
    ['url' => route('evenements.index'), 'label' => 'Événements'],
    ['url' => route('equipe'),           'label' => 'Équipe'],
];
@endphp

<header id="main-header"
        style="position:fixed;top:0;left:0;right:0;z-index:50;transition:background 0.3s,box-shadow 0.3s;">

    <div class="header-inner" style="max-width:1280px;margin:0 auto;padding:0 24px 0 0;display:flex;align-items:center;justify-content:space-between;height:76px;">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="orion-brand" style="display:flex;align-items:center;gap:12px;text-decoration:none;">
            <span class="brand-art-mark" aria-hidden="true"></span>
            <img src="{{ asset('images/logo.png') }}" alt="Centre d'Art Orion" style="height:34px;width:auto;object-fit:contain;display:block;">
            <span class="brand-wordmark" aria-hidden="true">
                <strong>Orion</strong>
                <span>Centre d'Art</span>
            </span>
        </a>

        {{-- Desktop nav --}}
        <nav style="display:none;" class="lg:block lg:flex lg:items-center lg:gap-1">
            @foreach($links as $link)
                <a href="{{ $link['url'] }}"
                   class="nav-link"
                   style="padding:8px 12px;font-family:'Space Grotesk',sans-serif;font-size:0.8rem;font-weight:500;letter-spacing:0.06em;text-transform:uppercase;color:rgba(28,21,16,0.65);text-decoration:none;border-radius:4px;transition:color 0.2s;">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </nav>

        {{-- CTA + Burger --}}
        <div style="display:flex;align-items:center;gap:12px;">
            <a href="{{ route('contact.index') }}"
               style="display:none;padding:9px 20px;background:linear-gradient(135deg,#4caf7d,#2d7a52);color:#fff;font-family:'Space Grotesk',sans-serif;font-size:0.8rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;border-radius:4px;text-decoration:none;transition:all 0.3s;box-shadow:0 4px 14px rgba(76,175,125,0.20);"
               class="header-cta lg:inline-flex"
               onmouseover="this.style.boxShadow='0 6px 20px rgba(76,175,125,0.35)'"
               onmouseout="this.style.boxShadow='0 4px 14px rgba(76,175,125,0.20)'">
                Nous contacter
            </a>

            {{-- Burger --}}
            <button id="burger-btn"
                    aria-label="Ouvrir le menu"
                    aria-expanded="false"
                    style="display:flex;flex-direction:column;justify-content:center;align-items:center;gap:5px;width:40px;height:40px;background:transparent;border:1px solid rgba(28,21,16,0.15);border-radius:4px;cursor:pointer;padding:8px;"
                    class="lg:hidden">
                <span style="display:block;width:20px;height:1.5px;background:#1c1510;transition:all 0.3s;"></span>
                <span style="display:block;width:14px;height:1.5px;background:#4caf7d;transition:all 0.3s;margin-left:auto;"></span>
                <span style="display:block;width:20px;height:1.5px;background:#1c1510;transition:all 0.3s;"></span>
            </button>
        </div>

    </div>
</header>

{{-- Spacer --}}
<div style="height:76px;"></div>

<style>
@media(min-width:1024px){
    #main-header nav          { display:flex !important; }
    #main-header .lg\:block   { display:block !important; }
    #main-header .lg\:inline-flex { display:inline-flex !important; }
    #burger-btn               { display:none !important; }
}
.nav-link:hover { color: #1c1510 !important; }
.nav-link.active { color: #4caf7d !important; }
</style>
