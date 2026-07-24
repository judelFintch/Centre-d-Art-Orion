@php
    $edit = isset($podcast);
    $fieldStyle = "width:100%;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.88rem;outline:none;";
@endphp

@if($errors->any())
<div style="background:rgba(224,112,48,0.1);border:1px solid rgba(224,112,48,0.3);border-radius:6px;padding:14px 18px;margin-bottom:24px;color:#e07030;font-size:0.86rem;font-family:'Space Grotesk',sans-serif;">
    Certains champs doivent être corrigés.
</div>
@endif

<div style="display:grid;grid-template-columns:minmax(0,1.3fr) minmax(300px,0.8fr);gap:24px;align-items:start;">
    <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;display:flex;flex-direction:column;gap:18px;">
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Titre <span style="color:#e07030;">*</span></label>
            <input type="text" name="title" id="podcast-title" value="{{ old('title', $edit ? $podcast->title : '') }}" required style="{{ $fieldStyle }}" placeholder="Titre de l'épisode">
            @error('title')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>

        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Slug</label>
            <input type="text" name="slug" id="podcast-slug" value="{{ old('slug', $edit ? $podcast->slug : '') }}" style="{{ $fieldStyle }}" placeholder="généré automatiquement depuis le titre">
            <p style="color:#555;font-size:0.74rem;margin:6px 0 0;font-family:'Space Grotesk',sans-serif;">Le slug se génère automatiquement tant que vous ne le modifiez pas manuellement.</p>
            @error('slug')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>

        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Résumé <span style="color:#e07030;">*</span></label>
            <textarea name="excerpt" rows="4" required style="{{ $fieldStyle }}resize:vertical;line-height:1.6;" placeholder="Résumé court affiché sur la page podcasts">{{ old('excerpt', $edit ? $podcast->excerpt : '') }}</textarea>
            @error('excerpt')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>

        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Description</label>
            <textarea name="description" rows="8" style="{{ $fieldStyle }}resize:vertical;line-height:1.7;" placeholder="Description détaillée de l'épisode">{{ old('description', $edit ? $podcast->description : '') }}</textarea>
            @error('description')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>

        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Transcription / notes</label>
            <textarea name="transcript" rows="10" style="{{ $fieldStyle }}resize:vertical;line-height:1.7;" placeholder="Transcription, notes ou chapitrage">{{ old('transcript', $edit ? $podcast->transcript : '') }}</textarea>
            @error('transcript')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>
    </div>

    <div style="display:flex;flex-direction:column;gap:20px;">
        <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;display:flex;flex-direction:column;gap:18px;">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                <div>
                    <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Série</label>
                    <input type="text" name="series" value="{{ old('series', $edit ? $podcast->series : "Dans l'atelier") }}" style="{{ $fieldStyle }}">
                    @error('series')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">N° épisode</label>
                    <input type="text" name="episode_number" value="{{ old('episode_number', $edit ? $podcast->episode_number : '') }}" style="{{ $fieldStyle }}" placeholder="01">
                    @error('episode_number')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                <div>
                    <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Invité</label>
                    <input type="text" name="guest" value="{{ old('guest', $edit ? $podcast->guest : '') }}" style="{{ $fieldStyle }}">
                    @error('guest')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Durée</label>
                    <input type="text" name="duration" value="{{ old('duration', $edit ? $podcast->duration : '') }}" style="{{ $fieldStyle }}" placeholder="38 min">
                    @error('duration')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">URL audio externe</label>
                <input type="url" name="audio_url" value="{{ old('audio_url', $edit ? $podcast->audio_url : '') }}" style="{{ $fieldStyle }}" placeholder="https://...">
                @error('audio_url')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>

            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Fichier audio</label>
                @if($edit && $podcast->audio_file)
                <audio controls src="{{ Storage::url($podcast->audio_file) }}" style="width:100%;margin-bottom:10px;"></audio>
                @endif
                <input type="file" name="audio_file" accept="audio/mpeg,audio/wav,audio/mp4,audio/ogg,audio/aac" style="{{ $fieldStyle }}padding:9px;">
                @error('audio_file')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>

            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Image de couverture</label>
                @if($edit && $podcast->cover_image)
                <div style="margin-bottom:12px;border-radius:6px;overflow:hidden;height:130px;background:#0d0d0d;">
                    <img src="{{ Storage::url($podcast->cover_image) }}" alt="{{ $podcast->title }}" style="width:100%;height:100%;object-fit:cover;">
                </div>
                @endif
                <input type="file" name="cover_image" accept="image/jpg,image/jpeg,image/png,image/webp" style="{{ $fieldStyle }}padding:9px;">
                @error('cover_image')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>
        </div>

        <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;display:flex;flex-direction:column;gap:18px;">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                <div>
                    <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Accent</label>
                    <input type="color" name="accent" value="{{ old('accent', $edit ? $podcast->accent : '#4caf7d') }}" style="width:100%;height:42px;background:#0d0d0d;border:1px solid #222;border-radius:6px;padding:2px;">
                </div>
                <div>
                    <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Ordre</label>
                    <input type="number" name="ordre" value="{{ old('ordre', $edit ? $podcast->ordre : 0) }}" min="0" style="{{ $fieldStyle }}">
                </div>
            </div>

            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Date de publication</label>
                <input type="datetime-local" name="published_at" value="{{ old('published_at', $edit && $podcast->published_at ? $podcast->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}" style="{{ $fieldStyle }}">
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                <label style="display:flex;align-items:center;gap:10px;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;cursor:pointer;">
                    <input type="checkbox" name="actif" value="1" {{ old('actif', $edit ? $podcast->actif : true) ? 'checked' : '' }} style="width:16px;height:16px;accent-color:#4caf7d;cursor:pointer;">
                    <span style="color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;">Publié</span>
                </label>
                <label style="display:flex;align-items:center;gap:10px;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;cursor:pointer;">
                    <input type="checkbox" name="featured" value="1" {{ old('featured', $edit ? $podcast->featured : false) ? 'checked' : '' }} style="width:16px;height:16px;accent-color:#4caf7d;cursor:pointer;">
                    <span style="color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;">À la une</span>
                </label>
            </div>
        </div>
    </div>
