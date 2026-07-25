@extends('layouts.admin')
@section('title', 'Contenu — Page Podcasts')

@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:12px;">
    <div>
        <h2 style="font-family:'Playfair Display',serif;font-size:1.4rem;font-weight:900;color:#f5f5f0;margin:0 0 4px;">Page Podcasts</h2>
        <p style="color:#555;font-size:0.82rem;margin:0;">Modifiez les sections générales. Les épisodes et leurs couvertures restent gérés séparément.</p>
    </div>
    <div style="display:flex;gap:10px;">
        <a href="{{ route('admin.podcasts.index') }}" style="padding:9px 16px;border-radius:6px;background:#111;border:1px solid #222;color:#aaa;font-size:0.8rem;text-decoration:none;">Gérer les épisodes</a>
        <a href="{{ route('podcasts.index') }}" target="_blank" style="padding:9px 16px;border-radius:6px;background:#111;border:1px solid #222;color:#4caf7d;font-size:0.8rem;text-decoration:none;">Voir la page →</a>
    </div>
</div>

@if(session('success'))
<div style="margin-bottom:20px;padding:12px 16px;border-radius:6px;background:rgba(76,175,125,0.1);border:1px solid rgba(76,175,125,0.25);color:#4caf7d;font-size:0.84rem;">
    {{ session('success') }}
</div>
@endif

<form method="POST" action="{{ route('admin.pages.podcasts.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div style="display:flex;flex-direction:column;gap:22px;">
        <section class="ps-section">
            <h3 style="color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:1rem;margin:0 0 18px;">Section d’introduction</h3>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                @include('admin.pages._field', ['name' => 'podcasts[hero][tag]', 'key' => 'podcasts.hero.tag', 'label' => 'Étiquette', 'default' => __('pages.podcasts.hero_tag')])
                @include('admin.pages._field', ['name' => 'podcasts[featured][label]', 'key' => 'podcasts.featured.label', 'label' => 'Libellé série à la une', 'default' => __('pages.podcasts.flagship_series')])
                @include('admin.pages._field', ['name' => 'podcasts[hero][title_1]', 'key' => 'podcasts.hero.title_1', 'label' => 'Titre ligne 1', 'default' => __('pages.podcasts.hero_title_1')])
                @include('admin.pages._field', ['name' => 'podcasts[hero][title_2]', 'key' => 'podcasts.hero.title_2', 'label' => 'Titre ligne 2', 'default' => __('pages.podcasts.hero_title_2')])
            </div>
            <div style="margin-top:16px;">
                @include('admin.pages._textarea', ['name' => 'podcasts[hero][description]', 'key' => 'podcasts.hero.description', 'label' => 'Description', 'default' => __('pages.podcasts.hero_desc'), 'rows' => 4])
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-top:16px;">
                @include('admin.pages._field', ['name' => 'podcasts[hero][listen_label]', 'key' => 'podcasts.hero.listen_label', 'label' => 'Bouton écouter', 'default' => __('pages.podcasts.listen_episodes')])
                @include('admin.pages._field', ['name' => 'podcasts[hero][propose_label]', 'key' => 'podcasts.hero.propose_label', 'label' => 'Bouton proposer', 'default' => __('pages.podcasts.propose_guest')])
            </div>
            <div style="margin-top:20px;padding-top:20px;border-top:1px solid #1a1a1a;">
                @include('admin.pages._image', [
                    'name' => 'podcasts[hero][fallback_image]',
                    'key' => 'podcasts.hero.fallback_image',
                    'label' => 'Image de présentation si aucun épisode',
                    'width' => '150px',
                    'height' => '110px',
                ])
                <p style="color:#555;font-size:0.74rem;line-height:1.6;margin:10px 0 0;">Cette image est commune aux versions française et anglaise. La couverture d’un épisode « À la une » reste prioritaire.</p>
            </div>
        </section>

        <section class="ps-section">
            <h3 style="color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:1rem;margin:0 0 18px;">Section des épisodes</h3>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                @include('admin.pages._field', ['name' => 'podcasts[latest][tag]', 'key' => 'podcasts.latest.tag', 'label' => 'Étiquette', 'default' => __('pages.podcasts.latest_tag')])
                @include('admin.pages._field', ['name' => 'podcasts[latest][title]', 'key' => 'podcasts.latest.title', 'label' => 'Titre', 'default' => __('pages.podcasts.latest_title')])
            </div>
            <div style="margin-top:16px;">
                @include('admin.pages._textarea', ['name' => 'podcasts[latest][description]', 'key' => 'podcasts.latest.description', 'label' => 'Description', 'default' => __('pages.podcasts.latest_desc')])
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-top:16px;">
                @include('admin.pages._field', ['name' => 'podcasts[empty][title]', 'key' => 'podcasts.empty.title', 'label' => 'Titre si aucun épisode', 'default' => __('pages.podcasts.empty_title')])
                @include('admin.pages._textarea', ['name' => 'podcasts[empty][description]', 'key' => 'podcasts.empty.description', 'label' => 'Message si aucun épisode', 'default' => __('pages.podcasts.empty_desc')])
            </div>
        </section>

        <section class="ps-section">
            <h3 style="color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:1rem;margin:0 0 18px;">Section participation</h3>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                @include('admin.pages._field', ['name' => 'podcasts[participate][tag]', 'key' => 'podcasts.participate.tag', 'label' => 'Étiquette', 'default' => __('pages.podcasts.participate_tag')])
                @include('admin.pages._field', ['name' => 'podcasts[participate][title]', 'key' => 'podcasts.participate.title', 'label' => 'Titre', 'default' => __('pages.podcasts.participate_title')])
            </div>
            <div style="margin-top:16px;">
                @include('admin.pages._textarea', ['name' => 'podcasts[participate][description]', 'key' => 'podcasts.participate.description', 'label' => 'Description', 'default' => __('pages.podcasts.participate_desc')])
            </div>
            @foreach(__('pages.podcasts.steps') as $index => $step)
            @php $number = $index + 1; @endphp
            <div style="display:grid;grid-template-columns:0.8fr 1.2fr;gap:16px;margin-top:16px;padding-top:16px;border-top:1px solid #1a1a1a;">
                @include('admin.pages._field', ['name' => "podcasts[participate][step{$number}_title]", 'key' => "podcasts.participate.step{$number}_title", 'label' => "Étape {$number} — titre", 'default' => $step['title']])
                @include('admin.pages._textarea', ['name' => "podcasts[participate][step{$number}_desc]", 'key' => "podcasts.participate.step{$number}_desc", 'label' => "Étape {$number} — description", 'default' => $step['desc']])
            </div>
            @endforeach
            <div style="margin-top:16px;">
                @include('admin.pages._field', ['name' => 'podcasts[participate][button_label]', 'key' => 'podcasts.participate.button_label', 'label' => 'Bouton final', 'default' => __('pages.podcasts.propose_participation')])
            </div>
        </section>
    </div>

    <div style="display:flex;justify-content:flex-end;margin-top:24px;">
        <button type="submit" style="padding:11px 24px;border:0;border-radius:6px;background:linear-gradient(135deg,#4caf7d,#2d7a52);color:#fff;font-family:'Space Grotesk',sans-serif;font-weight:700;cursor:pointer;">Enregistrer les sections</button>
    </div>
</form>

<style>
.ps-section { background:#0d0d0d;border:1px solid #1a1a1a;border-radius:8px;padding:24px; }
@media(max-width:800px){
    .ps-section > div[style*="grid-template-columns"] { grid-template-columns:1fr !important; }
}
</style>

@endsection
