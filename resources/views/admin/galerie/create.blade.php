@extends('layouts.admin')
@section('title', 'Nouvel élément galerie')

@section('content')

<div style="margin-bottom:24px;">
    <a href="{{ route('admin.galerie.index') }}" style="color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;">← Retour à la galerie</a>
</div>

<form method="POST" action="{{ route('admin.galerie.store') }}" enctype="multipart/form-data">
    @csrf
    @include('admin.galerie._form')

    <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:28px;padding-top:24px;border-top:1px solid #1a1a1a;">
        <a href="{{ route('admin.galerie.index') }}" style="padding:10px 20px;background:#111;border:1px solid #222;color:#777;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;border-radius:6px;">Annuler</a>
        <button type="submit" style="padding:10px 22px;background:linear-gradient(135deg,#4caf7d,#2d7a52);border:0;color:#fff;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:700;border-radius:6px;cursor:pointer;">Ajouter</button>
    </div>
</form>

@endsection
