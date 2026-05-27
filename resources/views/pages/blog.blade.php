@extends('layouts.app')

@section('title', 'Blog — Centre d\'Art Orion')
@section('meta_description', $activeCategory ? 'Articles de la catégorie '.$activeCategory['name'].' — Centre d\'Art Orion.' : 'Carnet d\'atelier du Centre d\'Art Orion : réflexions, coulisses, récits de création et actualités artistiques.')

@section('content')

<section style="background:#0a0a0a;position:relative;overflow:hidden;padding:120px 0 72px;border-bottom:1px solid #1a1a1a;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 18% 24%,rgba(212,160,48,0.13),transparent 34%),radial-gradient(ellipse at 78% 68%,rgba(76,175,125,0.09),transparent 36%);pointer-events:none;"></div>
    <div style="position:absolute;inset:0;opacity:0.12;background-image:linear-gradient(90deg,rgba(255,255,255,0.08) 1px,transparent 1px),linear-gradient(rgba(255,255,255,0.08) 1px,transparent 1px);background-size:72px 72px;mask-image:linear-gradient(to bottom,#000,transparent 80%);"></div>

    <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:1;">
        <div style="display:grid;grid-template-columns:minmax(0,0.9fr) minmax(420px,1.1fr);gap:48px;align-items:end;">
            <div>
                <div class="tag tag-gold" style="margin-bottom:18px;">{{ $activeCategory ? 'Catégorie' : "Carnet d'atelier" }}</div>
                <h1 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2.8rem,7vw,6.2rem);font-weight:900;color:#f5f5f0;line-height:0.95;margin:0 0 24px;">
                    {{ $activeCategory ? $activeCategory['name'] : 'Blog' }}<br>
                    <span style="background:linear-gradient(135deg,#d4a030,#4caf7d);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">{{ $activeCategory ? 'Articles' : 'Orion' }}</span>
                </h1>
                <p style="color:#8f877d;font-size:1.05rem;line-height:1.9;max-width:620px;margin:0;">
                    {{ $activeCategory ? $activeCategory['count'].' article(s) dans cette catégorie du carnet Orion.' : "Récits de création, coulisses d'ateliers, portraits et réflexions pour suivre la vie artistique du centre." }}
                </p>
            </div>

            @if($featured)
            <a href="{{ route('blog.show', $featured['slug']) }}"
               style="min-height:420px;background:#111;border:1px solid #1f1a12;border-radius:8px;overflow:hidden;display:flex;flex-direction:column;justify-content:flex-end;position:relative;text-decoration:none;">
                <div style="position:absolute;inset:0;background:linear-gradient(145deg,rgba(212,160,48,0.16),transparent 46%),url('{{ asset($featured['image']) }}') center/cover;opacity:0.78;"></div>
                <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.96),rgba(0,0,0,0.14));"></div>
                <div style="position:relative;padding:34px;">
                    <span class="tag tag-gold">Article à la une</span>
                    <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(1.9rem,3.5vw,3rem);line-height:1.04;color:#f5f5f0;margin:18px 0 14px;">
                        {{ $featured['title'] }}
                    </h2>
                    <p style="color:#b6afa7;font-size:0.95rem;line-height:1.75;max-width:620px;margin:0 0 20px;">
                        {{ $featured['excerpt'] }}
                    </p>
                    <span style="color:#d4a030;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;">Lire l'article →</span>
                </div>
            </a>
            @endif
        </div>
    </div>
</section>

