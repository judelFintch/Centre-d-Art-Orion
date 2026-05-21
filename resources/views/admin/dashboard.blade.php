@extends('layouts.admin')
@section('title', 'Tableau de bord')

@section('content')

{{-- Stats Cards --}}
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:16px;margin-bottom:32px;">
    @foreach([
        ['Formations',  $stats['formations'], '#4caf7d', '◉', route('admin.formations.index')],
        ['Événements',  $stats['evenements'], '#d4a030', '◎', route('admin.evenements.index')],
        ['Galerie',     $stats['galerie'],    '#e07030', '◧', route('admin.galerie.index')],
        ['Membres',     $stats['membres'],    '#4caf7d', '◈', route('admin.equipe.index')],
        ['Messages',    $stats['messages'],   '#d4a030', '✉', route('admin.messages.index')],
        ['Non lus',     $stats['non_lus'],    '#e07030', '!', route('admin.messages.index')],
    ] as $s)
    <a href="{{ $s[4] }}"
       style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:20px;display:block;text-decoration:none;transition:all 0.2s;"
       onmouseover="this.style.borderColor='{{ $s[2] }}44';this.style.background='#141414'"
       onmouseout="this.style.borderColor='#1a1a1a';this.style.background='#111'">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
            <span style="font-size:0.65rem;font-family:'Space Grotesk',sans-serif;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#555;">{{ $s[0] }}</span>
            <span style="font-size:0.7rem;color:{{ $s[2] }};">{{ $s[3] }}</span>
        </div>
        <div style="font-family:'Playfair Display',serif;font-size:2rem;font-weight:900;color:{{ $s[2] }};line-height:1;">{{ $s[1] }}</div>
    </a>
    @endforeach
</div>

{{-- Actions rapides --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-bottom:32px;">
    <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;">
        <h2 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.85rem;letter-spacing:0.08em;text-transform:uppercase;color:#f5f5f0;margin:0 0 16px;">Actions rapides</h2>
        <div style="display:flex;flex-direction:column;gap:10px;">
            @foreach([
                [route('admin.formations.create'),'Nouvelle formation','#4caf7d'],
                [route('admin.evenements.create'), 'Nouvel événement', '#d4a030'],
                [route('admin.galerie.create'),    'Ajouter une photo','#e07030'],
                [route('admin.equipe.create'),     'Nouveau membre',   '#4caf7d'],
            ] as $action)
            <a href="{{ $action[0] }}"
               style="display:flex;align-items:center;gap:10px;padding:10px 14px;background:rgba(255,255,255,0.03);border:1px solid #1a1a1a;border-radius:6px;text-decoration:none;color:{{ $action[2] }};font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;transition:all 0.2s;"
               onmouseover="this.style.background='rgba(255,255,255,0.06)';this.style.borderColor='{{ $action[2] }}33'"
               onmouseout="this.style.background='rgba(255,255,255,0.03)';this.style.borderColor='#1a1a1a'">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                {{ $action[1] }}
            </a>
            @endforeach
        </div>
    </div>

    {{-- Derniers messages --}}
    <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;">
        <h2 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.85rem;letter-spacing:0.08em;text-transform:uppercase;color:#f5f5f0;margin:0 0 16px;">
            Derniers messages
            @if($stats['non_lus'] > 0)
            <span style="display:inline-block;background:#e07030;color:#fff;font-size:0.65rem;padding:2px 7px;border-radius:100px;margin-left:8px;vertical-align:middle;">{{ $stats['non_lus'] }} non lus</span>
            @endif
        </h2>
        @if($derniers_messages->isEmpty())
        <p style="color:#555;font-size:0.82rem;">Aucun message reçu.</p>
        @else
        <div style="display:flex;flex-direction:column;gap:10px;">
            @foreach($derniers_messages as $msg)
            <a href="{{ route('admin.messages.show', $msg) }}"
               style="display:flex;align-items:center;justify-content:space-between;gap:12px;padding:10px 12px;background:rgba(255,255,255,0.02);border:1px solid {{ $msg->statut === 'non_lu' ? '#e0703022' : '#1a1a1a' }};border-radius:6px;text-decoration:none;transition:all 0.2s;"
               onmouseover="this.style.background='rgba(255,255,255,0.05)'" onmouseout="this.style.background='rgba(255,255,255,0.02)'">
                <div>
                    <p style="font-family:'Space Grotesk',sans-serif;font-weight:600;font-size:0.82rem;color:#f5f5f0;margin:0 0 2px;">{{ $msg->nom }}</p>
                    <p style="color:#555;font-size:0.75rem;margin:0;">{{ Str::limit($msg->sujet, 30) }}</p>
                </div>
                <div style="text-align:right;flex-shrink:0;">
                    <p style="color:#555;font-size:0.72rem;margin:0 0 3px;">{{ $msg->created_at->diffForHumans() }}</p>
                    @if($msg->statut === 'non_lu')
                    <span style="display:inline-block;width:8px;height:8px;border-radius:50%;background:#e07030;"></span>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
        <div style="margin-top:14px;">
            <a href="{{ route('admin.messages.index') }}" style="color:#4caf7d;font-size:0.78rem;font-family:'Space Grotesk',sans-serif;font-weight:600;text-decoration:none;">Voir tous les messages →</a>
        </div>
        @endif
    </div>
</div>

@endsection
