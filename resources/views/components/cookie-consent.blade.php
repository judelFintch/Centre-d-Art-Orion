{{--
    Bannière de consentement aux cookies — RGPD / CNIL
    ────────────────────────────────────────────────────
    Trois boutons : Tout accepter · Tout refuser · Personnaliser
    Panel détaillé : Nécessaires (forcé) · Analytiques · Réseaux sociaux
    Stockage : localStorage  →  clé "orion_cookie_consent"  (JSON)
--}}

{{-- ═══════════════════════════════════════════════════════════════
     BANNIÈRE PRINCIPALE
═══════════════════════════════════════════════════════════════ --}}
<div id="cookie-banner"
     role="dialog"
     aria-live="polite"
     aria-label="Gestion des cookies"
     style="
        display:none;
        position:fixed;
        bottom:0;left:0;right:0;
        z-index:9999;
        background:rgba(10,10,10,0.97);
        border-top:1px solid #1e1e1e;
        backdrop-filter:blur(12px);
        -webkit-backdrop-filter:blur(12px);
        padding:20px 24px;
        box-shadow:0 -8px 40px rgba(0,0,0,0.6);
        transform:translateY(100%);
        transition:transform 0.35s cubic-bezier(.4,0,.2,1);
        font-family:'Space Grotesk',sans-serif;
     ">

    <div style="max-width:1280px;margin:0 auto;display:flex;flex-wrap:wrap;align-items:center;gap:20px;">

        {{-- Texte --}}
        <div style="flex:1;min-width:260px;">
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px;">
                <span style="font-size:1.1rem;">🍪</span>
                <p style="font-weight:700;font-size:0.9rem;color:#f5f5f0;margin:0;letter-spacing:0.02em;">
                    Nous utilisons des cookies
                </p>
            </div>
            <p style="color:#777;font-size:0.8rem;line-height:1.6;margin:0;max-width:640px;">
                Ce site utilise des cookies pour améliorer votre expérience, analyser notre trafic et intégrer
                des fonctionnalités de réseaux sociaux. Vous pouvez choisir quels cookies accepter.
                <a href="#" id="cookie-learn-more"
                   style="color:#4caf7d;text-decoration:underline;text-underline-offset:2px;font-size:0.78rem;white-space:nowrap;"
                   onclick="return false;">En savoir plus</a>
            </p>
        </div>

        {{-- Boutons --}}
        <div style="display:flex;flex-wrap:wrap;gap:10px;align-items:center;">
            <button id="cookie-customize"
                    style="background:transparent;border:1px solid #333;color:#aaa;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;padding:9px 18px;border-radius:4px;cursor:pointer;transition:all 0.2s;white-space:nowrap;"
                    onmouseover="this.style.borderColor='#555';this.style.color='#f5f5f0'"
                    onmouseout="this.style.borderColor='#333';this.style.color='#aaa'">
                Personnaliser
            </button>
            <button id="cookie-reject-all"
                    style="background:transparent;border:1px solid #333;color:#aaa;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;padding:9px 18px;border-radius:4px;cursor:pointer;transition:all 0.2s;white-space:nowrap;"
                    onmouseover="this.style.borderColor='#e07030';this.style.color='#e07030'"
                    onmouseout="this.style.borderColor='#333';this.style.color='#aaa'">
                Tout refuser
            </button>
            <button id="cookie-accept-all"
                    style="background:#4caf7d;color:#0a0a0a;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;padding:9px 20px;border-radius:4px;border:none;cursor:pointer;transition:background 0.2s;white-space:nowrap;"
                    onmouseover="this.style.background='#3d9e6a'"
                    onmouseout="this.style.background='#4caf7d'">
                Tout accepter
            </button>
        </div>

    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════════
     PANNEAU DE PERSONNALISATION
