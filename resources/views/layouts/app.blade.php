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
    <meta property="og:type" content="@yield('og_type', 'website')">
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

    {{-- Bannière de consentement aux cookies (RGPD) --}}
    @include('components.cookie-consent')

    {{-- ══════════════════════════════════════════════════════════════
         Script de tracking analytics (s'active uniquement si l'utilisateur
         a accepté les cookies analytiques via la bannière RGPD)
    ══════════════════════════════════════════════════════════════ --}}
    <script>
    (function () {
        'use strict';

        var TRACK_URL  = '{{ route("analytics.track") }}';
        var UPDATE_URL = '{{ route("analytics.update") }}';
        var CSRF       = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
        var SESSION_KEY = 'orion_analytics_session';

        // ── Génère ou récupère un UUID de session anonyme ─────────
        function getSessionId() {
            var id = localStorage.getItem(SESSION_KEY);
            if (!id) {
                id = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
                    var r = Math.random() * 16 | 0;
                    return (c === 'x' ? r : (r & 0x3 | 0x8)).toString(16);
                });
                localStorage.setItem(SESSION_KEY, id);
            }
            return id;
        }

        // ── Profondeur de scroll (0-100 %) ────────────────────────
        var maxScroll = 0;
        function updateScroll() {
            var docH   = document.documentElement.scrollHeight - window.innerHeight;
            var scroll = docH > 0 ? Math.round((window.scrollY / docH) * 100) : 0;
            if (scroll > maxScroll) { maxScroll = Math.min(scroll, 100); }
        }

        // ── Envoi de la mise à jour (exit page) ───────────────────
        function sendUpdate(visiteId, startTime) {
            var tempsP = Math.min(Math.round((Date.now() - startTime) / 1000), 86400);
            var payload = JSON.stringify({
                visite_id:         visiteId,
                temps_passe:       tempsP,
                profondeur_scroll: maxScroll,
                _token:            CSRF,
            });
            if (navigator.sendBeacon) {
                var blob = new Blob([payload], { type: 'application/json' });
                navigator.sendBeacon(UPDATE_URL, blob);
            } else {
                // Fallback synchrone (anciens navigateurs)
                var xhr = new XMLHttpRequest();
                xhr.open('POST', UPDATE_URL, false);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.setRequestHeader('X-CSRF-TOKEN', CSRF);
                xhr.send(payload);
            }
        }

        // ── Démarre le tracking ───────────────────────────────────
        function startTracking() {
            var sessionId = getSessionId();
            var startTime = Date.now();
            var visiteId  = null;

            // Envoi de la visite de page
            fetch(TRACK_URL, {
                method:  'POST',
                headers: {
                    'Content-Type':  'application/json',
                    'Accept':        'application/json',
                    'X-CSRF-TOKEN':  CSRF,
                },
                body: JSON.stringify({
                    session_id:  sessionId,
                    page_url:    window.location.pathname + window.location.search,
                    page_titre:  document.title,
                    referrer:    document.referrer || null,
                }),
            })
            .then(function (r) { return r.json(); })
            .then(function (data) { visiteId = data.id; })
            .catch(function () {});

            // Scroll
            window.addEventListener('scroll', updateScroll, { passive: true });
            updateScroll();

            // Exit page → mise à jour temps + scroll
            document.addEventListener('visibilitychange', function () {
                if (document.visibilityState === 'hidden' && visiteId) {
                    sendUpdate(visiteId, startTime);
                }
            });
            window.addEventListener('beforeunload', function () {
                if (visiteId) { sendUpdate(visiteId, startTime); }
            });
        }

        // ── Point d'entrée : attend le consentement ───────────────
        function checkAndStart() {
            if (window.OrionCookies && window.OrionCookies.hasAnalytics()) {
                startTracking();
            }
        }

        // Tente au chargement (consentement déjà donné lors d'une visite précédente)
        document.addEventListener('DOMContentLoaded', function () {
            // Petit délai pour que OrionCookies soit initialisé
            setTimeout(checkAndStart, 200);
        });

        // Écoute si l'utilisateur accepte en cours de session
        window.addEventListener('orion:consent-granted', function (e) {
            if (e.detail && e.detail.analytics) {
                startTracking();
            }
        });
    })();
    </script>

    @stack('scripts')
</body>
</html>
