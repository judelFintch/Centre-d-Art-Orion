@extends('layouts.admin')
@section('title', 'Témoignages')

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:12px;">
    <div>
        <h2 style="font-family:'Playfair Display',serif;font-size:1.4rem;margin:0 0 4px;">Témoignages</h2>
        <p style="color:#555;font-size:0.82rem;margin:0;">{{ $temoignages->count() }} témoignage(s) — textes français et anglais.</p>
    </div>
    <a href="{{ route('admin.temoignages.create') }}" style="padding:10px 20px;background:linear-gradient(135deg,#4caf7d,#2d7a52);color:#fff;text-decoration:none;border-radius:6px;font-size:0.82rem;font-weight:700;">+ Nouveau témoignage</a>
</div>

@if(session('success'))
<div style="margin-bottom:20px;padding:12px 16px;border-radius:6px;background:rgba(76,175,125,0.1);border:1px solid rgba(76,175,125,0.25);color:#4caf7d;font-size:0.84rem;">{{ session('success') }}</div>
@endif

@forelse($temoignages as $temoignage)
<div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:16px 20px;display:flex;align-items:center;gap:16px;margin-bottom:10px;opacity:{{ $temoignage->actif ? '1' : '0.55' }};">
    <div style="width:58px;height:58px;border-radius:50%;overflow:hidden;background:linear-gradient(135deg,#4caf7d,#d4a030);display:flex;align-items:center;justify-content:center;color:#07110b;font-weight:800;flex-shrink:0;">
        @if($temoignage->photo_url)
        <img src="{{ $temoignage->photo_url }}" alt="{{ $temoignage->auteur }}" style="width:100%;height:100%;object-fit:cover;">
        @else
        {{ mb_strtoupper(mb_substr($temoignage->auteur, 0, 1)) }}
        @endif
    </div>
    <div style="flex:1;min-width:0;">
        <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
            <strong style="font-size:0.92rem;">{{ $temoignage->auteur }}</strong>
            <span style="color:#d4a030;font-size:0.75rem;">{{ str_repeat('★', $temoignage->note) }}</span>
            <span style="color:#555;font-size:0.7rem;">Ordre {{ $temoignage->ordre }}</span>
        </div>
        <p style="color:#777;font-size:0.8rem;margin:5px 0 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $temoignage->contenu }}</p>
        <div style="display:flex;gap:8px;margin-top:7px;">
            <span style="font-size:0.68rem;color:#4caf7d;">FR ✓</span>
            <span style="font-size:0.68rem;color:{{ $temoignage->getTranslation('contenu', 'en', false) ? '#4caf7d' : '#e07030' }};">EN {{ $temoignage->getTranslation('contenu', 'en', false) ? '✓' : 'manquant' }}</span>
        </div>
    </div>
    <form method="POST" action="{{ route('admin.temoignages.toggle', $temoignage) }}">
        @csrf
        @method('PATCH')
        <button type="submit" style="background:none;border:1px solid #2a2a2a;border-radius:5px;padding:7px 10px;color:{{ $temoignage->actif ? '#4caf7d' : '#777' }};cursor:pointer;">{{ $temoignage->actif ? 'Visible' : 'Masqué' }}</button>
    </form>
    <a href="{{ route('admin.temoignages.edit', $temoignage) }}" style="color:#d4a030;text-decoration:none;font-size:0.8rem;font-weight:700;">Modifier</a>
</div>
@empty
<div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:60px;text-align:center;">
    <p style="color:#555;margin:0 0 12px;">Aucun témoignage enregistré.</p>
    <a href="{{ route('admin.temoignages.create') }}" style="color:#4caf7d;text-decoration:none;">Créer le premier témoignage →</a>
</div>
@endforelse
@endsection
