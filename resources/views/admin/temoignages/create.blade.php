@extends('layouts.admin')
@section('title', 'Nouveau témoignage')

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:26px;">
    <div>
        <a href="{{ route('admin.temoignages.index') }}" style="color:#4caf7d;font-size:0.82rem;text-decoration:none;">← Retour aux témoignages</a>
        <h2 style="font-family:'Playfair Display',serif;font-size:1.4rem;margin:8px 0 0;">Nouveau témoignage</h2>
    </div>
</div>

<form method="POST" action="{{ route('admin.temoignages.store') }}" enctype="multipart/form-data">
    @csrf
    @include('admin.temoignages._form')
    <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:24px;">
        <a href="{{ route('admin.temoignages.index') }}" style="padding:10px 20px;background:#111;border:1px solid #222;color:#777;text-decoration:none;border-radius:6px;">Annuler</a>
        <button type="submit" style="padding:10px 22px;border:0;border-radius:6px;background:#4caf7d;color:#07110b;font-weight:800;cursor:pointer;">Créer le témoignage</button>
    </div>
</form>
@endsection
