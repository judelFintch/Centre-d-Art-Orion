@php
    $edit = isset($formation);
    $fieldStyle = "width:100%;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.88rem;outline:none;";
@endphp

@if($errors->any())
<div style="background:rgba(224,112,48,0.1);border:1px solid rgba(224,112,48,0.3);border-radius:6px;padding:14px 18px;margin-bottom:24px;color:#e07030;font-size:0.86rem;font-family:'Space Grotesk',sans-serif;">
    Certains champs doivent être corrigés.
</div>
@endif

<div style="display:grid;grid-template-columns:minmax(0,1.4fr) minmax(280px,0.8fr);gap:24px;align-items:start;">
    <div style="display:flex;flex-direction:column;gap:20px;">
        <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;display:flex;flex-direction:column;gap:18px;">
            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Titre <span style="color:#e07030;">*</span></label>
                <input type="text" name="titre" value="{{ old('titre', $edit ? $formation->titre : '') }}" required style="{{ $fieldStyle }}" placeholder="ex: Arts Plastiques & Peinture">
                @error('titre')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>

            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $edit ? $formation->slug : '') }}" style="{{ $fieldStyle }}" placeholder="laisser vide pour générer automatiquement">
                @error('slug')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>

            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Description courte <span style="color:#e07030;">*</span></label>
                <textarea name="description" rows="4" required style="{{ $fieldStyle }}resize:vertical;" placeholder="Résumé affiché sur la liste des formations">{{ old('description', $edit ? $formation->description : '') }}</textarea>
                @error('description')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>

            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Programme détaillé</label>
                <textarea name="contenu" rows="10" style="{{ $fieldStyle }}resize:vertical;line-height:1.6;" placeholder="Contenu détaillé affiché sur la page de la formation">{{ old('contenu', $edit ? $formation->contenu : '') }}</textarea>
                @error('contenu')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>
        </div>
    </div>

    <div style="display:flex;flex-direction:column;gap:20px;">
        <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;display:flex;flex-direction:column;gap:18px;">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                <div>
                    <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Catégorie</label>
                    <input type="text" name="categorie" value="{{ old('categorie', $edit ? $formation->categorie : '') }}" style="{{ $fieldStyle }}" placeholder="Arts Visuels">
                    @error('categorie')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Niveau</label>
                    <input type="text" name="niveau" value="{{ old('niveau', $edit ? $formation->niveau : '') }}" style="{{ $fieldStyle }}" placeholder="Débutant">
                    @error('niveau')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                <div>
                    <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Durée</label>
                    <input type="text" name="duree" value="{{ old('duree', $edit ? $formation->duree : '') }}" style="{{ $fieldStyle }}" placeholder="3 mois">
                    @error('duree')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Prix USD</label>
                    <input type="number" name="prix" value="{{ old('prix', $edit ? $formation->prix : '') }}" min="0" step="0.01" style="{{ $fieldStyle }}" placeholder="150">
                    @error('prix')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Public cible</label>
                <input type="text" name="public_cible" value="{{ old('public_cible', $edit ? $formation->public_cible : '') }}" style="{{ $fieldStyle }}" placeholder="Adolescents et adultes">
                @error('public_cible')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                <div>
                    <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Ordre</label>
                    <input type="number" name="ordre" value="{{ old('ordre', $edit ? $formation->ordre : 0) }}" min="0" style="{{ $fieldStyle }}">
                    @error('ordre')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Statut</label>
                    <label style="display:flex;align-items:center;gap:10px;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;cursor:pointer;">
                        <input type="checkbox" name="actif" value="1" {{ old('actif', $edit ? $formation->actif : true) ? 'checked' : '' }} style="width:16px;height:16px;accent-color:#e07030;cursor:pointer;">
                        <span style="color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;">Actif</span>
                    </label>
                    @error('actif')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;">
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Image</label>
            @if($edit && $formation->image)
            <div style="margin-bottom:12px;position:relative;border-radius:6px;overflow:hidden;height:120px;background:#0d0d0d;">
                <img src="{{ Storage::url($formation->image) }}" alt="{{ $formation->titre }}" style="width:100%;height:100%;object-fit:cover;">
            </div>
            @endif
            <input type="file" name="image" accept="image/jpg,image/jpeg,image/png,image/webp" id="image-input" style="display:none;" onchange="previewFormationImage(this)">
            <label for="image-input"
                   style="display:flex;align-items:center;gap:10px;padding:12px 16px;background:#0d0d0d;border:1px dashed #333;border-radius:6px;cursor:pointer;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#555" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                <span id="image-name" style="color:#555;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;">Choisir une image</span>
            </label>
            <div id="image-preview" style="display:none;margin-top:10px;border-radius:6px;overflow:hidden;height:120px;background:#0d0d0d;">
                <img id="preview-img" alt="" style="width:100%;height:100%;object-fit:cover;">
            </div>
            @error('image')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>
    </div>
</div>

<div style="margin-top:24px;">
    <x-admin.translation-panel label="Version anglaise de la formation (optionnel)">
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Title (EN)</label>
            <input type="text" name="titre_en" value="{{ old('titre_en', $edit ? $formation->getTranslation('titre', 'en', false) : '') }}" style="{{ $fieldStyle }}" placeholder="e.g. Visual Arts & Painting">
        </div>
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Short description (EN)</label>
            <textarea name="description_en" rows="4" style="{{ $fieldStyle }}resize:vertical;">{{ old('description_en', $edit ? $formation->getTranslation('description', 'en', false) : '') }}</textarea>
        </div>
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Detailed program (EN)</label>
            <textarea name="contenu_en" rows="8" style="{{ $fieldStyle }}resize:vertical;line-height:1.6;">{{ old('contenu_en', $edit ? $formation->getTranslation('contenu', 'en', false) : '') }}</textarea>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Category (EN)</label>
                <input type="text" name="categorie_en" value="{{ old('categorie_en', $edit ? $formation->getTranslation('categorie', 'en', false) : '') }}" style="{{ $fieldStyle }}" placeholder="Visual Arts">
            </div>
            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Level (EN)</label>
                <input type="text" name="niveau_en" value="{{ old('niveau_en', $edit ? $formation->getTranslation('niveau', 'en', false) : '') }}" style="{{ $fieldStyle }}" placeholder="Beginner">
            </div>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Duration (EN)</label>
                <input type="text" name="duree_en" value="{{ old('duree_en', $edit ? $formation->getTranslation('duree', 'en', false) : '') }}" style="{{ $fieldStyle }}" placeholder="3 months">
            </div>
            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Target audience (EN)</label>
                <input type="text" name="public_cible_en" value="{{ old('public_cible_en', $edit ? $formation->getTranslation('public_cible', 'en', false) : '') }}" style="{{ $fieldStyle }}" placeholder="Teenagers and adults">
            </div>
        </div>
    </x-admin.translation-panel>
</div>

<script>
function previewFormationImage(input) {
    if (!input.files[0]) return;
    document.getElementById('image-name').textContent = input.files[0].name;
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('preview-img').src = e.target.result;
        document.getElementById('image-preview').style.display = 'block';
    };
    reader.readAsDataURL(input.files[0]);
}
</script>
