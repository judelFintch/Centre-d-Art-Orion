@extends('layouts.app')

@section('title', $formation->titre . ' — ' . __('common.site_name'))
@section('meta_description', Str::limit($formation->description, 160))

@section('content')

{{-- Hero --}}
<section style="padding:80px 0 60px;background:#0a0a0a;border-bottom:1px solid #1a1a1a;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 30% 50%,rgba(224,112,48,0.07),transparent 60%);pointer-events:none;"></div>
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:1;">
        {{-- Breadcrumb --}}
        <nav style="display:flex;align-items:center;gap:8px;margin-bottom:32px;font-size:0.8rem;color:#555;font-family:'Space Grotesk',sans-serif;">
            <a href="{{ route('home') }}" style="color:#555;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#555'">{{ __('pages.formations.detail.breadcrumb_home') }}</a>
            <span>›</span>
            <a href="{{ route('formations.index') }}" style="color:#555;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#555'">{{ __('pages.formations.detail.breadcrumb_formations') }}</a>
            <span>›</span>
            <span style="color:#f5f5f0;">{{ $formation->titre }}</span>
        </nav>

        <div style="display:grid;grid-template-columns:1fr auto;gap:40px;align-items:start;flex-wrap:wrap;">
            <div>
                @if($formation->categorie)
                <span class="tag tag-orange" style="margin-bottom:16px;display:inline-block;">{{ $formation->categorie }}</span>
                @endif
                <h1 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,3.2rem);font-weight:900;color:#f5f5f0;line-height:1.1;margin:0 0 16px;">{{ $formation->titre }}</h1>
                <p style="color:#888;font-size:1rem;line-height:1.8;max-width:600px;">{{ $formation->description }}</p>
            </div>
        </div>
    </div>
</section>

{{-- Image de la formation --}}
@if($formation->image && file_exists(public_path('storage/'.$formation->image)))
<div style="max-width:1280px;margin:0 auto;padding:0 24px;">
    <div style="height:380px;border-radius:12px;overflow:hidden;margin-top:-1px;position:relative;">
        <img src="{{ asset('storage/'.$formation->image) }}"
             alt="{{ $formation->titre }}"
             style="width:100%;height:100%;object-fit:cover;display:block;">
        <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(10,10,10,0.5),transparent 50%);"></div>
        @if($formation->niveau)
        <div style="position:absolute;bottom:20px;left:20px;">
            <span class="tag tag-orange">{{ $formation->niveau }}</span>
        </div>
        @endif
    </div>
</div>
@endif

