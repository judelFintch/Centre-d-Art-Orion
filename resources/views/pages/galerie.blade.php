@extends('layouts.app')

@section('title', __('pages.gallery.title'))
@section('meta_description', __('pages.gallery.meta_description'))

@section('content')

{{-- Hero --}}
<section style="padding:100px 0 80px;background:#0a0a0a;border-bottom:1px solid #1a1a1a;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 50% 70%,rgba(76,175,125,0.06),transparent 60%);pointer-events:none;"></div>
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:1;">
        <div class="tag tag-green" style="margin-bottom:16px;">{{ __('pages.gallery.hero_tag') }}</div>
        <h1 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2.5rem,5vw,4rem);font-weight:900;color:#f5f5f0;line-height:1.1;margin:0 0 20px;">
            {{ __('pages.gallery.hero_title_1') }}<br>
            <span style="background:linear-gradient(135deg,#4caf7d,#d4a030);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">{{ __('pages.gallery.hero_title_2') }}</span>
        </h1>
        <p style="color:#777;font-size:1rem;max-width:500px;line-height:1.8;">{{ __('pages.gallery.hero_desc') }}</p>
    </div>
</section>

{{-- Filtres --}}
<section style="padding:40px 0 0;background:#0d0d0d;border-bottom:1px solid #1a1a1a;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
        <div style="display:flex;flex-wrap:wrap;gap:10px;padding-bottom:32px;" id="galerie-filters">
            <button class="galerie-filter active"
                    data-filter="all"
                    style="padding:8px 20px;background:rgba(76,175,125,0.15);border:1px solid rgba(76,175,125,0.4);color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.8rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;border-radius:4px;cursor:pointer;transition:all 0.2s;">
                {{ __('pages.gallery.filter_all') }}
            </button>
            <button class="galerie-filter"
                    data-filter="photo"
                    style="padding:8px 20px;background:rgba(255,255,255,0.04);border:1px solid #222;color:#777;font-family:'Space Grotesk',sans-serif;font-size:0.8rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;border-radius:4px;cursor:pointer;transition:all 0.2s;">
                {{ __('pages.gallery.filter_photos') }}
            </button>
            <button class="galerie-filter"
                    data-filter="video"
                    style="padding:8px 20px;background:rgba(255,255,255,0.04);border:1px solid #222;color:#777;font-family:'Space Grotesk',sans-serif;font-size:0.8rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;border-radius:4px;cursor:pointer;transition:all 0.2s;">
                {{ __('pages.gallery.filter_videos') }}
            </button>
            @foreach($categories as $cat)
            <button class="galerie-filter"
                    data-filter="{{ $cat }}"
                    style="padding:8px 20px;background:rgba(255,255,255,0.04);border:1px solid #222;color:#777;font-family:'Space Grotesk',sans-serif;font-size:0.8rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;border-radius:4px;cursor:pointer;transition:all 0.2s;">
                {{ ucfirst($cat) }}
            </button>
            @endforeach
        </div>
    </div>
</section>

