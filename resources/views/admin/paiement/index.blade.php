@extends('layouts.admin')
@section('title', 'Paramètres — Paiement')

@section('content')
<div style="max-width:760px;">

<form action="{{ route('admin.paiement.update') }}" method="POST">
@csrf @method('PUT')

@php
$operateurs = [
    'mpesa'   => ['label' => 'M-Pesa (Vodacom)',  'couleur' => '#e2001a', 'placeholder_num' => '+243 99 XXX XXXX'],
    'airtel'  => ['label' => 'Airtel Money',       'couleur' => '#ff3c00', 'placeholder_num' => '+243 97 XXX XXXX'],
    'orange'  => ['label' => 'Orange Money',       'couleur' => '#ff7900', 'placeholder_num' => '+243 84 XXX XXXX'],
];
@endphp

{{-- ── Mobile Money ── --}}
@foreach($operateurs as $key => $op)
<div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;margin-bottom:16px;">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;">
        <div style="display:flex;align-items:center;gap:10px;">
            <div style="width:10px;height:10px;border-radius:50%;background:{{ $op['couleur'] }};flex-shrink:0;"></div>
            <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.95rem;color:#f5f5f0;margin:0;">{{ $op['label'] }}</h3>
        </div>
        {{-- Toggle actif --}}
        <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
            <input type="checkbox" name="paiement_{{ $key }}_actif" value="1"
                   {{ ($settings['paiement_'.$key.'_actif'] ?? '0') === '1' ? 'checked' : '' }}
                   style="width:16px;height:16px;accent-color:{{ $op['couleur'] }};cursor:pointer;">
            <span style="font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;color:#666;">Activer</span>
        </label>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;margin-bottom:5px;">Numéro de compte</label>
            <input type="text" name="paiement_{{ $key }}_numero"
                   value="{{ $settings['paiement_'.$key.'_numero'] ?? '' }}"
                   placeholder="{{ $op['placeholder_num'] }}"
                   style="width:100%;padding:9px 12px;background:#0d0d0d;border:1px solid #1a1a1a;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;outline:none;box-sizing:border-box;"
                   onfocus="this.style.borderColor='{{ $op['couleur'] }}'" onblur="this.style.borderColor='#1a1a1a'">
        </div>
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;margin-bottom:5px;">Nom du compte</label>
            <input type="text" name="paiement_{{ $key }}_nom"
                   value="{{ $settings['paiement_'.$key.'_nom'] ?? '' }}"
                   placeholder="CENTRE ART ORION"
                   style="width:100%;padding:9px 12px;background:#0d0d0d;border:1px solid #1a1a1a;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;outline:none;box-sizing:border-box;"
                   onfocus="this.style.borderColor='{{ $op['couleur'] }}'" onblur="this.style.borderColor='#1a1a1a'">
        </div>
    </div>
</div>
@endforeach

{{-- ── Espèces ── --}}
<div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;margin-bottom:28px;">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;">
        <div style="display:flex;align-items:center;gap:10px;">
            <div style="width:10px;height:10px;border-radius:50%;background:#4caf7d;flex-shrink:0;"></div>
            <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.95rem;color:#f5f5f0;margin:0;">Espèces sur place</h3>
        </div>
        <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
            <input type="checkbox" name="paiement_especes_actif" value="1"
                   {{ ($settings['paiement_especes_actif'] ?? '1') !== '0' ? 'checked' : '' }}
                   style="width:16px;height:16px;accent-color:#4caf7d;cursor:pointer;">
            <span style="font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;color:#666;">Activer</span>
        </label>
    </div>
    <div>
        <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;margin-bottom:5px;">Message affiché au client</label>
        <input type="text" name="paiement_especes_note"
               value="{{ $settings['paiement_especes_note'] ?? '' }}"
               placeholder="Présentez votre référence à la caisse à l'entrée."
               style="width:100%;padding:9px 12px;background:#0d0d0d;border:1px solid #1a1a1a;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;outline:none;box-sizing:border-box;"
               onfocus="this.style.borderColor='#4caf7d'" onblur="this.style.borderColor='#1a1a1a'">
    </div>
</div>

<button type="submit" class="btn-primary">Enregistrer les paramètres</button>
</form>

</div>
@endsection