{{-- Contenu principal --}}
<section style="padding:80px 0;background:#0d0d0d;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
        <div style="display:grid;grid-template-columns:1fr 340px;gap:48px;align-items:start;">

            {{-- Contenu --}}
            <div>
                @if($formation->contenu)
                <div style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:40px;margin-bottom:32px;">
                    <h2 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1rem;letter-spacing:0.08em;text-transform:uppercase;color:#f5f5f0;margin:0 0 20px;">{{ __('pages.formations.detail.program_title') }}</h2>
                    <div class="prose-dark">{!! nl2br(e($formation->contenu)) !!}</div>
                </div>
                @endif

                {{-- Informations complémentaires --}}
                <div style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:40px;">
                    <h2 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1rem;letter-spacing:0.08em;text-transform:uppercase;color:#f5f5f0;margin:0 0 24px;">{{ __('pages.formations.detail.practical_info') }}</h2>
                    <div style="display:flex;flex-direction:column;gap:14px;">
                        @if($formation->duree)
                        <div style="display:flex;align-items:center;gap:14px;padding:14px;background:#0d0d0d;border-radius:6px;">
                            <div style="width:36px;height:36px;background:rgba(76,175,125,0.12);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4caf7d" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                            </div>
                            <div>
                                <div style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;margin-bottom:2px;">{{ __('pages.formations.detail.duration') }}</div>
                                <div style="color:#f5f5f0;font-size:0.9rem;">{{ $formation->duree }}</div>
                            </div>
                        </div>
                        @endif
                        @if($formation->niveau)
                        <div style="display:flex;align-items:center;gap:14px;padding:14px;background:#0d0d0d;border-radius:6px;">
                            <div style="width:36px;height:36px;background:rgba(212,160,48,0.12);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#d4a030" stroke-width="2"><path d="M18 20V10M12 20V4M6 20v-6"/></svg>
                            </div>
                            <div>
                                <div style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;margin-bottom:2px;">{{ __('pages.formations.detail.level') }}</div>
                                <div style="color:#f5f5f0;font-size:0.9rem;">{{ $formation->niveau }}</div>
                            </div>
                        </div>
                        @endif
                        @if($formation->public_cible)
                        <div style="display:flex;align-items:center;gap:14px;padding:14px;background:#0d0d0d;border-radius:6px;">
                            <div style="width:36px;height:36px;background:rgba(224,112,48,0.12);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#e07030" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8z"/></svg>
                            </div>
                            <div>
                                <div style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;margin-bottom:2px;">{{ __('pages.formations.detail.audience') }}</div>
                                <div style="color:#f5f5f0;font-size:0.9rem;">{{ $formation->public_cible }}</div>
                            </div>
                        </div>
                        @endif
                        @if($formation->categorie)
                        <div style="display:flex;align-items:center;gap:14px;padding:14px;background:#0d0d0d;border-radius:6px;">
                            <div style="width:36px;height:36px;background:rgba(76,175,125,0.12);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4caf7d" stroke-width="2"><path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/></svg>
                            </div>
                            <div>
                                <div style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;margin-bottom:2px;">{{ __('pages.formations.detail.category') }}</div>
                                <div style="color:#f5f5f0;font-size:0.9rem;">{{ $formation->categorie }}</div>
                            </div>
                        </div>
                        @endif
                        @if($formation->prix)
                        <div style="display:flex;align-items:center;gap:14px;padding:14px;background:#0d0d0d;border-radius:6px;">
                            <div style="width:36px;height:36px;background:rgba(212,160,48,0.12);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#d4a030" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
                            </div>
                            <div>
                                <div style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;margin-bottom:2px;">{{ __('pages.formations.detail.price') }}</div>
                                <div style="color:#d4a030;font-size:0.9rem;font-weight:700;">${{ number_format($formation->prix, 0) }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div>
                {{-- Carte inscription --}}
                <div style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:32px;position:sticky;top:90px;">
                    @if($formation->prix)
                    <div style="font-family:'Playfair Display',Georgia,serif;font-size:2.2rem;font-weight:900;color:#d4a030;margin-bottom:4px;">${{ number_format($formation->prix, 0) }}</div>
                    <p style="color:#555;font-size:0.8rem;margin:0 0 24px;">{{ __('pages.formations.detail.full_price_note') }}</p>
                    @endif

                    <div style="display:flex;flex-direction:column;gap:14px;margin-bottom:28px;padding-bottom:28px;border-bottom:1px solid #1a1a1a;">
                        @if($formation->duree)
                        <div style="display:flex;justify-content:space-between;align-items:center;">
                            <span style="color:#666;font-size:0.85rem;">{{ __('pages.formations.detail.duration') }}</span>
                            <span style="color:#f5f5f0;font-weight:600;font-size:0.85rem;font-family:'Space Grotesk',sans-serif;">{{ $formation->duree }}</span>
                        </div>
                        @endif
                        @if($formation->niveau)
                        <div style="display:flex;justify-content:space-between;align-items:center;">
                            <span style="color:#666;font-size:0.85rem;">{{ __('pages.formations.detail.level') }}</span>
                            <span style="color:#f5f5f0;font-weight:600;font-size:0.85rem;font-family:'Space Grotesk',sans-serif;">{{ $formation->niveau }}</span>
                        </div>
                        @endif
                        @if($formation->public_cible)
                        <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:12px;">
                            <span style="color:#666;font-size:0.85rem;flex-shrink:0;">{{ __('pages.formations.detail.audience') }}</span>
                            <span style="color:#f5f5f0;font-size:0.85rem;text-align:right;font-family:'Space Grotesk',sans-serif;">{{ $formation->public_cible }}</span>
                        </div>
                        @endif
                    </div>

                    <a href="{{ route('contact.index') }}?sujet=Inscription+{{ urlencode($formation->titre) }}"
                       class="btn-gold" style="width:100%;justify-content:center;">
                        {{ __('pages.formations.detail.enroll_now') }}
                    </a>
                    <a href="{{ route('contact.index') }}" class="btn-outline" style="width:100%;justify-content:center;margin-top:10px;">
                        {{ __('pages.formations.detail.ask_question') }}
                    </a>

                    <p style="color:#444;font-size:0.75rem;text-align:center;margin:16px 0 0;line-height:1.6;">
                        {{ __('pages.formations.detail.response_time') }}
                    </p>
                </div>

                {{-- Contact rapide --}}
                <div style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:24px;margin-top:16px;">
                    <h4 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.85rem;color:#f5f5f0;margin:0 0 12px;">{{ __('pages.formations.detail.questions_title') }}</h4>
                    <p style="color:#666;font-size:0.82rem;line-height:1.6;margin:0 0 14px;">{{ __('pages.formations.detail.questions_desc') }}</p>
                    <div style="display:flex;flex-direction:column;gap:6px;color:#4caf7d;font-size:0.85rem;font-family:'Space Grotesk',sans-serif;">
                        <a href="tel:+243802650023" style="display:flex;align-items:center;gap:8px;color:#4caf7d;text-decoration:none;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.82 19.79 19.79 0 012 1.18 2 2 0 014 .03h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 14v2.92z"/></svg>
                            +243 802 650 023
                        </a>
                        <a href="tel:+243852236771" style="display:flex;align-items:center;gap:8px;color:#4caf7d;text-decoration:none;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.82 19.79 19.79 0 012 1.18 2 2 0 014 .03h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 14v2.92z"/></svg>
                            +243 852 236 771
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Autres formations --}}
@if($autres->count())
<section style="padding:80px 0;background:#0a0a0a;border-top:1px solid #161616;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
        <h2 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1rem;letter-spacing:0.1em;text-transform:uppercase;color:#f5f5f0;margin:0 0 32px;" class="reveal">
            {{ __('pages.formations.detail.other_formations') }}
        </h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:20px;">
            @foreach($autres as $a)
            <a href="{{ route('formations.show', $a->slug) }}"
               class="reveal hover-lift"
               style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;text-decoration:none;display:block;transition:all 0.3s;"
               onmouseover="this.style.borderColor='#d4a03033'" onmouseout="this.style.borderColor='#1a1a1a'">
                <div class="tag tag-gold" style="margin-bottom:12px;display:inline-block;">{{ $a->categorie ?: __('pages.formations.detail.formation_tag_fallback') }}</div>
                <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1rem;color:#f5f5f0;margin:0 0 8px;">{{ $a->titre }}</h3>
                <p style="color:#666;font-size:0.82rem;line-height:1.6;margin:0 0 14px;">{{ Str::limit($a->description, 80) }}</p>
                <span style="color:#4caf7d;font-size:0.8rem;font-family:'Space Grotesk',sans-serif;font-weight:600;">{{ __('pages.formations.detail.view_link') }}</span>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<style>
@media(max-width:900px){
    section > div > div[style*="grid-template-columns:1fr 340px"] {
        grid-template-columns: 1fr !important;
    }
}
@media(max-width:600px){
    div[style*="grid-template-columns:1fr 1fr"][style*="grid-gap"] {
        grid-template-columns: 1fr !important;
    }
}
</style>

@endsection
