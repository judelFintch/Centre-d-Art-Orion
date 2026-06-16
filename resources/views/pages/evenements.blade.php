@extends('layouts.app')

@section('title', 'Événements — Centre d\'Art Orion')
@section('meta_description', 'Concerts, expositions, ateliers, galas — découvrez tous les événements à venir et passés du Centre d\'Art Orion.')

@section('content')

{{-- Hero --}}
<section style="padding:100px 0 80px;background:#0a0a0a;border-bottom:1px solid #1a1a1a;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 30% 60%,rgba(224,112,48,0.07),transparent 60%);pointer-events:none;"></div>
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:1;">
        <div class="tag tag-orange" style="margin-bottom:16px;">Agenda culturel</div>
        <h1 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2.5rem,5vw,4rem);font-weight:900;color:#f5f5f0;line-height:1.1;margin:0 0 20px;">
            Événements<br>
            <span style="background:linear-gradient(135deg,#e07030,#d4a030);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">& Agenda</span>
        </h1>
        <p style="color:#777;font-size:1rem;max-width:500px;line-height:1.8;">Concerts, expositions, ateliers ouverts et galas culturels — vivez l'art avec Orion.</p>
    </div>
</section>

{{-- Événements à venir --}}
<section style="padding:80px 0;background:#0d0d0d;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">

        <div class="reveal" style="margin-bottom:48px;">
            <div class="tag tag-orange" style="margin-bottom:16px;">Prochainement</div>
            <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(1.8rem,3.5vw,2.5rem);font-weight:900;color:#f5f5f0;line-height:1.15;margin:0;" class="accent-line">
                Événements à Venir
            </h2>
        </div>

        @if($aVenir->isEmpty())
        <div style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:60px;text-align:center;" class="reveal">
            <div style="font-size:2.5rem;margin-bottom:16px;">📅</div>
            <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1.1rem;color:#f5f5f0;margin:0 0 10px;">Nouveaux événements bientôt</h3>
            <p style="color:#666;font-size:0.88rem;margin:0 0 24px;">Revenez bientôt ou contactez-nous pour être tenu informé.</p>
            <a href="{{ route('contact.index') }}" class="btn-primary" style="display:inline-flex;">Être notifié</a>
        </div>
        @else
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(340px,1fr));gap:28px;">
            @foreach($aVenir as $ev)
            @php
                $eventImage = $ev->image_url;
            @endphp
            <div class="reveal hover-lift"
                 style="background:#111;border:1px solid #1a1a1a;border-radius:10px;overflow:hidden;transition:all 0.3s;"
                 onmouseover="this.style.borderColor='#e0703033'" onmouseout="this.style.borderColor='#1a1a1a'">

                {{-- Image / Date banner --}}
                <div style="position:relative;height:200px;background:linear-gradient(135deg,#1a1a1a,#111);display:flex;align-items:center;justify-content:center;overflow:hidden;">
                    @if($eventImage)
                        <img src="{{ $eventImage }}" alt="{{ $ev->titre }}" style="width:100%;height:100%;object-fit:cover;">
                    @else
                        @php $evPhotos = ['11.jpg','22.jpg','5.jpg','7.jpg','3.jpg','6.jpg','9.jpg','2.jpg']; @endphp
                        <img src="{{ asset('images/' . $evPhotos[$loop->index % count($evPhotos)]) }}"
                             alt="{{ $ev->titre }}"
                             style="width:100%;height:100%;object-fit:cover;">
                    @endif

                    {{-- Date badge --}}
                    <div style="position:absolute;top:16px;left:16px;background:rgba(0,0,0,0.85);border:1px solid rgba(224,112,48,0.3);border-radius:6px;padding:10px 14px;text-align:center;backdrop-filter:blur(8px);">
                        <div style="font-family:'Playfair Display',Georgia,serif;font-size:1.6rem;font-weight:900;color:#e07030;line-height:1;">{{ $ev->date_debut->format('d') }}</div>
                        <div style="font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#aaa;">{{ $ev->date_debut->translatedFormat('M Y') }}</div>
                    </div>

                    @if($ev->gratuit)
                    <div style="position:absolute;top:16px;right:16px;">
                        <span class="tag tag-green">Gratuit</span>
                    </div>
                    @elseif($ev->prix)
                    <div style="position:absolute;top:16px;right:16px;">
                        <span class="tag tag-gold">${{ number_format($ev->prix, 0) }}</span>
                    </div>
                    @endif
                </div>

                <div style="padding:28px;">
                    @if($ev->type)
                    <span class="tag tag-orange" style="margin-bottom:12px;display:inline-block;">{{ ucfirst($ev->type) }}</span>
                    @endif
                    <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1.05rem;color:#f5f5f0;margin:0 0 10px;line-height:1.3;">{{ $ev->titre }}</h3>
                    <p style="color:#666;font-size:0.85rem;line-height:1.7;margin:0 0 20px;">{{ Str::limit($ev->description, 100) }}</p>

                    <div style="display:flex;flex-direction:column;gap:8px;margin-bottom:20px;">
                        <div style="display:flex;align-items:center;gap:8px;color:#777;font-size:0.82rem;">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#e07030" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                            {{ $ev->date_debut->format('d/m/Y à H:i') }}
                        </div>
                        @if($ev->lieu)
                        <div style="display:flex;align-items:center;gap:8px;color:#777;font-size:0.82rem;">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#d4a030" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            {{ $ev->lieu }}
                        </div>
                        @endif
                    </div>

                    <a href="{{ route('evenements.show', $ev) }}" class="btn-primary" style="width:100%;justify-content:center;">
                        Voir les détails
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @endif

    </div>
