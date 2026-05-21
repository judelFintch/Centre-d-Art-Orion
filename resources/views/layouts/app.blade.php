<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO --}}
    <title>@yield('title', 'Centre d\'Art Orion') — Excellence Artistique</title>
    <meta name="description" content="@yield('meta_description', 'Le Centre d\'Art Orion — Production, Création, Formation artistique. Découvrez nos programmes, ateliers et événements culturels.')">
    <meta name="keywords" content="@yield('meta_keywords', 'centre art, formation artistique, production musicale, danse, peinture, théâtre, Orion')">
    <meta name="author" content="Centre d\'Art Orion">
    <meta name="robots" content="index, follow">

    {{-- Open Graph --}}
    <meta property="og:title" content="@yield('og_title', 'Centre d\'Art Orion')">
    <meta property="og:description" content="@yield('og_description', 'Production · Création · Formation — L\'excellence artistique au cœur de votre communauté.')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-orion.jpg'))">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="fr_FR">

    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head')
</head>
<body class="antialiased" style="background:#faf8f4;color:#1c1510;">

    {{-- Navigation --}}
    @include('components.navbar')

    {{-- Mobile sidebar overlay --}}
    <div id="mobile-overlay"
         class="fixed inset-0 bg-black/70 z-40 opacity-0 pointer-events-none transition-opacity duration-300 lg:hidden">
    </div>

    {{-- Mobile sidebar --}}
    @include('components.mobile-menu')

    {{-- Main content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.footer')

    {{-- Lightbox --}}
    @include('components.lightbox')

    @stack('scripts')
</body>
</html>
