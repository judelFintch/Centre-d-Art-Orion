@extends('layouts.app')
@section('title', __('pages.unsubscribe.title'))

@section('content')
<section style="min-height:70vh;display:flex;align-items:center;justify-content:center;padding:80px 24px;background:#0a0a0a;">
    <div style="max-width:520px;width:100%;text-align:center;">

        @php
            $listLabel = $abonnement->type === 'blog' ? __('pages.unsubscribe.blog_list') : __('pages.unsubscribe.newsletter_list');
        @endphp

        @if($alreadyUnsubscribed)
        <div style="width:72px;height:72px;background:rgba(212,160,48,0.1);border:1px solid rgba(212,160,48,0.25);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 28px;font-size:1.8rem;">ℹ️</div>
        <h1 style="font-family:'Playfair Display',Georgia,serif;font-size:1.8rem;font-weight:700;color:#f5f5f0;margin:0 0 14px;">{{ __('pages.unsubscribe.already_title') }}</h1>
        <p style="color:#666;font-size:0.9rem;line-height:1.75;margin:0 0 32px;">
            {!! __('pages.unsubscribe.already_desc', ['email' => '<strong style="color:#d4a030;">'.e($abonnement->email).'</strong>', 'list' => '<strong>'.$listLabel.'</strong>']) !!}
        </p>
        @else
        <div style="width:72px;height:72px;background:rgba(76,175,125,0.1);border:1px solid rgba(76,175,125,0.25);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 28px;font-size:1.8rem;">✓</div>
        <h1 style="font-family:'Playfair Display',Georgia,serif;font-size:1.8rem;font-weight:700;color:#f5f5f0;margin:0 0 14px;">{{ __('pages.unsubscribe.confirmed_title') }}</h1>
        <p style="color:#666;font-size:0.9rem;line-height:1.75;margin:0 0 32px;">
            {!! __('pages.unsubscribe.confirmed_desc', ['email' => '<strong style="color:#4caf7d;">'.e($abonnement->email).'</strong>', 'list' => '<strong>'.$listLabel.'</strong>']) !!}
        </p>
        @endif

        <a href="{{ route('home') }}"
           style="display:inline-block;background:#4caf7d;color:#0a0a0a;font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.82rem;letter-spacing:0.08em;text-transform:uppercase;text-decoration:none;padding:13px 28px;border-radius:4px;transition:background 0.2s;"
           onmouseover="this.style.background='#3d9e6a'" onmouseout="this.style.background='#4caf7d'">
            {{ __('pages.unsubscribe.back_home') }}
        </a>
    </div>
</section>
@endsection
