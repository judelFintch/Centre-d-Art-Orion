@extends('layouts.admin')
@section('title', 'Nouveau slide hero')

@section('content')

<div style="margin-bottom:20px;">
    <a href="{{ route('admin.hero.index') }}"
       style="display:inline-flex;align-items:center;gap:6px;color:#555;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;text-decoration:none;transition:color 0.2s;"
       onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#555'">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour aux slides
    </a>
</div>

<div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:28px;">

    <form method="POST" action="{{ route('admin.hero.store') }}" enctype="multipart/form-data">
        @csrf

        @include('admin.hero._form')

        <div style="margin-top:28px;padding-top:20px;border-top:1px solid #1a1a1a;display:flex;align-items:center;gap:12px;">
            <button type="submit"
                    style="display:inline-flex;align-items:center;gap:8px;padding:11px 24px;background:linear-gradient(135deg,#4caf7d,#2d7a52);color:#fff;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;font-weight:600;border:none;border-radius:6px;cursor:pointer;transition:opacity 0.2s;"
                    onmouseover="this.style.opacity='.88'" onmouseout="this.style.opacity='1'">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                Créer le slide
            </button>
            <a href="{{ route('admin.hero.index') }}"
               style="padding:11px 20px;color:#555;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;text-decoration:none;transition:color 0.2s;"
               onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#555'">Annuler</a>
        </div>

    </form>
</div>

@endsection
