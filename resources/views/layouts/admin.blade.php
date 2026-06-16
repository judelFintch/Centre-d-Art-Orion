<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin — @yield('title', 'Centre d\'Art Orion')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background:#080808;color:#f5f5f0;font-family:'Inter',sans-serif;display:flex;min-height:100vh;">

{{-- Sidebar --}}
<aside style="width:240px;background:#0d0d0d;border-right:1px solid #1a1a1a;display:flex;flex-direction:column;position:fixed;top:0;bottom:0;left:0;z-index:40;overflow-y:auto;flex-shrink:0;">

    {{-- Logo --}}
    <div style="padding:24px 20px;border-bottom:1px solid #1a1a1a;">
        <a href="{{ route('home') }}" target="_blank" style="display:flex;align-items:center;gap:10px;text-decoration:none;">
            <div style="width:34px;height:34px;border-radius:50%;background:linear-gradient(135deg,#4caf7d,#d4a030);display:flex;align-items:center;justify-content:center;font-weight:900;font-size:0.9rem;color:#0a0a0a;font-family:'Space Grotesk',sans-serif;flex-shrink:0;">O</div>
            <div>
                <div style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.78rem;color:#f5f5f0;line-height:1.1;">Admin</div>
                <div style="font-family:'Playfair Display',serif;font-weight:900;font-size:0.9rem;background:linear-gradient(90deg,#4caf7d,#d4a030);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;line-height:1.1;">ORION</div>
            </div>
        </a>
    </div>

    {{-- Navigation --}}
    <nav style="padding:16px 12px;flex:1;">
        @php
        $navItems = [
            ['route' => 'admin.dashboard',          'icon' => '◈', 'label' => 'Tableau de bord',  'color' => '#4caf7d'],
            ['route' => 'admin.analytics.index',    'icon' => '📊', 'label' => 'Analytics',         'color' => '#4a90e2'],
            ['route' => 'admin.hero.index',          'icon' => '▶', 'label' => 'Hero Slides',       'color' => '#4a90e2'],
            ['route' => 'admin.pages.home',          'icon' => '✦', 'label' => 'Contenu Pages',     'color' => '#b07aff'],
            ['route' => 'admin.formations.index',    'icon' => '◉', 'label' => 'Formations',        'color' => '#e07030'],
            ['route' => 'admin.evenements.index',    'icon' => '◎', 'label' => 'Événements',        'color' => '#d4a030'],
            ['route' => 'admin.galerie.index',       'icon' => '◧', 'label' => 'Galerie',           'color' => '#4caf7d'],
            ['route' => 'admin.blog.index',          'icon' => '✎', 'label' => 'Blog',              'color' => '#d4a030'],
            ['route' => 'admin.podcasts.index',      'icon' => '◌', 'label' => 'Podcasts',          'color' => '#4caf7d'],
            ['route' => 'admin.equipe.index',        'icon' => '◈', 'label' => 'Équipe',            'color' => '#d4a030'],
            ['route' => 'admin.equipe-roles.index',  'icon' => '◆', 'label' => 'Rôles équipe',      'color' => '#d4a030'],
            ['route' => 'admin.billets.index',       'icon' => '🎟', 'label' => 'Billetterie',       'color' => '#4caf7d'],
            ['route' => 'admin.paiement.index',      'icon' => '💳', 'label' => 'Config. Paiement',   'color' => '#d4a030'],
            ['route' => 'admin.messages.index',      'icon' => '✉', 'label' => 'Messages',          'color' => '#e07030'],
            ['route' => 'admin.abonnements.index',   'icon' => '◐', 'label' => 'Abonnements',       'color' => '#4caf7d'],
            ['route' => 'admin.mail.index',          'icon' => '✉', 'label' => 'Config. Mail',      'color' => '#4a90e2'],
        ];
        @endphp

        @foreach($navItems as $item)
        @php
            $isActive = request()->routeIs($item['route'])
                || (isset($item['active_pattern']) && request()->routeIs($item['active_pattern']));
            // Contenu Pages : actif pour home ET about
            if ($item['route'] === 'admin.pages.home') {
                $isActive = request()->routeIs('admin.pages.*');
            }
            // Billetterie : actif pour toutes les sous-routes billets
            if ($item['route'] === 'admin.billets.index') {
                $isActive = request()->routeIs('admin.billets.*');
            }
            // Config paiement
            if ($item['route'] === 'admin.paiement.index') {
                $isActive = request()->routeIs('admin.paiement.*');
            }
            if ($item['route'] === 'admin.equipe-roles.index') {
                $isActive = request()->routeIs('admin.equipe-roles.*');
            }
        @endphp
        <a href="{{ route($item['route']) }}"
           style="display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:6px;text-decoration:none;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:500;margin-bottom:2px;transition:all 0.2s;{{ $isActive ? 'background:rgba(76,175,125,0.1);color:'.$item['color'].';border-left:2px solid '.$item['color'].';padding-left:10px;' : 'color:#666;border-left:2px solid transparent;' }}"
           onmouseover="{{ !$isActive ? 'this.style.color=\"'.$item['color'].'\";this.style.background=\"rgba(255,255,255,0.04)\"' : '' }}"
           onmouseout="{{ !$isActive ? 'this.style.color=\"#666\";this.style.background=\"\"' : '' }}">
            <span style="font-size:0.7rem;flex-shrink:0;{{ $isActive ? 'color:'.$item['color'] : 'color:#444' }}">{{ $item['icon'] }}</span>
            {{ $item['label'] }}
        </a>
        @endforeach
    </nav>

    {{-- Bottom --}}
    <div style="padding:16px 12px;border-top:1px solid #1a1a1a;display:flex;flex-direction:column;gap:6px;">
        <a href="{{ route('admin.profile.edit') }}"
           style="display:flex;align-items:center;gap:8px;padding:10px 12px;border-radius:6px;color:{{ request()->routeIs('admin.profile.*') ? '#4caf7d' : '#555' }};font-size:0.8rem;text-decoration:none;font-family:'Space Grotesk',sans-serif;transition:color 0.2s,background 0.2s;{{ request()->routeIs('admin.profile.*') ? 'background:rgba(76,175,125,0.08);' : '' }}"
           onmouseover="this.style.color='#4caf7d';this.style.background='rgba(255,255,255,0.04)'"
           onmouseout="this.style.color='{{ request()->routeIs('admin.profile.*') ? '#4caf7d' : '#555' }}';this.style.background='{{ request()->routeIs('admin.profile.*') ? 'rgba(76,175,125,0.08)' : '' }}'">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21a8 8 0 0 0-16 0"/><circle cx="12" cy="7" r="4"/></svg>
            Mon profil
        </a>
        <a href="{{ route('home') }}" target="_blank"
           style="display:flex;align-items:center;gap:8px;padding:10px 12px;border-radius:6px;color:#555;font-size:0.8rem;text-decoration:none;font-family:'Space Grotesk',sans-serif;transition:color 0.2s;"
           onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#555'">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg>
            Voir le site
        </a>
        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
            @csrf
            <button type="submit"
                    style="width:100%;display:flex;align-items:center;gap:8px;padding:10px 12px;border-radius:6px;color:#e07030;background:transparent;border:0;font-size:0.8rem;text-decoration:none;font-family:'Space Grotesk',sans-serif;cursor:pointer;transition:background 0.2s;"
                    onmouseover="this.style.background='rgba(224,112,48,0.1)'"
                    onmouseout="this.style.background='transparent'">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                Déconnexion
            </button>
        </form>
    </div>
