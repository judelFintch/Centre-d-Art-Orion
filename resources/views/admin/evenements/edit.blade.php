@extends('layouts.admin')
@section('title', 'Modifier — ' . $evenement->titre)

@section('content')

<div style="display:flex;align-items:center;gap:16px;margin-bottom:28px;flex-wrap:wrap;">
    <a href="{{ route('admin.evenements.index') }}"
       style="color:#555;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;text-decoration:none;display:flex;align-items:center;gap:6px;transition:color 0.2s;"
       onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#555'">
        ← Retour
    </a>
    <span style="color:#2a2a2a;">|</span>
    <h2 style="font-family:'Playfair Display',serif;font-size:1.4rem;font-weight:900;color:#f5f5f0;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:500px;">
        {{ $evenement->titre }}
    </h2>
    @if($evenement->actif)
    <a href="{{ route('evenements.show', $evenement) }}" target="_blank"
       style="margin-left:auto;color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;text-decoration:none;white-space:nowrap;">
        Voir sur le site ↗
    </a>
    @endif
</div>

<form action="{{ route('admin.evenements.update', $evenement) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @include('admin.evenements._form')

    <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;margin-top:24px;padding-top:24px;border-top:1px solid #1a1a1a;flex-wrap:wrap;">

        {{-- Supprimer --}}
        <form action="{{ route('admin.evenements.destroy', $evenement) }}" method="POST"
              onsubmit="return confirm('Supprimer définitivement cet événement ?')" style="margin:0;">
            @csrf @method('DELETE')
            <button type="submit"
                    style="padding:10px 18px;background:rgba(224,112,48,0.08);border:1px solid rgba(224,112,48,0.2);color:#e07030;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;cursor:pointer;border-radius:6px;transition:all 0.2s;"
                    onmouseover="this.style.background='rgba(224,112,48,0.16)'" onmouseout="this.style.background='rgba(224,112,48,0.08)'">
                Supprimer l'événement
            </button>
        </form>

        <div style="display:flex;gap:12px;">
            <a href="{{ route('admin.evenements.index') }}"
               style="padding:11px 22px;background:#111;border:1px solid #2a2a2a;color:#888;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;font-weight:600;text-decoration:none;border-radius:6px;transition:all 0.2s;"
               onmouseover="this.style.borderColor='#444';this.style.color='#f5f5f0'" onmouseout="this.style.borderColor='#2a2a2a';this.style.color='#888'">
                Annuler
            </a>
            <button type="submit"
                    style="padding:11px 28px;background:linear-gradient(135deg,#e07030,#c05020);color:#fff;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;font-weight:700;border:none;border-radius:6px;cursor:pointer;transition:opacity 0.2s;"
                    onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
                Enregistrer les modifications
            </button>
        </div>

    </div>
</form>

@endsection
