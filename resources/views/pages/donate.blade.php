@extends('layouts.app')

@section('title', __('pages.donate.title'))
@section('meta_description', __('pages.donate.meta_description'))

@section('content')

{{-- Hero --}}
<section style="padding:100px 0 80px;background:#0a0a0a;border-bottom:1px solid #1a1a1a;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 25% 40%,rgba(212,160,48,0.10),transparent 60%);pointer-events:none;"></div>
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:1;text-align:center;">
        <div class="tag tag-gold" style="margin-bottom:16px;">{{ __('pages.donate.hero_tag') }}</div>
        <h1 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2.5rem,5vw,4rem);font-weight:900;color:#f5f5f0;line-height:1.1;margin:0 0 20px;">
            {{ __('pages.donate.hero_title_1') }}
            <span style="background:linear-gradient(135deg,#d4a030,#e07030);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">{{ __('pages.donate.hero_title_2') }}</span>
        </h1>
        <p style="color:#999;font-size:1rem;max-width:600px;line-height:1.8;margin:0 auto;">{{ __('pages.donate.hero_desc') }}</p>
    </div>
</section>

{{-- Avertissement : page de démonstration --}}
<section role="status" aria-label="{{ __('pages.donate.demo_notice_title') }}" style="background:#fff3cd;border-top:1px solid #e6c75a;border-bottom:1px solid #e6c75a;">
    <div style="max-width:1200px;margin:0 auto;padding:18px 24px;display:flex;align-items:flex-start;justify-content:center;gap:14px;">
        <span aria-hidden="true" style="font-size:1.35rem;line-height:1;">⚠️</span>
        <div>
            <strong style="display:block;color:#6b4d00;font-family:'Space Grotesk',sans-serif;font-size:0.9rem;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:4px;">
                {{ __('pages.donate.demo_notice_title') }}
            </strong>
            <p style="color:#705a20;font-size:0.86rem;line-height:1.6;margin:0;">
                {{ __('pages.donate.demo_notice_text') }}
            </p>
        </div>
    </div>
</section>

{{-- Pourquoi donner --}}
<section style="padding:88px 0;background:#ffffff;">
    <div style="max-width:1200px;margin:0 auto;padding:0 24px;">
        <div style="text-align:center;max-width:560px;margin:0 auto 52px;">
            <div class="tag tag-green" style="margin-bottom:16px;">{{ __('pages.donate.why_tag') }}</div>
            <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(1.8rem,3.5vw,2.5rem);font-weight:900;color:#1c1510;line-height:1.15;margin:0;">
                {{ __('pages.donate.why_title') }}
            </h2>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:24px;">
            @foreach(__('pages.donate.why_items') as $item)
            <div style="background:#faf8f4;border:1px solid #ede8e0;border-radius:10px;padding:32px;text-align:center;">
                <div style="font-size:2.4rem;margin-bottom:16px;">{{ $item['icon'] }}</div>
                <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1rem;color:#1c1510;margin:0 0 10px;">{{ $item['titre'] }}</h3>
                <p style="color:#78706a;font-size:0.88rem;line-height:1.7;margin:0;">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Formulaire + sidebar (objectif, flux temps réel, confiance) --}}
