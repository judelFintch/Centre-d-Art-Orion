<footer style="background:#0a0a0a;border-top:1px solid #1a1a1a;padding:80px 0 0;">

    {{-- Bandeau Newsletter --}}
    <div style="background:linear-gradient(135deg,#0d1a12 0%,#0a1510 100%);border-bottom:1px solid #1a2e20;padding:60px 0;">
        <div style="max-width:1280px;margin:0 auto;padding:0 24px;display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:32px;">
            <div style="flex:1;min-width:260px;">
                <p style="font-family:'Space Grotesk',sans-serif;font-size:0.75rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:#4caf7d;margin:0 0 10px;">Newsletter</p>
                <h3 style="font-family:'Playfair Display',Georgia,serif;font-size:1.6rem;font-weight:700;color:#f5f5f0;margin:0 0 10px;line-height:1.25;">Restez dans l'univers Orion</h3>
                <p style="color:#666;font-size:0.88rem;line-height:1.7;margin:0;max-width:440px;">Actualités, événements, nouvelles formations — recevez l'essentiel directement dans votre boîte mail.</p>
            </div>
            <div style="flex:1;min-width:280px;max-width:480px;">
                <form id="newsletter-footer-form" style="display:flex;gap:10px;flex-wrap:wrap;">
                    @csrf
                    <input type="hidden" name="type" value="newsletter">

                    {{-- Honeypot anti-bot : invisible pour les humains, attirant pour les robots --}}
                    <div style="position:absolute;left:-9999px;top:-9999px;width:1px;height:1px;overflow:hidden;" aria-hidden="true">
                        <label for="hp_website_footer">Ne pas remplir</label>
                        <input type="text" id="hp_website_footer" name="_hp_website" tabindex="-1" autocomplete="off" value="">
                    </div>
                    {{-- Timestamp de chargement du formulaire (détection bot trop rapide) --}}
                    <input type="hidden" name="_form_loaded_at" value="{{ base64_encode((string) time()) }}">
                    <input type="email" name="email" placeholder="Votre adresse e-mail" required
                           style="flex:1;min-width:200px;background:#111;border:1px solid #2a2a2a;border-radius:4px;padding:12px 16px;color:#f5f5f0;font-size:0.88rem;font-family:'Space Grotesk',sans-serif;outline:none;transition:border-color 0.2s;"
                           onfocus="this.style.borderColor='#4caf7d'" onblur="this.style.borderColor='#2a2a2a'">
                    <button type="submit"
                            style="background:#4caf7d;color:#0a0a0a;font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.82rem;letter-spacing:0.08em;text-transform:uppercase;border:none;border-radius:4px;padding:12px 22px;cursor:pointer;white-space:nowrap;transition:background 0.2s;"
                            onmouseover="this.style.background='#3d9e6a'" onmouseout="this.style.background='#4caf7d'">S'abonner</button>
                </form>
                <div id="newsletter-footer-msg" style="display:none;margin-top:12px;font-size:0.85rem;font-family:'Space Grotesk',sans-serif;"></div>
            </div>
        </div>
    </div>

    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">

        {{-- Grid --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:48px;padding-bottom:60px;border-bottom:1px solid #1a1a1a;">

            {{-- Brand --}}
            <div>
                <div style="margin-bottom:20px;">
                    <img src="{{ asset('images/logo.png') }}" alt="Centre d'Art Orion" style="height:44px;width:auto;object-fit:contain;display:block;filter:brightness(0) invert(1);opacity:0.85;">
                </div>
                <p style="color:#666;font-size:0.88rem;line-height:1.8;margin-bottom:24px;">
                    Production · Création · Formation.<br>
                    L'excellence artistique au cœur de votre communauté.
                </p>
                {{-- Réseaux sociaux --}}
                <div style="display:flex;gap:10px;">

                    {{-- Facebook --}}
                    <a href="https://www.facebook.com/share/1A8TQCwohp/?mibextid=wwXIfr" aria-label="Facebook"
                       target="_blank" rel="noopener noreferrer"
                       style="width:38px;height:38px;background:rgba(255,255,255,0.06);border:1px solid #222;border-radius:4px;display:flex;align-items:center;justify-content:center;color:#aaa;text-decoration:none;transition:all 0.25s;"
                       onmouseover="this.style.borderColor='#1877f2';this.style.color='#1877f2';this.style.background='rgba(24,119,242,0.1)'"
                       onmouseout="this.style.borderColor='#222';this.style.color='#aaa';this.style.background='rgba(255,255,255,0.06)'">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>

                    {{-- Instagram --}}
                    <a href="https://www.instagram.com/centre_orion?igsh=MXBoMWZ6ZmQ0cmh3bA%3D%3D&utm_source=qr" aria-label="Instagram"
                       target="_blank" rel="noopener noreferrer"
                       style="width:38px;height:38px;background:rgba(255,255,255,0.06);border:1px solid #222;border-radius:4px;display:flex;align-items:center;justify-content:center;color:#aaa;text-decoration:none;transition:all 0.25s;"
                       onmouseover="this.style.borderColor='#e1306c';this.style.color='#e1306c';this.style.background='rgba(225,48,108,0.1)'"
                       onmouseout="this.style.borderColor='#222';this.style.color='#aaa';this.style.background='rgba(255,255,255,0.06)'">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    </a>

                    {{-- YouTube --}}
                    <a href="#" aria-label="YouTube"
                       style="width:38px;height:38px;background:rgba(255,255,255,0.06);border:1px solid #222;border-radius:4px;display:flex;align-items:center;justify-content:center;color:#aaa;text-decoration:none;transition:all 0.25s;"
                       onmouseover="this.style.borderColor='#ff0000';this.style.color='#ff0000';this.style.background='rgba(255,0,0,0.1)'"
                       onmouseout="this.style.borderColor='#222';this.style.color='#aaa';this.style.background='rgba(255,255,255,0.06)'">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 0 0 1.46 6.42 29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58A2.78 2.78 0 0 0 3.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.95A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="#0a0a0a"/></svg>
                    </a>

                    {{-- TikTok --}}
                    <a href="https://www.tiktok.com/@centre_dart_orion?_r=1&_t=ZN-96g1IwdHuEg" aria-label="TikTok"
                       target="_blank" rel="noopener noreferrer"
                       style="width:38px;height:38px;background:rgba(255,255,255,0.06);border:1px solid #222;border-radius:4px;display:flex;align-items:center;justify-content:center;color:#aaa;text-decoration:none;transition:all 0.25s;"
                       onmouseover="this.style.borderColor='#69c9d0';this.style.color='#69c9d0';this.style.background='rgba(105,201,208,0.1)'"
                       onmouseout="this.style.borderColor='#222';this.style.color='#aaa';this.style.background='rgba(255,255,255,0.06)'">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.69a8.18 8.18 0 0 0 4.78 1.52V6.76a4.85 4.85 0 0 1-1.01-.07z"/></svg>
                    </a>

                </div>
            </div>

            {{-- Navigation --}}
            <div>
                <h4 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.8rem;letter-spacing:0.1em;text-transform:uppercase;color:#f5f5f0;margin-bottom:20px;">Navigation</h4>
                <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:10px;">
                    @foreach([
                        [route('home'),'Accueil'],
                        [route('about'),'À Propos'],
                        [route('services'),'Services'],
                        [route('formations.index'),'Formations'],
                        [route('galerie.index'),'Galerie'],
                        [route('evenements.index'),'Événements'],
                    ] as $l)
                    <li>
                        <a href="{{ $l[0] }}" style="color:#666;font-size:0.88rem;text-decoration:none;transition:color 0.2s;display:flex;align-items:center;gap:8px;"
                           onmouseover="this.style.color='#4caf7d'" onmouseout="this.style.color='#666'">
                            <span style="color:#4caf7d;font-size:0.6rem;">▶</span> {{ $l[1] }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Services --}}
            <div>
                <h4 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.8rem;letter-spacing:0.1em;text-transform:uppercase;color:#f5f5f0;margin-bottom:20px;">Nos Services</h4>
                <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:10px;">
                    @foreach(['Production Artistique','Création Artistique','Formation','Accompagnement','Événements','Ateliers Culturels'] as $s)
                    <li style="color:#666;font-size:0.88rem;display:flex;align-items:center;gap:8px;">
                        <span style="color:#d4a030;font-size:0.6rem;">◆</span> {{ $s }}
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.8rem;letter-spacing:0.1em;text-transform:uppercase;color:#f5f5f0;margin-bottom:20px;">Contact</h4>
                <div style="display:flex;flex-direction:column;gap:14px;">
                    <div style="display:flex;gap:12px;align-items:flex-start;">
                        <span style="color:#4caf7d;font-size:0.9rem;margin-top:2px;flex-shrink:0;">📍</span>
                        <p style="color:#666;font-size:0.85rem;line-height:1.6;margin:0;">380, Av. Changalele, Q. Gambela<br><span style="color:#555;">Derrière le bâtiment INPP</span></p>
                    </div>
                    <div style="display:flex;gap:12px;align-items:flex-start;">
                        <span style="color:#d4a030;font-size:0.9rem;flex-shrink:0;margin-top:2px;">📞</span>
                        <div style="display:flex;flex-direction:column;gap:4px;">
                            <a href="tel:+243802650023" style="color:#666;font-size:0.85rem;text-decoration:none;transition:color 0.2s;"
                               onmouseover="this.style.color='#d4a030'" onmouseout="this.style.color='#666'">+243 802 650 023</a>
                            <a href="tel:+243852236771" style="color:#666;font-size:0.85rem;text-decoration:none;transition:color 0.2s;"
                               onmouseover="this.style.color='#d4a030'" onmouseout="this.style.color='#666'">+243 852 236 771</a>
                        </div>
                    </div>
                    <div style="display:flex;gap:12px;align-items:center;">
                        <span style="color:#e07030;font-size:0.9rem;flex-shrink:0;">✉</span>
                        <a href="mailto:info@orioncentredart.com" style="color:#666;font-size:0.85rem;text-decoration:none;transition:color 0.2s;"
                           onmouseover="this.style.color='#e07030'" onmouseout="this.style.color='#666'">info@orioncentredart.com</a>
                    </div>
                </div>

                <div style="margin-top:24px;padding:16px;background:#111;border:1px solid #1a1a1a;border-radius:6px;">
                    <p style="font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;color:#f5f5f0;margin:0 0 6px;">Heures d'ouverture</p>
                    <p style="color:#666;font-size:0.82rem;margin:0;line-height:1.6;">Lun – Sam : 08h00 – 18h00<br>Dim : Sur rendez-vous</p>
                </div>
            </div>

        </div>

        {{-- Bottom bar --}}
        <div style="padding:24px 0;display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:12px;">
            <p style="color:#444;font-size:0.8rem;margin:0;">
                &copy; {{ date('Y') }} <span style="color:#4caf7d;">Centre d'Art Orion</span>. Tous droits réservés.
            </p>
            <div style="display:flex;flex-wrap:wrap;gap:12px 20px;align-items:center;">
                <a href="#" style="color:#444;font-size:0.78rem;text-decoration:none;transition:color 0.2s;"
                   onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#444'">Mentions légales</a>
                <a href="#" style="color:#444;font-size:0.78rem;text-decoration:none;transition:color 0.2s;"
                   onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#444'">Politique de confidentialité</a>
                <button onclick="window.OrionCookies && window.OrionCookies.openPanel()"
                        style="background:none;border:none;padding:0;color:#444;font-size:0.78rem;cursor:pointer;text-decoration:none;transition:color 0.2s;font-family:'Space Grotesk',sans-serif;"
                        onmouseover="this.style.color='#4caf7d'" onmouseout="this.style.color='#444'">
                    🍪 Gestion des cookies
                </button>
                <span style="color:#2a2a2a;font-size:0.68rem;">|</span>
                <a href="https://fintchweb.com/" target="_blank" rel="noopener noreferrer"
                   style="display:inline-flex;align-items:center;gap:5px;text-decoration:none;opacity:0.5;transition:opacity 0.25s;"
                   onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.5'">
                    <span style="font-family:'Space Grotesk',sans-serif;font-size:0.68rem;letter-spacing:0.06em;color:#888;">Conçu par</span>
                    <span style="font-family:'Playfair Display',Georgia,serif;font-size:0.75rem;font-style:italic;color:#b6afa7;letter-spacing:0.02em;">Fintch</span>
                    <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="#666" stroke-width="2"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                </a>
            </div>
        </div>

    </div>

<script>
(function () {
    function setupSubscribeForm(formId, msgId) {
        var form = document.getElementById(formId);
        if (!form) return;
        var msg = document.getElementById(msgId);

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            var data = new FormData(form);
            var btn = form.querySelector('button[type="submit"]');
            btn.disabled = true;
            btn.textContent = '…';

            fetch('{{ route("abonnement.store") }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': data.get('_token'), 'Accept': 'application/json' },
                body: data,
            })
            .then(function (r) { return r.json(); })
            .then(function (json) {
                msg.style.display = 'block';
                msg.style.color = json.success ? '#4caf7d' : '#e07030';
                msg.textContent = json.message;
                if (json.success) { form.reset(); }
            })
            .catch(function () {
                msg.style.display = 'block';
                msg.style.color = '#e07030';
                msg.textContent = 'Une erreur est survenue. Veuillez réessayer.';
            })
            .finally(function () {
                btn.disabled = false;
                btn.textContent = "S'abonner";
            });
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        setupSubscribeForm('newsletter-footer-form', 'newsletter-footer-msg');
    });
})();
</script>
</footer>