</div>

<div style="margin-top:24px;">
    <x-admin.translation-panel label="Version anglaise de l'épisode (optionnel)">
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Title (EN)</label>
            <input type="text" name="title_en" value="{{ old('title_en', $edit ? $podcast->getTranslation('title', 'en', false) : '') }}" style="{{ $fieldStyle }}" placeholder="Episode title">
        </div>
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Series (EN)</label>
            <input type="text" name="series_en" value="{{ old('series_en', $edit ? $podcast->getTranslation('series', 'en', false) : '') }}" style="{{ $fieldStyle }}" placeholder="In the workshop">
        </div>
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Excerpt (EN)</label>
            <textarea name="excerpt_en" rows="4" style="{{ $fieldStyle }}resize:vertical;line-height:1.6;">{{ old('excerpt_en', $edit ? $podcast->getTranslation('excerpt', 'en', false) : '') }}</textarea>
        </div>
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Description (EN)</label>
            <textarea name="description_en" rows="6" style="{{ $fieldStyle }}resize:vertical;line-height:1.7;">{{ old('description_en', $edit ? $podcast->getTranslation('description', 'en', false) : '') }}</textarea>
        </div>
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Transcript / notes (EN)</label>
            <textarea name="transcript_en" rows="8" style="{{ $fieldStyle }}resize:vertical;line-height:1.7;">{{ old('transcript_en', $edit ? $podcast->getTranslation('transcript', 'en', false) : '') }}</textarea>
        </div>
    </x-admin.translation-panel>
</div>

<script>
(function() {
    const title = document.getElementById('podcast-title');
    const slug = document.getElementById('podcast-slug');
    let slugTouched = Boolean(slug.value);

    function makeSlug(value) {
        return value.normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '')
            .replace(/-{2,}/g, '-');
    }

    slug.addEventListener('input', () => {
        slugTouched = true;
        slug.value = makeSlug(slug.value);
    });

    title.addEventListener('input', () => {
        if (!slugTouched) {
            slug.value = makeSlug(title.value);
        }
    });
})();
</script>
