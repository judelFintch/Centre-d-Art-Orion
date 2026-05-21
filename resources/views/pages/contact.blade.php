@extends('layouts.app')

@section('title', 'Contact — Centre d\'Art Orion')
@section('meta_description', 'Contactez le Centre d\'Art Orion. 380, Av. Changalele, Q. Gambela. Formulaire de contact, téléphone, email et carte Google Maps.')

@section('content')

{{-- Hero --}}
<section style="padding:100px 0 80px;background:#0a0a0a;border-bottom:1px solid #1a1a1a;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 20% 50%,rgba(76,175,125,0.07),transparent 60%);pointer-events:none;"></div>
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:1;">
        <div class="tag tag-green" style="margin-bottom:16px;">Parlons-nous</div>
        <h1 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2.5rem,5vw,4rem);font-weight:900;color:#f5f5f0;line-height:1.1;margin:0 0 20px;">
            Contactez<br>
            <span style="background:linear-gradient(135deg,#4caf7d,#d4a030);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">le Centre</span>
        </h1>
        <p style="color:#777;font-size:1rem;max-width:500px;line-height:1.8;">Une question sur nos formations, un projet artistique, une demande de partenariat ? Nous vous répondrons rapidement.</p>
    </div>
</section>

{{-- Contact Grid --}}
<section style="padding:80px 0 100px;background:#0d0d0d;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
        <div style="display:grid;grid-template-columns:1fr 400px;gap:60px;align-items:start;">

            {{-- Formulaire --}}
            <div class="reveal">
                <h2 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1rem;letter-spacing:0.08em;text-transform:uppercase;color:#f5f5f0;margin:0 0 32px;">Envoyer un message</h2>

                @if(session('success'))
                <div style="background:rgba(76,175,125,0.1);border:1px solid rgba(76,175,125,0.3);border-radius:6px;padding:16px;margin-bottom:24px;color:#4caf7d;font-size:0.9rem;">
                    ✓ {{ session('success') }}
                </div>
                @endif

                <div id="form-alert" class="hidden" style="margin-bottom:16px;"></div>

                <form id="contact-form"
                      action="{{ route('contact.store') }}"
                      method="POST"
                      style="display:flex;flex-direction:column;gap:20px;">
                    @csrf

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div>
                            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#888;margin-bottom:8px;">Nom *</label>
                            <input type="text"
                                   name="nom"
                                   value="{{ old('nom') }}"
                                   placeholder="Votre nom"
                                   class="orion-input"
                                   required>
                            @error('nom')<p style="color:#e07030;font-size:0.78rem;margin:6px 0 0;">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#888;margin-bottom:8px;">Email *</label>
                            <input type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   placeholder="votre@email.com"
                                   class="orion-input"
                                   required>
                            @error('email')<p style="color:#e07030;font-size:0.78rem;margin:6px 0 0;">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div>
                            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#888;margin-bottom:8px;">Téléphone</label>
                            <input type="tel"
                                   name="telephone"
                                   value="{{ old('telephone') }}"
                                   placeholder="+243 000 000 000"
                                   class="orion-input">
                        </div>
                        <div>
                            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#888;margin-bottom:8px;">Sujet *</label>
                            <select name="sujet" class="orion-input" required style="appearance:none;cursor:pointer;">
                                <option value="">Choisir un sujet</option>
                                @foreach(['Information générale','Inscription à une formation','Participation à un événement','Demande de partenariat','Résidence artistique','Candidature équipe','Autre demande'] as $opt)
                                <option value="{{ $opt }}" {{ old('sujet', request('sujet')) === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                            @error('sujet')<p style="color:#e07030;font-size:0.78rem;margin:6px 0 0;">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div>
                        <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#888;margin-bottom:8px;">Message *</label>
                        <textarea name="message"
                                  rows="6"
                                  placeholder="Décrivez votre demande en détail..."
                                  class="orion-input"
                                  required
                                  style="resize:vertical;min-height:140px;">{{ old('message') }}</textarea>
                        @error('message')<p style="color:#e07030;font-size:0.78rem;margin:6px 0 0;">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <button type="submit" class="btn-primary" style="width:100%;justify-content:center;padding:15px;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                            Envoyer le message
                        </button>
                    </div>
                </form>
            </div>

            {{-- Sidebar infos --}}
            <div class="reveal">

                {{-- Infos contact --}}
                <div style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:32px;margin-bottom:20px;">
                    <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.85rem;letter-spacing:0.08em;text-transform:uppercase;color:#f5f5f0;margin:0 0 24px;">Nos coordonnées</h3>

                    <div style="display:flex;flex-direction:column;gap:20px;">
                        <div style="display:flex;gap:16px;align-items:flex-start;">
                            <div style="width:40px;height:40px;background:rgba(76,175,125,0.12);border:1px solid rgba(76,175,125,0.2);border-radius:6px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4caf7d" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <div>
                                <p style="font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#555;margin:0 0 6px;">Adresse</p>
                                <p style="color:#ccc;font-size:0.88rem;line-height:1.6;margin:0;">380, Av. Changalele, Q. Gambela<br><span style="color:#666;font-size:0.82rem;">Derrière le nouveau bâtiment de l'INPP</span></p>
                            </div>
                        </div>

                        <div style="display:flex;gap:16px;align-items:flex-start;">
                            <div style="width:40px;height:40px;background:rgba(212,160,48,0.12);border:1px solid rgba(212,160,48,0.2);border-radius:6px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#d4a030" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.82 19.79 19.79 0 012 1.18 2 2 0 014 .03h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 14v2.92z"/></svg>
                            </div>
                            <div>
                                <p style="font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#555;margin:0 0 6px;">Téléphone</p>
                                <a href="tel:+243000000000" style="color:#ccc;font-size:0.88rem;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#d4a030'" onmouseout="this.style.color='#ccc'">+243 000 000 000</a>
                            </div>
                        </div>

                        <div style="display:flex;gap:16px;align-items:flex-start;">
                            <div style="width:40px;height:40px;background:rgba(224,112,48,0.12);border:1px solid rgba(224,112,48,0.2);border-radius:6px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#e07030" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            </div>
                            <div>
                                <p style="font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#555;margin:0 0 6px;">Email</p>
                                <a href="mailto:contact@centreartorion.cd" style="color:#ccc;font-size:0.88rem;text-decoration:none;transition:color 0.2s;word-break:break-all;" onmouseover="this.style.color='#e07030'" onmouseout="this.style.color='#ccc'">contact@centreartorion.cd</a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Horaires --}}
                <div style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:32px;margin-bottom:20px;">
                    <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.85rem;letter-spacing:0.08em;text-transform:uppercase;color:#f5f5f0;margin:0 0 20px;">Horaires d'ouverture</h3>
                    @foreach([
                        ['Lundi — Vendredi','08:00 — 18:00'],
                        ['Samedi',          '08:00 — 16:00'],
                        ['Dimanche',        'Sur rendez-vous'],
                    ] as $h)
                    <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid #1a1a1a;">
                        <span style="color:#888;font-size:0.85rem;">{{ $h[0] }}</span>
                        <span style="color:#f5f5f0;font-size:0.85rem;font-family:'Space Grotesk',sans-serif;font-weight:600;">{{ $h[1] }}</span>
                    </div>
                    @endforeach
                </div>

                {{-- Réseaux --}}
                <div style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:24px;">
                    <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.85rem;letter-spacing:0.08em;text-transform:uppercase;color:#f5f5f0;margin:0 0 16px;">Suivez-nous</h3>
                    <div style="display:flex;gap:10px;flex-wrap:wrap;">
                        @foreach([['Facebook','#1877f2','FB'],['Instagram','#e1306c','IG'],['YouTube','#ff0000','YT'],['TikTok','#69c9d0','TK']] as $rs)
                        <a href="#" aria-label="{{ $rs[0] }}"
                           style="flex:1;min-width:70px;padding:10px;background:rgba(255,255,255,0.04);border:1px solid #222;border-radius:6px;display:flex;align-items:center;justify-content:center;gap:6px;color:#888;font-size:0.75rem;font-weight:700;text-decoration:none;transition:all 0.2s;font-family:'Space Grotesk',sans-serif;"
                           onmouseover="this.style.borderColor='{{ $rs[1] }}';this.style.color='{{ $rs[1] }}'"
                           onmouseout="this.style.borderColor='#222';this.style.color='#888'">
                            {{ $rs[2] }} <span style="font-weight:400;opacity:0.6;font-size:0.7rem;">{{ $rs[0] }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

{{-- Carte --}}
<section style="padding:0 0 100px;background:#0d0d0d;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
        <div class="map-container reveal">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3978.4!2d27.4665!3d-4.3220!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sCentre+d%27Art+Orion!5e0!3m2!1sfr!2scd!4v1"
                width="100%"
                height="400"
                style="border:0;display:block;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Localisation du Centre d'Art Orion">
            </iframe>
        </div>
        <div style="margin-top:16px;text-align:center;">
            <p style="color:#555;font-size:0.8rem;font-family:'Space Grotesk',sans-serif;">
                380, Av. Changalele, Q. Gambela — Derrière le nouveau bâtiment de l'INPP
            </p>
        </div>
    </div>
</section>

<style>
@media(max-width:900px){
    section > div > div[style*="grid-template-columns:1fr 400px"] {
        grid-template-columns: 1fr !important;
    }
}
@media(max-width:600px){
    form div[style*="grid-template-columns:1fr 1fr"] {
        grid-template-columns: 1fr !important;
    }
}
</style>

@endsection
