@extends('layouts.app')

@section('title', 'À Propos — Centre d\'Art Orion')
@section('meta_description', 'Découvrez l\'histoire, la vision, la mission et les valeurs du Centre d\'Art Orion. Rencontrez notre équipe de direction.')

@php
    use App\Models\PageSetting as PS;
    use Illuminate\Support\Facades\Storage;
    function psImgAbout(string $key): ?string {
        $stored = PS::get($key);
        return $stored ? Storage::url($stored) : null;
    }
@endphp

@section('content')

{{-- Page Hero --}}
<section style="padding:100px 0 80px;background:#0a0a0a;border-bottom:1px solid #1a1a1a;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 20% 50%,rgba(76,175,125,0.07),transparent 60%);pointer-events:none;"></div>
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:1;">
        <div class="tag tag-green" style="margin-bottom:16px;">À Propos</div>
        <h1 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2.5rem,5vw,4rem);font-weight:900;color:#f5f5f0;line-height:1.1;margin:0 0 20px;">
            {{ PS::get('about.hero.titre_1','Notre Histoire,') }}<br>
            <span style="background:linear-gradient(135deg,#4caf7d,#d4a030);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">{{ PS::get('about.hero.titre_2','Notre Passion') }}</span>
        </h1>
        <p style="color:#777;font-size:1rem;max-width:560px;line-height:1.8;">
            {{ PS::get('about.hero.desc',"Découvrez l'histoire et les valeurs qui font du Centre d'Art Orion un espace unique dédié à l'excellence artistique.") }}
        </p>
    </div>
</section>

{{-- Histoire --}}
<section style="padding:100px 0;background:#0d0d0d;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:center;">

            <div class="reveal">
                <div class="tag tag-gold" style="margin-bottom:20px;">{{ PS::get('about.histoire.kicker','Notre genèse') }}</div>
                <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(1.8rem,3vw,2.5rem);font-weight:900;color:#f5f5f0;line-height:1.2;margin:0 0 24px;" class="accent-line">
                    {{ PS::get('about.histoire.titre',"L'Histoire du Centre d'Art Orion") }}
                </h2>
                <div class="prose-dark">
                    @foreach(['para1','para2','para3'] as $pk)
                        @php
                            $defaults = [
                                'para1' => "Né de la vision de son fondateur <strong style=\"color:#f5f5f0;\">Aras M. NGONGO</strong>, le Centre d'Art Orion a été créé avec une ambition claire : offrir aux artistes congolais un espace professionnel, structuré et inspirant pour développer leur art.",
                                'para2' => "Implanté au cœur du Quartier Gambela, au 380, Avenue Changalele — derrière le nouveau bâtiment de l'INPP — le centre s'est rapidement imposé comme un pilier incontournable de la scène artistique locale.",
                                'para3' => "Sous la direction opérationnelle de <strong style=\"color:#f5f5f0;\">Magellan KAHOZI</strong>, Chef de Centre, Orion a su construire des programmes de formation rigoureux, accueillir des artistes en résidence et organiser des événements culturels qui ont marqué la communauté.",
                            ];
                            $val = PS::get('about.histoire.'.$pk, '');
                        @endphp
                        @if($val)
                        <p>{!! nl2br(e($val)) !!}</p>
                        @else
                        <p>{!! $defaults[$pk] !!}</p>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="reveal">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    @php
                    $histItemsDefaults = [
                        ['📅','Fondation','Une vision née de la passion pour l\'art et les artistes congolais'],
                        ['📍','Localisation','380, Av. Changalele, Q. Gambela — au cœur de la ville'],
                        ['🎯','Mission','Former, produire, créer et accompagner les talents artistiques'],
                        ['🌟','Vision','Faire d\'Orion le centre de référence artistique en Afrique centrale'],
                    ];
                    $histItemsDyn = [];
                    foreach($histItemsDefaults as $i => $hd) {
                        $n = $i + 1;
                        $histItemsDyn[] = [
                            PS::get('about.histoire.item'.$n.'_emoji', $hd[0]),
                            PS::get('about.histoire.item'.$n.'_titre', $hd[1]),
                            PS::get('about.histoire.item'.$n.'_desc',  $hd[2]),
                        ];
                    }
                    @endphp
                    @foreach($histItemsDyn as $item)
                    <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;transition:border-color 0.3s;"
                         onmouseover="this.style.borderColor='#4caf7d33'" onmouseout="this.style.borderColor='#1a1a1a'">
                        <div style="font-size:1.8rem;margin-bottom:12px;">{{ $item[0] }}</div>
                        <h4 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.9rem;color:#f5f5f0;margin:0 0 8px;">{{ $item[1] }}</h4>
                        <p style="color:#666;font-size:0.82rem;line-height:1.6;margin:0;">{{ $item[2] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Vision / Mission / Valeurs --}}