═══════════════════════════════════════════════════════════════ --}}
<div id="cookie-panel"
     role="dialog"
     aria-modal="true"
     aria-label="Personnaliser les cookies"
     style="
        display:none;
        position:fixed;
        inset:0;
        z-index:10000;
        background:rgba(0,0,0,0.75);
        backdrop-filter:blur(4px);
        -webkit-backdrop-filter:blur(4px);
        align-items:flex-end;
        justify-content:center;
        padding:0 0 0 0;
     ">

    <div style="
            width:100%;
            max-width:600px;
            margin:0 auto;
            background:#111;
            border:1px solid #1e1e1e;
            border-radius:12px 12px 0 0;
            padding:32px 28px 28px;
            max-height:90vh;
            overflow-y:auto;
            position:fixed;
            bottom:0;
            left:50%;
            transform:translateX(-50%);
            box-shadow:0 -16px 60px rgba(0,0,0,0.7);
            font-family:'Space Grotesk',sans-serif;
         ">

        {{-- En-tête --}}
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;">
            <div>
                <p style="font-family:'Playfair Display',Georgia,serif;font-size:1.15rem;font-weight:700;color:#f5f5f0;margin:0 0 4px;">Paramètres des cookies</p>
                <p style="color:#555;font-size:0.78rem;margin:0;">Choisissez les cookies que vous autorisez.</p>
            </div>
            <button id="cookie-panel-close"
                    aria-label="Fermer"
                    style="width:32px;height:32px;background:rgba(255,255,255,0.06);border:1px solid #222;border-radius:6px;cursor:pointer;display:flex;align-items:center;justify-content:center;color:#777;font-size:1.1rem;flex-shrink:0;transition:all 0.2s;"
                    onmouseover="this.style.background='rgba(255,255,255,0.1)';this.style.color='#f5f5f0'"
                    onmouseout="this.style.background='rgba(255,255,255,0.06)';this.style.color='#777'">
                ✕
            </button>
        </div>

        {{-- Catégories --}}

        {{-- 1. Nécessaires (toujours actifs) --}}
        <div style="border:1px solid #1e1e1e;border-radius:8px;padding:18px 20px;margin-bottom:12px;background:rgba(76,175,125,0.04);">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                <div style="display:flex;align-items:center;gap:10px;">
                    <span style="width:8px;height:8px;border-radius:50%;background:#4caf7d;display:inline-block;flex-shrink:0;"></span>
                    <span style="font-weight:700;font-size:0.88rem;color:#f5f5f0;">Cookies nécessaires</span>
                </div>
                <span style="font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#4caf7d;background:rgba(76,175,125,0.12);padding:3px 10px;border-radius:20px;">Toujours actif</span>
            </div>
            <p style="color:#666;font-size:0.78rem;line-height:1.6;margin:0;">
                Indispensables au fonctionnement du site : session, sécurité CSRF, authentification.
                Ils ne peuvent pas être désactivés.
            </p>
        </div>

        {{-- 2. Analytiques --}}
        <div style="border:1px solid #1e1e1e;border-radius:8px;padding:18px 20px;margin-bottom:12px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                <div style="display:flex;align-items:center;gap:10px;">
                    <span style="width:8px;height:8px;border-radius:50%;background:#d4a030;display:inline-block;flex-shrink:0;"></span>
                    <span style="font-weight:700;font-size:0.88rem;color:#f5f5f0;">Cookies analytiques</span>
                </div>
                {{-- Toggle --}}
                <label style="position:relative;display:inline-flex;align-items:center;cursor:pointer;">
                    <input type="checkbox" id="cookie-toggle-analytics"
                           style="position:absolute;opacity:0;width:0;height:0;"
                           aria-label="Activer les cookies analytiques">
                    <span class="cookie-toggle-track"
                          data-for="cookie-toggle-analytics"
                          style="
                            display:block;width:40px;height:22px;
                            background:#222;border:1px solid #333;
                            border-radius:11px;position:relative;
                            transition:background 0.25s,border-color 0.25s;
                          ">
                        <span class="cookie-toggle-thumb"
                              style="
                                position:absolute;top:2px;left:2px;
                                width:16px;height:16px;border-radius:50%;
                                background:#555;
                                transition:transform 0.25s,background 0.25s;
                              "></span>
                    </span>
                </label>
            </div>
            <p style="color:#666;font-size:0.78rem;line-height:1.6;margin:0;">
                Nous aident à comprendre comment les visiteurs utilisent le site (pages vues, temps passé).
                Ces données sont anonymes et servent uniquement à améliorer le contenu.
            </p>
        </div>

        {{-- 3. Réseaux sociaux --}}
        <div style="border:1px solid #1e1e1e;border-radius:8px;padding:18px 20px;margin-bottom:24px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                <div style="display:flex;align-items:center;gap:10px;">
                    <span style="width:8px;height:8px;border-radius:50%;background:#e07030;display:inline-block;flex-shrink:0;"></span>
                    <span style="font-weight:700;font-size:0.88rem;color:#f5f5f0;">Cookies réseaux sociaux</span>
                </div>
                <label style="position:relative;display:inline-flex;align-items:center;cursor:pointer;">
                    <input type="checkbox" id="cookie-toggle-social"
                           style="position:absolute;opacity:0;width:0;height:0;"
                           aria-label="Activer les cookies réseaux sociaux">
                    <span class="cookie-toggle-track"
                          data-for="cookie-toggle-social"
                          style="
                            display:block;width:40px;height:22px;
                            background:#222;border:1px solid #333;
                            border-radius:11px;position:relative;
                            transition:background 0.25s,border-color 0.25s;
                          ">
                        <span class="cookie-toggle-thumb"
                              style="
                                position:absolute;top:2px;left:2px;
                                width:16px;height:16px;border-radius:50%;
                                background:#555;
                                transition:transform 0.25s,background 0.25s;
                              "></span>
                    </span>
                </label>
            </div>
            <p style="color:#666;font-size:0.78rem;line-height:1.6;margin:0;">
                Permettent l'intégration des boutons de partage Facebook, Instagram, TikTok et YouTube.
                Ces plateformes peuvent déposer leurs propres cookies lors de l'utilisation.
            </p>
        </div>

        {{-- Boutons de validation --}}
        <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <button id="cookie-reject-panel"
                    style="flex:1;background:transparent;border:1px solid #333;color:#aaa;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;padding:11px;border-radius:6px;cursor:pointer;transition:all 0.2s;min-width:120px;"
                    onmouseover="this.style.borderColor='#555';this.style.color='#f5f5f0'"
                    onmouseout="this.style.borderColor='#333';this.style.color='#aaa'">
                Tout refuser
            </button>
            <button id="cookie-save-panel"
                    style="flex:2;background:#4caf7d;color:#0a0a0a;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;padding:11px;border-radius:6px;border:none;cursor:pointer;transition:background 0.2s;min-width:160px;"
                    onmouseover="this.style.background='#3d9e6a'"
                    onmouseout="this.style.background='#4caf7d'">
                Enregistrer mes choix
            </button>
            <button id="cookie-accept-panel"
                    style="flex:2;background:#d4a030;color:#0a0a0a;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;padding:11px;border-radius:6px;border:none;cursor:pointer;transition:background 0.2s;min-width:160px;"
                    onmouseover="this.style.background='#c49020'"
                    onmouseout="this.style.background='#d4a030'">
                Tout accepter
            </button>
        </div>

        {{-- Note légale --}}
        <p style="margin:18px 0 0;color:#444;font-size:0.72rem;line-height:1.6;text-align:center;">
            Vous pouvez modifier vos préférences à tout moment depuis le lien
            <button id="cookie-reopen-link"
                    style="background:none;border:none;padding:0;color:#4caf7d;font-size:0.72rem;cursor:pointer;text-decoration:underline;text-underline-offset:2px;font-family:'Space Grotesk',sans-serif;">
                Gestion des cookies
            </button>
            en bas de page.
        </p>

    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════════
     SCRIPT
