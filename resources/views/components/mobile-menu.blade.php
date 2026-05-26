@php
$links = [
    ['url' => route('home'),             'label' => 'Accueil',    'icon' => '🏠'],
    ['url' => route('about'),            'label' => 'À Propos',   'icon' => '✦'],
    ['url' => route('services'),         'label' => 'Services',   'icon' => '◈'],
    ['url' => route('formations.index'), 'label' => 'Formations', 'icon' => '◉'],
    ['url' => route('galerie.index'),    'label' => 'Galerie',    'icon' => '◧'],
    ['url' => route('evenements.index'), 'label' => 'Événements', 'icon' => '◎'],
    ['url' => route('podcasts.index'),   'label' => 'Podcasts',   'icon' => '◌'],
    ['url' => route('blog.index'),       'label' => 'Blog',       'icon' => '✎'],
    ['url' => route('equipe'),           'label' => 'Équipe',     'icon' => '◈'],
    ['url' => route('contact.index'),    'label' => 'Contact',    'icon' => '◉'],
];
@endphp

<aside id="mobile-menu"
       class="-translate-x-full"
       style="position:fixed;top:0;left:0;bottom:0;width:300px;background:#faf8f4;z-index:50;transition:transform 0.35s cubic-bezier(0.4,0,0.2,1);overflow-y:auto;border-right:1px solid #e0d8cc;box-shadow:4px 0 40px rgba(30,20,10,0.10);">

    {{-- Header --}}
    <div style="padding:20px 24px;border-bottom:1px solid #e0d8cc;display:flex;align-items:center;justify-content:space-between;">
        <div>
            <img src="{{ asset('images/logo.png') }}" alt="Centre d'Art Orion" style="height:32px;width:auto;object-fit:contain;display:block;">
        </div>
        <button id="mobile-close" type="button" aria-label="Fermer le menu"
                style="width:32px;height:32px;background:rgba(30,20,10,0.06);border:1px solid #e0d8cc;border-radius:4px;color:#1c1510;cursor:pointer;font-size:1.1rem;display:flex;align-items:center;justify-content:center;">✕</button>
    </div>

    {{-- Links --}}
    <nav style="padding:16px 0;">
        @foreach($links as $link)
        <a href="{{ $link['url'] }}"
           class="mobile-nav-link nav-link"
           style="display:flex;align-items:center;gap:14px;padding:14px 24px;color:rgba(28,21,16,0.65);text-decoration:none;font-family:'Space Grotesk',sans-serif;font-size:0.9rem;font-weight:500;letter-spacing:0.04em;text-transform:uppercase;border-left:2px solid transparent;transition:all 0.2s;">
            <span style="font-size:0.75rem;opacity:0.5;">{{ $link['icon'] }}</span>
            {{ $link['label'] }}
        </a>
        @endforeach
    </nav>

    {{-- Bottom CTA --}}
    <div style="padding:20px 24px;border-top:1px solid #e0d8cc;margin-top:auto;">
        @auth
        <a href="{{ route('admin.dashboard') }}"
           class="mobile-nav-link"
           style="display:flex;align-items:center;justify-content:center;width:100%;margin-bottom:12px;padding:12px 16px;border:1px solid rgba(76,175,125,0.35);border-radius:4px;color:#2d7a52;text-decoration:none;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;">
            Admin
        </a>
        @endauth

        <a href="{{ route('contact.index') }}"
           class="mobile-nav-link btn-primary"
           style="width:100%;justify-content:center;">
            Nous contacter
        </a>
        <div style="margin-top:20px;text-align:center;">
            <p style="font-size:0.75rem;color:#a89a8e;font-family:'Space Grotesk',sans-serif;">380, Av. Changalele — Q. Gambela</p>
        </div>
    </div>
</aside>

<style>
.mobile-nav-link:hover {
    color: #2a7a50 !important;
    border-left-color: #4caf7d !important;
    background: rgba(76,175,125,0.07);
}
</style>
