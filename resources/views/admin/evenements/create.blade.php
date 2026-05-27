@extends('layouts.admin')
@section('title', 'Nouvel événement')

@section('content')

<div style="display:flex;align-items:center;gap:16px;margin-bottom:28px;flex-wrap:wrap;">
    <a href="{{ route('admin.evenements.index') }}"
       style="color:#555;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;text-decoration:none;display:flex;align-items:center;gap:6px;transition:color 0.2s;"
       onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#555'">
        ← Retour
    </a>
    <span style="color:#2a2a2a;">|</span>
    <h2 style="font-family:'Playfair Display',serif;font-size:1.4rem;font-weight:900;color:#f5f5f0;margin:0;">Nouvel événement</h2>
</div>

<form action="{{ route('admin.evenements.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    @include('admin.evenements._form')

    <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:24px;padding-top:24px;border-top:1px solid #1a1a1a;">
        <a href="{{ route('admin.evenements.index') }}"
           style="padding:11px 22px;background:#111;border:1px solid #2a2a2a;color:#888;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;font-weight:600;text-decoration:none;border-radius:6px;transition:all 0.2s;"
           onmouseover="this.style.borderColor='#444';this.style.color='#f5f5f0'" onmouseout="this.style.borderColor='#2a2a2a';this.style.color='#888'">
            Annuler
        </a>
        <button type="submit"
                style="padding:11px 28px;background:linear-gradient(135deg,#e07030,#c05020);color:#fff;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;font-weight:700;border:none;border-radius:6px;cursor:pointer;transition:opacity 0.2s;"
                onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
            Créer l'événement
        </button>
    </div>
</form>

@endsection
