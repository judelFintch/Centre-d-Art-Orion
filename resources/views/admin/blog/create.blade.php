@extends('layouts.admin')
@section('title', 'Nouvelle publication')

@section('content')

<div style="margin-bottom:24px;">
    <a href="{{ route('admin.blog.index') }}" style="color:#d4a030;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;">← Retour au blog</a>
</div>

<form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data">
    @csrf
    @include('admin.blog._form')

    <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:28px;padding-top:24px;border-top:1px solid #1a1a1a;">
        <a href="{{ route('admin.blog.index') }}" style="padding:10px 20px;background:#111;border:1px solid #222;color:#777;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;border-radius:6px;">Annuler</a>
        <button type="submit" style="padding:10px 22px;background:linear-gradient(135deg,#d4a030,#8f6518);border:0;color:#fff;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:700;border-radius:6px;cursor:pointer;">Publier</button>
    </div>
</form>

@endsection