</section>

{{-- Événements passés --}}
@if($passes->count())
<section style="padding:80px 0 100px;background:#0a0a0a;border-top:1px solid #161616;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">

        <div class="reveal" style="margin-bottom:48px;">
            <div class="tag tag-white" style="margin-bottom:16px;">Rétrospective</div>
            <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(1.8rem,3.5vw,2.5rem);font-weight:900;color:#f5f5f0;line-height:1.15;margin:0;" class="accent-line">
                Événements Passés
            </h2>
        </div>

        <div style="display:flex;flex-direction:column;gap:16px;">
            @foreach($passes as $ev)
            <a href="{{ route('evenements.show', $ev) }}"
               class="reveal"
               style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px 28px;display:flex;align-items:center;gap:28px;text-decoration:none;transition:all 0.3s;flex-wrap:wrap;"
               onmouseover="this.style.borderColor='#33333388';this.style.background='#141414'"
               onmouseout="this.style.borderColor='#1a1a1a';this.style.background='#111'">

                {{-- Date --}}
                <div style="min-width:60px;text-align:center;flex-shrink:0;opacity:0.5;">
                    <div style="font-family:'Playfair Display',Georgia,serif;font-size:1.8rem;font-weight:900;color:#888;line-height:1;">{{ $ev->date_debut->format('d') }}</div>
                    <div style="font-family:'Space Grotesk',sans-serif;font-size:0.7rem;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:#555;">{{ $ev->date_debut->translatedFormat('M Y') }}</div>
                </div>

                {{-- Info --}}
                <div style="flex:1;min-width:180px;">
                    @if($ev->type)
                    <span class="tag tag-white" style="margin-bottom:8px;display:inline-block;opacity:0.6;">{{ ucfirst($ev->type) }}</span>
                    @endif
                    <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:600;font-size:0.95rem;color:#999;margin:0 0 6px;">{{ $ev->titre }}</h3>
                    @if($ev->lieu)
                    <p style="color:#555;font-size:0.8rem;margin:0;">{{ $ev->lieu }}</p>
                    @endif
                </div>

                {{-- Badge passé --}}
                <div style="flex-shrink:0;">
                    <span class="tag tag-white" style="opacity:0.5;">Terminé</span>
                </div>
            </a>
            @endforeach
        </div>

    </div>
</section>
@endif

@endsection
