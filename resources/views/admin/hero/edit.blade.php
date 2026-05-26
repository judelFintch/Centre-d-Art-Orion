@extends('layouts.admin')
@section('title', 'Modifier — ' . $hero->title_one)

@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:10px;">
    <a href="{{ route('admin.hero.index') }}"
       style="display:inline-flex;align-items:center;gap:6px;color:#555;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;text-decoration:none;transition:color 0.2s;"
       onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#555'">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour aux slides
    </a>

    <form method="POST" action="{{ route('admin.hero.destroy', $hero) }}"
          onsubmit="return confirm('Supprimer ce slide définitivement ?')">
        @csrf @method('DELETE')
        <button type="submit"
                style="display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(224,112,48,0.1);border:1px solid rgba(224,112,48,0.25);border-radius:6px;color:#e07030;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;cursor:pointer;">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/></svg>
            Supprimer
        </button>
    </form>
</div>

<div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:28px;">

    <form method="POST" action="{{ route('admin.hero.update', $hero) }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        @include('admin.hero._form')

        <div style="margin-top:28px;padding-top:20px;border-top:1px solid #1a1a1a;display:flex;align-items:center;gap:12px;">
            <button type="submit"
                    style="display:inline-flex;align-items:center;gap:8px;padding:11px 24px;background:linear-gradient(135deg,#d4a030,#a07820);color:#fff;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;font-weight:600;border:none;border-radius:6px;cursor:pointer;transition:opacity 0.2s;"
                    onmouseover="this.style.opacity='.88'" onmouseout="this.style.opacity='1'">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                Enregistrer les modifications
            </button>
            <a href="{{ route('admin.hero.index') }}"
               style="padding:11px 20px;color:#555;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;text-decoration:none;transition:color 0.2s;"
               onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#555'">Annuler</a>
        </div>

    </form>
</div>

@endsection
