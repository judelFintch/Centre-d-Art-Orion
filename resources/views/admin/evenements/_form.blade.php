@php
    $edit = isset($evenement);
    $fs   = "width:100%;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.88rem;outline:none;box-sizing:border-box;";
    $types = ['concert', 'atelier', 'exposition', 'gala', 'résidence', 'spectacle', 'conférence', 'autre'];
@endphp

@if($errors->any())
<div style="background:rgba(224,112,48,0.1);border:1px solid rgba(224,112,48,0.3);border-radius:6px;padding:14px 18px;margin-bottom:24px;color:#e07030;font-size:0.86rem;font-family:'Space Grotesk',sans-serif;">
    <ul style="margin:0;padding-left:18px;">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div style="display:grid;grid-template-columns:minmax(0,1.35fr) minmax(300px,0.75fr);gap:24px;align-items:start;">

    {{-- Colonne principale --}}
    <div style="display:flex;flex-direction:column;gap:20px;">

        <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;display:flex;flex-direction:column;gap:18px;">

            {{-- Titre --}}
            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Titre <span style="color:#e07030;">*</span></label>
                <input type="text" name="titre" id="ev-titre"
                       value="{{ old('titre', $edit ? $evenement->titre : '') }}"
                       required style="{{ $fs }}" placeholder="Nom de l'événement">
                @error('titre')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>

            {{-- Slug --}}
            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Slug URL</label>
                <input type="text" name="slug" id="ev-slug"
                       value="{{ old('slug', $edit ? $evenement->slug : '') }}"
                       style="{{ $fs }}" placeholder="généré depuis le titre">
                <p style="color:#555;font-size:0.74rem;margin:5px 0 0;font-family:'Space Grotesk',sans-serif;">Modifiez pour personnaliser l'URL publique de l'événement.</p>
                @error('slug')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>

            {{-- Description --}}
            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Description courte <span style="color:#e07030;">*</span></label>
                <textarea name="description" rows="4" required
                          style="{{ $fs }}resize:vertical;line-height:1.6;"
                          placeholder="Résumé affiché dans la liste et sur la carte de l'événement">{{ old('description', $edit ? $evenement->description : '') }}</textarea>
                @error('description')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>

            {{-- Contenu --}}
            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Description complète</label>
                <textarea name="contenu" rows="10"
                          style="{{ $fs }}resize:vertical;line-height:1.8;"
                          placeholder="Détails complets affichés sur la page de l'événement (présentation, programme, intervenants…)">{{ old('contenu', $edit ? $evenement->contenu : '') }}</textarea>
                @error('contenu')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>

            {{-- Lieu --}}
            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Lieu</label>
                <input type="text" name="lieu"
                       value="{{ old('lieu', $edit ? $evenement->lieu : '') }}"
                       style="{{ $fs }}" placeholder="Salle, adresse, en ligne…">
                @error('lieu')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>

        </div>

    </div>

    {{-- Colonne latérale --}}
    <div style="display:flex;flex-direction:column;gap:20px;">

        {{-- Dates --}}
        <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;display:flex;flex-direction:column;gap:16px;">
            <h4 style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin:0;">Dates</h4>

            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Début <span style="color:#e07030;">*</span></label>
                <input type="datetime-local" name="date_debut" required
                       value="{{ old('date_debut', $edit ? $evenement->date_debut->format('Y-m-d\TH:i') : '') }}"
                       style="{{ $fs }}">
                @error('date_debut')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>

            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Fin <span style="color:#555;">(optionnel)</span></label>
                <input type="datetime-local" name="date_fin"
                       value="{{ old('date_fin', $edit && $evenement->date_fin ? $evenement->date_fin->format('Y-m-d\TH:i') : '') }}"
                       style="{{ $fs }}">
                @error('date_fin')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>
        </div>

        {{-- Type & Entrée --}}
        <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;display:flex;flex-direction:column;gap:16px;">
            <h4 style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin:0;">Catégorie & Tarif</h4>

            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Type</label>
                <select name="type" style="{{ $fs }}cursor:pointer;appearance:auto;">
                    <option value="">— Choisir un type —</option>
                    @foreach($types as $t)
                    <option value="{{ $t }}" {{ old('type', $edit ? $evenement->type : '') === $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                    @endforeach
                </select>
                @error('type')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>

            <label style="display:flex;align-items:center;gap:10px;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;cursor:pointer;">
                <input type="checkbox" name="gratuit" value="1" id="ev-gratuit"
                       {{ old('gratuit', $edit ? $evenement->gratuit : false) ? 'checked' : '' }}
                       style="width:16px;height:16px;accent-color:#4caf7d;cursor:pointer;"
                       onchange="document.getElementById('ev-prix-wrap').style.display=this.checked?'none':'block'">
                <span style="color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;">Entrée gratuite</span>
            </label>

            <div id="ev-prix-wrap" style="{{ old('gratuit', $edit ? $evenement->gratuit : false) ? 'display:none;' : '' }}">
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Prix ($)</label>
                <input type="number" name="prix" min="0" step="0.01"
                       value="{{ old('prix', $edit ? $evenement->prix : '') }}"
                       style="{{ $fs }}" placeholder="0.00">
                @error('prix')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>

            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Lien inscription</label>
                <input type="url" name="lien_inscription"
                       value="{{ old('lien_inscription', $edit ? $evenement->lien_inscription : '') }}"
                       style="{{ $fs }}" placeholder="https://…">
                @error('lien_inscription')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>
        </div>

        {{-- Visibilité --}}
        <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;">
            <h4 style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin:0 0 14px;">Visibilité</h4>
            <label style="display:flex;align-items:center;gap:10px;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;cursor:pointer;">
                <input type="checkbox" name="actif" value="1"
                       {{ old('actif', $edit ? $evenement->actif : true) ? 'checked' : '' }}
                       style="width:16px;height:16px;accent-color:#e07030;cursor:pointer;">
                <span style="color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;">Publier l'événement</span>
            </label>
            <p style="color:#444;font-size:0.75rem;margin:8px 0 0;font-family:'Space Grotesk',sans-serif;">Si décoché, l'événement n'apparaît pas sur le site public.</p>
        </div>

        {{-- Image --}}
        <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;">
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:12px;">Image principale</label>

            @if($edit && $evenement->image)
            <div id="event-image-preview-wrap" style="margin-bottom:12px;border-radius:6px;overflow:hidden;height:130px;background:#0d0d0d;position:relative;">
                <img id="event-image-preview" src="{{ $evenement->image_url }}" alt="{{ $evenement->titre }}" style="width:100%;height:100%;object-fit:cover;">
            </div>
            <label style="display:flex;align-items:center;gap:10px;padding:8px 12px;background:#0d0d0d;border:1px solid #222;border-radius:6px;cursor:pointer;margin-bottom:10px;">
                <input type="checkbox" name="remove_image" value="1"
                       style="width:14px;height:14px;accent-color:#e07030;cursor:pointer;">
                <span style="color:#e07030;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;">Supprimer l'image actuelle</span>
            </label>
            @else
            <div id="event-image-preview-wrap" style="display:none;margin-bottom:12px;border-radius:6px;overflow:hidden;height:130px;background:#0d0d0d;position:relative;">
                <img id="event-image-preview" src="" alt="Aperçu de l'image" style="width:100%;height:100%;object-fit:cover;">
            </div>
            @endif

            <input id="event-image-input" type="file" name="image" accept="image/jpg,image/jpeg,image/png,image/webp" style="{{ $fs }}padding:9px;">
            <p style="color:#555;font-size:0.74rem;margin:6px 0 0;font-family:'Space Grotesk',sans-serif;">JPG, PNG ou WebP — 4 Mo max. Recommandé : 1200×800px.</p>
            @error('image')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>

    </div>
</div>

<script>
(function () {
    var titre = document.getElementById('ev-titre');
    var slug  = document.getElementById('ev-slug');
    var slugTouched = Boolean(slug.value);

    function makeSlug(v) {
        return v.normalize('NFD').replace(/[̀-ͯ]/g,'').toLowerCase()
            .replace(/[^a-z0-9]+/g,'-').replace(/^-+|-+$/g,'').replace(/-{2,}/g,'-');
    }

    slug.addEventListener('input', function () { slugTouched = true; slug.value = makeSlug(slug.value); });
    titre.addEventListener('input', function () { if (!slugTouched) slug.value = makeSlug(titre.value); });

    var imageInput = document.getElementById('event-image-input');
    var imagePreviewWrap = document.getElementById('event-image-preview-wrap');
    var imagePreview = document.getElementById('event-image-preview');

    if (imageInput && imagePreviewWrap && imagePreview) {
        imageInput.addEventListener('change', function () {
            var file = imageInput.files && imageInput.files[0];
            if (!file) return;

            imagePreview.src = URL.createObjectURL(file);
            imagePreviewWrap.style.display = 'block';
        });
    }
})();
</script>
