@extends('layouts.admin')
@section('title', 'Modifier un épisode podcast')

@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;gap:12px;flex-wrap:wrap;">
    <a href="{{ route('admin.podcasts.index') }}" style="color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;">← Retour aux podcasts</a>
    <a href="{{ route('podcasts.index') }}" target="_blank" style="color:#d4a030;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;">Voir sur le site →</a>
</div>

<form method="POST" action="{{ route('admin.podcasts.update', $podcast) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.podcasts._form')

    <div style="display:flex;justify-content:space-between;gap:12px;margin-top:28px;padding-top:24px;border-top:1px solid #1a1a1a;flex-wrap:wrap;">
        <button type="submit" form="delete-podcast" style="padding:10px 18px;background:rgba(224,112,48,0.08);border:1px solid rgba(224,112,48,0.25);color:#e07030;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:700;border-radius:6px;cursor:pointer;">Supprimer</button>
        <div style="display:flex;gap:12px;">
            <a href="{{ route('admin.podcasts.index') }}" style="padding:10px 20px;background:#111;border:1px solid #222;color:#777;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;border-radius:6px;">Annuler</a>
            <button type="submit" style="padding:10px 22px;background:linear-gradient(135deg,#4caf7d,#2d7a52);border:0;color:#fff;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:700;border-radius:6px;cursor:pointer;">Enregistrer</button>
        </div>
    </div>
</form>

<form id="delete-podcast" method="POST" action="{{ route('admin.podcasts.destroy', $podcast) }}" onsubmit="return confirm('Supprimer cet épisode ?')" style="display:none;">
    @csrf
    @method('DELETE')
</form>

@endsection
