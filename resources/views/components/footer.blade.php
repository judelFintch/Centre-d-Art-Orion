<footer style="background:#0a0a0a;border-top:1px solid #1a1a1a;padding:80px 0 0;">

    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">

        {{-- Grid --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:48px;padding-bottom:60px;border-bottom:1px solid #1a1a1a;">

            {{-- Brand --}}
            <div>
                <div style="display:flex;align-items:center;gap:12px;margin-bottom:20px;">
                    <div style="width:48px;height:48px;border-radius:50%;background:linear-gradient(135deg,#4caf7d,#d4a030);display:flex;align-items:center;justify-content:center;font-weight:900;font-size:1.2rem;color:#0a0a0a;font-family:'Space Grotesk',sans-serif;">O</div>
                    <div>
                        <div style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.85rem;color:#f5f5f0;line-height:1.2;">Centre d'Art</div>
                        <div style="font-family:'Playfair Display',Georgia,serif;font-weight:900;font-size:1.2rem;background:linear-gradient(90deg,#4caf7d,#d4a030);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;line-height:1.2;">ORION</div>
                    </div>
                </div>
                <p style="color:#666;font-size:0.88rem;line-height:1.8;margin-bottom:24px;">
                    Production · Création · Formation.<br>
                    L'excellence artistique au cœur de votre communauté.
                </p>
                {{-- Réseaux sociaux --}}
                <div style="display:flex;gap:10px;">
                    @foreach([['fb','Facebook','#1877f2'],['ig','Instagram','#e1306c'],['yt','YouTube','#ff0000'],['tw','Twitter','#1da1f2']] as $r)
                    <a href="#" aria-label="{{ $r[1] }}"
                       style="width:36px;height:36px;background:rgba(255,255,255,0.06);border:1px solid #222;border-radius:4px;display:flex;align-items:center;justify-content:center;color:#aaa;font-size:0.7rem;font-weight:700;text-decoration:none;transition:all 0.2s;font-family:'Space Grotesk',sans-serif;"
                       onmouseover="this.style.borderColor='{{ $r[2] }}';this.style.color='{{ $r[2] }}'"
                       onmouseout="this.style.borderColor='#222';this.style.color='#aaa'">
                        {{ strtoupper($r[0]) }}
                    </a>
                    @endforeach
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
                    <div style="display:flex;gap:12px;align-items:center;">
                        <span style="color:#d4a030;font-size:0.9rem;flex-shrink:0;">📞</span>
                        <a href="tel:+243000000000" style="color:#666;font-size:0.85rem;text-decoration:none;transition:color 0.2s;"
                           onmouseover="this.style.color='#d4a030'" onmouseout="this.style.color='#666'">+243 000 000 000</a>
                    </div>
                    <div style="display:flex;gap:12px;align-items:center;">
                        <span style="color:#e07030;font-size:0.9rem;flex-shrink:0;">✉</span>
                        <a href="mailto:contact@centreartorion.cd" style="color:#666;font-size:0.85rem;text-decoration:none;transition:color 0.2s;"
                           onmouseover="this.style.color='#e07030'" onmouseout="this.style.color='#666'">contact@centreartorion.cd</a>
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
