@extends('layouts.app')

@section('title', 'Podcasts — Centre d\'Art Orion')
@section('meta_description', 'Écoutez les podcasts du Centre d\'Art Orion : conversations avec artistes, coulisses de création, formation et culture contemporaine.')

@section('content')

<section style="min-height:92vh;background:#0a0a0a;position:relative;overflow:hidden;padding:120px 0 80px;border-bottom:1px solid #1a1a1a;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 18% 24%,rgba(76,175,125,0.15),transparent 34%),radial-gradient(ellipse at 82% 62%,rgba(212,160,48,0.12),transparent 38%);pointer-events:none;"></div>
    <div style="position:absolute;inset:0;opacity:0.16;background-image:linear-gradient(90deg,rgba(255,255,255,0.07) 1px,transparent 1px),linear-gradient(rgba(255,255,255,0.07) 1px,transparent 1px);background-size:68px 68px;mask-image:linear-gradient(to bottom,#000,transparent 84%);"></div>

    <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:1;">
        <div style="display:grid;grid-template-columns:minmax(0,0.95fr) minmax(360px,0.85fr);gap:56px;align-items:center;">
            <div>
                <div class="tag tag-green" style="margin-bottom:18px;">Voix d'artistes</div>
                <h1 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2.8rem,7vw,6rem);font-weight:900;color:#f5f5f0;line-height:0.96;margin:0 0 24px;">
                    Podcasts<br>
                    <span style="background:linear-gradient(135deg,#4caf7d,#d4a030);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Orion</span>
                </h1>
                <p style="color:#aaa19a;font-size:1.05rem;line-height:1.9;max-width:640px;margin:0 0 32px;">
                    Conversations longues, récits d'ateliers, parcours d'artistes et réflexions sur la création. Un espace audio pour écouter ce qui se passe avant, pendant et après l'oeuvre.
                </p>
                <div style="display:flex;gap:14px;flex-wrap:wrap;">
                    <a href="#episodes" class="btn-primary">Écouter les épisodes</a>
                    <a href="{{ route('contact.index') }}?sujet=Proposition+Podcast" class="btn-outline">Proposer un invité</a>
                </div>
            </div>

            <div style="position:relative;">
                <div style="aspect-ratio:1;border-radius:50%;background:linear-gradient(135deg,rgba(76,175,125,0.22),rgba(212,160,48,0.16));border:1px solid rgba(255,255,255,0.12);display:flex;align-items:center;justify-content:center;box-shadow:0 30px 100px rgba(0,0,0,0.45);">
                    <div style="width:74%;height:74%;border-radius:50%;background:url('{{ $featured ? $featured->cover_source : asset('images/11.jpg') }}') center/cover;border:1px solid rgba(255,255,255,0.18);position:relative;overflow:hidden;">
                        <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.82),rgba(0,0,0,0.08));"></div>
                        <div style="position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);width:84px;height:84px;border-radius:50%;background:rgba(212,160,48,0.22);border:2px solid rgba(212,160,48,0.55);display:flex;align-items:center;justify-content:center;">
                            <svg width="30" height="30" viewBox="0 0 24 24" fill="#d4a030"><polygon points="7 4 19 12 7 20 7 4"/></svg>
                        </div>
                    </div>
                </div>
                <div style="position:absolute;right:0;bottom:24px;background:#111;border:1px solid #242018;border-radius:8px;padding:18px 20px;max-width:260px;">
                    <div style="color:#d4a030;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;margin-bottom:8px;">Série phare</div>
                    <p style="color:#f5f5f0;font-family:'Playfair Display',Georgia,serif;font-size:1.35rem;line-height:1.1;margin:0;">{{ $featured->series ?? "Dans l'atelier" }}</p>
                    <p style="color:#777;font-size:0.82rem;line-height:1.55;margin:8px 0 0;">{{ $featured->description ?? 'Une immersion dans les gestes et les voix de la création.' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="episodes" style="padding:88px 0;background:#0d0d0d;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
        <div style="display:flex;align-items:end;justify-content:space-between;gap:24px;flex-wrap:wrap;margin-bottom:34px;">
            <div>
                <div class="tag tag-gold" style="margin-bottom:14px;">Derniers épisodes</div>
                <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,3rem);line-height:1.08;color:#f5f5f0;margin:0;">À écouter</h2>
            </div>
            <p style="color:#777;max-width:420px;line-height:1.75;margin:0;">Les épisodes sont préparés comme des archives vivantes : un invité, une pratique, une question de création.</p>
        </div>

        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px;">
            @foreach($episodes as $episode)
            <article style="background:#111;border:1px solid #1a1a1a;border-radius:8px;overflow:hidden;">
                <div style="height:190px;position:relative;background:#161616;">
                    <img src="{{ $episode->cover_source }}" alt="{{ $episode->title }}" style="width:100%;height:100%;object-fit:cover;">
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
                        <span style="color:#555;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;">{{ $episode->duration ?: 'À venir' }}</span>
                        <a href="{{ route('contact.index') }}?sujet=Podcast+{{ urlencode($episode->title) }}" style="color:{{ $episode->accent }};font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:700;text-decoration:none;text-transform:uppercase;letter-spacing:0.08em;">{{ $episode->audio_source ? 'Réagir →' : 'Être notifié →' }}</a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>

<section style="padding:88px 0;background:#0a0a0a;border-top:1px solid #161616;">
    <div style="max-width:1120px;margin:0 auto;padding:0 24px;">
        <div style="display:grid;grid-template-columns:0.9fr 1.1fr;gap:48px;align-items:start;">
            <div>
                <div class="tag tag-green" style="margin-bottom:14px;">Participer</div>
                <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,3rem);line-height:1.08;color:#f5f5f0;margin:0 0 18px;">Vous avez une voix à partager ?</h2>
                <p style="color:#888;line-height:1.85;margin:0;">Artistes, formateurs, techniciens, curateurs, anciens apprenants : le podcast Orion accueille les récits qui éclairent une pratique et transmettent une expérience.</p>
            </div>
            <div style="display:grid;gap:14px;">
                @foreach([
                    ['Proposer un sujet','Présentez une idée d\'épisode, une démarche artistique ou une expérience d\'atelier.'],
                    ['Préparer l\'entretien','Nous construisons ensemble les axes de discussion et les images associées.'],
                    ['Diffuser l\'épisode','L\'épisode rejoint le site, les réseaux et les archives numériques du centre.'],
                ] as $step)
                <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:22px;">
                    <h3 style="font-family:'Space Grotesk',sans-serif;color:#f5f5f0;font-size:0.95rem;text-transform:uppercase;letter-spacing:0.08em;margin:0 0 8px;">{{ $step[0] }}</h3>
                    <p style="color:#777;font-size:0.9rem;line-height:1.7;margin:0;">{{ $step[1] }}</p>
                </div>
                @endforeach
                <a href="{{ route('contact.index') }}?sujet=Proposition+Podcast" class="btn-gold" style="justify-content:center;margin-top:8px;">Proposer une participation</a>
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
