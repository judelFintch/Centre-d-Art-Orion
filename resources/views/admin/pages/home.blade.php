@extends('layouts.admin')
@section('title', 'Contenu — Page d\'accueil')

@php use App\Models\PageSetting; @endphp

@section('content')

{{-- En-tête --}}
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:12px;">
    <div>
        <h2 style="font-family:'Playfair Display',serif;font-size:1.4rem;font-weight:900;color:#f5f5f0;margin:0 0 4px;">Page d'accueil</h2>
        <p style="color:#555;font-size:0.82rem;font-family:'Space Grotesk',sans-serif;margin:0;">Modifiez les textes et contenus affichés sur la page principale du site.</p>
    </div>
    <div style="display:flex;gap:10px;">
        <a href="{{ route('admin.pages.about') }}"
           style="display:inline-flex;align-items:center;gap:6px;padding:9px 16px;border-radius:6px;background:#111;border:1px solid #1a1a1a;color:#aaa;font-size:0.8rem;font-family:'Space Grotesk',sans-serif;text-decoration:none;">
            Aller à "À propos" →
        </a>
        <a href="{{ route('home') }}" target="_blank"
           style="display:inline-flex;align-items:center;gap:6px;padding:9px 16px;border-radius:6px;background:#111;border:1px solid #1a1a1a;color:#4caf7d;font-size:0.8rem;font-family:'Space Grotesk',sans-serif;text-decoration:none;">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg>
            Voir la page
        </a>
    </div>
</div>

{{-- Onglets navigation interne --}}
<div style="display:flex;gap:4px;margin-bottom:28px;border-bottom:1px solid #1a1a1a;padding-bottom:0;">
    @foreach(['identite' => 'Notre Identité','services' => 'Services','podcasts' => 'Podcasts','cta' => 'CTA Final'] as $id => $label)
    <a href="#section-{{ $id }}"
       style="padding:10px 16px;font-family:'Space Grotesk',sans-serif;font-size:0.8rem;font-weight:600;color:#666;text-decoration:none;border-bottom:2px solid transparent;transition:all 0.2s;"
       onclick="scrollSection('{{ $id }}');return false;"
       id="tab-{{ $id }}">{{ $label }}</a>
    @endforeach
</div>

