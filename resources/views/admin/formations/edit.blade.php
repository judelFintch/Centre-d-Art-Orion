@extends('layouts.admin')
@section('title', 'Modifier une formation')

@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;gap:12px;flex-wrap:wrap;">
    <a href="{{ route('admin.formations.index') }}"
       style="color:#e07030;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;">← Retour aux formations</a>
    <a href="{{ route('formations.show', $formation) }}" target="_blank"
       style="color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;">Voir sur le site →</a>
</div>

<form method="POST" action="{{ route('admin.formations.update', $formation) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.formations._form')

    <div style="display:flex;justify-content:space-between;gap:12px;margin-top:28px;padding-top:24px;border-top:1px solid #1a1a1a;flex-wrap:wrap;">
        <button type="submit"
                form="delete-formation"
                style="padding:10px 18px;background:rgba(224,112,48,0.08);border:1px solid rgba(224,112,48,0.25);color:#e07030;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:700;border-radius:6px;cursor:pointer;">
            Supprimer
        </button>
        <div style="display:flex;gap:12px;">
            <a href="{{ route('admin.formations.index') }}"
               style="padding:10px 20px;background:#111;border:1px solid #222;color:#777;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;border-radius:6px;">
                Annuler
            </a>
            <button type="submit"
                    style="padding:10px 22px;background:linear-gradient(135deg,#e07030,#b65320);border:0;color:#fff;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:700;border-radius:6px;cursor:pointer;">
                Enregistrer
            </button>
        </div>
    </div>
</form>

<form id="delete-formation" method="POST" action="{{ route('admin.formations.destroy', $formation) }}" onsubmit="return confirm('Supprimer cette formation ?')" style="display:none;">
    @csrf
    @method('DELETE')
</form>

@endsection
