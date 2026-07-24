@extends('layouts.app')

@section('title', __('pages.ticketing.confirmation.title') . ' — ' . $billet->reference)
@section('meta_description', __('pages.ticketing.confirmation.meta_description'))

@section('content')

<section style="min-height:calc(100vh - 96px);background:#faf8f4;display:flex;align-items:center;justify-content:center;padding:80px 24px;">
    <div style="max-width:600px;width:100%;text-align:center;">

        {{-- Icône succès --}}
        <div style="width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,#4caf7d,#2d7a52);display:flex;align-items:center;justify-content:center;margin:0 auto 28px;box-shadow:0 8px 32px rgba(76,175,125,0.3);">
            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
        </div>

        <p style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:#4caf7d;margin:0 0 12px;">{{ __('pages.ticketing.confirmation.kicker') }}</p>
        <h1 style="font-family:'Playfair Display',serif;font-size:clamp(1.8rem,4vw,2.5rem);font-weight:900;color:#1c1510;margin:0 0 16px;line-height:1.2;">{{ __('pages.ticketing.confirmation.thanks', ['name' => $billet->prenom]) }}</h1>
        <p style="color:#666;font-size:0.95rem;line-height:1.7;margin:0 0 36px;">{{ __('pages.ticketing.confirmation.desc') }}</p>

        {{-- Carte récap --}}
        <div style="background:#fff;border:1px solid #ede8e0;border-radius:12px;padding:32px;text-align:left;margin-bottom:32px;box-shadow:0 4px 20px rgba(28,21,16,0.06);">

            {{-- Référence --}}
            <div style="text-align:center;padding:20px;background:linear-gradient(135deg,rgba(76,175,125,0.06),rgba(212,160,48,0.06));border:1px dashed rgba(76,175,125,0.3);border-radius:8px;margin-bottom:28px;">
                <p style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#888;margin:0 0 8px;">{{ __('pages.ticketing.confirmation.reference_number') }}</p>
                <p style="font-family:'Space Grotesk',sans-serif;font-size:1.6rem;font-weight:900;color:#4caf7d;letter-spacing:0.08em;margin:0;">{{ $billet->reference }}</p>
            </div>

            <div style="display:flex;flex-direction:column;gap:16px;">
                <div style="display:flex;justify-content:space-between;align-items:flex-start;padding-bottom:14px;border-bottom:1px solid #f0ebe3;">
                    <span style="font-family:'Space Grotesk',sans-serif;font-size:0.8rem;font-weight:600;color:#999;text-transform:uppercase;letter-spacing:0.06em;">{{ __('pages.ticketing.confirmation.event_label') }}</span>
                    <span style="font-family:'Playfair Display',serif;font-size:0.95rem;font-weight:700;color:#1c1510;text-align:right;max-width:280px;">{{ $billet->evenement->titre }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;padding-bottom:14px;border-bottom:1px solid #f0ebe3;">
                    <span style="font-family:'Space Grotesk',sans-serif;font-size:0.8rem;font-weight:600;color:#999;text-transform:uppercase;letter-spacing:0.06em;">{{ __('pages.ticketing.confirmation.date_label') }}</span>
                    <span style="font-family:'Space Grotesk',sans-serif;font-size:0.88rem;color:#444;">{{ $billet->evenement->date_debut->isoFormat('dddd D MMMM YYYY ['.__('pages.ticketing.at_time').'] HH:mm') }}</span>
                </div>
                @if($billet->evenement->lieu)
                <div style="display:flex;justify-content:space-between;padding-bottom:14px;border-bottom:1px solid #f0ebe3;">
                    <span style="font-family:'Space Grotesk',sans-serif;font-size:0.8rem;font-weight:600;color:#999;text-transform:uppercase;letter-spacing:0.06em;">{{ __('pages.ticketing.confirmation.venue_label') }}</span>
                    <span style="font-family:'Space Grotesk',sans-serif;font-size:0.88rem;color:#444;">{{ $billet->evenement->lieu }}</span>
                </div>
                @endif
                <div style="display:flex;justify-content:space-between;padding-bottom:14px;border-bottom:1px solid #f0ebe3;">
                    <span style="font-family:'Space Grotesk',sans-serif;font-size:0.8rem;font-weight:600;color:#999;text-transform:uppercase;letter-spacing:0.06em;">{{ __('pages.ticketing.confirmation.booked_for_label') }}</span>
                    <span style="font-family:'Space Grotesk',sans-serif;font-size:0.88rem;color:#444;font-weight:600;">{{ $billet->prenom }} {{ $billet->nom }}</span>
                </div>
                @if($billet->categorie)
                <div style="display:flex;justify-content:space-between;padding-bottom:14px;border-bottom:1px solid #f0ebe3;">
                    <span style="font-family:'Space Grotesk',sans-serif;font-size:0.8rem;font-weight:600;color:#999;text-transform:uppercase;letter-spacing:0.06em;">{{ __('pages.ticketing.confirmation.category_label') }}</span>
                    <span style="display:inline-block;padding:3px 10px;background:rgba(176,122,255,0.08);border:1px solid rgba(176,122,255,0.18);color:#9a5eff;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:700;border-radius:20px;">{{ $billet->categorie->nom }}</span>
                </div>
                @endif
                <div style="display:flex;justify-content:space-between;padding-bottom:14px;border-bottom:1px solid #f0ebe3;">
                    <span style="font-family:'Space Grotesk',sans-serif;font-size:0.8rem;font-weight:600;color:#999;text-transform:uppercase;letter-spacing:0.06em;">{{ __('pages.ticketing.confirmation.ticket_count_label') }}</span>
                    <span style="font-family:'Space Grotesk',sans-serif;font-size:0.88rem;color:#444;">{{ trans_choice('pages.ticketing.confirmation.ticket_count', $billet->nombre_billets, ['count' => $billet->nombre_billets]) }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;">
                    <span style="font-family:'Space Grotesk',sans-serif;font-size:0.8rem;font-weight:600;color:#999;text-transform:uppercase;letter-spacing:0.06em;">{{ __('pages.ticketing.confirmation.total_amount_label') }}</span>
                    @if($billet->evenement->gratuit || $billet->montant_total == 0)
                    <span style="font-family:'Space Grotesk',sans-serif;font-size:0.95rem;font-weight:700;color:#4caf7d;">{{ __('pages.ticketing.confirmation.free') }}</span>
                    @else
                    <span style="font-family:'Playfair Display',serif;font-size:1.1rem;font-weight:700;color:#d4a030;">{{ number_format($billet->montant_total, 0, ',', ' ') }} FC</span>
                    @endif
                </div>
            </div>
        </div>

        {{-- ── Statut paiement ── --}}
        @if($billet->montant_total > 0)
        @php
            $meta     = \App\Models\Billet::METHODES;
            $methode  = $billet->methode_paiement;
            $couleur  = $meta[$methode]['couleur']  ?? '#d4a030';
            $bgColor  = $meta[$methode]['bg']        ?? 'rgba(212,160,48,0.08)';
            $border   = $meta[$methode]['border']    ?? 'rgba(212,160,48,0.25)';
            $labelMM  = $meta[$methode]['label']     ?? '';
        @endphp

        @if($billet->paiement_verifie)
        {{-- Paiement confirmé --}}
        <div style="background:rgba(76,175,125,0.08);border:1px solid rgba(76,175,125,0.3);border-radius:8px;padding:16px 20px;margin-bottom:20px;display:flex;align-items:center;gap:10px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#4caf7d" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            <div>
                <p style="font-family:'Space Grotesk',sans-serif;font-size:0.85rem;font-weight:700;color:#2d7a52;margin:0;">{{ __('pages.ticketing.confirmation.payment_verified') }}</p>
                <p style="font-size:0.78rem;color:#4caf7d;margin:2px 0 0;">{{ __('pages.ticketing.confirmation.payment_verified_desc') }}</p>
            </div>
        </div>
        @elseif($methode === 'especes')
        {{-- Espèces sur place --}}
        <div style="background:rgba(76,175,125,0.06);border:1px solid rgba(76,175,125,0.2);border-radius:8px;padding:16px 20px;margin-bottom:20px;">
            <p style="font-family:'Space Grotesk',sans-serif;font-size:0.85rem;font-weight:700;color:#2d7a52;margin:0 0 4px;">{{ __('pages.ticketing.confirmation.cash_payment') }}</p>
            <p style="font-size:0.82rem;color:#555;margin:0;">
                {{ !empty($methodesActives['especes']['note']) ? $methodesActives['especes']['note'] : __('pages.ticketing.confirmation.cash_note_fallback') }}
            </p>
        </div>
        @else
        {{-- Mobile Money : en attente de vérification --}}
        <div style="background:{{ $bgColor }};border:1px solid {{ $border }};border-radius:8px;padding:16px 20px;margin-bottom:20px;">
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px;">
                <div style="width:8px;height:8px;border-radius:50%;background:{{ $couleur }};"></div>
                <p style="font-family:'Space Grotesk',sans-serif;font-size:0.85rem;font-weight:700;color:#1c1510;margin:0;">{{ $labelMM }} — {{ __('pages.ticketing.confirmation.pending_verification') }}</p>
            </div>
            @if($billet->reference_paiement)
            <p style="font-size:0.82rem;color:#555;margin:0 0 4px;">
                {{ __('pages.ticketing.confirmation.reference_submitted') }} <strong style="color:#1c1510;letter-spacing:0.04em;">{{ $billet->reference_paiement }}</strong>
            </p>
            @endif
            <p style="font-size:0.78rem;color:#888;margin:0;">{{ __('pages.ticketing.confirmation.pending_note') }}</p>
        </div>
        @endif
        @endif

        <div style="background:rgba(212,160,48,0.08);border:1px solid rgba(212,160,48,0.25);border-radius:8px;padding:16px;margin-bottom:32px;">
            <p style="font-family:'Space Grotesk',sans-serif;font-size:0.82rem;color:#9a6a1d;line-height:1.6;margin:0;">
                <strong>{{ __('pages.ticketing.confirmation.important_label') }}</strong> {!! __('pages.ticketing.confirmation.important_note', ['reference' => '<strong>'.e($billet->reference).'</strong>']) !!}
            </p>
        </div>

        <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
            <a href="{{ route('billetterie.index') }}"
               style="padding:11px 24px;background:linear-gradient(135deg,#4caf7d,#2d7a52);color:#fff;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;border-radius:6px;text-decoration:none;">
                {{ __('pages.ticketing.confirmation.other_events') }}
            </a>
            <a href="{{ route('home') }}"
               style="padding:11px 24px;border:1px solid rgba(28,21,16,0.2);color:#444;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;border-radius:6px;text-decoration:none;">
                {{ __('pages.ticketing.confirmation.home') }}
            </a>
        </div>

    </div>
</section>

@endsection
