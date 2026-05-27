@extends('layouts.app')
@section('title', 'Désinscription — Centre d\'Art Orion')

@section('content')
<section style="min-height:70vh;display:flex;align-items:center;justify-content:center;padding:80px 24px;background:#0a0a0a;">
    <div style="max-width:520px;width:100%;text-align:center;">

        @if($alreadyUnsubscribed)
        <div style="width:72px;height:72px;background:rgba(212,160,48,0.1);border:1px solid rgba(212,160,48,0.25);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 28px;font-size:1.8rem;">ℹ️</div>
        <h1 style="font-family:'Playfair Display',Georgia,serif;font-size:1.8rem;font-weight:700;color:#f5f5f0;margin:0 0 14px;">Déjà désinscrit(e)</h1>
        <p style="color:#666;font-size:0.9rem;line-height:1.75;margin:0 0 32px;">
            Cette adresse e-mail (<strong style="color:#d4a030;">{{ $abonnement->email }}</strong>) était déjà désinscrite de notre <strong>{{ $abonnement->type === 'blog' ? 'liste d\'articles blog' : 'newsletter' }}</strong>.
        </p>
        @else
        <div style="width:72px;height:72px;background:rgba(76,175,125,0.1);border:1px solid rgba(76,175,125,0.25);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 28px;font-size:1.8rem;">✓</div>
        <h1 style="font-family:'Playfair Display',Georgia,serif;font-size:1.8rem;font-weight:700;color:#f5f5f0;margin:0 0 14px;">Désinscription confirmée</h1>
        <p style="color:#666;font-size:0.9rem;line-height:1.75;margin:0 0 32px;">
            L'adresse <strong style="color:#4caf7d;">{{ $abonnement->email }}</strong> a bien été retirée de notre <strong>{{ $abonnement->type === 'blog' ? 'liste d\'articles blog' : 'newsletter' }}</strong>. Vous ne recevrez plus d'e-mails de notre part pour cet abonnement.
        </p>
        @endif

        <a href="{{ route('home') }}"
           style="display:inline-block;background:#4caf7d;color:#0a0a0a;font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.82rem;letter-spacing:0.08em;text-transform:uppercase;text-decoration:none;padding:13px 28px;border-radius:4px;transition:background 0.2s;"
           onmouseover="this.style.background='#3d9e6a'" onmouseout="this.style.background='#4caf7d'">
            Retour à l'accueil
        </a>
    </div>
</section>
@endsection