</aside>

{{-- Main --}}
<div style="margin-left:240px;flex:1;display:flex;flex-direction:column;min-height:100vh;">

    {{-- Top bar --}}
    <header style="background:#0d0d0d;border-bottom:1px solid #1a1a1a;padding:0 28px;height:60px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:30;">
        <h1 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.95rem;color:#f5f5f0;margin:0;">@yield('title', 'Tableau de bord')</h1>
        <div style="display:flex;align-items:center;gap:12px;">
            @php
                $adminUser = auth()->user();
                $adminName = $adminUser?->name ?: 'Admin Orion';
                $adminInitial = mb_strtoupper(mb_substr($adminName, 0, 1));
            @endphp
            <a href="{{ route('admin.profile.edit') }}"
               style="display:flex;align-items:center;gap:10px;text-decoration:none;padding:6px 8px;border-radius:6px;transition:background 0.2s;"
               onmouseover="this.style.background='rgba(255,255,255,0.04)'"
               onmouseout="this.style.background='transparent'">
                <div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,#4caf7d,#d4a030);display:flex;align-items:center;justify-content:center;font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.78rem;color:#0a0a0a;">{{ $adminInitial }}</div>
                <span style="color:#888;font-size:0.82rem;font-family:'Space Grotesk',sans-serif;">{{ $adminName }}</span>
            </a>
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit"
                        title="Déconnexion"
                        style="width:34px;height:34px;border-radius:6px;background:#111;border:1px solid #222;color:#e07030;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all 0.2s;"
                        onmouseover="this.style.borderColor='#e07030';this.style.background='rgba(224,112,48,0.1)'"
                        onmouseout="this.style.borderColor='#222';this.style.background='#111'">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                </button>
            </form>
        </div>
    </header>

    {{-- Content --}}
    <main style="padding:32px 28px;flex:1;">
        @if(session('success'))
        <div style="background:rgba(76,175,125,0.1);border:1px solid rgba(76,175,125,0.3);border-radius:6px;padding:14px 18px;margin-bottom:24px;color:#4caf7d;font-size:0.88rem;font-family:'Space Grotesk',sans-serif;display:flex;align-items:center;gap:8px;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div style="background:rgba(224,112,48,0.1);border:1px solid rgba(224,112,48,0.3);border-radius:6px;padding:14px 18px;margin-bottom:24px;color:#e07030;font-size:0.88rem;font-family:'Space Grotesk',sans-serif;">
            {{ session('error') }}
        </div>
        @endif
        @yield('content')
    </main>
</div>

{{-- SortableJS — drag-and-drop réordonnancement --}}
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>
@stack('scripts')
</body>
</html>
