@extends('layouts.app')

@section('title', 'Billetterie')
@section('meta_description', 'Réservez vos billets pour les événements du Centre d\'Art Orion — concerts, ateliers, expositions et spectacles.')

@section('content')

{{-- Hero --}}
<section style="background:linear-gradient(135deg,#0a0a0a 0%,#111 100%);padding:120px 0 72px;text-align:center;border-bottom:1px solid #1a1a1a;">
    <div style="max-width:800px;margin:0 auto;padding:0 24px;">
        <p style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:#4caf7d;margin:0 0 16px;">Centre d'Art Orion</p>
        <h1 style="font-family:'Playfair Display',serif;font-size:clamp(2rem,5vw,3.5rem);font-weight:900;color:#f5f5f0;margin:0 0 20px;line-height:1.15;">Billetterie</h1>
        <p style="font-size:1.05rem;color:#888;line-height:1.7;max-width:560px;margin:0 auto;">Réservez vos places pour nos prochains événements culturels. Concerts, ateliers, expositions et spectacles vous attendent.</p>
    </div>
</section>

{{-- Événements disponibles --}}
<section style="padding:80px 0;background:#faf8f4;">
    <div style="max-width:1200px;margin:0 auto;padding:0 24px;">

        @if($evenements->isEmpty())
        <div style="text-align:center;padding:80px 24px;">
            <div style="font-size:3rem;margin-bottom:16px;">🎭</div>
            <h2 style="font-family:'Playfair Display',serif;font-size:1.6rem;color:#1c1510;margin:0 0 12px;">Aucun événement à venir</h2>
            <p style="color:#888;font-size:0.95rem;">De nouveaux événements seront bientôt disponibles. Revenez très vite !</p>
            <a href="{{ route('evenements.index') }}" style="display:inline-block;margin-top:24px;padding:10px 24px;background:linear-gradient(135deg,#4caf7d,#2d7a52);color:#fff;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;border-radius:4px;text-decoration:none;">Voir tous les événements</a>
        </div>
        @else

        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(340px,1fr));gap:32px;">
            @foreach($evenements as $evt)
            <article style="background:#fff;border:1px solid #ede8e0;border-radius:12px;overflow:hidden;display:flex;flex-direction:column;transition:box-shadow 0.3s,transform 0.3s;"
                     onmouseover="this.style.boxShadow='0 12px 40px rgba(28,21,16,0.12)';this.style.transform='translateY(-3px)'"
                     onmouseout="this.style.boxShadow='';this.style.transform=''">

                {{-- Image --}}
                @if($evt->image_url)
                <div style="height:200px;overflow:hidden;flex-shrink:0;">
                    <img src="{{ $evt->image_url }}" alt="{{ $evt->titre }}"
                         style="width:100%;height:100%;object-fit:cover;transition:transform 0.4s;"
                         onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform=''">
                </div>
                @else
                <div style="height:200px;background:linear-gradient(135deg,#1a1a1a,#2a2a2a);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <span style="font-size:3rem;opacity:0.3;">🎭</span>
                </div>
                @endif

                <div style="padding:24px;display:flex;flex-direction:column;flex:1;">
                    {{-- Type + Statut --}}
                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:12px;flex-wrap:wrap;">
                        @if($evt->type)
                        <span style="padding:3px 10px;background:rgba(76,175,125,0.1);color:#2d7a52;font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;border-radius:20px;">{{ $evt->type }}</span>
                        @endif
                        @if($evt->gratuit)
                        <span style="padding:3px 10px;background:rgba(76,175,125,0.15);color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;border-radius:20px;">Gratuit</span>
                        @else
                        <span style="padding:3px 10px;background:rgba(212,160,48,0.12);color:#9a6a1d;font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;border-radius:20px;">{{ number_format($evt->prix, 0, ',', ' ') }} FC</span>
                        @endif
                    </div>

                    <h2 style="font-family:'Playfair Display',serif;font-size:1.2rem;font-weight:700;color:#1c1510;margin:0 0 8px;line-height:1.3;">{{ $evt->titre }}</h2>

                    {{-- Date --}}
                    <div style="display:flex;align-items:center;gap:6px;margin-bottom:8px;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#4caf7d" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        <span style="font-family:'Space Grotesk',sans-serif;font-size:0.8rem;color:#666;">{{ $evt->date_debut->isoFormat('dddd D MMMM YYYY [à] HH:mm') }}</span>
                    </div>

                    {{-- Lieu --}}
                    @if($evt->lieu)
                    <div style="display:flex;align-items:center;gap:6px;margin-bottom:16px;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#4caf7d" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span style="font-family:'Space Grotesk',sans-serif;font-size:0.8rem;color:#666;">{{ $evt->lieu }}</span>
                    </div>
                    @endif

                    <p style="font-size:0.88rem;color:#666;line-height:1.6;margin:0 0 20px;flex:1;">{{ Str::limit($evt->description, 120) }}</p>

                    <a href="{{ route('billetterie.show', $evt->slug) }}"
                       style="display:block;text-align:center;padding:11px 20px;background:linear-gradient(135deg,#4caf7d,#2d7a52);color:#fff;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;border-radius:6px;text-decoration:none;transition:box-shadow 0.2s;"
                       onmouseover="this.style.boxShadow='0 6px 20px rgba(76,175,125,0.35)'"
                       onmouseout="this.style.boxShadow=''">
                        Réserver ma place
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        @endif
    </div>
</section>

{{-- CTA bas --}}
<section style="background:#0a0a0a;padding:72px 24px;text-align:center;">
    <p style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:#4caf7d;margin:0 0 12px;">Besoin d'aide ?</p>
    <h2 style="font-family:'Playfair Display',serif;font-size:1.8rem;color:#f5f5f0;margin:0 0 16px;">Une question sur votre réservation ?</h2>
    <p style="color:#666;font-size:0.92rem;margin:0 0 28px;max-width:500px;margin-left:auto;margin-right:auto;">Notre équipe est disponible pour vous accompagner. Contactez-nous par email ou par téléphone.</p>
    <a href="{{ route('contact.index') }}"
       style="display:inline-block;padding:12px 28px;border:1px solid rgba(76,175,125,0.4);color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;border-radius:4px;text-decoration:none;transition:all 0.3s;"
       onmouseover="this.style.background='rgba(76,175,125,0.1)'" onmouseout="this.style.background=''">
        Nous contacter
    </a>
</section>

@endsection
