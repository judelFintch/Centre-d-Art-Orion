@extends('layouts.admin')
@section('title', 'Nouvel épisode podcast')

@section('content')

<div style="margin-bottom:24px;">
    <a href="{{ route('admin.podcasts.index') }}" style="color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;">← Retour aux podcasts</a>
</div>

<form method="POST" action="{{ route('admin.podcasts.store') }}" enctype="multipart/form-data">
    @csrf
    @include('admin.podcasts._form')

    <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:28px;padding-top:24px;border-top:1px solid #1a1a1a;">
        <a href="{{ route('admin.podcasts.index') }}" style="padding:10px 20px;background:#111;border:1px solid #222;color:#777;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;border-radius:6px;">Annuler</a>
        <button type="submit" style="padding:10px 22px;background:linear-gradient(135deg,#4caf7d,#2d7a52);border:0;color:#fff;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:700;border-radius:6px;cursor:pointer;">Créer l'épisode</button>
    </div>
</form>

@endsection