<section style="padding:0 0 100px;background:#0d0d0d;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
        <div style="display:grid;grid-template-columns:1fr 400px;gap:48px;align-items:start;">

            {{-- ── Formulaire de don ── --}}
            <div class="reveal">
                <div style="background:#111;border:1px solid #1a1a1a;border-radius:12px;padding:36px;margin-top:-56px;position:relative;z-index:2;box-shadow:0 20px 60px rgba(0,0,0,0.35);">
                    <h2 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1rem;letter-spacing:0.08em;text-transform:uppercase;color:#f5f5f0;margin:0 0 28px;">{{ __('pages.donate.form_title') }}</h2>

                    <div id="donate-form-wrap">
                        <form id="donate-form">
                            {{-- Montant --}}
                            <div style="margin-bottom:24px;">
                                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#888;margin-bottom:10px;">{{ __('pages.donate.amount_label') }}</label>
                                <div id="amount-pills" style="display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin-bottom:10px;">
                                    @foreach([10, 25, 50, 100, 250] as $preset)
                                    <button type="button" class="amount-pill" data-amount="{{ $preset }}"
                                            style="padding:12px;background:#0d0d0d;border:1.5px solid #222;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.9rem;font-weight:700;cursor:pointer;transition:all 0.15s;">
                                        ${{ $preset }}
                                    </button>
                                    @endforeach
                                    <input type="number" id="amount-custom" min="1" step="1" placeholder="{{ __('pages.donate.amount_custom_placeholder') }}"
                                           style="padding:12px;background:#0d0d0d;border:1.5px solid #222;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;outline:none;box-sizing:border-box;">
                                </div>
                                <input type="hidden" id="amount-value" value="50">
                            </div>

                            {{-- Fréquence --}}
                            <div style="margin-bottom:28px;">
                                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#888;margin-bottom:10px;">{{ __('pages.donate.frequency_label') }}</label>
                                <div id="frequency-toggle" style="display:grid;grid-template-columns:1fr 1fr;gap:8px;padding:4px;background:#0d0d0d;border:1px solid #222;border-radius:8px;">
                                    <button type="button" class="frequency-btn active" data-frequency="once"
                                            style="padding:10px;background:#4caf7d;border:none;border-radius:6px;color:#0a0a0a;font-family:'Space Grotesk',sans-serif;font-size:0.8rem;font-weight:700;cursor:pointer;transition:all 0.15s;">
                                        {{ __('pages.donate.frequency_once') }}
                                    </button>
                                    <button type="button" class="frequency-btn" data-frequency="monthly"
                                            style="padding:10px;background:transparent;border:none;border-radius:6px;color:#888;font-family:'Space Grotesk',sans-serif;font-size:0.8rem;font-weight:700;cursor:pointer;transition:all 0.15s;">
                                        {{ __('pages.donate.frequency_monthly') }}
                                    </button>
                                </div>
                            </div>

                            {{-- Infos donateur --}}
                            <div style="margin-bottom:10px;padding-top:8px;border-top:1px solid #1a1a1a;">
                                <p style="font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:#666;margin:20px 0 16px;">{{ __('pages.donate.donor_info_title') }}</p>
                                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px;">
                                    <div>
                                        <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.7rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#777;margin-bottom:6px;">{{ __('pages.donate.label_firstname') }}</label>
                                        <input type="text" name="prenom" required class="donate-input">
                                    </div>
                                    <div>
                                        <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.7rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#777;margin-bottom:6px;">{{ __('pages.donate.label_lastname') }}</label>
                                        <input type="text" name="nom" required class="donate-input">
                                    </div>
                                </div>
                                <div style="margin-bottom:14px;">
                                    <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.7rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#777;margin-bottom:6px;">{{ __('pages.donate.label_email') }}</label>
                                    <input type="email" name="email" required class="donate-input">
                                </div>
                                <label style="display:flex;align-items:center;gap:10px;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;cursor:pointer;margin-bottom:14px;">
                                    <input type="checkbox" id="donate-anonymous" style="width:15px;height:15px;accent-color:#4caf7d;cursor:pointer;">
                                    <span style="color:#ccc;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;">{{ __('pages.donate.anonymous_label') }}</span>
                                </label>
                                <div style="margin-bottom:8px;">
                                    <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.7rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#777;margin-bottom:6px;">{{ __('pages.donate.message_label') }}</label>
                                    <textarea name="message" rows="2" class="donate-input" style="resize:vertical;" placeholder="{{ __('pages.donate.message_placeholder') }}"></textarea>
                                </div>
                            </div>

                            {{-- Paiement --}}
                            <div style="margin-top:20px;padding-top:20px;border-top:1px solid #1a1a1a;">
                                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;flex-wrap:wrap;gap:8px;">
                                    <p style="font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:#666;margin:0;">{{ __('pages.donate.payment_title') }}</p>
                                    <span style="font-family:'Space Grotesk',sans-serif;font-size:0.7rem;font-weight:700;letter-spacing:0.04em;color:#9a6a1d;background:rgba(212,160,48,0.12);border:1px solid rgba(212,160,48,0.25);padding:4px 10px;border-radius:20px;">
                                        {{ __('pages.donate.coming_soon_badge') }}
                                    </span>
                                </div>
                                <p style="color:#666;font-size:0.8rem;font-weight:600;margin:0 0 12px;">{{ __('pages.donate.payment_card_label') }} <span style="opacity:0.6;font-weight:400;">VISA · Mastercard</span></p>

                                <div style="margin-bottom:12px;">
                                    <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.7rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#777;margin-bottom:6px;">{{ __('pages.donate.card_number_label') }}</label>
                                    <input type="text" id="card-number" inputmode="numeric" autocomplete="cc-number" maxlength="19" placeholder="4242 4242 4242 4242" class="donate-input">
                                </div>
                                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:12px;">
                                    <div>
                                        <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.7rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#777;margin-bottom:6px;">{{ __('pages.donate.card_expiry_label') }}</label>
                                        <input type="text" id="card-expiry" inputmode="numeric" autocomplete="cc-exp" maxlength="5" placeholder="MM/AA" class="donate-input">
                                    </div>
                                    <div>
                                        <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.7rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#777;margin-bottom:6px;">{{ __('pages.donate.card_cvv_label') }}</label>
                                        <input type="text" id="card-cvv" inputmode="numeric" autocomplete="cc-csc" maxlength="4" placeholder="•••" class="donate-input">
                                    </div>
                                </div>
                                <div style="margin-bottom:6px;">
                                    <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.7rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#777;margin-bottom:6px;">{{ __('pages.donate.card_name_label') }}</label>
                                    <input type="text" autocomplete="cc-name" placeholder="{{ __('pages.donate.card_name_placeholder') }}" class="donate-input">
                                </div>
                            </div>

                            <p style="display:flex;align-items:center;gap:8px;color:#555;font-size:0.75rem;line-height:1.5;margin:18px 0 22px;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4caf7d" stroke-width="2" style="flex-shrink:0;"><rect x="3" y="11" width="18" height="10" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                                {{ __('pages.donate.secure_note') }}
                            </p>

                            <button type="submit" id="donate-submit" class="btn-gold" style="width:100%;justify-content:center;padding:15px;font-size:0.85rem;">
                                <span id="donate-submit-label">{{ __('pages.donate.submit_button', ['amount' => '$50']) }}</span>
                            </button>
                        </form>
                    </div>

                    {{-- État "bientôt disponible" affiché après soumission --}}
                    <div id="donate-coming-soon" style="display:none;text-align:center;padding:24px 8px;">
                        <div style="width:64px;height:64px;border-radius:50%;background:rgba(212,160,48,0.12);border:1px solid rgba(212,160,48,0.3);display:flex;align-items:center;justify-content:center;margin:0 auto 20px;font-size:1.6rem;">🙏</div>
                        <p style="color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.95rem;margin:0 0 12px;">{{ __('pages.donate.coming_soon_badge') }}</p>
                        <p style="color:#999;font-size:0.88rem;line-height:1.7;margin:0 0 24px;max-width:400px;margin-left:auto;margin-right:auto;">{{ __('pages.donate.coming_soon_message') }}</p>
                        <a href="{{ route('contact.index') }}" class="btn-primary" style="justify-content:center;">{{ __('pages.donate.coming_soon_cta') }}</a>
                    </div>
                </div>
            </div>

            {{-- ── Sidebar ── --}}
            <div class="reveal" style="display:flex;flex-direction:column;gap:20px;">

                {{-- Objectif de campagne --}}
                <div style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:28px;">
                    <div class="tag tag-gold" style="margin-bottom:14px;">{{ __('pages.donate.goal_tag') }}</div>
                    <h3 style="font-family:'Playfair Display',Georgia,serif;font-size:1.1rem;font-weight:700;color:#f5f5f0;margin:0 0 16px;">{{ __('pages.donate.goal_title') }}</h3>
                    @php
                        $goalPct = min(100, round(($campaign['raised'] / $campaign['goal']) * 100));
                    @endphp
                    <div style="height:8px;background:#0d0d0d;border-radius:99px;overflow:hidden;margin-bottom:12px;">
                        <div style="height:100%;width:{{ $goalPct }}%;background:linear-gradient(90deg,#4caf7d,#d4a030);border-radius:99px;"></div>
                    </div>
                    <div style="display:flex;align-items:baseline;justify-content:space-between;margin-bottom:6px;">
                        <span style="font-family:'Playfair Display',Georgia,serif;font-size:1.35rem;font-weight:900;color:#d4a030;">${{ number_format($campaign['raised']) }}</span>
                        <span style="color:#666;font-size:0.78rem;">{{ __('pages.donate.goal_of_label') }} ${{ number_format($campaign['goal']) }}</span>
                    </div>
                    <p style="color:#777;font-size:0.8rem;margin:0;">${{ number_format($campaign['raised']) }} {{ __('pages.donate.goal_raised_label') }} · {{ trans_choice('pages.donate.goal_donors', $campaign['donors'], ['count' => number_format($campaign['donors'])]) }}</p>
                </div>

                {{-- Flux de dons en direct --}}
                <div style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:28px;">
                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:18px;">
                        <span class="live-dot"></span>
                        <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.85rem;letter-spacing:0.06em;text-transform:uppercase;color:#f5f5f0;margin:0;">{{ __('pages.donate.feed_title') }}</h3>
                    </div>
                    <div id="donation-feed" aria-live="polite" style="display:flex;flex-direction:column;gap:2px;max-height:340px;overflow-y:auto;">
                        @forelse($recentDonations as $donation)
                        <div class="donation-row">
                            <span class="donation-row-avatar">{{ $donation['anonymous'] ? '🙈' : strtoupper(substr($donation['name'], 0, 1)) }}</span>
                            <span style="flex:1;min-width:0;">
                                <span style="display:block;color:#e8e4de;font-size:0.84rem;font-weight:600;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                                    {{ $donation['anonymous'] ? __('pages.donate.feed_anonymous') : $donation['name'] }}
                                </span>
                                <span style="display:block;color:#555;font-size:0.72rem;">{{ $donation['time'] }}</span>
                            </span>
                            <span style="color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.88rem;flex-shrink:0;">${{ $donation['amount'] }}</span>
                        </div>
                        @empty
                        <p style="color:#555;font-size:0.85rem;text-align:center;padding:20px 0;">{{ __('pages.donate.feed_empty') }}</p>
                        @endforelse
                    </div>
                </div>

                {{-- Badges confiance --}}
                <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:8px;">
                    @foreach([
                        ['icon' => '🔒', 'label' => __('pages.donate.trust_ssl')],
                        ['icon' => '💳', 'label' => __('pages.donate.trust_visa')],
                        ['icon' => '📧', 'label' => __('pages.donate.trust_receipt')],
                    ] as $badge)
                    <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:14px 8px;text-align:center;">
                        <div style="font-size:1.2rem;margin-bottom:6px;">{{ $badge['icon'] }}</div>
                        <div style="color:#888;font-size:0.68rem;font-family:'Space Grotesk',sans-serif;font-weight:600;line-height:1.3;">{{ $badge['label'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

<style>
.donate-input {
    width: 100%;
    padding: 11px 14px;
    background: #0d0d0d;
    border: 1.5px solid #222;
    border-radius: 6px;
    color: #f5f5f0;
    font-family: 'Inter', sans-serif;
    font-size: 0.88rem;
    outline: none;
    box-sizing: border-box;
    transition: border-color 0.15s;
}
.donate-input:focus { border-color: #4caf7d55; }
.donate-input::placeholder { color: #555; }

.amount-pill:hover { border-color: #4caf7d55; }
.amount-pill.active { background: linear-gradient(135deg,#4caf7d,#2d7a52) !important; border-color: transparent !important; color: #fff !important; }
#amount-custom:focus { border-color: #4caf7d55; }
#amount-custom.active { border-color: #4caf7d !important; }

.live-dot {
    width: 8px; height: 8px; border-radius: 50%; background: #4caf7d; flex-shrink: 0;
    box-shadow: 0 0 0 0 rgba(76,175,125,0.6);
    animation: liveDotPulse 1.8s ease-out infinite;
}
@keyframes liveDotPulse {
    0%   { box-shadow: 0 0 0 0 rgba(76,175,125,0.55); }
    70%  { box-shadow: 0 0 0 7px rgba(76,175,125,0); }
    100% { box-shadow: 0 0 0 0 rgba(76,175,125,0); }
}

.donation-row {
    display: flex; align-items: center; gap: 10px;
    padding: 10px 6px;
    border-bottom: 1px solid #1a1a1a;
    animation: donationRowIn 0.4s ease;
}
.donation-row:last-child { border-bottom: none; }
@keyframes donationRowIn {
    from { opacity: 0; transform: translateY(-8px); }
    to   { opacity: 1; transform: translateY(0); }
}
.donation-row-avatar {
    width: 32px; height: 32px; border-radius: 50%; flex-shrink: 0;
    background: linear-gradient(135deg,#4caf7d,#d4a030);
    display: flex; align-items: center; justify-content: center;
    font-family: 'Space Grotesk', sans-serif; font-weight: 700; font-size: 0.8rem; color: #0a0a0a;
}

@media(max-width:900px){
    section > div > div[style*="grid-template-columns:1fr 400px"] {
        grid-template-columns: 1fr !important;
    }
    #donate-form-wrap form > div[style*="margin-top:-56px"],
    div[style*="margin-top:-56px"] {
        margin-top: 0 !important;
    }
}
@media(max-width:520px){
    #amount-pills { grid-template-columns: repeat(2,1fr) !important; }
}
</style>

@push('scripts')
<script>
(function () {
    const amountPills = document.querySelectorAll('.amount-pill');
    const amountCustom = document.getElementById('amount-custom');
    const amountValue = document.getElementById('amount-value');
    const submitLabel = document.getElementById('donate-submit-label');
    const submitTemplate = @json(__('pages.donate.submit_button', ['amount' => '__AMOUNT__']));

    function selectPreset(pill) {
        amountPills.forEach((p) => p.classList.remove('active'));
        amountCustom.classList.remove('active');
        amountCustom.value = '';
        pill.classList.add('active');
        setAmount(pill.dataset.amount);
    }

    function setAmount(value) {
        const amount = Math.max(1, parseInt(value, 10) || 0);
        amountValue.value = amount;
        submitLabel.textContent = submitTemplate.replace('__AMOUNT__', '$' + amount);
    }

    amountPills.forEach((pill) => pill.addEventListener('click', () => selectPreset(pill)));
    amountCustom.addEventListener('input', () => {
        amountPills.forEach((p) => p.classList.remove('active'));
        amountCustom.classList.add('active');
        if (amountCustom.value) setAmount(amountCustom.value);
    });
    // Montant par défaut ($50 déjà actif visuellement)
    document.querySelector('.amount-pill[data-amount="50"]')?.classList.add('active');

    // ── Fréquence ──
    document.querySelectorAll('.frequency-btn').forEach((btn) => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.frequency-btn').forEach((b) => {
                b.classList.remove('active');
                b.style.background = 'transparent';
                b.style.color = '#888';
            });
            btn.classList.add('active');
            btn.style.background = '#4caf7d';
            btn.style.color = '#0a0a0a';
        });
    });

    // ── Formatage carte ──
    const cardNumber = document.getElementById('card-number');
    cardNumber?.addEventListener('input', () => {
        cardNumber.value = cardNumber.value.replace(/\D/g, '').slice(0, 16).replace(/(.{4})/g, '$1 ').trim();
    });
    const cardExpiry = document.getElementById('card-expiry');
    cardExpiry?.addEventListener('input', () => {
        let v = cardExpiry.value.replace(/\D/g, '').slice(0, 4);
        if (v.length > 2) v = v.slice(0, 2) + '/' + v.slice(2);
        cardExpiry.value = v;
    });
    const cardCvv = document.getElementById('card-cvv');
    cardCvv?.addEventListener('input', () => {
        cardCvv.value = cardCvv.value.replace(/\D/g, '').slice(0, 4);
    });

    // ── Soumission (front-end uniquement pour l'instant — API de paiement à venir) ──
    const form = document.getElementById('donate-form');
    form?.addEventListener('submit', (e) => {
        e.preventDefault();
        document.getElementById('donate-form-wrap').style.display = 'none';
        document.getElementById('donate-coming-soon').style.display = 'block';
    });

    // ── Flux de dons en direct (démo front-end — à relier à une vraie source temps réel) ──
    const feed = document.getElementById('donation-feed');
    const demoPool = [
        { name: 'Alice B.', amount: 20 },
        { name: 'Thierry K.', amount: 40 },
        { name: null, amount: 15 },
        { name: 'Nadine P.', amount: 60 },
        { name: 'Éric M.', amount: 100 },
        { name: 'Chantal O.', amount: 35 },
    ];
    const justNowLabel = @json(__('pages.donate.feed_just_now'));
    const anonymousLabel = @json(__('pages.donate.feed_anonymous'));

    function pushDonation(entry) {
        if (!feed) return;
        const row = document.createElement('div');
        row.className = 'donation-row';
        const initial = entry.name ? entry.name.charAt(0).toUpperCase() : '🙈';
        const displayName = entry.name || anonymousLabel;
        row.innerHTML =
            '<span class="donation-row-avatar">' + initial + '</span>' +
            '<span style="flex:1;min-width:0;">' +
                '<span style="display:block;color:#e8e4de;font-size:0.84rem;font-weight:600;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">' + displayName + '</span>' +
                '<span style="display:block;color:#555;font-size:0.72rem;">' + justNowLabel + '</span>' +
            '</span>' +
            '<span style="color:#4caf7d;font-family:\'Space Grotesk\',sans-serif;font-weight:700;font-size:0.88rem;flex-shrink:0;">$' + entry.amount + '</span>';
        feed.prepend(row);
        while (feed.children.length > 8) {
            feed.removeChild(feed.lastElementChild);
        }
    }

    // Simule l'arrivée périodique de nouveaux dons (remplacer par un polling/WebSocket réel côté API)
    setInterval(() => {
        const entry = demoPool[Math.floor(Math.random() * demoPool.length)];
        pushDonation(entry);
    }, 14000);
})();
</script>
@endpush

@endsection
