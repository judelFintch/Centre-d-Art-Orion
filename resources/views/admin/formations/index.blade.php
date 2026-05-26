@extends('layouts.admin')
@section('title', 'Formations')

@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:12px;">
    <div>
        <p style="color:#555;font-size:0.82rem;font-family:'Space Grotesk',sans-serif;margin:0;">
            {{ $formations->count() }} formation(s) enregistrée(s)
        </p>
    </div>
    <a href="{{ route('admin.formations.create') }}"
       style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:linear-gradient(135deg,#e07030,#b65320);color:#fff;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;border-radius:6px;transition:opacity 0.2s;"
       onmouseover="this.style.opacity='.88'" onmouseout="this.style.opacity='1'">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouvelle formation
    </a>
</div>

@if($formations->isEmpty())
<div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:60px;text-align:center;">
    <p style="color:#555;font-family:'Space Grotesk',sans-serif;">Aucune formation pour l'instant.</p>
    <a href="{{ route('admin.formations.create') }}" style="color:#e07030;font-size:0.85rem;text-decoration:none;">Créer la première formation →</a>
</div>
@else
<div style="display:flex;flex-direction:column;gap:10px;">
    @foreach($formations as $formation)
    <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:16px 20px;display:flex;align-items:center;gap:16px;">
        <div style="width:84px;height:56px;border-radius:4px;overflow:hidden;background:#1a1a1a;flex-shrink:0;">
            @if($formation->image)
            <img src="{{ Storage::url($formation->image) }}" alt="{{ $formation->titre }}" style="width:100%;height:100%;object-fit:cover;">
            @else
            <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#333;font-size:1.2rem;">◉</div>
            @endif
        </div>

        <div style="flex:1;min-width:0;">
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:4px;flex-wrap:wrap;">
                <span style="font-family:'Space Grotesk',sans-serif;font-size:0.65rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#e07030;">{{ $formation->categorie ?: 'Formation' }}</span>
                <span style="font-family:'Space Grotesk',sans-serif;font-size:0.65rem;color:#333;">ordre {{ $formation->ordre }}</span>
                @if($formation->niveau)
                <span style="font-family:'Space Grotesk',sans-serif;font-size:0.65rem;color:#555;">{{ $formation->niveau }}</span>
                @endif
            </div>
            <p style="font-family:'Space Grotesk',sans-serif;font-size:0.95rem;font-weight:700;color:#f5f5f0;margin:0 0 2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                {{ $formation->titre }}
            </p>
            <p style="color:#555;font-size:0.78rem;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $formation->description }}</p>
        </div>

        <div style="flex-shrink:0;text-align:right;min-width:90px;">
            @if($formation->prix)
            <div style="color:#d4a030;font-family:'Space Grotesk',sans-serif;font-size:0.9rem;font-weight:700;">${{ number_format($formation->prix, 0) }}</div>
            @else
            <div style="color:#555;font-size:0.78rem;">Sur devis</div>
            @endif
            @if($formation->duree)
            <div style="color:#555;font-size:0.72rem;margin-top:2px;">{{ $formation->duree }}</div>
            @endif
        </div>

        <div style="flex-shrink:0;">
            <span style="padding:5px 12px;border-radius:100px;border:1px solid {{ $formation->actif ? '#4caf7d44' : '#33333388' }};background:{{ $formation->actif ? 'rgba(76,175,125,0.1)' : 'rgba(255,255,255,0.03)' }};color:{{ $formation->actif ? '#4caf7d' : '#555' }};font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:600;">
                {{ $formation->actif ? '● Actif' : '○ Inactif' }}
            </span>
        </div>

        <div style="display:flex;align-items:center;gap:8px;flex-shrink:0;">
            <a href="{{ route('formations.show', $formation) }}" target="_blank"
               style="display:flex;align-items:center;gap:6px;padding:7px 12px;background:rgba(76,175,125,0.08);border:1px solid rgba(76,175,125,0.2);border-radius:6px;color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;text-decoration:none;">
                Voir
            </a>
            <a href="{{ route('admin.formations.edit', $formation) }}"
               style="display:flex;align-items:center;gap:6px;padding:7px 14px;background:rgba(212,160,48,0.1);border:1px solid rgba(212,160,48,0.2);border-radius:6px;color:#d4a030;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;text-decoration:none;">
                Modifier
            </a>
            <form method="POST" action="{{ route('admin.formations.destroy', $formation) }}" onsubmit="return confirm('Supprimer cette formation ?')" style="margin:0;">
                @csrf @method('DELETE')
                <button type="submit"
                        style="display:flex;align-items:center;gap:6px;padding:7px 14px;background:rgba(224,112,48,0.08);border:1px solid rgba(224,112,48,0.2);border-radius:6px;color:#e07030;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;cursor:pointer;">
                    Supprimer
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endif

@endsection