<section style="padding:100px 0;background:#0a0a0a;border-top:1px solid #161616;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">

        <div class="reveal" style="text-align:center;max-width:540px;margin:0 auto 64px;">
            <div class="tag tag-orange" style="margin-bottom:20px;">Ce qui nous guide</div>
            <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,2.8rem);font-weight:900;color:#f5f5f0;line-height:1.15;margin:0;" class="accent-line accent-line-center">
                Vision, Mission & Valeurs
            </h2>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:24px;">

            {{-- Vision --}}
            <div class="reveal" style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:40px;position:relative;overflow:hidden;">
                <div style="position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,#4caf7d,#2d7a52);"></div>
                <div style="width:48px;height:48px;background:rgba(76,175,125,0.1);border:1px solid rgba(76,175,125,0.2);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;margin-bottom:20px;">🔭</div>
                <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1.1rem;color:#4caf7d;margin:0 0 16px;letter-spacing:0.04em;text-transform:uppercase;font-size:0.85rem;">Notre Vision</h3>
                <p style="color:#888;font-size:0.92rem;line-height:1.8;margin:0;">
                    {!! nl2br(e(PS::get('about.vision.texte',"Devenir le centre artistique de référence en Afrique centrale, reconnu pour l'excellence de ses formations, la qualité de ses productions et son rôle de catalyseur culturel dans la région."))) !!}
                </p>
            </div>

            {{-- Mission --}}
            <div class="reveal" style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:40px;position:relative;overflow:hidden;">
                <div style="position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,#d4a030,#e07030);"></div>
                <div style="width:48px;height:48px;background:rgba(212,160,48,0.1);border:1px solid rgba(212,160,48,0.2);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;margin-bottom:20px;">🎯</div>
                <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.85rem;color:#d4a030;margin:0 0 16px;letter-spacing:0.04em;text-transform:uppercase;">Notre Mission</h3>
                <p style="color:#888;font-size:0.92rem;line-height:1.8;margin:0;">
                    {!! nl2br(e(PS::get('about.mission.texte',"Former, accompagner et promouvoir les artistes à travers des programmes de qualité, un environnement créatif stimulant et un réseau de partenaires engagés dans le développement des arts et de la culture."))) !!}
                </p>
            </div>

            {{-- Valeurs --}}
            <div class="reveal" style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:40px;position:relative;overflow:hidden;">
                <div style="position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,#e07030,#c05020);"></div>
                <div style="width:48px;height:48px;background:rgba(224,112,48,0.1);border:1px solid rgba(224,112,48,0.2);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;margin-bottom:20px;">💎</div>
                <h3 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.85rem;color:#e07030;margin:0 0 16px;letter-spacing:0.04em;text-transform:uppercase;">Nos Valeurs</h3>
                <div style="display:flex;flex-direction:column;gap:10px;">
                    @php
                    $valeursDefault = [
                        "Excellence — Qualité sans compromis",
                        "Créativité — Encourager l'expression unique",
                        "Inclusion — Art pour tous, sans distinction",
                        "Intégrité — Éthique professionnelle constante",
                        "Communauté — Tisser des liens durables",
                    ];
                    $valeursDyn = [];
                    foreach($valeursDefault as $i => $vd) {
                        $n = $i + 1;
                        $valeursDyn[] = PS::get('about.valeurs.item'.$n, $vd);
                    }
                    @endphp
                    @foreach($valeursDyn as $v)
                    <div style="display:flex;align-items:flex-start;gap:10px;">
                        <span style="color:#e07030;font-size:0.7rem;margin-top:4px;flex-shrink:0;">◆</span>
                        <span style="color:#888;font-size:0.88rem;line-height:1.5;">{{ $v }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Direction --}}
