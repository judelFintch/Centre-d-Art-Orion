@extends('layouts.admin')
@section('title', 'Modifier — ' . $billet->reference)

@section('content')
<div style="max-width:820px;">

    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:12px;">
        <div>
            <a href="{{ route('admin.billets.show', $billet) }}" style="color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;">← {{ $billet->reference }}</a>
            <h2 style="font-family:'Playfair Display',serif;font-size:1.4rem;font-weight:900;color:#f5f5f0;margin:6px 0 0;">Modifier la réservation</h2>
            <p style="color:#555;font-size:0.8rem;font-family:'Space Grotesk',sans-serif;margin:4px 0 0;">
                {{ $billet->prenom }} {{ $billet->nom }}
                @if($billet->evenement) · {{ $billet->evenement->titre }} @endif
            </p>
        </div>
    </div>

    {{-- Référence (lecture seule) --}}
    <div style="display:flex;align-items:center;gap:10px;padding:10px 16px;background:#111;border:1px solid #1a1a1a;border-radius:8px;margin-bottom:16px;">
        <span style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;">Référence</span>
        <span style="font-family:'Space Grotesk',sans-serif;font-size:0.95rem;font-weight:700;color:#4caf7d;letter-spacing:0.06em;">{{ $billet->reference }}</span>
        <span style="color:#333;font-size:0.72rem;margin-left:auto;">Créée le {{ $billet->created_at->format('d/m/Y à H:i') }}</span>
    </div>

    <form action="{{ route('admin.billets.update', $billet) }}" method="POST">
        @csrf @method('PUT')
        @include('admin.billets._form')

        <div style="display:flex;gap:12px;flex-wrap:wrap;">
            <button type="submit"
                    style="padding:11px 28px;background:linear-gradient(135deg,#4caf7d,#2d7a52);border:none;border-radius:6px;color:#0a0a0a;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;font-weight:700;cursor:pointer;transition:opacity 0.2s;"
                    onmouseover="this.style.opacity='0.88'" onmouseout="this.style.opacity='1'">
                Enregistrer les modifications
            </button>
            <a href="{{ route('admin.billets.show', $billet) }}"
               style="padding:11px 20px;background:#111;border:1px solid #1a1a1a;color:#888;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;font-weight:600;border-radius:6px;text-decoration:none;transition:color 0.2s;"
               onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#888'">
                Annuler
            </a>
        </div>
    </form>
</div>
@endsection
