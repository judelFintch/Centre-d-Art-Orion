@extends('layouts.admin')
@section('title', 'Blog — Publications')

@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:12px;">
    <p style="color:#555;font-size:0.82rem;font-family:'Space Grotesk',sans-serif;margin:0;">{{ $posts->count() }} publication(s)</p>
    <a href="{{ route('admin.blog.create') }}"
       style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:linear-gradient(135deg,#d4a030,#8f6518);color:#fff;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;border-radius:6px;">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouvelle publication
    </a>
</div>

@if($posts->isEmpty())
<div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:60px;text-align:center;">
    <p style="color:#555;font-family:'Space Grotesk',sans-serif;">Aucune publication pour l'instant.</p>
    <a href="{{ route('admin.blog.create') }}" style="color:#d4a030;font-size:0.85rem;text-decoration:none;">Créer le premier article →</a>
</div>
@else
<div style="display:flex;flex-direction:column;gap:10px;">
    @foreach($posts as $post)
    <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:16px 20px;display:flex;align-items:center;gap:16px;">
        <div style="width:96px;height:64px;border-radius:4px;overflow:hidden;background:#1a1a1a;flex-shrink:0;">
            @if($post->image)
            <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" style="width:100%;height:100%;object-fit:cover;">
            @else
            <div style="height:100%;display:flex;align-items:center;justify-content:center;color:#333;">✎</div>
            @endif
        </div>
        <div style="flex:1;min-width:0;">
            <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;margin-bottom:4px;">
                <span style="font-family:'Space Grotesk',sans-serif;font-size:0.65rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#d4a030;">{{ $post->category ?: 'Blog' }}</span>
                @if($post->featured)<span style="font-size:0.65rem;color:#4caf7d;">À la une</span>@endif
                <span style="font-size:0.65rem;color:#444;">ordre {{ $post->ordre }}</span>
            </div>
            <p style="font-family:'Space Grotesk',sans-serif;font-size:0.95rem;font-weight:700;color:#f5f5f0;margin:0 0 2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $post->title }}</p>
            <p style="color:#555;font-size:0.78rem;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $post->excerpt }}</p>
        </div>
        <div style="flex-shrink:0;text-align:right;color:#555;font-size:0.72rem;">
            <div>{{ optional($post->published_at)->format('d/m/Y') ?: 'Non daté' }}</div>
            <div style="margin-top:4px;color:{{ $post->actif ? '#4caf7d' : '#555' }};">{{ $post->actif ? '● Publié' : '○ Brouillon' }}</div>
        </div>
        <div style="display:flex;align-items:center;gap:8px;flex-shrink:0;">
            @if($post->actif)
            <a href="{{ route('blog.show', $post->slug) }}" target="_blank" style="color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;text-decoration:none;">Voir</a>
            @endif
            <a href="{{ route('admin.blog.edit', $post) }}" style="color:#d4a030;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;text-decoration:none;">Modifier</a>
            <form method="POST" action="{{ route('admin.blog.destroy', $post) }}" onsubmit="return confirm('Supprimer cette publication ?')" style="margin:0;">
                @csrf @method('DELETE')
                <button type="submit" style="background:transparent;border:0;color:#e07030;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;cursor:pointer;padding:0;">Supprimer</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endif

@endsection
