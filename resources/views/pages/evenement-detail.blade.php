@extends('layouts.app')

@section('title', $evenement->titre . ' — ' . __('common.site_name'))
@section('meta_description', Str::limit($evenement->description, 160))
@section('og_title', $evenement->titre . ' — ' . __('common.site_name'))
@section('og_description', Str::limit($evenement->description, 160))
@section('og_image', $evenement->image_url ?: asset('images/og-orion.jpg'))
@section('og_type', 'article')

@push('head')
<link rel="canonical" href="{{ route('evenements.show', $evenement) }}">
<meta property="og:url" content="{{ route('evenements.show', $evenement) }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $evenement->titre }} — {{ __('common.site_name') }}">
<meta name="twitter:description" content="{{ Str::limit($evenement->description, 160) }}">
<meta name="twitter:image" content="{{ $evenement->image_url ?: asset('images/og-orion.jpg') }}">
@php
    $eventSchema = array_filter([
        '@context' => 'https://schema.org',
        '@type' => 'Event',
        'name' => $evenement->titre,
        'description' => $evenement->description,
        'startDate' => $evenement->date_debut?->toIso8601String(),
        'endDate' => $evenement->date_fin?->toIso8601String(),
        'eventStatus' => 'https://schema.org/EventScheduled',
        'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode',
        'image' => $evenement->image_url ? [$evenement->image_url] : null,
        'url' => route('evenements.show', $evenement),
        'location' => $evenement->lieu ? [
            '@type' => 'Place',
            'name' => $evenement->lieu,
            'address' => $evenement->lieu,
        ] : null,
        'offers' => [
            '@type' => 'Offer',
            'url' => $evenement->lien_inscription ?: route('evenements.show', $evenement),
            'price' => $evenement->gratuit ? 0 : (float) ($evenement->prix ?: 0),
            'priceCurrency' => 'CDF',
            'availability' => 'https://schema.org/InStock',
        ],
        'organizer' => [
            '@type' => 'Organization',
            'name' => 'Centre d\'Art Orion',
            'url' => route('home'),
        ],
    ]);
