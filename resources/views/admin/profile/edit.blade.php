@extends('layouts.admin')
@section('title', 'Mon profil')

@section('content')

@php $fs = "width:100%;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.88rem;outline:none;box-sizing:border-box;"; @endphp

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:12px;">
    <div>
        <h2 style="font-family:'Playfair Display',serif;font-size:1.5rem;font-weight:900;color:#f5f5f0;margin:0;">Mon profil</h2>
        <p style="color:#555;font-size:0.82rem;margin:4px 0 0;font-family:'Space Grotesk',sans-serif;">Gérez les informations de connexion du compte administrateur.</p>
    </div>
</div>

@if($errors->any())
<div style="background:rgba(224,112,48,0.1);border:1px solid rgba(224,112,48,0.3);border-radius:6px;padding:14px 18px;margin-bottom:20px;color:#e07030;font-size:0.85rem;font-family:'Space Grotesk',sans-serif;">
    <ul style="margin:0;padding-left:18px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<form action="{{ route('admin.profile.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div style="display:grid;grid-template-columns:minmax(0,1.2fr) minmax(300px,0.8fr);gap:24px;align-items:start;">

        <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:28px;display:flex;flex-direction:column;gap:18px;">
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:4px;">
                <span style="font-size:1rem;color:#4caf7d;">◈</span>
                <h3 style="font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#f5f5f0;margin:0;">Identité</h3>
            </div>

            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Nom <span style="color:#e07030;">*</span></label>
                <input type="text" name="name" required value="{{ old('name', $user->name) }}" style="{{ $fs }}" autocomplete="name">
                @error('name')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>

            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Email <span style="color:#e07030;">*</span></label>
                <input type="email" name="email" required value="{{ old('email', $user->email) }}" style="{{ $fs }}" autocomplete="email">
                @error('email')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>
        </div>

        <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:28px;display:flex;flex-direction:column;gap:18px;">
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:4px;">
                <span style="font-size:1rem;color:#d4a030;">●</span>
                <h3 style="font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#f5f5f0;margin:0;">Mot de passe</h3>
            </div>

            <p style="color:#555;font-size:0.78rem;line-height:1.6;margin:0;font-family:'Space Grotesk',sans-serif;">Laissez ces champs vides pour conserver le mot de passe actuel.</p>

            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Mot de passe actuel</label>
                <input type="password" name="current_password" style="{{ $fs }}" autocomplete="current-password">
                @error('current_password')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>

            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Nouveau mot de passe</label>
                <input type="password" name="password" style="{{ $fs }}" autocomplete="new-password">
                @error('password')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>

            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Confirmation</label>
                <input type="password" name="password_confirmation" style="{{ $fs }}" autocomplete="new-password">
            </div>
        </div>
    </div>

    <div style="display:flex;justify-content:flex-end;margin-top:24px;">
        <button type="submit"
                style="padding:12px 32px;background:linear-gradient(135deg,#4caf7d,#2d7a52);color:#0a0a0a;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;font-weight:700;border:none;border-radius:6px;cursor:pointer;transition:opacity 0.2s;"
                onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
            Enregistrer le profil
        </button>
    </div>
</form>

@endsection