<section style="padding:72px 0 100px;background:#0d0d0d;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
        <div style="display:flex;align-items:center;justify-content:space-between;gap:20px;margin-bottom:32px;flex-wrap:wrap;">
	            <h2 style="font-family:'Space Grotesk',sans-serif;font-size:1rem;font-weight:700;color:#f5f5f0;letter-spacing:0.1em;text-transform:uppercase;margin:0;">{{ $activeCategory ? 'Articles filtrés' : 'Tous les articles' }}</h2>
            <div style="display:flex;gap:8px;flex-wrap:wrap;">
                <a href="{{ route('blog.index') }}"
                   style="padding:7px 12px;border:1px solid {{ $activeCategory ? '#222' : 'rgba(76,175,125,0.45)' }};border-radius:4px;color:{{ $activeCategory ? '#777' : '#4caf7d' }};background:{{ $activeCategory ? 'transparent' : 'rgba(76,175,125,0.1)' }};font-family:'Space Grotesk',sans-serif;font-size:0.72rem;text-transform:uppercase;letter-spacing:0.06em;text-decoration:none;">
                    Tous
                </a>
                @foreach($categories as $category)
                @php $isActive = $activeCategory && $activeCategory['slug'] === $category['slug']; @endphp
                <a href="{{ route('blog.category', $category['slug']) }}"
                   style="padding:7px 12px;border:1px solid {{ $isActive ? 'rgba(212,160,48,0.45)' : '#222' }};border-radius:4px;color:{{ $isActive ? '#d4a030' : '#777' }};background:{{ $isActive ? 'rgba(212,160,48,0.1)' : 'transparent' }};font-family:'Space Grotesk',sans-serif;font-size:0.72rem;text-transform:uppercase;letter-spacing:0.06em;text-decoration:none;">
                    {{ $category['name'] }} · {{ $category['count'] }}
                </a>
                @endforeach
            </div>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:22px;">
            @foreach($articles as $article)
            <a href="{{ route('blog.show', $article['slug']) }}"
               class="hover-lift"
               style="background:#111;border:1px solid #1a1a1a;border-radius:8px;overflow:hidden;text-decoration:none;display:flex;flex-direction:column;transition:all 0.3s;">
                <div style="height:210px;position:relative;overflow:hidden;background:#161616;">
                    <img src="{{ asset($article['image']) }}" alt="{{ $article['title'] }}" style="width:100%;height:100%;object-fit:cover;">
	                    <div style="position:absolute;left:14px;bottom:14px;">
	                        <span class="tag {{ $loop->even ? 'tag-green' : 'tag-gold' }}">{{ $article['category'] }}</span>
	                    </div>
                </div>
                <div style="padding:24px;display:flex;flex-direction:column;flex:1;">
                    <div style="display:flex;gap:10px;color:#555;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:12px;flex-wrap:wrap;">
                        <span>{{ $article['date'] }}</span>
                        <span>•</span>
                        <span>{{ $article['read_time'] }}</span>
                        <span>•</span>
                        <span style="display:inline-flex;align-items:center;gap:4px;">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            {{ number_format($article['views'] ?? 0) }}
                        </span>
                    </div>
                    <h3 style="font-family:'Playfair Display',Georgia,serif;font-size:1.45rem;line-height:1.15;color:#f5f5f0;margin:0 0 12px;">{{ $article['title'] }}</h3>
                    <p style="color:#777;font-size:0.88rem;line-height:1.7;margin:0 0 20px;flex:1;">{{ $article['excerpt'] }}</p>
                    <span style="color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;">Ouvrir →</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- Abonnement Blog --}}
<section style="padding:72px 24px;background:#0d1a12;border-top:1px solid #1a2e20;border-bottom:1px solid #1a2e20;">
    <div style="max-width:640px;margin:0 auto;text-align:center;">
        <p style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:#4caf7d;margin:0 0 12px;">Abonnement Blog</p>
        <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:2rem;font-weight:700;color:#f5f5f0;margin:0 0 14px;line-height:1.2;">Ne manquez aucun article</h2>
        <p style="color:#666;font-size:0.9rem;line-height:1.75;margin:0 0 32px;">Recevez nos nouveaux articles — coulisses, formations, création et résidences — dès leur publication.</p>
        <form id="blog-subscribe-form" style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
            @csrf
            <input type="hidden" name="type" value="blog">
            <input type="email" name="email" placeholder="Votre adresse e-mail" required
                   style="flex:1;min-width:220px;max-width:340px;background:#111;border:1px solid #2a2a2a;border-radius:4px;padding:13px 18px;color:#f5f5f0;font-size:0.88rem;font-family:'Space Grotesk',sans-serif;outline:none;transition:border-color 0.2s;"
                   onfocus="this.style.borderColor='#4caf7d'" onblur="this.style.borderColor='#2a2a2a'">
            <button type="submit"
                    style="background:#4caf7d;color:#0a0a0a;font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.82rem;letter-spacing:0.08em;text-transform:uppercase;border:none;border-radius:4px;padding:13px 26px;cursor:pointer;transition:background 0.2s;white-space:nowrap;"
                    onmouseover="this.style.background='#3d9e6a'" onmouseout="this.style.background='#4caf7d'">S'abonner</button>
        </form>
        <div id="blog-subscribe-msg" style="display:none;margin-top:14px;font-size:0.85rem;font-family:'Space Grotesk',sans-serif;"></div>
        <p style="color:#444;font-size:0.78rem;margin:18px 0 0;">Aucun spam. Désabonnement possible à tout moment.</p>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('blog-subscribe-form');
    if (!form) return;
    var msg = document.getElementById('blog-subscribe-msg');

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        var data = new FormData(form);
        var btn = form.querySelector('button[type="submit"]');
        btn.disabled = true;
        btn.textContent = '…';

        fetch('{{ route("abonnement.store") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': data.get('_token'), 'Accept': 'application/json' },
            body: data,
        })
        .then(function (r) { return r.json(); })
        .then(function (json) {
            msg.style.display = 'block';
            msg.style.color = json.success ? '#4caf7d' : '#e07030';
            msg.textContent = json.message;
            if (json.success) { form.reset(); }
        })
        .catch(function () {
            msg.style.display = 'block';
            msg.style.color = '#e07030';
            msg.textContent = 'Une erreur est survenue. Veuillez réessayer.';
        })
        .finally(function () {
            btn.disabled = false;
            btn.textContent = "S'abonner";
        });
    });
});
</script>

<style>
@media(max-width:900px){
    section div[style*="grid-template-columns:minmax(0,0.9fr)"] {
        grid-template-columns: 1fr !important;
    }
}
</style>

@endsection
