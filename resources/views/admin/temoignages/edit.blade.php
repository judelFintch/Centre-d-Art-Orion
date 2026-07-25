@extends('layouts.admin')
@section('title', 'Modifier le témoignage')

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:26px;">
    <div>
        <a href="{{ route('admin.temoignages.index') }}" style="color:#4caf7d;font-size:0.82rem;text-decoration:none;">← Retour aux témoignages</a>
        <h2 style="font-family:'Playfair Display',serif;font-size:1.4rem;margin:8px 0 0;">Modifier — {{ $temoignage->auteur }}</h2>
    </div>
</div>

<form method="POST" action="{{ route('admin.temoignages.update', $temoignage) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.temoignages._form')
    <div style="display:flex;justify-content:space-between;gap:10px;margin-top:24px;">
        <button type="submit" form="delete-testimonial" style="padding:10px 18px;background:rgba(224,112,48,0.08);border:1px solid rgba(224,112,48,0.25);color:#e07030;border-radius:6px;cursor:pointer;">Supprimer</button>
        <div style="display:flex;gap:10px;">
            <a href="{{ route('admin.temoignages.index') }}" style="padding:10px 20px;background:#111;border:1px solid #222;color:#777;text-decoration:none;border-radius:6px;">Annuler</a>
            <button type="submit" style="padding:10px 22px;border:0;border-radius:6px;background:#4caf7d;color:#07110b;font-weight:800;cursor:pointer;">Enregistrer</button>
        </div>
    </div>
</form>

<form id="delete-testimonial" method="POST" action="{{ route('admin.temoignages.destroy', $temoignage) }}" onsubmit="return confirm('Supprimer définitivement ce témoignage ?')" style="display:none;">
    @csrf
    @method('DELETE')
</form>
@endsection
