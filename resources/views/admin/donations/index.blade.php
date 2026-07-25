@extends('layouts.admin')
@section('title', 'Campagnes de dons')

@php
use App\Models\PageSetting as PS;
$row = PS::where('key', 'donation.campaign_name')->first();
$nameEn = $row?->getTranslation('value', 'en', false) ?? '';
$input = "width:100%;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;color:#f5f5f0;box-sizing:border-box;";
@endphp

@section('content')
<div style="margin-bottom:26px;">
    <h2 style="font-family:'Playfair Display',serif;font-size:1.4rem;margin:0 0 5px;">Gestion de la campagne de dons</h2>
    <p style="color:#666;font-size:0.82rem;margin:0;">Préparation de l’intégration FlexPaie — carte bancaire et Mobile Money.</p>
</div>

@if(session('success'))<div style="padding:12px 16px;margin-bottom:18px;background:#102018;border:1px solid #234b34;color:#4caf7d;border-radius:6px;">{{ session('success') }}</div>@endif
@if($errors->any())<div style="padding:12px 16px;margin-bottom:18px;background:#24130d;border:1px solid #63301d;color:#e07030;border-radius:6px;">{{ $errors->first() }}</div>@endif

<form method="POST" action="{{ route('admin.donations.update') }}">
@csrf @method('PUT')
<div style="display:grid;grid-template-columns:1.2fr .8fr;gap:22px;align-items:start;">
    <div style="display:flex;flex-direction:column;gap:20px;">
        <section class="donation-admin-card">
            <h3>Campagne</h3>
            <label>Nom de la campagne (FR)</label>
            <input name="campaign_name" required value="{{ old('campaign_name', PS::get('donation.campaign_name', 'Soutenir les artistes Orion')) }}" style="{{ $input }}">
            <label>Campaign name (EN)</label>
            <input name="campaign_name_en" value="{{ old('campaign_name_en', $nameEn) }}" style="{{ $input }}">
            <div class="donation-admin-grid">
                <div><label>Objectif</label><input type="number" min="1" step="1" name="goal" required value="{{ old('goal', PS::get('donation.goal', '30000')) }}" style="{{ $input }}"></div>
                <div><label>Devise</label><select name="currency" style="{{ $input }}"><option @selected(PS::get('donation.currency','USD')==='USD')>USD</option><option @selected(PS::get('donation.currency')==='CDF')>CDF</option></select></div>
                <div><label>Date de début</label><input type="datetime-local" name="starts_at" value="{{ old('starts_at', PS::get('donation.starts_at')) }}" style="{{ $input }}"></div>
                <div><label>Date de fin</label><input type="datetime-local" name="ends_at" value="{{ old('ends_at', PS::get('donation.ends_at')) }}" style="{{ $input }}"></div>
            </div>
        </section>

        <section class="donation-admin-card">
            <h3>Moyens proposés au lancement</h3>
            <p>Seuls les moyens cochés seront transmis à FlexPaie.</p>
            <div class="method-grid">
            @foreach(['card'=>'Carte Visa / Mastercard','mpesa'=>'M-Pesa','airtel'=>'Airtel Money','orange'=>'Orange Money','mtn'=>'MTN MoMo','afrimoney'=>'Afrimoney'] as $key=>$label)
                <label class="method"><input type="checkbox" name="methods[{{ $key }}]" value="1" @checked(old("methods.$key", PS::get("donation.methods.$key",'0')==='1'))> {{ $label }}</label>
            @endforeach
            </div>
        </section>
    </div>

    <section class="donation-admin-card">
        <h3>Publication</h3>
        <label>État de l’intégration FlexPaie</label>
        <select name="integration_status" style="{{ $input }}">
            <option value="awaiting_docs" @selected(PS::get('donation.integration_status','awaiting_docs')==='awaiting_docs')>Documentation attendue</option>
            <option value="sandbox" @selected(PS::get('donation.integration_status')==='sandbox')>Tests sandbox</option>
            <option value="ready" @selected(PS::get('donation.integration_status')==='ready')>Validée pour production</option>
        </select>
        <label>État de la campagne</label>
        <select name="status" style="{{ $input }}">
            @foreach(['draft'=>'Brouillon','published'=>'Publiée','paused'=>'Suspendue','ended'=>'Terminée'] as $value=>$label)
            <option value="{{ $value }}" @selected(old('status',PS::get('donation.status','draft'))===$value)>{{ $label }}</option>
            @endforeach
        </select>
        <div style="padding:14px;background:#19140b;border:1px solid #493a18;border-radius:6px;color:#b99a4a;font-size:.78rem;line-height:1.6;">Si la campagne est publiée avant la validation FlexPaie, elle reste en mode aperçu : l’avertissement de démonstration demeure visible et aucun paiement réel n’est transmis.</div>
        <button type="submit" style="width:100%;padding:12px;border:0;border-radius:6px;background:#4caf7d;color:#07110b;font-weight:800;cursor:pointer;">Enregistrer la configuration</button>
    </section>
</div>
</form>

<style>
.donation-admin-card{background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;display:flex;flex-direction:column;gap:14px}.donation-admin-card h3{margin:0 0 5px;font-size:1rem}.donation-admin-card>p{color:#666;font-size:.78rem;margin:0}.donation-admin-card label{color:#888;font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em}.donation-admin-grid,.method-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px}.donation-admin-grid>div{display:flex;flex-direction:column;gap:7px}.method{padding:12px;background:#0d0d0d;border:1px solid #222;border-radius:6px;color:#ccc!important;text-transform:none!important;letter-spacing:0!important}.method input{accent-color:#4caf7d}@media(max-width:900px){div[style*="grid-template-columns:1.2fr"]{grid-template-columns:1fr!important}}
</style>
@endsection
