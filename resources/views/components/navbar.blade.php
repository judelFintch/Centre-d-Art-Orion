@php
$links = [
    ['url' => route('home'),        'label' => 'Accueil'],
    ['url' => route('about'),       'label' => 'À Propos'],
    ['url' => route('services'),    'label' => 'Services'],
    ['url' => route('formations.index'), 'label' => 'Formations'],
    ['url' => route('galerie.index'),    'label' => 'Galerie'],
    ['url' => route('evenements.index'), 'label' => 'Événements'],
    ['url' => route('equipe'),      'label' => 'Équipe'],
    ['url' => route('contact.index'), 'label' => 'Contact'],
];
@endphp

<header id="main-header"
        style="position:fixed;top:0;left:0;right:0;z-index:50;transition:background 0.3s,box-shadow 0.3s;background:rgba(10,10,10,0.85);backdrop-filter:blur(16px);border-bottom:1px solid rgba(255,255,255,0.06);">

    <div style="max-width:1280px;margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:space-between;height:72px;">

        {{-- Logo --}}
        <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:12px;text-decoration:none;">
            <div style="width:42px;height:42px;border-radius:50%;background:linear-gradient(135deg,#4caf7d,#d4a030);display:flex;align-items:center;justify-content:center;font-weight:900;font-size:1.1rem;color:#0a0a0a;font-family:'Space Grotesk',sans-serif;flex-shrink:0;">O</div>
            <div>
                <div style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1rem;color:#f5f5f0;letter-spacing:0.02em;line-height:1.1;">Centre d'Art</div>
                <div style="font-family:'Playfair Display',Georgia,serif;font-weight:900;font-size:1.1rem;background:linear-gradient(90deg,#4caf7d,#d4a030);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;line-height:1.1;">ORION</div>
            </div>
        </a>

        {{-- Desktop nav --}}
        <nav style="display:none;" class="lg:block lg:flex lg:items-center lg:gap-1">
            @foreach($links as $link)
                <a href="{{ $link['url'] }}"
                   class="nav-link"
                   style="padding:8px 14px;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;font-weight:500;letter-spacing:0.04em;text-transform:uppercase;color:rgba(245,245,240,0.75);text-decoration:none;border-radius:4px;transition:color 0.2s;">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </nav>

        {{-- CTA + Burger --}}
        <div style="display:flex;align-items:center;gap:12px;">
            <a href="{{ route('contact.index') }}"
               style="display:none;padding:9px 20px;background:linear-gradient(135deg,#4caf7d,#2d7a52);color:#fff;font-family:'Space Grotesk',sans-serif;font-size:0.8rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;border-radius:4px;text-decoration:none;transition:all 0.3s;"
               class="lg:inline-flex">
                Nous contacter
            </a>

            {{-- Burger --}}
            <button id="burger-btn"
                    aria-label="Ouvrir le menu"
                    style="display:flex;flex-direction:column;justify-content:center;align-items:center;gap:5px;width:40px;height:40px;background:transparent;border:1px solid rgba(255,255,255,0.12);border-radius:4px;cursor:pointer;padding:8px;"
                    class="lg:hidden">
                <span style="display:block;width:20px;height:1.5px;background:#f5f5f0;transition:all 0.3s;"></span>
                <span style="display:block;width:14px;height:1.5px;background:#4caf7d;transition:all 0.3s;margin-left:auto;"></span>
                <span style="display:block;width:20px;height:1.5px;background:#f5f5f0;transition:all 0.3s;"></span>
            </button>
        </div>

    </div>
</header>

{{-- Spacer for fixed header --}}
<div style="height:72px;"></div>

<style>
@media(min-width:1024px){
    #main-header nav { display:flex !important; }
    #main-header .lg\\:block { display:block !important; }
    #main-header .lg\\:inline-flex { display:inline-flex !important; }
    #burger-btn { display:none !important; }
}
#main-header.scrolled {
    background: rgba(10,10,10,0.97) !important;
    box-shadow: 0 4px 30px rgba(0,0,0,0.5);
}
.nav-link:hover { color: #f5f5f0 !important; }
.nav-link.active { color: #4caf7d !important; }
</style>
