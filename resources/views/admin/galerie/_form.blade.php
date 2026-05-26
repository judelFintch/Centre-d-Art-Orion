@php
    $edit = isset($galerie);
    $fieldStyle = "width:100%;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.88rem;outline:none;";
    $selectedType = old('type', $edit ? $galerie->type : 'photo');
@endphp

@if($errors->any())
<div style="background:rgba(224,112,48,0.1);border:1px solid rgba(224,112,48,0.3);border-radius:6px;padding:14px 18px;margin-bottom:24px;color:#e07030;font-size:0.86rem;font-family:'Space Grotesk',sans-serif;">
    Certains champs doivent être corrigés.
</div>
@endif

<div style="display:grid;grid-template-columns:minmax(0,1.2fr) minmax(280px,0.8fr);gap:24px;align-items:start;">
    <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;display:flex;flex-direction:column;gap:18px;">
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Titre <span style="color:#e07030;">*</span></label>
            <input type="text" name="titre" value="{{ old('titre', $edit ? $galerie->titre : '') }}" required style="{{ $fieldStyle }}" placeholder="ex: Atelier peinture">
            @error('titre')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Type <span style="color:#e07030;">*</span></label>
                <select name="type" id="galerie-type" required style="{{ $fieldStyle }}">
                    <option value="photo" {{ $selectedType === 'photo' ? 'selected' : '' }}>Photo</option>
                    <option value="video" {{ $selectedType === 'video' ? 'selected' : '' }}>Vidéo</option>
                </select>
                @error('type')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>
            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Catégorie</label>
                <input type="text" name="categorie" value="{{ old('categorie', $edit ? $galerie->categorie : '') }}" style="{{ $fieldStyle }}" placeholder="atelier, evenement, production">
                @error('categorie')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>
        </div>

        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Description</label>
            <textarea name="description" rows="5" style="{{ $fieldStyle }}resize:vertical;line-height:1.6;" placeholder="Description courte de l'élément">{{ old('description', $edit ? $galerie->description : '') }}</textarea>
            @error('description')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>

        <div id="video-url-wrap">
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">URL vidéo</label>
            <input type="url" name="url_video" value="{{ old('url_video', $edit ? $galerie->url_video : '') }}" style="{{ $fieldStyle }}" placeholder="https://youtube.com/...">
            @error('url_video')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>
    </div>

    <div style="display:flex;flex-direction:column;gap:20px;">
        <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;display:flex;flex-direction:column;gap:18px;">
            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Fichier image</label>
                @if($edit && $galerie->type === 'photo' && $galerie->fichier && Storage::disk('public')->exists($galerie->fichier))
                <div style="margin-bottom:12px;border-radius:6px;overflow:hidden;height:120px;background:#0d0d0d;">
                    <img src="{{ Storage::url($galerie->fichier) }}" alt="{{ $galerie->titre }}" style="width:100%;height:100%;object-fit:cover;">
                </div>
                @endif
                <input type="file" name="fichier" accept="image/jpg,image/jpeg,image/png,image/webp" id="galerie-file" style="display:none;" onchange="previewGalerieImage(this, 'file-name', 'file-preview', 'file-preview-img')">
                <label for="galerie-file" style="display:flex;align-items:center;gap:10px;padding:12px 16px;background:#0d0d0d;border:1px dashed #333;border-radius:6px;cursor:pointer;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#555" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    <span id="file-name" style="color:#555;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;">Choisir une image</span>
                </label>
                <div id="file-preview" style="display:none;margin-top:10px;border-radius:6px;overflow:hidden;height:120px;background:#0d0d0d;">
                    <img id="file-preview-img" alt="" style="width:100%;height:100%;object-fit:cover;">
                </div>
                @error('fichier')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>

            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Miniature vidéo</label>
                @if($edit && $galerie->miniature && Storage::disk('public')->exists($galerie->miniature))
                <div style="margin-bottom:12px;border-radius:6px;overflow:hidden;height:90px;background:#0d0d0d;">
                    <img src="{{ Storage::url($galerie->miniature) }}" alt="{{ $galerie->titre }}" style="width:100%;height:100%;object-fit:cover;">
                </div>
                @endif
                <input type="file" name="miniature" accept="image/jpg,image/jpeg,image/png,image/webp" id="galerie-thumbnail" style="display:none;" onchange="previewGalerieImage(this, 'thumbnail-name', 'thumbnail-preview', 'thumbnail-preview-img')">
                <label for="galerie-thumbnail" style="display:flex;align-items:center;gap:10px;padding:12px 16px;background:#0d0d0d;border:1px dashed #333;border-radius:6px;cursor:pointer;">
                    <span id="thumbnail-name" style="color:#555;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;">Choisir une miniature</span>
                </label>
                <div id="thumbnail-preview" style="display:none;margin-top:10px;border-radius:6px;overflow:hidden;height:90px;background:#0d0d0d;">
                    <img id="thumbnail-preview-img" alt="" style="width:100%;height:100%;object-fit:cover;">
                </div>
                @error('miniature')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>
        </div>

        <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;display:grid;grid-template-columns:1fr 1fr;gap:14px;">
            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Ordre</label>
                <input type="number" name="ordre" value="{{ old('ordre', $edit ? $galerie->ordre : 0) }}" min="0" style="{{ $fieldStyle }}">
                @error('ordre')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>
            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Statut</label>
                <label style="display:flex;align-items:center;gap:10px;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;cursor:pointer;">
                    <input type="checkbox" name="actif" value="1" {{ old('actif', $edit ? $galerie->actif : true) ? 'checked' : '' }} style="width:16px;height:16px;accent-color:#4caf7d;cursor:pointer;">
                    <span style="color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;">Actif</span>
                </label>
            </div>
        </div>
    </div>
</div>

<script>
function previewGalerieImage(input, nameId, previewId, imageId) {
    if (!input.files[0]) return;
    document.getElementById(nameId).textContent = input.files[0].name;
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById(imageId).src = e.target.result;
        document.getElementById(previewId).style.display = 'block';
    };
    reader.readAsDataURL(input.files[0]);
}

function syncGalerieType() {
    const isVideo = document.getElementById('galerie-type').value === 'video';
    document.getElementById('video-url-wrap').style.display = isVideo ? 'block' : 'none';
}

document.getElementById('galerie-type').addEventListener('change', syncGalerieType);
syncGalerieType();
</script>
