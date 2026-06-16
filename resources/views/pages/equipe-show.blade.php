@extends('layouts.app')

@section('title', $equipe->nom_complet . ' — Équipe Orion')
@section('meta_description', Str::limit($equipe->bio ?: $equipe->poste . ' au Centre d\'Art Orion.', 155))

@section('content')

@php
    $color = $equipe->role_color;
    $roleLabel = $equipe->role_label;
    $initials = strtoupper(substr($equipe->prenom, 0, 1) . substr($equipe->nom, 0, 1));
@endphp

<section style="padding:100px 0 80px;background:#0a0a0a;border-bottom:1px solid #1a1a1a;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 60% 35%,{{ $color }}18,transparent 62%);pointer-events:none;"></div>
    <div style="max-width:1180px;margin:0 auto;padding:0 24px;position:relative;z-index:1;">
        <a href="{{ route('equipe') }}" style="display:inline-flex;align-items:center;margin-bottom:28px;color:#777;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;transition:color 0.2s;"
           onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#777'">
            ← Retour à l'équipe
        </a>

        <div style="display:grid;grid-template-columns:minmax(260px,0.72fr) minmax(0,1.28fr);gap:44px;align-items:center;">
            <div style="display:flex;justify-content:center;">
                @if($equipe->photo_url)
                <img src="{{ $equipe->photo_url }}" alt="{{ $equipe->nom_complet }}" style="width:min(320px,100%);aspect-ratio:1/1;border-radius:12px;object-fit:cover;border:1px solid {{ $color }}55;box-shadow:0 20px 70px rgba(0,0,0,0.45);">
                @else
                <div aria-label="{{ $equipe->nom_complet }}" style="width:min(320px,100%);aspect-ratio:1/1;border-radius:12px;border:1px solid {{ $color }}55;background:rgba(255,255,255,0.04);display:flex;align-items:center;justify-content:center;color:{{ $color }};font-family:'Space Grotesk',sans-serif;font-size:3rem;font-weight:900;">
                    {{ $initials }}
                </div>
                @endif
            </div>

            <div>
                <span class="tag" style="background:{{ $color }}22;color:{{ $color }};margin-bottom:16px;">{{ $roleLabel }}</span>
                <h1 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2.3rem,5vw,4.4rem);font-weight:900;color:#f5f5f0;line-height:1.05;margin:0 0 16px;">
                    {{ $equipe->prenom }}<br>{{ $equipe->nom }}
                </h1>
                <p style="color:{{ $color }};font-family:'Space Grotesk',sans-serif;font-size:1rem;font-weight:700;margin:0 0 22px;">{{ $equipe->poste }}</p>
                @if($equipe->bio)
                <p style="color:#888;font-size:0.98rem;line-height:1.85;margin:0;max-width:680px;">{{ $equipe->bio }}</p>
                @endif
            </div>
        </div>
    </div>
</section>

<section style="padding:70px 0;background:#0d0d0d;">
    <div style="max-width:1180px;margin:0 auto;padding:0 24px;display:grid;grid-template-columns:minmax(0,1fr) minmax(280px,0.45fr);gap:28px;align-items:start;">
        <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:28px;">
            <h2 style="font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:800;letter-spacing:0.1em;text-transform:uppercase;color:#f5f5f0;margin:0 0 20px;">Détails</h2>

            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:14px;">
                @foreach([
                    ['Rôle', $roleLabel],
                    ['Poste', $equipe->poste],
                    ['Email', $equipe->email],
                    ['Téléphone', $equipe->telephone],
                ] as [$label, $value])
                @if($value)
                <div style="padding:16px;background:#0d0d0d;border:1px solid #1a1a1a;border-radius:6px;">
                    <p style="font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:800;letter-spacing:0.08em;text-transform:uppercase;color:#555;margin:0 0 8px;">{{ $label }}</p>
                    <p style="color:#f5f5f0;font-size:0.9rem;line-height:1.5;margin:0;overflow-wrap:anywhere;">{{ $value }}</p>
                </div>
                @endif
                @endforeach
            </div>

            @if($equipe->competences)
            <div style="margin-top:26px;">
                <h3 style="font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:800;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin:0 0 14px;">Compétences</h3>
                <div style="display:flex;gap:10px;flex-wrap:wrap;">
                    @foreach($equipe->competences as $competence)
                    <span style="display:inline-block;padding:7px 12px;background:{{ $color }}18;border:1px solid {{ $color }}44;border-radius:4px;color:{{ $color }};font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:700;">{{ $competence }}</span>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <aside style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:28px;">
            <h2 style="font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:800;letter-spacing:0.1em;text-transform:uppercase;color:#f5f5f0;margin:0 0 18px;">Contact</h2>

            @if($equipe->email)
            <a href="mailto:{{ $equipe->email }}" style="display:flex;align-items:center;gap:10px;padding:12px 0;color:#888;text-decoration:none;border-bottom:1px solid #1a1a1a;font-size:0.88rem;overflow-wrap:anywhere;">
                <span style="color:#4caf7d;">✉</span> {{ $equipe->email }}
            </a>
            @endif

            @if($equipe->telephone)
            <a href="tel:{{ preg_replace('/\s+/', '', $equipe->telephone) }}" style="display:flex;align-items:center;gap:10px;padding:12px 0;color:#888;text-decoration:none;border-bottom:1px solid #1a1a1a;font-size:0.88rem;">
                <span style="color:#d4a030;">✆</span> {{ $equipe->telephone }}
            </a>
            @endif

            @if($equipe->reseaux_sociaux)
            <div style="display:flex;gap:10px;flex-wrap:wrap;margin-top:18px;">
                @foreach($equipe->reseaux_sociaux as $rs => $url)
                <a href="{{ $url }}" target="_blank" rel="noopener" style="padding:8px 11px;background:#0d0d0d;border:1px solid #222;border-radius:4px;color:#777;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:800;text-decoration:none;text-transform:uppercase;">
                    {{ $rs }}
                </a>
                @endforeach
            </div>
            @endif

            @if(!$equipe->email && !$equipe->telephone && !$equipe->reseaux_sociaux)
            <p style="color:#555;font-size:0.86rem;line-height:1.6;margin:0;">Aucune information de contact publique pour ce membre.</p>
            @endif
        </aside>
    </div>
</section>

@endsection