<form method="POST" action="{{ route('admin.pages.home.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- ═══════════════════════════════ SECTION IDENTITÉ ═════════════════════════════ --}}
    <div id="section-identite" class="ps-section">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
            <div style="width:4px;height:36px;background:linear-gradient(180deg,#4caf7d,#2d7a52);border-radius:2px;flex-shrink:0;"></div>
            <div>
                <h3 style="font-family:'Space Grotesk',sans-serif;font-size:0.95rem;font-weight:700;color:#f5f5f0;margin:0;">Section "Notre Identité"</h3>
                <p style="color:#555;font-size:0.78rem;margin:0;">Bloc texte + stats + points-clés au centre de la page</p>
            </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">

            @include('admin.pages._field', ['name' => 'home[ni][kicker]', 'label' => 'Kicker (étiquette)', 'default' => 'Notre identité', 'key' => 'home.ni.kicker'])
            @include('admin.pages._field', ['name' => 'home[ni][annee]', 'label' => 'Mention "Depuis…"', 'default' => 'Depuis 2019', 'key' => 'home.ni.annee'])
            @include('admin.pages._field', ['name' => 'home[ni][titre_em]', 'label' => 'Titre ligne 1 (italique vert)', 'default' => "Un espace dédié à", 'key' => 'home.ni.titre_em'])
            @include('admin.pages._field', ['name' => 'home[ni][titre]', 'label' => 'Titre ligne 2', 'default' => "l'excellence artistique", 'key' => 'home.ni.titre'])
        </div>

        {{-- Prose --}}
        <div style="margin-top:16px;">
            @include('admin.pages._textarea', [
                'name'    => 'home[ni][prose]',
                'label'   => 'Texte principal',
                'default' => "Fondé par Aras M. NGONGO, le Centre d'Art Orion est bien plus qu'un espace de formation — c'est un écosystème artistique complet où les talents émergent, se développent et rayonnent.",
                'key'     => 'home.ni.prose',
            ])
        </div>

        {{-- Statistiques — SORTABLE --}}
        @php
        $statsOrder = array_map('intval', array_filter(explode(',', \App\Models\PageSetting::get('home.ni.stats_order','1,2,3'))));
        if (count($statsOrder) < 3) $statsOrder = [1,2,3];
        $statsDefaults = [
            1 => ['home[ni][stat1_val]','home.ni.stat1_val','5+', 'home[ni][stat1_lbl]','home.ni.stat1_lbl','Années'],
            2 => ['home[ni][stat2_val]','home.ni.stat2_val','100+','home[ni][stat2_lbl]','home.ni.stat2_lbl','Artistes'],
            3 => ['home[ni][stat3_val]','home.ni.stat3_val','6',  'home[ni][stat3_lbl]','home.ni.stat3_lbl','Disciplines'],
        ];
        @endphp
        <div style="margin-top:20px;">
            @include('admin.pages._sortable_header', ['label' => 'Statistiques (3 métriques)', 'hint' => 'Glisser pour réordonner'])
            <div id="sortable-ni-stats" style="display:flex;flex-direction:column;gap:8px;">
                @foreach($statsOrder as $n)
                @php $sd = $statsDefaults[$n]; @endphp
                <div class="sort-item" data-id="{{ $n }}"
                     style="background:#0d0d0d;border:1px solid #1a1a1a;border-radius:6px;padding:12px 14px;display:flex;align-items:center;gap:10px;">
                    @include('admin.pages._drag_handle')
                    <span class="pos-badge" style="min-width:18px;height:18px;border-radius:50%;background:#4caf7d22;color:#4caf7d;font-size:0.68rem;font-family:'Space Grotesk',sans-serif;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0;">{{ $loop->iteration }}</span>
                    <div style="display:grid;grid-template-columns:80px 1fr;gap:8px;flex:1;">
                        @include('admin.pages._field', ['name' => $sd[0], 'key' => $sd[1], 'label' => 'Valeur', 'default' => $sd[2]])
                        @include('admin.pages._field', ['name' => $sd[3], 'key' => $sd[4], 'label' => 'Libellé', 'default' => $sd[5]])
                    </div>
                </div>
                @endforeach
            </div>
            <input type="hidden" name="home[ni][stats_order]" id="ni-stats-order"
                   value="{{ \App\Models\PageSetting::get('home.ni.stats_order','1,2,3') }}">
        </div>

        {{-- Points-clés — SORTABLE --}}
        @php
        $featsOrder = array_map('intval', array_filter(explode(',', \App\Models\PageSetting::get('home.ni.feats_order','1,2,3'))));
        if (count($featsOrder) < 3) $featsOrder = [1,2,3];
        $featsDefaults = [
            1 => ['home[ni][feat1_text]','home.ni.feat1_text','Accompagnement personnalisé de chaque artiste'],
            2 => ['home[ni][feat2_text]','home.ni.feat2_text','Équipements professionnels de pointe'],
            3 => ['home[ni][feat3_text]','home.ni.feat3_text','Réseau actif de partenaires culturels'],
        ];
        @endphp
        <div style="margin-top:20px;">
            @include('admin.pages._sortable_header', ['label' => 'Points-clés (3 lignes)', 'hint' => 'Glisser pour réordonner'])
            <div id="sortable-ni-feats" style="display:flex;flex-direction:column;gap:8px;">
                @foreach($featsOrder as $n)
                @php $fd = $featsDefaults[$n]; @endphp
                <div class="sort-item" data-id="{{ $n }}"
                     style="background:#0d0d0d;border:1px solid #1a1a1a;border-radius:6px;padding:12px 14px;display:flex;align-items:center;gap:10px;">
                    @include('admin.pages._drag_handle')
                    <span class="pos-badge" style="min-width:18px;height:18px;border-radius:50%;background:#d4a03022;color:#d4a030;font-size:0.68rem;font-family:'Space Grotesk',sans-serif;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0;">{{ $loop->iteration }}</span>
                    <div style="flex:1;">
                        @include('admin.pages._field', ['name' => $fd[0], 'key' => $fd[1], 'label' => 'Texte du point', 'default' => $fd[2]])
                    </div>
                </div>
                @endforeach
            </div>
            <input type="hidden" name="home[ni][feats_order]" id="ni-feats-order"
                   value="{{ \App\Models\PageSetting::get('home.ni.feats_order','1,2,3') }}">
        </div>

        {{-- Labels images + CTA --}}
        <div style="margin-top:20px;display:grid;grid-template-columns:repeat(3,1fr) 1fr;gap:12px;">
            @include('admin.pages._field', ['name' => 'home[ni][img1_label]', 'key' => 'home.ni.img1_label', 'label' => 'Label image principale', 'default' => 'Arts Visuels'])
            @include('admin.pages._field', ['name' => 'home[ni][img2_label]', 'key' => 'home.ni.img2_label', 'label' => 'Label image 2', 'default' => 'Musique'])
            @include('admin.pages._field', ['name' => 'home[ni][img3_label]', 'key' => 'home.ni.img3_label', 'label' => 'Label image 3', 'default' => 'Danse'])
            @include('admin.pages._field', ['name' => 'home[ni][cta_label]', 'key' => 'home.ni.cta_label', 'label' => 'Texte du lien CTA', 'default' => 'Notre histoire complète'])
        </div>

        {{-- Upload photos ── --}}
        <div style="margin-top:20px;">
            <p style="color:#888;font-size:0.78rem;font-family:'Space Grotesk',sans-serif;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;margin:0 0 14px;">Photos de la section</p>
            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:14px;">
                @include('admin.pages._image', [
                    'name'     => 'home[ni][img1_file]',
                    'key'      => 'home.ni.img1_file',
                    'label'    => 'Image principale (grande)',
                    'fallback' => asset('images/10.jpg'),
                    'width'    => '120px',
                    'height'   => '80px',
                ])
                @include('admin.pages._image', [
                    'name'     => 'home[ni][img2_file]',
                    'key'      => 'home.ni.img2_file',
                    'label'    => 'Petite image 2',
                    'fallback' => asset('images/5.jpg'),
                    'width'    => '100px',
                    'height'   => '70px',
                ])
                @include('admin.pages._image', [
                    'name'     => 'home[ni][img3_file]',
                    'key'      => 'home.ni.img3_file',
                    'label'    => 'Petite image 3',
                    'fallback' => asset('images/11.jpg'),
                    'width'    => '100px',
                    'height'   => '70px',
                ])
            </div>
        </div>

    </div>

    <div style="height:1px;background:#161616;margin:32px 0;"></div>

    {{-- ═══════════════════════════════ SECTION SERVICES ═════════════════════════════ --}}
    <div id="section-services" class="ps-section">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
            <div style="width:4px;height:36px;background:linear-gradient(180deg,#d4a030,#e07030);border-radius:2px;flex-shrink:0;"></div>
            <div>
                <h3 style="font-family:'Space Grotesk',sans-serif;font-size:0.95rem;font-weight:700;color:#f5f5f0;margin:0;">Section "Services"</h3>
                <p style="color:#555;font-size:0.78rem;margin:0;">En-tête + 6 cartes de services</p>
            </div>
        </div>

        {{-- En-tête section --}}
        <div style="display:grid;grid-template-columns:1fr 1fr 2fr;gap:12px;margin-bottom:20px;">
            @include('admin.pages._field', ['name' => 'home[services][tag]', 'key' => 'home.services.tag', 'label' => 'Étiquette', 'default' => 'Ce que nous offrons'])
            @include('admin.pages._field', ['name' => 'home[services][titre_1]', 'key' => 'home.services.titre_1', 'label' => 'Titre ligne 1', 'default' => 'Nos Services'])
            @include('admin.pages._field', ['name' => 'home[services][titre_2]', 'key' => 'home.services.titre_2', 'label' => 'Titre ligne 2', 'default' => '& Activités'])
        </div>
        <div style="margin-bottom:20px;">
            @include('admin.pages._field', ['name' => 'home[services][desc]', 'key' => 'home.services.desc', 'label' => 'Description sous le titre', 'default' => "De la création à la scène — un écosystème complet pour chaque artiste, à chaque étape."])
        </div>

        {{-- 6 services --}}
        @php
        $servicesDefaults = [
            ['🎬','Production Artistique','Studios, accompagnement technique et distribution des œuvres.'],
            ['✨','Création Artistique','Résidences, ateliers ouverts et collaborations inter-disciplines.'],
            ['🎓','Formation Artistique','6 disciplines, de débutant à avancé, avec certification.'],
            ['🤝','Accompagnement','Mentorat, développement de carrière et mise en réseau.'],
            ['🎪','Événements Culturels','Concerts, expositions et galas qui valorisent les talents.'],
            ['🏛','Ateliers & Programmes','Programmes ouverts à tous, toute l\'année.'],
        ];
        @endphp

        @php
        $servicesFallbacks = ['10.jpg','5.jpg','10.jpg','11.jpg','10.jpg','5.jpg'];
        $servicesColors    = ['#4caf7d','#d4a030','#e07030','#4caf7d','#d4a030','#e07030'];
        $servicesOrder = array_map('intval', array_filter(
            explode(',', \App\Models\PageSetting::get('home.services.order','1,2,3,4,5,6'))
        ));
        if (count($servicesOrder) < 6) $servicesOrder = range(1,6);
        @endphp

        @include('admin.pages._sortable_header', ['label' => 'Les 6 services (glisser pour réordonner)'])
        <div id="sortable-services" style="display:flex;flex-direction:column;gap:10px;">
            @foreach($servicesOrder as $pos => $n)
            @php
                $sd  = $servicesDefaults[$n-1];
                $col = $servicesColors[$n-1];
                $fb  = $servicesFallbacks[$n-1];
            @endphp
            <div class="sort-item" data-id="{{ $n }}"
                 style="background:#0d0d0d;border:1px solid #1a1a1a;border-left:3px solid {{ $col }};border-radius:8px;padding:14px 16px;display:flex;align-items:flex-start;gap:12px;">

                {{-- Poignée --}}
                @include('admin.pages._drag_handle')

                {{-- Numéro de position --}}
                <div class="pos-badge" style="min-width:24px;height:24px;border-radius:50%;background:{{ $col }}22;color:{{ $col }};font-size:0.72rem;font-family:'Space Grotesk',sans-serif;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
                    {{ $pos+1 }}
                </div>

                {{-- Contenu --}}
                <div style="flex:1;min-width:0;">
                    <p style="color:{{ $col }};font-size:0.7rem;font-family:'Space Grotesk',sans-serif;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;margin:0 0 10px;">
                        Service {{ $n }}
                    </p>
                    {{-- Photo --}}
                    <div style="margin-bottom:12px;">
                        @include('admin.pages._image', [
                            'name'     => 'home[services][item'.$n.'_img]',
                            'key'      => 'home.services.item'.$n.'_img',
                            'label'    => 'Photo',
                            'fallback' => asset('images/'.$fb),
                            'width'    => '90px', 'height' => '60px',
                        ])
                    </div>
                    <div style="display:grid;grid-template-columns:60px 1fr;gap:8px;margin-bottom:8px;">
                        @include('admin.pages._field', ['name' => 'home[services][item'.$n.'_icon]', 'key' => 'home.services.item'.$n.'_icon', 'label' => 'Icône', 'default' => $sd[0]])
                        @include('admin.pages._field', ['name' => 'home[services][item'.$n.'_titre]', 'key' => 'home.services.item'.$n.'_titre', 'label' => 'Titre', 'default' => $sd[1]])
                    </div>
                    @include('admin.pages._field', ['name' => 'home[services][item'.$n.'_desc]', 'key' => 'home.services.item'.$n.'_desc', 'label' => 'Description', 'default' => $sd[2]])
                </div>

            </div>
            @endforeach
        </div>
        <input type="hidden" name="home[services][order]" id="services-order"
               value="{{ \App\Models\PageSetting::get('home.services.order','1,2,3,4,5,6') }}">
    </div>

    <div style="height:1px;background:#161616;margin:32px 0;"></div>

    {{-- ═══════════════════════════════ SECTION PODCASTS ═════════════════════════════ --}}
    <div id="section-podcasts" class="ps-section">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
            <div style="width:4px;height:36px;background:linear-gradient(180deg,#4caf7d,#4a90e2);border-radius:2px;flex-shrink:0;"></div>
            <div>
                <h3 style="font-family:'Space Grotesk',sans-serif;font-size:0.95rem;font-weight:700;color:#f5f5f0;margin:0;">Section "Podcasts"</h3>
                <p style="color:#555;font-size:0.78rem;margin:0;">Bloc de promotion podcasts (fond noir)</p>
            </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
            @include('admin.pages._field', ['name' => 'home[podcasts][kicker]', 'key' => 'home.podcasts.kicker', 'label' => 'Étiquette', 'default' => 'Podcasts Orion'])
            @include('admin.pages._field', ['name' => 'home[podcasts][titre_1]', 'key' => 'home.podcasts.titre_1', 'label' => 'Titre ligne 1', 'default' => 'Écouter les voix'])
            @include('admin.pages._field', ['name' => 'home[podcasts][titre_gradient]', 'key' => 'home.podcasts.titre_gradient', 'label' => 'Titre ligne 2 (dégradé vert/or)', 'default' => 'de la création'])
            @include('admin.pages._field', ['name' => 'home[podcasts][serie_titre]', 'key' => 'home.podcasts.serie_titre', 'label' => 'Titre de la série', 'default' => "Dans l'atelier"])
        </div>
        <div style="margin-top:12px;display:grid;grid-template-columns:1fr 1fr;gap:12px;">
            <div>
                @include('admin.pages._textarea', ['name' => 'home[podcasts][desc]', 'key' => 'home.podcasts.desc', 'label' => 'Description principale', 'default' => "Conversations avec artistes, formateurs et créateurs du centre : coulisses d'ateliers, parcours, résidences et réflexions sur les métiers de l'art."])
            </div>
            <div>
                @include('admin.pages._textarea', ['name' => 'home[podcasts][serie_desc]', 'key' => 'home.podcasts.serie_desc', 'label' => 'Description de la série audio', 'default' => "Une immersion dans les gestes, les voix et les idées qui précèdent l'oeuvre."])
            </div>
        </div>

        {{-- Photo de couverture --}}
        <div style="margin-top:16px;">
            @include('admin.pages._image', [
                'name'     => 'home[podcasts][img_file]',
                'key'      => 'home.podcasts.img_file',
                'label'    => 'Photo de couverture podcasts',
                'fallback' => asset('images/11.jpg'),
                'width'    => '160px',
                'height'   => '100px',
            ])
        </div>
    </div>

    <div style="height:1px;background:#161616;margin:32px 0;"></div>

    {{-- ═══════════════════════════════ SECTION CTA FINAL ═════════════════════════════ --}}
    <div id="section-cta" class="ps-section">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
            <div style="width:4px;height:36px;background:linear-gradient(180deg,#e07030,#c05020);border-radius:2px;flex-shrink:0;"></div>
            <div>
                <h3 style="font-family:'Space Grotesk',sans-serif;font-size:0.95rem;font-weight:700;color:#f5f5f0;margin:0;">Section CTA Final — "Rejoignez-nous"</h3>
                <p style="color:#555;font-size:0.78rem;margin:0;">Dernier bloc d'appel à l'action en fond vert</p>
            </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;margin-bottom:12px;">
            @include('admin.pages._field', ['name' => 'home[cta][kicker]', 'key' => 'home.cta.kicker', 'label' => 'Kicker', 'default' => 'Rejoignez-nous'])
            @include('admin.pages._field', ['name' => 'home[cta][titre_1]', 'key' => 'home.cta.titre_1', 'label' => 'Titre ligne 1', 'default' => 'Prêt à révéler'])
            @include('admin.pages._field', ['name' => 'home[cta][titre_em]', 'key' => 'home.cta.titre_em', 'label' => 'Titre ligne 2 (italique)', 'default' => 'votre talent ?'])
        </div>
        @include('admin.pages._textarea', ['name' => 'home[cta][prose]', 'key' => 'home.cta.prose', 'label' => 'Texte d\'accompagnement', 'default' => "Rejoignez une communauté d'artistes passionnés et bénéficiez d'un accompagnement professionnel pour concrétiser vos projets artistiques."])
    </div>

    {{-- Barre de sauvegarde sticky --}}
    <div style="position:sticky;bottom:0;left:0;right:0;background:#0d0d0d;border-top:1px solid #1a1a1a;padding:16px 0;margin-top:32px;display:flex;align-items:center;justify-content:space-between;z-index:20;">
        <p style="color:#555;font-size:0.78rem;font-family:'Space Grotesk',sans-serif;margin:0;">
            <svg style="vertical-align:middle;margin-right:4px;" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#555" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            Les modifications sont immédiatement visibles sur le site.
        </p>
        <button type="submit"
            style="display:inline-flex;align-items:center;gap:8px;padding:11px 28px;background:linear-gradient(135deg,#4caf7d,#2d7a52);border:none;border-radius:6px;color:#0a0a0a;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;font-weight:700;cursor:pointer;transition:opacity 0.2s;"
            onmouseover="this.style.opacity='0.88'" onmouseout="this.style.opacity='1'">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            Enregistrer toutes les modifications
        </button>
    </div>

</form>

<script>
function scrollSection(id) {
    const el = document.getElementById('section-' + id);
    if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
}
</script>

@push('scripts')
<script>
function makeSortable(containerId, hiddenInputId) {
    const el = document.getElementById(containerId);
    if (!el) return;
    new Sortable(el, {
        handle: '.drag-handle',
        animation: 150,
        ghostClass: 'sortable-ghost',
        onEnd: function () {
            const items = [...el.querySelectorAll('.sort-item')];
            // Mettre à jour la valeur de l'input caché
            document.getElementById(hiddenInputId).value = items.map(i => i.dataset.id).join(',');
            // Mettre à jour les badges de position
            items.forEach(function (item, idx) {
                const badge = item.querySelector('.pos-badge');
                if (badge) badge.textContent = idx + 1;
            });
        }
    });
}
makeSortable('sortable-ni-stats',  'ni-stats-order');
makeSortable('sortable-ni-feats',  'ni-feats-order');
makeSortable('sortable-services',  'services-order');
</script>
@endpush

@endsection
