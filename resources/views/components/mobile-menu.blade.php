@php
$links = [
    ['url' => route('home'),             'label' => 'Accueil',    'icon' => '🏠'],
    ['url' => route('about'),            'label' => 'À Propos',   'icon' => '✦'],
    ['url' => route('services'),         'label' => 'Services',   'icon' => '◈'],
    ['url' => route('formations.index'), 'label' => 'Formations', 'icon' => '◉'],
    ['url' => route('galerie.index'),    'label' => 'Galerie',    'icon' => '◧'],
    ['url' => route('evenements.index'), 'label' => 'Événements', 'icon' => '◎'],
    ['url' => route('equipe'),           'label' => 'Équipe',     'icon' => '◈'],
    ['url' => route('contact.index'),    'label' => 'Contact',    'icon' => '◉'],
];
@endphp

<aside id="mobile-menu"
       style="position:fixed;top:0;left:0;bottom:0;width:300px;background:#111;z-index:50;transform:translateX(-100%);transition:transform 0.35s cubic-bezier(0.4,0,0.2,1);overflow-y:auto;border-right:1px solid #222;">

    {{-- Header --}}
    <div style="padding:20px 24px;border-bottom:1px solid #222;display:flex;align-items:center;justify-content:space-between;">
        <div style="display:flex;align-items:center;gap:10px;">
            <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#4caf7d,#d4a030);display:flex;align-items:center;justify-content:center;font-weight:900;font-size:0.95rem;color:#0a0a0a;font-family:'Space Grotesk',sans-serif;">O</div>
            <span style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.95rem;color:#f5f5f0;">Centre d'Art Orion</span>
        </div>
        <button id="mobile-close" onclick="document.getElementById('burger-btn').click()"
                style="width:32px;height:32px;background:rgba(255,255,255,0.06);border:none;border-radius:4px;color:#f5f5f0;cursor:pointer;font-size:1.1rem;display:flex;align-items:center;justify-content:center;">✕</button>
    </div>

    {{-- Links --}}
    <nav style="padding:16px 0;">
        @foreach($links as $link)
        <a href="{{ $link['url'] }}"
           class="mobile-nav-link nav-link"
           style="display:flex;align-items:center;gap:14px;padding:14px 24px;color:rgba(245,245,240,0.75);text-decoration:none;font-family:'Space Grotesk',sans-serif;font-size:0.9rem;font-weight:500;letter-spacing:0.04em;text-transform:uppercase;border-left:2px solid transparent;transition:all 0.2s;">
            <span style="font-size:0.75rem;opacity:0.5;">{{ $link['icon'] }}</span>
            {{ $link['label'] }}
        </a>
        @endforeach
    </nav>

    {{-- Bottom CTA --}}
    <div style="padding:20px 24px;border-top:1px solid #222;margin-top:auto;">
        <a href="{{ route('contact.index') }}"
           class="mobile-nav-link btn-primary"
           style="width:100%;justify-content:center;">
            Nous contacter
        </a>
        <div style="margin-top:20px;text-align:center;">
            <p style="font-size:0.75rem;color:#555;font-family:'Space Grotesk',sans-serif;">380, Av. Changalele — Q. Gambela</p>
        </div>
    </div>
</aside>

<style>
.mobile-nav-link:hover {
    color: #4caf7d !important;
    border-left-color: #4caf7d !important;
    background: rgba(76,175,125,0.06);
}
</style>
