@extends('layouts.app')

@section('title', $formation->titre . ' — Centre d\'Art Orion')
@section('meta_description', Str::limit($formation->description, 160))

@section('content')

{{-- Hero --}}
<section style="padding:80px 0 60px;background:#0a0a0a;border-bottom:1px solid #1a1a1a;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 30% 50%,rgba(224,112,48,0.07),transparent 60%);pointer-events:none;"></div>
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:1;">
        {{-- Breadcrumb --}}
        <nav style="display:flex;align-items:center;gap:8px;margin-bottom:32px;font-size:0.8rem;color:#555;font-family:'Space Grotesk',sans-serif;">
            <a href="{{ route('home') }}" style="color:#555;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#555'">Accueil</a>
            <span>›</span>
            <a href="{{ route('formations.index') }}" style="color:#555;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#555'">Formations</a>
            <span>›</span>
            <span style="color:#f5f5f0;">{{ $formation->titre }}</span>
        </nav>

        <div style="display:grid;grid-template-columns:1fr auto;gap:40px;align-items:start;flex-wrap:wrap;">
            <div>
                @if($formation->categorie)
                <span class="tag tag-orange" style="margin-bottom:16px;display:inline-block;">{{ $formation->categorie }}</span>
                @endif
                <h1 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,3.2rem);font-weight:900;color:#f5f5f0;line-height:1.1;margin:0 0 16px;">{{ $formation->titre }}</h1>
                <p style="color:#888;font-size:1rem;line-height:1.8;max-width:600px;">{{ $formation->description }}</p>
            </div>
        </div>
    </div>
</section>

{{-- Contenu principal --}}
<section style="padding:80px 0;background:#0d0d0d;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
        <div style="display:grid;grid-template-columns:1fr 340px;gap:48px;align-items:start;">

            {{-- Contenu --}}
            <div>
                @if($formation->contenu)
                <div style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:40px;margin-bottom:32px;">
                    <h2 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1rem;letter-spacing:0.08em;text-transform:uppercase;color:#f5f5f0;margin:0 0 20px;">Programme détaillé</h2>
                    <div class="prose-dark">{!! nl2br(e($formation->contenu)) !!}</div>
                </div>
                @endif

                {{-- Points clés --}}
                <div style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:40px;">
                    <h2 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1rem;letter-spacing:0.08em;text-transform:uppercase;color:#f5f5f0;margin:0 0 24px;">Ce que vous apprendrez</h2>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                        @foreach(['Techniques fondamentales de la discipline','Pratique intensive en ateliers','Expression et créativité personnelle','Professionnalisme et standards du métier','Collaboration et projets de groupe','Présentation et mise en valeur de son travail'] as $pt)
                        <div style="display:flex;align-items:flex-start;gap:10px;padding:12px;background:#0d0d0d;border-radius:6px;">
                            <div style="width:20px;height:20px;background:rgba(76,175,125,0.15);border:1px solid rgba(76,175,125,0.25);border-radius:3px;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px;">
                                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#4caf7d" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                            </div>
                            <span style="color:#888;font-size:0.85rem;line-height:1.5;">{{ $pt }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div>
                {{-- Carte inscription --}}
                <div style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:32px;position:sticky;top:90px;">
                    @if($formation->prix)
                    <div style="font-family:'Playfair Display',Georgia,serif;font-size:2.2rem;font-weight:900;color:#d4a030;margin-bottom:4px;">${{ number_format($formation->prix, 0) }}</div>
                    <p style="color:#555;font-size:0.8rem;margin:0 0 24px;">Prix de la formation complète</p>
                    @endif

                    <div style="display:flex;flex-direction:column;gap:14px;margin-bottom:28px;padding-bottom:28px;border-bottom:1px solid #1a1a1a;">
                        @if($formation->duree)
                        <div style="display:flex;justify-content:space-between;align-items:center;">
                            <span style="color:#666;font-size:0.85rem;">Durée</span>
                            <span style="color:#f5f5f0;font-weight:600;font-size:0.85rem;font-family:'Space Grotesk',sans-serif;">{{ $formation->duree }}</span>
                        </div>
                        @endif
                        @if($formation->niveau)
                        <div style="display:flex;justify-content:space-between;align-items:center;">
                            <span style="color:#666;font-size:0.85rem;">Niveau</span>
                            <span style="color:#f5f5f0;font-weight:600;font-size:0.85rem;font-family:'Space Grotesk',sans-serif;">{{ $formation->niveau }}</span>
                        </div>
                        @endif
                        @if($formation->public_cible)
                        <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:12px;">
                            <span style="color:#666;font-size:0.85rem;flex-shrink:0;">Public</span>
                            <span style="color:#f5f5f0;font-size:0.85rem;text-align:right;font-family:'Space Grotesk',sans-serif;">{{ $formation->public_cible }}</span>
                        </div>
                        @endif
                    </div>

                    <a href="{{ route('contact.index') }}?sujet=Inscription+{{ urlencode($formation->titre) }}"
                       class="btn-gold" style="width:100%;justify-content:center;">
                        S'inscrire maintenant
                    </a>
                    <a href="{{ route('contact.index') }}" class="btn-outline" style="width:100%;justify-content:center;margin-top:10px;">
                        Poser une question
                    </a>

                    <p style="color:#444;font-size:0.75rem;text-align:center;margin:16px 0 0;line-height:1.6;">
                        Réponse garantie sous 24h ouvrées
                    </p>
                </div>

                {{-- Contact rapide --}}
                <div style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:24px;margin-top:16px;">
                    <h4 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.85rem;color:#f5f5f0;margin:0 0 12px;">Des questions ?</h4>
                    <p style="color:#666;font-size:0.82rem;line-height:1.6;margin:0 0 14px;">Notre équipe est disponible pour vous renseigner.</p>
                    <div style="display:flex;align-items:center;gap:8px;color:#4caf7d;font-size:0.85rem;font-family:'Space Grotesk',sans-serif;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.82 19.79 19.79 0 012 1.18 2 2 0 014 .03h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 14v2.92z"/></svg>
                        +243 000 000 000
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Autres formations --}}
@if($autres->count())
<section style="padding:80px 0;background:#0a0a0a;border-top:1px solid #161616;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
        <h2 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1rem;letter-spacing:0.1em;text-transform:uppercase;color:#f5f5f0;margin:0 0 32px;" class="reveal">
            Autres formations
        </h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:20px;">
            @foreach($autres as $a)
            <a href="{{ route('formations.show', $a) }}"
               class="reveal hover-lift"
               style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;text-decoration:none;display:block;transition:all 0.3s;"
               onmouseover="this.style.borderColor='#d4a03033'" onmouseout="this.style.borderColor='#1a1a1a'">
                <div class="tag tag-gold" style="margin-bottom:12px;display:inline-block;">{{ $a->categorie ?: 'Formation' }}</div>
                <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1rem;color:#f5f5f0;margin:0 0 8px;">{{ $a->titre }}</h3>
                <p style="color:#666;font-size:0.82rem;line-height:1.6;margin:0 0 14px;">{{ Str::limit($a->description, 80) }}</p>
                <span style="color:#4caf7d;font-size:0.8rem;font-family:'Space Grotesk',sans-serif;font-weight:600;">Voir →</span>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<style>
@media(max-width:900px){
    section > div > div[style*="grid-template-columns:1fr 340px"] {
        grid-template-columns: 1fr !important;
    }
}
@media(max-width:600px){
    div[style*="grid-template-columns:1fr 1fr"][style*="grid-gap"] {
        grid-template-columns: 1fr !important;
    }
}
</style>

@endsection
