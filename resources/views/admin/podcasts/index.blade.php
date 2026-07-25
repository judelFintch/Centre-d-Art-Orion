@extends('layouts.admin')
@section('title', 'Podcasts')

@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:12px;">
    <p style="color:#555;font-size:0.82rem;font-family:'Space Grotesk',sans-serif;margin:0;">{{ $episodes->count() }} épisode(s)</p>
    <div style="display:flex;gap:10px;flex-wrap:wrap;">
        <a href="{{ route('admin.pages.podcasts') }}"
           style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:#111;border:1px solid #2a2a2a;color:#d4a030;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;border-radius:6px;">
            Modifier les sections
        </a>
        <a href="{{ route('admin.podcasts.create') }}"
           style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:linear-gradient(135deg,#4caf7d,#2d7a52);color:#fff;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;border-radius:6px;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Nouvel épisode
        </a>
    </div>
</div>

@if($episodes->isEmpty())
<div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:60px;text-align:center;">
    <p style="color:#555;font-family:'Space Grotesk',sans-serif;">Aucun épisode podcast pour l'instant.</p>
    <a href="{{ route('admin.podcasts.create') }}" style="color:#4caf7d;font-size:0.85rem;text-decoration:none;">Créer le premier épisode →</a>
</div>
@else
<div style="display:flex;flex-direction:column;gap:10px;">
    @foreach($episodes as $episode)
    <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:16px 20px;display:flex;align-items:center;gap:16px;">
        <div style="width:96px;height:64px;border-radius:4px;overflow:hidden;background:#1a1a1a;flex-shrink:0;">
            @if($episode->cover_image)
            <img src="{{ Storage::url($episode->cover_image) }}" alt="{{ $episode->title }}" style="width:100%;height:100%;object-fit:cover;">
            @else
            <div style="height:100%;display:flex;align-items:center;justify-content:center;color:#333;">◌</div>
            @endif
        </div>
        <div style="flex:1;min-width:0;">
            <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;margin-bottom:4px;">
                <span style="font-family:'Space Grotesk',sans-serif;font-size:0.65rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:{{ $episode->accent }};">{{ $episode->series ?: 'Podcast' }}</span>
                @if($episode->episode_number)<span style="font-size:0.65rem;color:#555;">EP. {{ $episode->episode_number }}</span>@endif
                @if($episode->featured)<span style="font-size:0.65rem;color:#4caf7d;">À la une</span>@endif
            </div>
            <p style="font-family:'Space Grotesk',sans-serif;font-size:0.95rem;font-weight:700;color:#f5f5f0;margin:0 0 2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $episode->title }}</p>
            <p style="color:#555;font-size:0.78rem;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $episode->excerpt }}</p>
        </div>
        <div style="flex-shrink:0;text-align:right;color:#555;font-size:0.72rem;">
            <div>{{ $episode->duration ?: 'Durée non définie' }}</div>
            <div style="margin-top:4px;color:{{ $episode->actif ? '#4caf7d' : '#555' }};">{{ $episode->actif ? '● Publié' : '○ Brouillon' }}</div>
        </div>
        <div style="display:flex;align-items:center;gap:8px;flex-shrink:0;">
            <a href="{{ route('podcasts.index') }}" target="_blank" style="color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;text-decoration:none;">Voir</a>
            <a href="{{ route('admin.podcasts.edit', $episode) }}" style="color:#d4a030;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;text-decoration:none;">Modifier</a>
            <form method="POST" action="{{ route('admin.podcasts.destroy', $episode) }}" onsubmit="return confirm('Supprimer cet épisode ?')" style="margin:0;">
                @csrf @method('DELETE')
                <button type="submit" style="background:transparent;border:0;color:#e07030;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;cursor:pointer;padding:0;">Supprimer</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endif

@endsection
