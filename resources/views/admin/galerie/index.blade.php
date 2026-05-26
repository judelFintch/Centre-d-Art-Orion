@extends('layouts.admin')
@section('title', 'Galerie')

@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:12px;">
    <div>
        <p style="color:#555;font-size:0.82rem;font-family:'Space Grotesk',sans-serif;margin:0;">
            {{ $items->count() }} élément(s) dans la galerie
        </p>
    </div>
    <a href="{{ route('admin.galerie.create') }}"
       style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:linear-gradient(135deg,#4caf7d,#2d7a52);color:#fff;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;border-radius:6px;">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouvel élément
    </a>
</div>

@if($items->isEmpty())
<div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:60px;text-align:center;">
    <p style="color:#555;font-family:'Space Grotesk',sans-serif;">Aucun élément dans la galerie.</p>
    <a href="{{ route('admin.galerie.create') }}" style="color:#4caf7d;font-size:0.85rem;text-decoration:none;">Ajouter le premier élément →</a>
</div>
@else
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:16px;">
    @foreach($items as $item)
    <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;overflow:hidden;">
        <div style="height:160px;background:#1a1a1a;position:relative;">
            @if($item->type === 'video')
            <div style="height:100%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#161616,#0d0d0d);">
                <div style="width:52px;height:52px;border-radius:50%;background:rgba(212,160,48,0.18);border:1px solid rgba(212,160,48,0.35);display:flex;align-items:center;justify-content:center;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="#d4a030"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                </div>
            </div>
            @elseif($item->fichier && Storage::disk('public')->exists($item->fichier))
            <img src="{{ Storage::url($item->fichier) }}" alt="{{ $item->titre }}" style="width:100%;height:100%;object-fit:cover;">
            @else
            <div style="height:100%;display:flex;align-items:center;justify-content:center;color:#333;font-size:1.4rem;">◧</div>
            @endif
            <div style="position:absolute;left:10px;bottom:10px;display:flex;gap:6px;flex-wrap:wrap;">
                <span style="padding:4px 8px;background:rgba(0,0,0,0.65);border:1px solid rgba(255,255,255,0.1);border-radius:4px;color:{{ $item->type === 'video' ? '#d4a030' : '#4caf7d' }};font-size:0.68rem;font-family:'Space Grotesk',sans-serif;text-transform:uppercase;">{{ $item->type }}</span>
                @if($item->categorie)
                <span style="padding:4px 8px;background:rgba(0,0,0,0.65);border:1px solid rgba(255,255,255,0.1);border-radius:4px;color:#ccc;font-size:0.68rem;font-family:'Space Grotesk',sans-serif;text-transform:uppercase;">{{ $item->categorie }}</span>
                @endif
            </div>
        </div>
        <div style="padding:16px;">
            <div style="display:flex;justify-content:space-between;gap:12px;margin-bottom:8px;">
                <h3 style="font-family:'Space Grotesk',sans-serif;font-size:0.95rem;font-weight:700;color:#f5f5f0;margin:0;line-height:1.35;">{{ $item->titre }}</h3>
                <span style="color:#444;font-size:0.72rem;flex-shrink:0;">#{{ $item->ordre }}</span>
            </div>
            <p style="color:#555;font-size:0.78rem;line-height:1.5;margin:0 0 14px;min-height:36px;">{{ Str::limit($item->description ?: 'Aucune description', 80) }}</p>
            <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;">
                <span style="padding:5px 10px;border-radius:100px;border:1px solid {{ $item->actif ? '#4caf7d44' : '#33333388' }};background:{{ $item->actif ? 'rgba(76,175,125,0.1)' : 'rgba(255,255,255,0.03)' }};color:{{ $item->actif ? '#4caf7d' : '#555' }};font-family:'Space Grotesk',sans-serif;font-size:0.7rem;font-weight:600;">
                    {{ $item->actif ? '● Actif' : '○ Inactif' }}
                </span>
                <div style="display:flex;gap:8px;">
                    <a href="{{ route('admin.galerie.edit', $item) }}" style="color:#d4a030;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;text-decoration:none;">Modifier</a>
                    <form method="POST" action="{{ route('admin.galerie.destroy', $item) }}" onsubmit="return confirm('Supprimer cet élément ?')" style="margin:0;">
                        @csrf @method('DELETE')
                        <button type="submit" style="background:transparent;border:0;color:#e07030;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;cursor:pointer;padding:0;">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

@endsection
