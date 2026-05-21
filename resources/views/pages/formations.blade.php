@extends('layouts.app')

@section('title', 'Formations — Centre d\'Art Orion')
@section('meta_description', 'Découvrez nos formations artistiques : arts plastiques, musique, danse, théâtre, photographie, production musicale. Inscrivez-vous au Centre d\'Art Orion.')

@section('content')

{{-- Hero --}}
<section style="padding:100px 0 80px;background:#0a0a0a;border-bottom:1px solid #1a1a1a;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 70% 30%,rgba(224,112,48,0.07),transparent 60%);pointer-events:none;"></div>
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:1;">
        <div class="tag tag-orange" style="margin-bottom:16px;">Programmes de formation</div>
        <h1 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2.5rem,5vw,4rem);font-weight:900;color:#f5f5f0;line-height:1.1;margin:0 0 20px;">
            Formations<br>
            <span style="background:linear-gradient(135deg,#e07030,#d4a030);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Artistiques</span>
        </h1>
        <p style="color:#777;font-size:1rem;max-width:560px;line-height:1.8;">
            Des programmes structurés et progressifs pour développer vos compétences artistiques sous la direction d'experts passionnés.
        </p>
    </div>
</section>

{{-- Formations par catégorie --}}
<section style="padding:80px 0;background:#0d0d0d;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">

        @if($formations->isEmpty())
        <div class="reveal" style="text-align:center;padding:80px 24px;">
            <div style="font-size:3rem;margin-bottom:16px;">📚</div>
            <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1.2rem;color:#f5f5f0;margin:0 0 12px;">Formations à venir</h3>
            <p style="color:#666;font-size:0.9rem;">Nos programmes sont en cours de préparation. Contactez-nous pour être informé en priorité.</p>
            <a href="{{ route('contact.index') }}" class="btn-primary" style="margin-top:24px;display:inline-flex;">Être notifié</a>
        </div>
        @else

        @foreach($formations as $categorie => $items)
        <div style="margin-bottom:64px;">
            <div class="reveal" style="display:flex;align-items:center;gap:16px;margin-bottom:32px;">
                <h2 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1rem;color:#f5f5f0;letter-spacing:0.08em;text-transform:uppercase;margin:0;">
                    {{ $categorie ?: 'Autres formations' }}
                </h2>
                <div style="flex:1;height:1px;background:linear-gradient(90deg,#222,transparent);"></div>
                <span style="font-size:0.78rem;color:#555;font-family:'Space Grotesk',sans-serif;">{{ $items->count() }} {{ Str::plural('formation', $items->count()) }}</span>
            </div>

            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:24px;">
                @foreach($items as $f)
                <div class="reveal hover-lift"
                     style="background:#111;border:1px solid #1a1a1a;border-radius:10px;overflow:hidden;transition:all 0.3s;display:flex;flex-direction:column;">

                    {{-- Image --}}
                    <div style="height:200px;background:linear-gradient(135deg,#161616,#111);display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden;">
                        @if($f->image && file_exists(public_path('storage/'.$f->image)))
                            <img src="{{ asset('storage/'.$f->image) }}" alt="{{ $f->titre }}" style="width:100%;height:100%;object-fit:cover;">
                        @else
                            @php $fPhotos = ['4.jpg','5.jpg','6.jpg','7.jpg','9.jpg','1.png','2.jpg','3.jpg']; @endphp
                            <img src="{{ asset('images/' . $fPhotos[$loop->index % count($fPhotos)]) }}"
                                 alt="{{ $f->titre }}"
                                 style="width:100%;height:100%;object-fit:cover;">
                        @endif
                        @if($f->niveau)
                        <div style="position:absolute;bottom:12px;left:12px;">
                            <span class="tag tag-orange">{{ $f->niveau }}</span>
                        </div>
                        @endif
                    </div>

                    <div style="padding:28px;flex:1;display:flex;flex-direction:column;">
                        <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1.05rem;color:#f5f5f0;margin:0 0 10px;line-height:1.3;">{{ $f->titre }}</h3>
                        <p style="color:#666;font-size:0.85rem;line-height:1.7;margin:0 0 20px;flex:1;">{{ Str::limit($f->description, 120) }}</p>

                        {{-- Meta info --}}
                        <div style="display:flex;flex-wrap:wrap;gap:14px;padding:16px 0;border-top:1px solid #1a1a1a;border-bottom:1px solid #1a1a1a;margin-bottom:20px;">
                            @if($f->duree)
                            <div style="display:flex;align-items:center;gap:6px;color:#777;font-size:0.8rem;">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#4caf7d" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                                {{ $f->duree }}
                            </div>
                            @endif
                            @if($f->public_cible)
                            <div style="display:flex;align-items:center;gap:6px;color:#777;font-size:0.8rem;">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#d4a030" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8z"/></svg>
                                {{ Str::limit($f->public_cible, 30) }}
                            </div>
                            @endif
                        </div>

                        <div style="display:flex;align-items:center;justify-content:space-between;">
                            @if($f->prix)
                            <div>
                                <span style="font-family:'Space Grotesk',sans-serif;font-size:1.1rem;font-weight:700;color:#d4a030;">${{ number_format($f->prix, 0) }}</span>
                                <span style="color:#555;font-size:0.75rem;margin-left:4px;">/ formation</span>
                            </div>
                            @else
                            <span style="color:#4caf7d;font-weight:600;font-size:0.9rem;">Sur devis</span>
                            @endif
                            <a href="{{ route('formations.show', $f) }}" class="btn-primary" style="padding:9px 18px;font-size:0.78rem;">
                                Détails & inscription
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach

        @endif

    </div>
