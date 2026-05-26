@extends('layouts.app')

@section('title', $article['title'] . ' — Blog Orion')
@section('meta_description', Str::limit($article['excerpt'], 160))

@section('content')

<article>
    <section style="padding:110px 0 56px;background:#0a0a0a;border-bottom:1px solid #1a1a1a;position:relative;overflow:hidden;">
        <div style="position:absolute;inset:0;background:url('{{ asset($article['image']) }}') center/cover;opacity:0.26;"></div>
        <div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(10,10,10,0.58),#0a0a0a 82%);"></div>
        <div style="max-width:1120px;margin:0 auto;padding:0 24px;position:relative;z-index:1;">
            <nav style="display:flex;align-items:center;gap:8px;margin-bottom:34px;font-size:0.8rem;color:#555;font-family:'Space Grotesk',sans-serif;">
                <a href="{{ route('home') }}" style="color:#555;text-decoration:none;">Accueil</a>
                <span>›</span>
                <a href="{{ route('blog.index') }}" style="color:#555;text-decoration:none;">Blog</a>
                <span>›</span>
                <span style="color:#f5f5f0;">{{ $article['category'] }}</span>
            </nav>

            <a href="{{ route('blog.category', Str::slug($article['category'])) }}" class="tag tag-gold" style="margin-bottom:18px;text-decoration:none;">{{ $article['category'] }}</a>
            <h1 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2.4rem,6vw,5.2rem);font-weight:900;line-height:0.98;color:#f5f5f0;margin:0 0 22px;max-width:900px;">
                {{ $article['title'] }}
            </h1>
            <p style="color:#b6afa7;font-size:1.05rem;line-height:1.85;max-width:740px;margin:0 0 28px;">{{ $article['excerpt'] }}</p>
            <div style="display:flex;align-items:center;gap:14px;flex-wrap:wrap;color:#777;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;">
                <span>{{ $article['author'] }}</span>
                <span style="color:#333;">•</span>
                <span>{{ $article['date'] }}</span>
                <span style="color:#333;">•</span>
                <span>{{ $article['read_time'] }} de lecture</span>
            </div>
        </div>
    </section>

    <section style="padding:72px 0;background:#0d0d0d;">
        <div style="max-width:1120px;margin:0 auto;padding:0 24px;">
            <div style="display:grid;grid-template-columns:minmax(0,720px) 280px;gap:56px;align-items:start;">
                <div>
                    <div style="border-radius:8px;overflow:hidden;border:1px solid #1a1a1a;margin-bottom:42px;background:#111;">
                        <img src="{{ asset($article['image']) }}" alt="{{ $article['title'] }}" style="width:100%;height:auto;display:block;">
                    </div>

                    <div style="font-size:1.02rem;line-height:1.95;color:#b6afa7;">
                        @foreach($article['body'] as $paragraph)
                        <p style="margin:0 0 24px;">{{ $paragraph }}</p>
                        @endforeach
                    </div>

                    <blockquote style="margin:42px 0;padding:28px 32px;border-left:3px solid #d4a030;background:#111;color:#f5f5f0;font-family:'Playfair Display',Georgia,serif;font-size:1.55rem;line-height:1.35;border-radius:0 8px 8px 0;">
                        {{ $article['quote'] }}
                    </blockquote>

                    <div style="margin-top:48px;">
                        <h2 style="font-family:'Space Grotesk',sans-serif;font-size:0.95rem;font-weight:700;color:#f5f5f0;text-transform:uppercase;letter-spacing:0.1em;margin:0 0 22px;">Images correspondantes</h2>
                        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;">
                            @foreach($article['gallery'] as $image)
                            <div style="aspect-ratio:4/3;border-radius:8px;overflow:hidden;background:#111;border:1px solid #1a1a1a;">
                                <img src="{{ asset($image) }}" alt="{{ $article['title'] }}" style="width:100%;height:100%;object-fit:cover;">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <aside style="position:sticky;top:96px;">
                    <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;margin-bottom:18px;">
                        <h3 style="font-family:'Space Grotesk',sans-serif;font-size:0.85rem;font-weight:700;color:#f5f5f0;text-transform:uppercase;letter-spacing:0.09em;margin:0 0 16px;">Dans cet article</h3>
                        <div style="display:flex;flex-direction:column;gap:12px;color:#777;font-size:0.86rem;line-height:1.55;">
                            <span>Processus créatif</span>
                            <span>Transmission artistique</span>
                            <span>Vie du centre</span>
                        </div>
                    </div>
                    <a href="{{ route('contact.index') }}" style="display:block;background:linear-gradient(135deg,#4caf7d,#2d7a52);border-radius:8px;padding:24px;text-decoration:none;color:#fff;">
                        <span style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:8px;">Participer</span>
                        <span style="display:block;font-size:0.9rem;line-height:1.55;">Échangez avec nous pour rejoindre un atelier ou proposer un projet.</span>
                    </a>
                </aside>
            </div>
        </div>
    </section>
</article>

@if($related->count())
<section style="padding:72px 0 96px;background:#0a0a0a;border-top:1px solid #161616;">
    <div style="max-width:1120px;margin:0 auto;padding:0 24px;">
        <h2 style="font-family:'Space Grotesk',sans-serif;font-size:0.95rem;font-weight:700;color:#f5f5f0;text-transform:uppercase;letter-spacing:0.1em;margin:0 0 28px;">À lire aussi</h2>
        <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:20px;">
            @foreach($related as $item)
            <a href="{{ route('blog.show', $item['slug']) }}" style="background:#111;border:1px solid #1a1a1a;border-radius:8px;overflow:hidden;text-decoration:none;display:grid;grid-template-columns:140px 1fr;">
                <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}" style="width:100%;height:100%;object-fit:cover;">
                <div style="padding:18px;">
                    <span style="color:#d4a030;font-family:'Space Grotesk',sans-serif;font-size:0.68rem;text-transform:uppercase;letter-spacing:0.08em;">{{ $item['category'] }}</span>
                    <h3 style="font-family:'Playfair Display',Georgia,serif;color:#f5f5f0;font-size:1.25rem;line-height:1.15;margin:8px 0;">{{ $item['title'] }}</h3>
                    <p style="color:#666;font-size:0.8rem;line-height:1.55;margin:0;">{{ Str::limit($item['excerpt'], 82) }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<style>
@media(max-width:900px){
    section div[style*="grid-template-columns:minmax(0,720px)"] {
        grid-template-columns: 1fr !important;
    }
    aside[style*="position:sticky"] {
        position: static !important;
    }
    section div[style*="grid-template-columns:repeat(2,1fr)"],
    div[style*="grid-template-columns:repeat(3,1fr)"] {
        grid-template-columns: 1fr !important;
    }
    a[style*="grid-template-columns:140px 1fr"] {
        grid-template-columns: 1fr !important;
    }
}
</style>

@endsection
