@extends('layouts.admin')
@section('title', 'Hero — Slides')

@section('content')

{{-- Header --}}
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:12px;">
    <div>
        <p style="color:#555;font-size:0.82rem;font-family:'Space Grotesk',sans-serif;margin:0;">
            {{ $slides->count() }} slide(s) — glisser-déposer pour réordonner
        </p>
    </div>
    <a href="{{ route('admin.hero.create') }}"
       style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:linear-gradient(135deg,#4caf7d,#2d7a52);color:#fff;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;border-radius:6px;transition:opacity 0.2s;"
       onmouseover="this.style.opacity='.88'" onmouseout="this.style.opacity='1'">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouveau slide
    </a>
</div>

@if($slides->isEmpty())
<div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:60px;text-align:center;">
    <p style="color:#555;font-family:'Space Grotesk',sans-serif;">Aucun slide pour l'instant.</p>
    <a href="{{ route('admin.hero.create') }}" style="color:#4caf7d;font-size:0.85rem;text-decoration:none;">Créer le premier slide →</a>
</div>
@else

{{-- Liste réordonnée --}}
<div id="slides-list" style="display:flex;flex-direction:column;gap:10px;">
    @foreach($slides as $slide)
    <div class="slide-row" data-id="{{ $slide->id }}"
         style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:16px 20px;display:flex;align-items:center;gap:16px;transition:border-color 0.2s;cursor:grab;">

        {{-- Poignée drag --}}
        <div class="drag-handle" style="color:#333;cursor:grab;flex-shrink:0;padding:4px;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><circle cx="9" cy="5" r="1.5"/><circle cx="9" cy="12" r="1.5"/><circle cx="9" cy="19" r="1.5"/><circle cx="15" cy="5" r="1.5"/><circle cx="15" cy="12" r="1.5"/><circle cx="15" cy="19" r="1.5"/></svg>
        </div>

        {{-- Aperçu image --}}
        <div style="width:80px;height:52px;border-radius:4px;overflow:hidden;background:#1a1a1a;flex-shrink:0;position:relative;">
            @if($slide->image)
            <img src="{{ Storage::url($slide->image) }}" style="width:100%;height:100%;object-fit:cover;">
            @else
            <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:1.2rem;color:#333;">◈</div>
            @endif
            {{-- Accent bar --}}
            <div style="position:absolute;bottom:0;left:0;right:0;height:3px;background:{{ $slide->accent }};"></div>
        </div>

        {{-- Infos --}}
        <div style="flex:1;min-width:0;">
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:4px;flex-wrap:wrap;">
                <span style="font-family:'Space Grotesk',sans-serif;font-size:0.65rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:{{ $slide->accent }};">{{ $slide->label }}</span>
                <span style="font-family:'Space Grotesk',sans-serif;font-size:0.65rem;color:#333;">ordre {{ $slide->ordre }}</span>
            </div>
            <p style="font-family:'Playfair Display',serif;font-size:0.95rem;font-weight:700;color:#f5f5f0;margin:0 0 2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                {{ $slide->title_one }} / {{ $slide->title_two }}
            </p>
            <p style="color:#555;font-size:0.78rem;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $slide->lead }}</p>
        </div>

        {{-- Statut --}}
        <div style="flex-shrink:0;">
            <form method="POST" action="{{ route('admin.hero.toggle', $slide) }}">
                @csrf @method('PATCH')
                <button type="submit"
                        style="padding:5px 12px;border-radius:100px;border:1px solid {{ $slide->actif ? '#4caf7d44' : '#33333388' }};background:{{ $slide->actif ? 'rgba(76,175,125,0.1)' : 'rgba(255,255,255,0.03)' }};color:{{ $slide->actif ? '#4caf7d' : '#555' }};font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:600;cursor:pointer;transition:all 0.2s;">
                    {{ $slide->actif ? '● Actif' : '○ Inactif' }}
                </button>
            </form>
        </div>

        {{-- Actions --}}
        <div style="display:flex;align-items:center;gap:8px;flex-shrink:0;">
            <a href="{{ route('admin.hero.edit', $slide) }}"
               style="display:flex;align-items:center;gap:6px;padding:7px 14px;background:rgba(212,160,48,0.1);border:1px solid rgba(212,160,48,0.2);border-radius:6px;color:#d4a030;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;text-decoration:none;transition:all 0.2s;"
               onmouseover="this.style.background='rgba(212,160,48,0.18)'" onmouseout="this.style.background='rgba(212,160,48,0.1)'">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                Modifier
            </a>
            <form method="POST" action="{{ route('admin.hero.destroy', $slide) }}"
                  onsubmit="return confirm('Supprimer ce slide ?')">
                @csrf @method('DELETE')
                <button type="submit"
                        style="display:flex;align-items:center;gap:6px;padding:7px 14px;background:rgba(224,112,48,0.08);border:1px solid rgba(224,112,48,0.2);border-radius:6px;color:#e07030;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;cursor:pointer;transition:all 0.2s;"
                        onmouseover="this.style.background='rgba(224,112,48,0.16)'" onmouseout="this.style.background='rgba(224,112,48,0.08)'">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                    Supprimer
                </button>
            </form>
        </div>

    </div>
    @endforeach
</div>

{{-- Aperçu live --}}
<div style="margin-top:24px;background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:20px;">
    <p style="font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;color:#555;margin:0 0 14px;text-transform:uppercase;letter-spacing:0.08em;">Aperçu du hero</p>
    <a href="{{ route('home') }}#hc-section" target="_blank"
       style="display:inline-flex;align-items:center;gap:8px;color:#4caf7d;font-size:0.85rem;font-family:'Space Grotesk',sans-serif;text-decoration:none;">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg>
        Voir le hero sur le site →
    </a>
</div>

@endif

{{-- Drag & drop reorder --}}
<script>
(function() {
    const list = document.getElementById('slides-list');
    if (!list) return;

    let dragging = null;

    list.querySelectorAll('.slide-row').forEach(row => {
        row.addEventListener('dragstart', e => { dragging = row; row.style.opacity = '.4'; });
        row.addEventListener('dragend',   e => { dragging = null; row.style.opacity = '1'; saveOrder(); });
        row.addEventListener('dragover',  e => { e.preventDefault(); if (dragging && dragging !== row) { const rect = row.getBoundingClientRect(); const mid = rect.top + rect.height / 2; list.insertBefore(dragging, e.clientY < mid ? row : row.nextSibling); } });
        row.setAttribute('draggable', 'true');
    });

    function saveOrder() {
        const ids = [...list.querySelectorAll('.slide-row')].map(r => r.dataset.id);
        fetch('{{ route('admin.hero.reorder') }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content },
            body: JSON.stringify({ ordre: ids }),
        });
    }
})();
</script>

@endsection