</section>

{{-- Pourquoi nous choisir --}}
<section style="padding:100px 0;background:#0a0a0a;border-top:1px solid #161616;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">

        <div class="reveal" style="text-align:center;max-width:540px;margin:0 auto 56px;">
            <div class="tag tag-green" style="margin-bottom:20px;">Nos avantages</div>
            <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(1.8rem,3.5vw,2.5rem);font-weight:900;color:#f5f5f0;line-height:1.15;margin:0;" class="accent-line accent-line-center">
                Pourquoi nous choisir ?
            </h2>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:24px;">
            @foreach([
                ['🏆','Formateurs experts','Tous nos formateurs sont des professionnels reconnus dans leur discipline.','#4caf7d'],
                ['🎯','Approche pratique','80% pratique, 20% théorie pour un apprentissage concret et efficace.','#d4a030'],
                ['👥','Petits groupes','Maximum 12 élèves par groupe pour un suivi personnalisé de qualité.','#e07030'],
                ['📜','Certification','Obtenez un certificat Orion reconnu par les partenaires artistiques.','#4caf7d'],
            ] as $av)
            <div class="reveal"
                 style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:32px;text-align:center;transition:all 0.3s;"
                 onmouseover="this.style.borderColor='{{ $av[3] }}33';this.style.background='#141414'"
                 onmouseout="this.style.borderColor='#1a1a1a';this.style.background='#111'">
                <div style="font-size:2.5rem;margin-bottom:16px;">{{ $av[0] }}</div>
                <h4 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.95rem;color:#f5f5f0;margin:0 0 10px;">{{ $av[1] }}</h4>
                <p style="color:#666;font-size:0.85rem;line-height:1.7;margin:0;">{{ $av[2] }}</p>
            </div>
            @endforeach
        </div>

    </div>
</section>

{{-- CTA Inscription --}}
<section style="padding:80px 0;background:#0d0d0d;border-top:1px solid #161616;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at center,rgba(224,112,48,0.06),transparent 70%);pointer-events:none;"></div>
    <div style="max-width:700px;margin:0 auto;padding:0 24px;text-align:center;position:relative;z-index:1;" class="reveal">
        <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(1.8rem,4vw,2.8rem);font-weight:900;color:#f5f5f0;margin:0 0 16px;">
            Prêt à commencer votre<br>
            <span style="background:linear-gradient(135deg,#e07030,#d4a030);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">parcours artistique ?</span>
        </h2>
        <p style="color:#777;font-size:0.95rem;margin:0 0 36px;line-height:1.8;">Contactez-nous pour vous inscrire ou obtenir plus d'informations sur nos formations.</p>
        <a href="{{ route('contact.index') }}" class="btn-gold">S'inscrire maintenant</a>
    </div>
</section>

@endsection
