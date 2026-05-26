@extends('layouts.app')

@section('title', 'Blog — Centre d\'Art Orion')
@section('meta_description', 'Carnet d\'atelier du Centre d\'Art Orion : réflexions, coulisses, récits de création et actualités artistiques.')

@section('content')

<section style="min-height:92vh;background:#0a0a0a;position:relative;overflow:hidden;padding:120px 0 80px;border-bottom:1px solid #1a1a1a;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 18% 28%,rgba(212,160,48,0.13),transparent 34%),radial-gradient(ellipse at 78% 68%,rgba(76,175,125,0.09),transparent 36%);pointer-events:none;"></div>
    <div style="position:absolute;inset:0;opacity:0.12;background-image:linear-gradient(90deg,rgba(255,255,255,0.08) 1px,transparent 1px),linear-gradient(rgba(255,255,255,0.08) 1px,transparent 1px);background-size:72px 72px;mask-image:linear-gradient(to bottom,#000,transparent 82%);"></div>

    <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:1;">
        <div style="max-width:760px;">
            <div class="tag tag-gold" style="margin-bottom:18px;">Carnet d'atelier</div>
            <h1 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2.8rem,7vw,6.2rem);font-weight:900;color:#f5f5f0;line-height:0.95;margin:0 0 24px;">
                Blog<br>
                <span style="background:linear-gradient(135deg,#d4a030,#4caf7d);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Orion</span>
            </h1>
            <p style="color:#8f877d;font-size:1.05rem;line-height:1.9;max-width:620px;margin:0;">
                Un espace pour raconter les coulisses du centre, les gestes de création, les parcours d'artistes et les idées qui nourrissent notre constellation artistique.
            </p>
        </div>

        <div style="margin-top:72px;display:grid;grid-template-columns:1.1fr 0.9fr;gap:28px;align-items:stretch;">
            <article style="background:#111;border:1px solid #1f1a12;border-radius:8px;overflow:hidden;min-height:360px;display:flex;flex-direction:column;justify-content:flex-end;position:relative;">
                <div style="position:absolute;inset:0;background:linear-gradient(145deg,rgba(212,160,48,0.16),transparent 46%),url('{{ asset('images/10.jpg') }}') center/cover;opacity:0.72;"></div>
                <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.94),rgba(0,0,0,0.18));"></div>
                <div style="position:relative;padding:32px;">
                    <span class="tag tag-gold">À venir</span>
                    <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(1.8rem,3vw,2.6rem);line-height:1.05;color:#f5f5f0;margin:18px 0 12px;">
                        Les récits du centre prendront bientôt forme ici.
                    </h2>
                    <p style="color:#b6afa7;font-size:0.95rem;line-height:1.75;max-width:620px;margin:0;">
                        Interviews, retours d'ateliers, chroniques d'exposition et notes de production seront publiés progressivement.
                    </p>
                </div>
            </article>

            <div style="display:grid;gap:16px;">
                @foreach([
                    ['Coulisses', 'Suivre les préparations, répétitions, montages et rencontres qui précèdent chaque création.', '#4caf7d'],
                    ['Portraits', 'Donner la parole aux artistes, formateurs et talents qui font vivre Orion.', '#d4a030'],
                    ['Pensées', 'Partager des repères sur la création, la formation et la pratique artistique contemporaine.', '#e07030'],
                ] as $note)
                <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;">
                    <div style="width:28px;height:2px;background:{{ $note[2] }};margin-bottom:18px;"></div>
                    <h3 style="font-family:'Space Grotesk',sans-serif;color:#f5f5f0;font-size:0.95rem;text-transform:uppercase;letter-spacing:0.08em;margin:0 0 10px;">{{ $note[0] }}</h3>
                    <p style="color:#777;font-size:0.88rem;line-height:1.7;margin:0;">{{ $note[1] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<style>
@media(max-width:900px){
    section div[style*="grid-template-columns:1.1fr 0.9fr"] {
        grid-template-columns: 1fr !important;
    }
}
</style>

@endsection