@endphp
<script type="application/ld+json">{!! json_encode($eventSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endpush

@section('content')

@php
    $shareUrl = route('evenements.show', $evenement);
    $shareText = __('pages.events.detail.share_text', ['titre' => $evenement->titre]);
@endphp

<section style="padding:80px 0 60px;background:#0a0a0a;border-bottom:1px solid #1a1a1a;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
        <nav style="display:flex;align-items:center;gap:8px;margin-bottom:32px;font-size:0.8rem;color:#555;font-family:'Space Grotesk',sans-serif;">
            <a href="{{ route('home') }}" style="color:#555;text-decoration:none;" onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#555'">{{ __('pages.events.detail.breadcrumb_home') }}</a>
            <span>›</span>
            <a href="{{ route('evenements.index') }}" style="color:#555;text-decoration:none;" onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#555'">{{ __('pages.events.detail.breadcrumb_events') }}</a>
            <span>›</span>
            <span style="color:#f5f5f0;">{{ Str::limit($evenement->titre, 40) }}</span>
        </nav>
        <div style="display:grid;grid-template-columns:1fr auto;gap:32px;align-items:start;flex-wrap:wrap;">
            <div>
                @if($evenement->type)<span class="tag tag-orange" style="margin-bottom:16px;display:inline-block;">{{ ucfirst($evenement->type) }}</span>@endif
                <h1 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,3.2rem);font-weight:900;color:#f5f5f0;line-height:1.1;margin:0 0 16px;">{{ $evenement->titre }}</h1>
                <p style="color:#888;font-size:1rem;line-height:1.8;max-width:600px;">{{ $evenement->description }}</p>
            </div>
        </div>
    </div>
</section>

<section style="padding:80px 0;background:#0d0d0d;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
        <div style="display:grid;grid-template-columns:1fr 320px;gap:48px;align-items:start;">

            <div>
                @if($evenement->image_url)
                <div style="border-radius:10px;overflow:hidden;margin-bottom:28px;height:360px;background:#111;border:1px solid #1a1a1a;">
                    <img src="{{ $evenement->image_url }}" alt="{{ $evenement->titre }}" style="width:100%;height:100%;object-fit:cover;">
                </div>
                @endif

                @if($evenement->contenu)
                <div style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:40px;margin-bottom:28px;">
                    <h2 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1rem;letter-spacing:0.08em;text-transform:uppercase;color:#f5f5f0;margin:0 0 20px;">{{ __('pages.events.detail.about_title') }}</h2>
                    <div class="prose-dark">{!! nl2br(e($evenement->contenu)) !!}</div>
                </div>
                @else
                <div style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:40px;margin-bottom:28px;">
                    <h2 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1rem;letter-spacing:0.08em;text-transform:uppercase;color:#f5f5f0;margin:0 0 20px;">{{ __('pages.events.detail.about_title') }}</h2>
                    <p class="prose-dark">{{ $evenement->description }}</p>
                </div>
                @endif

                @if($autres->count())
                <div>
                    <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.9rem;letter-spacing:0.08em;text-transform:uppercase;color:#f5f5f0;margin:0 0 20px;">{{ __('pages.events.detail.other_upcoming') }}</h3>
                    <div style="display:flex;flex-direction:column;gap:12px;">
                        @foreach($autres as $a)
                        <a href="{{ route('evenements.show', $a) }}"
                           style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:20px;display:flex;gap:20px;align-items:center;text-decoration:none;transition:border-color 0.2s;"
                           onmouseover="this.style.borderColor='#e0703033'" onmouseout="this.style.borderColor='#1a1a1a'">
                            <div style="text-align:center;min-width:50px;flex-shrink:0;">
                                <div style="font-family:'Playfair Display',serif;font-size:1.4rem;font-weight:900;color:#e07030;line-height:1;">{{ $a->date_debut->format('d') }}</div>
                                <div style="font-size:0.65rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#666;font-family:'Space Grotesk',sans-serif;">{{ $a->date_debut->translatedFormat('M') }}</div>
                            </div>
                            <div>
                                <h4 style="font-family:'Space Grotesk',sans-serif;font-weight:600;font-size:0.9rem;color:#f5f5f0;margin:0 0 4px;">{{ $a->titre }}</h4>
                                <p style="color:#555;font-size:0.78rem;margin:0;">{{ $a->lieu }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div>
                <div style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:32px;position:sticky;top:90px;">
                    <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.85rem;letter-spacing:0.08em;text-transform:uppercase;color:#f5f5f0;margin:0 0 20px;">{{ __('pages.events.detail.practical_info') }}</h3>

                    <div style="display:flex;flex-direction:column;gap:16px;margin-bottom:28px;padding-bottom:28px;border-bottom:1px solid #1a1a1a;">
                        <div style="display:flex;gap:12px;align-items:flex-start;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#e07030" stroke-width="2" style="flex-shrink:0;margin-top:2px;"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                            <div>
                                <p style="color:#888;font-size:0.8rem;margin:0 0 2px;font-family:'Space Grotesk',sans-serif;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;font-size:0.72rem;">{{ __('pages.events.detail.date') }}</p>
                                <p style="color:#f5f5f0;font-size:0.88rem;margin:0;">{{ $evenement->date_debut->format(app()->getLocale() === 'en' ? 'd/m/Y \a\t H:i' : 'd/m/Y à H:i') }}</p>
                            </div>
                        </div>
                        @if($evenement->lieu)
                        <div style="display:flex;gap:12px;align-items:flex-start;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#d4a030" stroke-width="2" style="flex-shrink:0;margin-top:2px;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <div>
                                <p style="color:#888;font-size:0.72rem;font-family:'Space Grotesk',sans-serif;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;margin:0 0 2px;">{{ __('pages.events.detail.venue') }}</p>
                                <p style="color:#f5f5f0;font-size:0.88rem;margin:0;">{{ $evenement->lieu }}</p>
                            </div>
                        </div>
                        @endif
                        <div style="display:flex;gap:12px;align-items:flex-start;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4caf7d" stroke-width="2" style="flex-shrink:0;margin-top:2px;"><path d="M20 12V22H4V12M22 7H2v5h20V7zM12 22V7M12 7H7.5a2.5 2.5 0 010-5C11 2 12 7 12 7zM12 7h4.5a2.5 2.5 0 000-5C13 2 12 7 12 7z"/></svg>
                            <div>
                                <p style="color:#888;font-size:0.72rem;font-family:'Space Grotesk',sans-serif;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;margin:0 0 2px;">{{ __('pages.events.detail.entry') }}</p>
                                @if($evenement->gratuit)
                                <p style="color:#4caf7d;font-size:0.88rem;font-weight:700;margin:0;">{{ __('pages.events.detail.free') }}</p>
                                @elseif($evenement->prix)
                                <p style="color:#d4a030;font-size:0.88rem;font-weight:700;margin:0;">${{ number_format($evenement->prix, 0) }}</p>
                                @else
                                <p style="color:#f5f5f0;font-size:0.88rem;margin:0;">{{ __('pages.events.detail.on_registration') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div style="margin-bottom:28px;padding-bottom:28px;border-bottom:1px solid #1a1a1a;">
                        <h4 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.78rem;letter-spacing:0.08em;text-transform:uppercase;color:#f5f5f0;margin:0 0 14px;">{{ __('pages.events.detail.share_event') }}</h4>

                        <div style="display:flex;gap:8px;margin-bottom:12px;">
                            <input id="event-share-url" type="text" readonly value="{{ $shareUrl }}"
                                   style="flex:1;min-width:0;padding:9px 10px;background:#0d0d0d;border:1px solid #1a1a1a;border-radius:6px;color:#777;font-family:'Space Grotesk',sans-serif;font-size:0.75rem;outline:none;"
                                   onclick="this.select()">
                            <button type="button" id="event-share-copy" onclick="copyEventShareUrl()"
                                    style="padding:9px 12px;background:rgba(76,175,125,0.1);border:1px solid rgba(76,175,125,0.25);border-radius:6px;color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;cursor:pointer;">
                                {{ __('pages.events.detail.copy') }}
                            </button>
                        </div>

                        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:8px;">
                            <a href="https://wa.me/?text={{ urlencode($shareText . ' : ' . $shareUrl) }}" target="_blank" rel="noopener"
                               aria-label="{{ __('pages.events.detail.share_whatsapp') }}"
                               style="height:38px;display:flex;align-items:center;justify-content:center;background:rgba(37,211,102,0.08);border:1px solid rgba(37,211,102,0.22);border-radius:6px;color:#25d366;text-decoration:none;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:800;">
                                WA
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}" target="_blank" rel="noopener"
                               aria-label="{{ __('pages.events.detail.share_facebook') }}"
                               style="height:38px;display:flex;align-items:center;justify-content:center;background:rgba(24,119,242,0.08);border:1px solid rgba(24,119,242,0.22);border-radius:6px;color:#1877f2;text-decoration:none;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:800;">
                                FB
                            </a>
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($shareText) }}&url={{ urlencode($shareUrl) }}" target="_blank" rel="noopener"
                               aria-label="{{ __('pages.events.detail.share_x') }}"
                               style="height:38px;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,0.04);border:1px solid #222;border-radius:6px;color:#aaa;text-decoration:none;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:800;">
                                X
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($shareUrl) }}" target="_blank" rel="noopener"
                               aria-label="{{ __('pages.events.detail.share_linkedin') }}"
                               style="height:38px;display:flex;align-items:center;justify-content:center;background:rgba(10,102,194,0.08);border:1px solid rgba(10,102,194,0.22);border-radius:6px;color:#0a66c2;text-decoration:none;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:800;">
                                IN
                            </a>
                        </div>
                    </div>

                    @if($evenement->statut === 'a_venir')
                    @if($evenement->lien_inscription)
                    <a href="{{ $evenement->lien_inscription }}" target="_blank" class="btn-gold" style="width:100%;justify-content:center;">
                        {{ __('pages.events.detail.register_external') }}
                    </a>
                    @else
                    <a href="{{ route('contact.index') }}?sujet={{ urlencode('Inscription — '.$evenement->titre) }}"
                       class="btn-gold" style="width:100%;justify-content:center;">
                        {{ __('pages.events.detail.register_contact') }}
                    </a>
                    @endif
                    @endif

                    <a href="{{ route('evenements.index') }}" class="btn-outline" style="width:100%;justify-content:center;margin-top:10px;">
                        {{ __('pages.events.detail.back_to_events') }}
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
@media(max-width:900px){
    section > div > div[style*="grid-template-columns:1fr 320px"] {
        grid-template-columns: 1fr !important;
    }
}
</style>

@push('scripts')
<script>
function copyEventShareUrl() {
    var input = document.getElementById('event-share-url');
    var btn = document.getElementById('event-share-copy');
    if (!input) return;

    input.select();
    input.setSelectionRange(0, 99999);

    var done = function () {
        if (!btn) return;
        var old = btn.textContent;
        btn.textContent = @json(__('pages.events.detail.copied'));
        setTimeout(function () { btn.textContent = old; }, 1600);
    };

    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(input.value).then(done).catch(function () {
            document.execCommand('copy');
            done();
        });
        return;
    }

    document.execCommand('copy');
    done();
}
</script>
@endpush

@endsection
