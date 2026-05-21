@extends('layouts.app')

@section('title', $evenement->titre . ' — Centre d\'Art Orion')
@section('meta_description', Str::limit($evenement->description, 160))

@section('content')

<section style="padding:80px 0 60px;background:#0a0a0a;border-bottom:1px solid #1a1a1a;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
        <nav style="display:flex;align-items:center;gap:8px;margin-bottom:32px;font-size:0.8rem;color:#555;font-family:'Space Grotesk',sans-serif;">
            <a href="{{ route('home') }}" style="color:#555;text-decoration:none;" onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#555'">Accueil</a>
            <span>›</span>
            <a href="{{ route('evenements.index') }}" style="color:#555;text-decoration:none;" onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#555'">Événements</a>
            <span>›</span>
            <span style="color:#f5f5f0;">{{ Str::limit($evenement->titre, 40) }}</span>
        </nav>
        <div style="display:grid;grid-template-columns:1fr auto;gap:32px;align-items:start;flex-wrap:wrap;">
            <div>
                @if($evenement->type)<span class="tag tag-orange" style="margin-bottom:16px;display:inline-block;">{{ ucfirst($evenement->type) }}</span>@endif
                <h1 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,3.2rem);font-weight:900;color:#f5f5f0;line-height:1.1;margin:0 0 16px;">{{ $evenement->titre }}</h1>
                <p style="color:#888;font-size:1rem;line-height:1.8;max-width:600px;">{{ $evenement->description }}</p>
            </div>
        </div>
    </div>
</section>

<section style="padding:80px 0;background:#0d0d0d;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
        <div style="display:grid;grid-template-columns:1fr 320px;gap:48px;align-items:start;">

            <div>
                @if($evenement->contenu)
                <div style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:40px;margin-bottom:28px;">
                    <h2 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1rem;letter-spacing:0.08em;text-transform:uppercase;color:#f5f5f0;margin:0 0 20px;">À propos de cet événement</h2>
                    <div class="prose-dark">{!! nl2br(e($evenement->contenu)) !!}</div>
                </div>
                @else
                <div style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:40px;margin-bottom:28px;">
                    <h2 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1rem;letter-spacing:0.08em;text-transform:uppercase;color:#f5f5f0;margin:0 0 20px;">À propos de cet événement</h2>
                    <p class="prose-dark">{{ $evenement->description }}</p>
                </div>
                @endif

                @if($autres->count())
                <div>
                    <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.9rem;letter-spacing:0.08em;text-transform:uppercase;color:#f5f5f0;margin:0 0 20px;">Autres événements à venir</h3>
                    <div style="display:flex;flex-direction:column;gap:12px;">
                        @foreach($autres as $a)
                        <a href="{{ route('evenements.show', $a) }}"
                           style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:20px;display:flex;gap:20px;align-items:center;text-decoration:none;transition:border-color 0.2s;"
                           onmouseover="this.style.borderColor='#e0703033'" onmouseout="this.style.borderColor='#1a1a1a'">
                            <div style="text-align:center;min-width:50px;flex-shrink:0;">
                                <div style="font-family:'Playfair Display',serif;font-size:1.4rem;font-weight:900;color:#e07030;line-height:1;">{{ $a->date_debut->format('d') }}</div>
                                <div style="font-size:0.65rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#666;font-family:'Space Grotesk',sans-serif;">{{ $a->date_debut->translatedFormat('M') }}</div>
                            </div>
                            <div>
                                <h4 style="font-family:'Space Grotesk',sans-serif;font-weight:600;font-size:0.9rem;color:#f5f5f0;margin:0 0 4px;">{{ $a->titre }}</h4>
                                <p style="color:#555;font-size:0.78rem;margin:0;">{{ $a->lieu }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div>
                <div style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:32px;position:sticky;top:90px;">
                    <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.85rem;letter-spacing:0.08em;text-transform:uppercase;color:#f5f5f0;margin:0 0 20px;">Infos pratiques</h3>

                    <div style="display:flex;flex-direction:column;gap:16px;margin-bottom:28px;padding-bottom:28px;border-bottom:1px solid #1a1a1a;">
                        <div style="display:flex;gap:12px;align-items:flex-start;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#e07030" stroke-width="2" style="flex-shrink:0;margin-top:2px;"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                            <div>
                                <p style="color:#888;font-size:0.8rem;margin:0 0 2px;font-family:'Space Grotesk',sans-serif;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;font-size:0.72rem;">Date</p>
                                <p style="color:#f5f5f0;font-size:0.88rem;margin:0;">{{ $evenement->date_debut->format('d/m/Y à H:i') }}</p>
                            </div>
                        </div>
                        @if($evenement->lieu)
                        <div style="display:flex;gap:12px;align-items:flex-start;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#d4a030" stroke-width="2" style="flex-shrink:0;margin-top:2px;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <div>
                                <p style="color:#888;font-size:0.72rem;font-family:'Space Grotesk',sans-serif;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;margin:0 0 2px;">Lieu</p>
                                <p style="color:#f5f5f0;font-size:0.88rem;margin:0;">{{ $evenement->lieu }}</p>
                            </div>
                        </div>
                        @endif
                        <div style="display:flex;gap:12px;align-items:flex-start;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4caf7d" stroke-width="2" style="flex-shrink:0;margin-top:2px;"><path d="M20 12V22H4V12M22 7H2v5h20V7zM12 22V7M12 7H7.5a2.5 2.5 0 010-5C11 2 12 7 12 7zM12 7h4.5a2.5 2.5 0 000-5C13 2 12 7 12 7z"/></svg>
                            <div>
                                <p style="color:#888;font-size:0.72rem;font-family:'Space Grotesk',sans-serif;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;margin:0 0 2px;">Entrée</p>
                                @if($evenement->gratuit)
                                <p style="color:#4caf7d;font-size:0.88rem;font-weight:700;margin:0;">Gratuit</p>
                                @elseif($evenement->prix)
                                <p style="color:#d4a030;font-size:0.88rem;font-weight:700;margin:0;">${{ number_format($evenement->prix, 0) }}</p>
                                @else
                                <p style="color:#f5f5f0;font-size:0.88rem;margin:0;">Sur inscription</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($evenement->statut === 'a_venir')
                    @if($evenement->lien_inscription)
                    <a href="{{ $evenement->lien_inscription }}" target="_blank" class="btn-gold" style="width:100%;justify-content:center;">
                        S'inscrire à l'événement
                    </a>
                    @else
                    <a href="{{ route('contact.index') }}?sujet={{ urlencode('Inscription — '.$evenement->titre) }}"
                       class="btn-gold" style="width:100%;justify-content:center;">
                        Je m'inscris
                    </a>
                    @endif
                    @endif

                    <a href="{{ route('evenements.index') }}" class="btn-outline" style="width:100%;justify-content:center;margin-top:10px;">
                        ← Tous les événements
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
@media(max-width:900px){
    section > div > div[style*="grid-template-columns:1fr 320px"] {
        grid-template-columns: 1fr !important;
    }
}
</style>

@endsection