<section style="padding:100px 0;background:#0d0d0d;border-top:1px solid #161616;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">

        <div class="reveal" style="text-align:center;max-width:540px;margin:0 auto 64px;">
            <div class="tag tag-green" style="margin-bottom:20px;">Direction</div>
            <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(2rem,4vw,2.8rem);font-weight:900;color:#f5f5f0;line-height:1.15;margin:0;" class="accent-line accent-line-center">
                La Direction du Centre
            </h2>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(340px,1fr));gap:32px;max-width:800px;margin:0 auto;">

            {{-- CEO --}}
            <div class="reveal hover-lift"
                 style="background:#111;border:1px solid #1a1a1a;border-radius:12px;padding:40px;text-align:center;transition:all 0.3s;"
                 onmouseover="this.style.borderColor='#4caf7d44'" onmouseout="this.style.borderColor='#1a1a1a'">
                @php $ceoPhoto = psImgAbout('about.direction.ceo_photo'); @endphp
                @if($ceoPhoto)
                <div style="width:90px;height:90px;border-radius:50%;overflow:hidden;margin:0 auto 20px;box-shadow:0 8px 30px rgba(76,175,125,0.3);border:2px solid #4caf7d44;">
                    <img src="{{ $ceoPhoto }}" alt="{{ PS::get('about.direction.ceo_nom','Aras M. NGONGO') }}" style="width:100%;height:100%;object-fit:cover;display:block;">
                </div>
                @else
                <div style="width:90px;height:90px;border-radius:50%;background:linear-gradient(135deg,#4caf7d,#d4a030);display:flex;align-items:center;justify-content:center;font-family:'Playfair Display',serif;font-weight:900;font-size:1.8rem;color:#0a0a0a;margin:0 auto 20px;box-shadow:0 8px 30px rgba(76,175,125,0.3);">
                    {{ PS::get('about.direction.ceo_initiales','AN') }}
                </div>
                @endif
                <span class="tag tag-gold" style="margin-bottom:16px;display:inline-block;">{{ PS::get('about.direction.ceo_role','CEO & Fondateur') }}</span>
                <h3 style="font-family:'Playfair Display',Georgia,serif;font-weight:700;font-size:1.4rem;color:#f5f5f0;margin:0 0 6px;">{{ PS::get('about.direction.ceo_nom','Aras M. NGONGO') }}</h3>
                <p style="color:#777;font-size:0.85rem;margin:0 0 20px;font-family:'Space Grotesk',sans-serif;">{{ PS::get('about.direction.ceo_sous_titre','Visionnaire — Fondateur') }}</p>
                <p style="color:#666;font-size:0.88rem;line-height:1.8;">
                    {!! nl2br(e(PS::get('about.direction.ceo_bio',"Visionnaire et fondateur du Centre d'Art Orion, Aras M. NGONGO a consacré sa vie à la promotion des arts et des talents émergents en RDC. Sa vision : faire d'Orion un pilier de la culture africaine contemporaine."))) !!}
                </p>
            </div>

            {{-- Chef de Centre --}}
            <div class="reveal hover-lift"
                 style="background:#111;border:1px solid #1a1a1a;border-radius:12px;padding:40px;text-align:center;transition:all 0.3s;"
                 onmouseover="this.style.borderColor='#d4a03044'" onmouseout="this.style.borderColor='#1a1a1a'">
                @php $chefPhoto = psImgAbout('about.direction.chef_photo'); @endphp
                @if($chefPhoto)
                <div style="width:90px;height:90px;border-radius:50%;overflow:hidden;margin:0 auto 20px;box-shadow:0 8px 30px rgba(212,160,48,0.3);border:2px solid #d4a03044;">
                    <img src="{{ $chefPhoto }}" alt="{{ PS::get('about.direction.chef_nom','Magellan KAHOZI') }}" style="width:100%;height:100%;object-fit:cover;display:block;">
                </div>
                @else
                <div style="width:90px;height:90px;border-radius:50%;background:linear-gradient(135deg,#d4a030,#e07030);display:flex;align-items:center;justify-content:center;font-family:'Playfair Display',serif;font-weight:900;font-size:1.8rem;color:#0a0a0a;margin:0 auto 20px;box-shadow:0 8px 30px rgba(212,160,48,0.3);">
                    {{ PS::get('about.direction.chef_initiales','MK') }}
                </div>
                @endif
                <span class="tag tag-green" style="margin-bottom:16px;display:inline-block;">{{ PS::get('about.direction.chef_role','Chef de Centre') }}</span>
                <h3 style="font-family:'Playfair Display',Georgia,serif;font-weight:700;font-size:1.4rem;color:#f5f5f0;margin:0 0 6px;">{{ PS::get('about.direction.chef_nom','Magellan KAHOZI') }}</h3>
                <p style="color:#777;font-size:0.85rem;margin:0 0 20px;font-family:'Space Grotesk',sans-serif;">{{ PS::get('about.direction.chef_sous_titre','Direction opérationnelle') }}</p>
                <p style="color:#666;font-size:0.88rem;line-height:1.8;">
                    {!! nl2br(e(PS::get('about.direction.chef_bio',"Magellan KAHOZI dirige les opérations quotidiennes du Centre d'Art Orion avec passion et rigueur. Fort d'une expérience solide dans la gestion culturelle, il veille à l'excellence de chaque programme."))) !!}
                </p>
            </div>

        </div>

        <div class="reveal" style="text-align:center;margin-top:48px;">
            <a href="{{ route('equipe') }}" class="btn-outline">Voir toute l'équipe →</a>
        </div>

    </div>
</section>

{{-- CTA --}}
<section style="padding:80px 0;background:#0a0a0a;border-top:1px solid #161616;">
    <div style="max-width:700px;margin:0 auto;padding:0 24px;text-align:center;" class="reveal">
        <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(1.8rem,4vw,2.8rem);font-weight:900;color:#f5f5f0;margin:0 0 20px;">
            {{ PS::get('about.cta.titre_1',"Rejoignez l'aventure") }} <span style="background:linear-gradient(135deg,#4caf7d,#d4a030);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">{{ PS::get('about.cta.titre_gradient','Orion') }}</span>
        </h2>
        <p style="color:#777;font-size:0.95rem;line-height:1.8;margin:0 0 36px;">{{ PS::get('about.cta.desc',"Découvrez nos formations, participez à nos événements ou rejoignez notre équipe de passionnés.") }}</p>
        <div style="display:flex;flex-wrap:wrap;gap:14px;justify-content:center;">
            <a href="{{ route('formations.index') }}" class="btn-primary">Voir les formations</a>
            <a href="{{ route('contact.index') }}" class="btn-outline">Nous contacter</a>
        </div>
    </div>
</section>

@endsection