═══════════════════════════════════════════════════════════════ --}}
<script>
(function () {
    'use strict';

    var STORAGE_KEY = 'orion_cookie_consent';
    var banner      = document.getElementById('cookie-banner');
    var panel       = document.getElementById('cookie-panel');

    // ── Récupère / initialise le consentement ──────────────────────
    function getConsent() {
        try { return JSON.parse(localStorage.getItem(STORAGE_KEY)); }
        catch (e) { return null; }
    }

    function saveConsent(analytics, social) {
        var data = {
            necessary: true,
            analytics: !!analytics,
            social: !!social,
            date: new Date().toISOString(),
        };
        try { localStorage.setItem(STORAGE_KEY, JSON.stringify(data)); }
        catch (e) {}
        // Notifie le script de tracking si analytics activé
        if (analytics) {
            window.dispatchEvent(new CustomEvent('orion:consent-granted', {
                detail: { analytics: true, social: !!social }
            }));
        }
        return data;
    }

    // ── Affiche / masque la bannière ───────────────────────────────
    function showBanner() {
        banner.style.display = 'block';
        // Force reflow pour que la transition soit visible
        banner.offsetHeight; // eslint-disable-line
        banner.style.transform = 'translateY(0)';
    }

    function hideBanner() {
        banner.style.transform = 'translateY(100%)';
        setTimeout(function () { banner.style.display = 'none'; }, 360);
    }

    // ── Affiche / masque le panel ─────────────────────────────────
    function openPanel() {
        panel.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closePanel() {
        panel.style.display = 'none';
        document.body.style.overflow = '';
    }

    // ── Gestion des toggles ───────────────────────────────────────
    function syncToggle(checkbox) {
        var track = document.querySelector('.cookie-toggle-track[data-for="' + checkbox.id + '"]');
        if (!track) return;
        var thumb = track.querySelector('.cookie-toggle-thumb');
        if (checkbox.checked) {
            track.style.background = '#4caf7d';
            track.style.borderColor = '#4caf7d';
            thumb.style.transform = 'translateX(18px)';
            thumb.style.background = '#fff';
        } else {
            track.style.background = '#222';
            track.style.borderColor = '#333';
            thumb.style.transform = 'translateX(0)';
            thumb.style.background = '#555';
        }
    }

    function setToggle(checkboxId, value) {
        var cb = document.getElementById(checkboxId);
        if (!cb) return;
        cb.checked = value;
        syncToggle(cb);
    }

    // ── Écoute les toggles ────────────────────────────────────────
    ['cookie-toggle-analytics', 'cookie-toggle-social'].forEach(function (id) {
        var cb = document.getElementById(id);
        if (!cb) return;
        cb.addEventListener('change', function () { syncToggle(cb); });
    });

    // ── Actions ───────────────────────────────────────────────────
    function acceptAll() {
        saveConsent(true, true);
        hideBanner();
        closePanel();
    }

    function rejectAll() {
        saveConsent(false, false);
        hideBanner();
        closePanel();
    }

    function saveCustom() {
        var analytics = document.getElementById('cookie-toggle-analytics').checked;
        var social    = document.getElementById('cookie-toggle-social').checked;
        saveConsent(analytics, social);
        hideBanner();
        closePanel();
    }

    // ── Boutons bannière ──────────────────────────────────────────
    document.getElementById('cookie-accept-all').addEventListener('click', acceptAll);
    document.getElementById('cookie-reject-all').addEventListener('click', rejectAll);
    document.getElementById('cookie-customize').addEventListener('click', function () {
        hideBanner();
        openPanel();
    });
    document.getElementById('cookie-learn-more').addEventListener('click', function (e) {
        e.preventDefault();
        hideBanner();
        openPanel();
    });

    // ── Boutons panel ─────────────────────────────────────────────
    document.getElementById('cookie-accept-panel').addEventListener('click', acceptAll);
    document.getElementById('cookie-reject-panel').addEventListener('click', rejectAll);
    document.getElementById('cookie-save-panel').addEventListener('click', saveCustom);
    document.getElementById('cookie-panel-close').addEventListener('click', function () {
        closePanel();
        // Re-ouvre la bannière si pas encore de consentement
        if (!getConsent()) { showBanner(); }
    });

    // Fermer en cliquant sur l'overlay
    panel.addEventListener('click', function (e) {
        if (e.target === panel) {
            closePanel();
            if (!getConsent()) { showBanner(); }
        }
    });

    // ── Lien "Gestion des cookies" (footer) ───────────────────────
    document.getElementById('cookie-reopen-link').addEventListener('click', function () {
        closePanel();
        openPanel();
    });

    // ── Point d'entrée ────────────────────────────────────────────
    var consent = getConsent();

    if (!consent) {
        // Premier visit : affiche la bannière après 800 ms
        setTimeout(showBanner, 800);
    } else {
        // Restaure l'état des toggles si l'utilisateur re-ouvre le panel
        setToggle('cookie-toggle-analytics', consent.analytics);
        setToggle('cookie-toggle-social',    consent.social);
    }

    // ── Expose une API globale ─────────────────────────────────────
    window.OrionCookies = {
        getConsent  : getConsent,
        openPanel   : function () { openPanel(); },
        hasAnalytics: function () { var c = getConsent(); return c && c.analytics; },
        hasSocial   : function () { var c = getConsent(); return c && c.social; },
    };
})();
</script>