{{-- Grille galerie --}}
<section style="padding:60px 0 100px;background:#0d0d0d;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">

        @if($items->isEmpty())
        <div style="text-align:center;padding:80px 24px;">
            <div style="font-size:3rem;margin-bottom:16px;">🖼</div>
            <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1.2rem;color:#f5f5f0;margin:0 0 12px;">{{ __('pages.gallery.empty_title') }}</h3>
            <p style="color:#666;font-size:0.9rem;">{{ __('pages.gallery.empty_desc') }}</p>
        </div>
        @else
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:16px;" id="galerie-grid">
            @foreach($items as $item)
            <div class="galerie-item reveal"
                 data-type="{{ $item->type }}"
                 data-categorie="{{ $item->categorie }}"
                 style="position:relative;border-radius:8px;overflow:hidden;background:#111;border:1px solid #1a1a1a;cursor:pointer;aspect-ratio:4/3;transition:all 0.3s;"
                 onmouseover="this.querySelector('.galerie-overlay').style.opacity='1';this.style.transform='scale(1.02)';this.style.boxShadow='0 20px 50px rgba(0,0,0,0.5)'"
                 onmouseout="this.querySelector('.galerie-overlay').style.opacity='0';this.style.transform='scale(1)';this.style.boxShadow='none'"
                 @if($item->type === 'photo') data-lightbox data-src="{{ asset('storage/'.$item->fichier) }}" data-caption="{{ $item->titre }}" @endif>

                {{-- Contenu --}}
                @if($item->type === 'video' && $item->url_video)
                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#1a1a1a,#0d0d0d);">
                    <div style="text-align:center;">
                        <div style="width:60px;height:60px;border-radius:50%;background:rgba(212,160,48,0.2);border:2px solid rgba(212,160,48,0.4);display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#d4a030" stroke="none"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                        </div>
                        <p style="color:#888;font-size:0.78rem;font-family:'Space Grotesk',sans-serif;">{{ $item->titre }}</p>
                    </div>
                </div>
                @elseif($item->fichier && file_exists(public_path('storage/'.$item->fichier)))
                <img src="{{ asset('storage/'.$item->fichier) }}"
                     alt="{{ $item->titre }}"
                     style="width:100%;height:100%;object-fit:cover;">
                @else
                @php $gFallback = ['2.jpg','5.jpg','7.jpg','3.jpg','6.jpg','9.jpg','4.jpg','1.png','22.jpg','11.jpg']; @endphp
                <img src="{{ asset('images/' . $gFallback[$loop->index % count($gFallback)]) }}"
                     alt="{{ $item->titre }}"
                     style="width:100%;height:100%;object-fit:cover;">
                @endif

                {{-- Overlay --}}
                <div class="galerie-overlay"
                     style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.85) 0%,rgba(0,0,0,0.3) 50%,transparent 100%);opacity:0;transition:opacity 0.3s;display:flex;flex-direction:column;justify-content:flex-end;padding:20px;">
                    <p style="font-family:'Space Grotesk',sans-serif;font-weight:600;font-size:0.88rem;color:#f5f5f0;margin:0 0 6px;">{{ $item->titre }}</p>
                    @if($item->categorie)
                    <span class="tag tag-green">{{ $item->categorie }}</span>
                    @endif
                    @if($item->type === 'video')
                    <span class="tag tag-gold" style="margin-top:4px;display:inline-block;">{{ __('pages.gallery.video_tag') }}</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif

    </div>
</section>

{{-- CTA --}}
<section style="padding:80px 0;background:#0a0a0a;border-top:1px solid #161616;">
    <div style="max-width:700px;margin:0 auto;padding:0 24px;text-align:center;" class="reveal">
        <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(1.8rem,3.5vw,2.5rem);font-weight:900;color:#f5f5f0;margin:0 0 16px;">
            {{ __('pages.gallery.cta_title') }}
        </h2>
        <p style="color:#777;font-size:0.95rem;line-height:1.8;margin:0 0 32px;">{{ __('pages.gallery.cta_desc') }}</p>
        <div style="display:flex;flex-wrap:wrap;gap:14px;justify-content:center;">
            <a href="{{ route('formations.index') }}" class="btn-primary">{{ __('pages.about.cta_view_formations') }}</a>
            <a href="{{ route('evenements.index') }}" class="btn-outline">{{ __('pages.gallery.cta_events') }}</a>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.querySelectorAll('.galerie-filter').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.galerie-filter').forEach(b => {
            b.style.background = 'rgba(255,255,255,0.04)';
            b.style.borderColor = '#222';
            b.style.color = '#777';
        });
        btn.style.background = 'rgba(76,175,125,0.15)';
        btn.style.borderColor = 'rgba(76,175,125,0.4)';
        btn.style.color = '#4caf7d';

        const filter = btn.dataset.filter;
        document.querySelectorAll('.galerie-item').forEach(item => {
            if (filter === 'all') {
                item.style.display = '';
            } else if (filter === 'photo' || filter === 'video') {
                item.style.display = item.dataset.type === filter ? '' : 'none';
            } else {
                item.style.display = item.dataset.categorie === filter ? '' : 'none';
            }
        });
    });
});
</script>
@endpush

@endsection
