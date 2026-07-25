@php
    $edit = isset($temoignage);
    $fieldStyle = "width:100%;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.88rem;outline:none;box-sizing:border-box;";
@endphp

@if($errors->any())
<div style="background:rgba(224,112,48,0.1);border:1px solid rgba(224,112,48,0.3);border-radius:6px;padding:14px 18px;margin-bottom:24px;color:#e07030;font-size:0.86rem;">
    Certains champs doivent être corrigés.
</div>
@endif

<div style="display:grid;grid-template-columns:minmax(0,1.25fr) minmax(300px,0.75fr);gap:24px;align-items:start;">
    <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;display:flex;flex-direction:column;gap:18px;">
        <div>
            <label class="testimonial-label">Auteur *</label>
            <input type="text" name="auteur" value="{{ old('auteur', $edit ? $temoignage->auteur : '') }}" required maxlength="160" style="{{ $fieldStyle }}">
            @error('auteur')<p class="testimonial-error">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="testimonial-label">Fonction / qualité</label>
            <input type="text" name="poste" value="{{ old('poste', $edit ? $temoignage->poste : '') }}" maxlength="200" style="{{ $fieldStyle }}" placeholder="Artiste, apprenant, partenaire…">
            @error('poste')<p class="testimonial-error">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="testimonial-label">Témoignage *</label>
            <textarea name="contenu" rows="9" required maxlength="3000" style="{{ $fieldStyle }}resize:vertical;line-height:1.7;">{{ old('contenu', $edit ? $temoignage->contenu : '') }}</textarea>
            @error('contenu')<p class="testimonial-error">{{ $message }}</p>@enderror
        </div>
    </div>

    <div style="display:flex;flex-direction:column;gap:20px;">
        <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;display:flex;flex-direction:column;gap:18px;">
            <div>
                <label class="testimonial-label">Photo</label>
                @if($edit && $temoignage->photo_url)
                <div style="width:110px;height:110px;border-radius:50%;overflow:hidden;margin-bottom:12px;border:2px solid #2a2a2a;">
                    <img src="{{ $temoignage->photo_url }}" alt="{{ $temoignage->auteur }}" style="width:100%;height:100%;object-fit:cover;">
                </div>
                <label style="display:flex;align-items:center;gap:8px;color:#e07030;font-size:0.76rem;margin-bottom:12px;">
                    <input type="checkbox" name="remove_photo" value="1"> Supprimer la photo actuelle
                </label>
                @endif
                <input type="file" name="photo" accept="image/jpg,image/jpeg,image/png,image/webp" style="{{ $fieldStyle }}padding:9px;">
                <p style="color:#555;font-size:0.7rem;margin:6px 0 0;">JPG, PNG ou WEBP — 4 Mo maximum. Photo commune aux deux langues.</p>
                @error('photo')<p class="testimonial-error">{{ $message }}</p>@enderror
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                <div>
                    <label class="testimonial-label">Note</label>
                    <select name="note" style="{{ $fieldStyle }}">
                        @for($note = 5; $note >= 1; $note--)
                        <option value="{{ $note }}" @selected((int) old('note', $edit ? $temoignage->note : 5) === $note)>{{ $note }} étoile{{ $note > 1 ? 's' : '' }}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label class="testimonial-label">Ordre</label>
                    <input type="number" name="ordre" min="0" value="{{ old('ordre', $edit ? $temoignage->ordre : '') }}" style="{{ $fieldStyle }}">
                </div>
            </div>

            <label style="display:flex;align-items:center;gap:10px;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;cursor:pointer;">
                <input type="checkbox" name="actif" value="1" @checked(old('actif', $edit ? $temoignage->actif : true)) style="width:16px;height:16px;accent-color:#4caf7d;">
                <span style="font-size:0.85rem;">Afficher sur le site</span>
            </label>
        </div>
    </div>
</div>

<x-admin.translation-panel label="Version anglaise du témoignage">
    <div>
        <label class="testimonial-label">Position / role (EN)</label>
        <input type="text" name="poste_en" value="{{ old('poste_en', $edit ? $temoignage->getTranslation('poste', 'en', false) : '') }}" maxlength="200" style="{{ $fieldStyle }}">
    </div>
    <div>
        <label class="testimonial-label">Testimonial (EN)</label>
        <textarea name="contenu_en" rows="8" maxlength="3000" style="{{ $fieldStyle }}resize:vertical;line-height:1.7;">{{ old('contenu_en', $edit ? $temoignage->getTranslation('contenu', 'en', false) : '') }}</textarea>
    </div>
</x-admin.translation-panel>

<style>
.testimonial-label { display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px; }
.testimonial-error { color:#e07030;font-size:0.75rem;margin:5px 0 0; }
@media(max-width:850px){ div[style*="grid-template-columns:minmax(0,1.25fr)"]{grid-template-columns:1fr !important;} }
</style>
