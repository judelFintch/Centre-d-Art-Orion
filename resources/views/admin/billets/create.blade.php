@extends('layouts.admin')
@section('title', 'Nouvelle réservation')

@section('content')
<div style="max-width:820px;">

    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:12px;">
        <div>
            <a href="{{ route('admin.billets.index') }}" style="color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;">← Retour</a>
            <h2 style="font-family:'Playfair Display',serif;font-size:1.4rem;font-weight:900;color:#f5f5f0;margin:6px 0 0;">Nouvelle réservation</h2>
            <p style="color:#555;font-size:0.8rem;font-family:'Space Grotesk',sans-serif;margin:4px 0 0;">Saisie manuelle — réservation téléphonique, sur place, etc.</p>
        </div>
    </div>

    <form action="{{ route('admin.billets.store') }}" method="POST">
        @csrf
        @include('admin.billets._form')

        <div style="display:flex;gap:12px;">
            <button type="submit"
                    style="padding:11px 28px;background:linear-gradient(135deg,#4caf7d,#2d7a52);border:none;border-radius:6px;color:#0a0a0a;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;font-weight:700;cursor:pointer;transition:opacity 0.2s;"
                    onmouseover="this.style.opacity='0.88'" onmouseout="this.style.opacity='1'">
                Créer la réservation
            </button>
            <a href="{{ route('admin.billets.index') }}"
               style="padding:11px 20px;background:#111;border:1px solid #1a1a1a;color:#888;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;font-weight:600;border-radius:6px;text-decoration:none;transition:color 0.2s;"
               onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#888'">
                Annuler
            </a>
        </div>
    </form>
</div>
@endsection
