@extends('layouts.app')

@section('title', __('pages.podcasts.title'))
@section('meta_description', __('pages.podcasts.meta_description'))

@section('content')

<section style="min-height:92vh;background:#0a0a0a;position:relative;overflow:hidden;padding:120px 0 80px;border-bottom:1px solid #1a1a1a;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 18% 24%,rgba(76,175,125,0.15),transparent 34%),radial-gradient(ellipse at 82% 62%,rgba(212,160,48,0.12),transparent 38%);pointer-events:none;"></div>
    <div style="position:absolute;inset:0;opacity:0.16;background-image:linear-gradient(90deg,rgba(255,255,255,0.07) 1px,transparent 1px),linear-gradient(rgba(255,255,255,0.07) 1px,transparent 1px);background-size:68px 68px;mask-image:linear-gradient(to bottom,#000,transparent 84%);"></div>

    <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:1;">
        <div style="display:grid;grid-template-columns:minmax(0,0.95fr) minmax(360px,0.85fr);gap:56px;align-items:center;">
            <div>
                <div class="tag tag-green" style="margin-bottom:18px;">{{ __('pages.podcasts.hero_tag') }}</div>
                <h1 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2.8rem,7vw,6rem);font-weight:900;color:#f5f5f0;line-height:0.96;margin:0 0 24px;">
                    {{ __('pages.podcasts.hero_title_1') }}<br>
                    <span style="background:linear-gradient(135deg,#4caf7d,#d4a030);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">{{ __('pages.podcasts.hero_title_2') }}</span>
                </h1>
                <p style="color:#aaa19a;font-size:1.05rem;line-height:1.9;max-width:640px;margin:0 0 32px;">
                    {{ __('pages.podcasts.hero_desc') }}
                </p>
                <div style="display:flex;gap:14px;flex-wrap:wrap;">
                    <a href="#episodes" class="btn-primary">{{ __('pages.podcasts.listen_episodes') }}</a>
                    <a href="{{ route('contact.index') }}?sujet=Proposition+Podcast" class="btn-outline">{{ __('pages.podcasts.propose_guest') }}</a>
                </div>
            </div>

            <div style="position:relative;">
                @if($featured)
                <div style="aspect-ratio:1;border-radius:50%;background:linear-gradient(135deg,rgba(76,175,125,0.22),rgba(212,160,48,0.16));border:1px solid rgba(255,255,255,0.12);display:flex;align-items:center;justify-content:center;box-shadow:0 30px 100px rgba(0,0,0,0.45);">
                    <div style="width:74%;height:74%;border-radius:50%;{{ $featured->cover_source ? "background:url('{$featured->cover_source}') center/cover;" : 'background:linear-gradient(135deg,#16241d,#2b2417);' }}border:1px solid rgba(255,255,255,0.18);position:relative;overflow:hidden;">
                        <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.82),rgba(0,0,0,0.08));"></div>
                        <div style="position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);width:84px;height:84px;border-radius:50%;background:rgba(212,160,48,0.22);border:2px solid rgba(212,160,48,0.55);display:flex;align-items:center;justify-content:center;">
                            <svg width="30" height="30" viewBox="0 0 24 24" fill="#d4a030"><polygon points="7 4 19 12 7 20 7 4"/></svg>
                        </div>
                    </div>
                </div>
                <div style="position:absolute;right:0;bottom:24px;background:#111;border:1px solid #242018;border-radius:8px;padding:18px 20px;max-width:260px;">
                    <div style="color:#d4a030;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;margin-bottom:8px;">{{ __('pages.podcasts.flagship_series') }}</div>
                    <p style="color:#f5f5f0;font-family:'Playfair Display',Georgia,serif;font-size:1.35rem;line-height:1.1;margin:0;">{{ $featured->series ?? __('pages.podcasts.flagship_series_fallback') }}</p>
                    <p style="color:#777;font-size:0.82rem;line-height:1.55;margin:8px 0 0;">{{ $featured->description ?? __('pages.podcasts.flagship_desc_fallback') }}</p>
                </div>
                @else
                <div style="aspect-ratio:1;border-radius:50%;background:linear-gradient(135deg,rgba(76,175,125,0.12),rgba(212,160,48,0.08));border:1px solid rgba(255,255,255,0.1);display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:56px;box-shadow:0 30px 100px rgba(0,0,0,0.35);">
                    <svg width="62" height="62" viewBox="0 0 24 24" fill="none" stroke="#d4a030" stroke-width="1.4" aria-hidden="true"><path d="M4 14a8 8 0 0 1 16 0"/><path d="M18 19v-5a2 2 0 0 1 2-2h1v7h-3ZM6 19v-5a2 2 0 0 0-2-2H3v7h3Z"/></svg>
                    <p style="color:#f5f5f0;font-family:'Playfair Display',Georgia,serif;font-size:1.35rem;line-height:1.2;margin:20px 0 8px;">{{ __('pages.podcasts.empty_title') }}</p>
                    <p style="color:#777;font-size:0.84rem;line-height:1.6;margin:0;">{{ __('pages.podcasts.empty_desc') }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<section id="episodes" style="padding:88px 0;background:#0d0d0d;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
        <div style="display:flex;align-items:end;justify-content:space-between;gap:24px;flex-wrap:wrap;margin-bottom:34px;">
            <div>
                <div class="tag tag-gold" style="margin-bottom:14px;">{{ __('pages.podcasts.latest_tag') }}</div>
                <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,3rem);line-height:1.08;color:#f5f5f0;margin:0;">{{ __('pages.podcasts.latest_title') }}</h2>
            </div>
            <p style="color:#777;max-width:420px;line-height:1.75;margin:0;">{{ __('pages.podcasts.latest_desc') }}</p>
        </div>

        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px;">
            @forelse($episodes as $episode)
            <article style="background:#111;border:1px solid #1a1a1a;border-radius:8px;overflow:hidden;">
                <div style="height:190px;position:relative;background:#161616;">
                    @if($episode->cover_source)
                    <img src="{{ $episode->cover_source }}" alt="{{ $episode->title }}" style="width:100%;height:100%;object-fit:cover;">
                    @else
                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#16241d,#2b2417);">
                        <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="{{ $episode->accent }}" stroke-width="1.4" aria-hidden="true"><path d="M4 14a8 8 0 0 1 16 0"/><path d="M18 19v-5a2 2 0 0 1 2-2h1v7h-3ZM6 19v-5a2 2 0 0 0-2-2H3v7h3Z"/></svg>
                    </div>
                    @endif
                    <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.82),transparent);"></div>
                    <div style="position:absolute;left:18px;bottom:16px;color:{{ $episode->accent }};font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:800;letter-spacing:0.1em;">EP. {{ $episode->episode_number ?: $loop->iteration }}</div>
                </div>
                <div style="padding:24px;">
                    <h3 style="font-family:'Playfair Display',Georgia,serif;color:#f5f5f0;font-size:1.45rem;line-height:1.12;margin:0 0 10px;">{{ $episode->title }}</h3>
                    <p style="color:#777;font-size:0.88rem;line-height:1.7;margin:0 0 18px;">{{ $episode->excerpt }}</p>
                    @if($episode->audio_source)
                    <audio controls src="{{ $episode->audio_source }}" style="width:100%;margin-bottom:16px;"></audio>
                    @endif
                    <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;">
                        <span style="color:#555;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;">{{ $episode->duration ?: __('pages.podcasts.coming_soon') }}</span>
                        <a href="{{ route('contact.index') }}?sujet=Podcast+{{ urlencode($episode->title) }}" style="color:{{ $episode->accent }};font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:700;text-decoration:none;text-transform:uppercase;letter-spacing:0.08em;">{{ $episode->audio_source ? __('pages.podcasts.react') : __('pages.podcasts.get_notified') }}</a>
                    </div>
                </div>
            </article>
            @empty
            <div style="grid-column:1/-1;background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:48px 24px;text-align:center;">
                <h3 style="font-family:'Playfair Display',Georgia,serif;color:#f5f5f0;font-size:1.6rem;margin:0 0 10px;">{{ __('pages.podcasts.empty_title') }}</h3>
                <p style="color:#777;line-height:1.7;margin:0;">{{ __('pages.podcasts.empty_desc') }}</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<section style="padding:88px 0;background:#0a0a0a;border-top:1px solid #161616;">
    <div style="max-width:1120px;margin:0 auto;padding:0 24px;">
        <div style="display:grid;grid-template-columns:0.9fr 1.1fr;gap:48px;align-items:start;">
            <div>
                <div class="tag tag-green" style="margin-bottom:14px;">{{ __('pages.podcasts.participate_tag') }}</div>
                <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,3rem);line-height:1.08;color:#f5f5f0;margin:0 0 18px;">{{ __('pages.podcasts.participate_title') }}</h2>
                <p style="color:#888;line-height:1.85;margin:0;">{{ __('pages.podcasts.participate_desc') }}</p>
            </div>
            <div style="display:grid;gap:14px;">
                @foreach(__('pages.podcasts.steps') as $step)
                <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:22px;">
                    <h3 style="font-family:'Space Grotesk',sans-serif;color:#f5f5f0;font-size:0.95rem;text-transform:uppercase;letter-spacing:0.08em;margin:0 0 8px;">{{ $step['title'] }}</h3>
                    <p style="color:#777;font-size:0.9rem;line-height:1.7;margin:0;">{{ $step['desc'] }}</p>
                </div>
                @endforeach
                <a href="{{ route('contact.index') }}?sujet=Proposition+Podcast" class="btn-gold" style="justify-content:center;margin-top:8px;">{{ __('pages.podcasts.propose_participation') }}</a>
            </div>
        </div>
    </div>
</section>

<style>
@media(max-width:900px){
    section div[style*="grid-template-columns:minmax(0,0.95fr)"],
    section div[style*="grid-template-columns:0.9fr 1.1fr"],
    section div[style*="grid-template-columns:repeat(3,1fr)"] {
        grid-template-columns: 1fr !important;
    }
}
</style>

@endsection
