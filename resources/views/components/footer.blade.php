<footer style="background:#0a0a0a;border-top:1px solid #1a1a1a;padding:80px 0 0;">

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
            <div style="display:flex;gap:20px;">
                <a href="#" style="color:#444;font-size:0.78rem;text-decoration:none;transition:color 0.2s;"
                   onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#444'">Mentions légales</a>
                <a href="#" style="color:#444;font-size:0.78rem;text-decoration:none;transition:color 0.2s;"
                   onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#444'">Politique de confidentialité</a>
            </div>
        </div>

    </div>
</footer>
