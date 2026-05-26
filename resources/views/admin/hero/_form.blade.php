@php $edit = isset($hero); @endphp

<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">

    {{-- Colonne gauche --}}
    <div style="display:flex;flex-direction:column;gap:20px;">

        {{-- Label --}}
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">
                Label <span style="color:#e07030;">*</span>
            </label>
            <input type="text" name="label" value="{{ old('label', $edit ? $hero->label : '') }}" required
                   placeholder="ex: Production"
                   style="width:100%;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.88rem;outline:none;transition:border-color 0.2s;"
                   onfocus="this.style.borderColor='#4caf7d'" onblur="this.style.borderColor='#222'">
            @error('label')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>

        {{-- Titre ligne 1 --}}
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">
                Titre — ligne 1 <span style="color:#e07030;">*</span>
            </label>
            <input type="text" name="title_one" value="{{ old('title_one', $edit ? $hero->title_one : '') }}" required
                   placeholder="ex: DONNER VIE"
                   style="width:100%;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.88rem;outline:none;transition:border-color 0.2s;"
                   onfocus="this.style.borderColor='#4caf7d'" onblur="this.style.borderColor='#222'">
            @error('title_one')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>

        {{-- Titre ligne 2 --}}
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">
                Titre — ligne 2 <span style="color:#e07030;">*</span>
            </label>
            <input type="text" name="title_two" value="{{ old('title_two', $edit ? $hero->title_two : '') }}" required
                   placeholder="ex: A L'OEUVRE"
                   style="width:100%;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.88rem;outline:none;transition:border-color 0.2s;"
                   onfocus="this.style.borderColor='#4caf7d'" onblur="this.style.borderColor='#222'">
            @error('title_two')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>

        {{-- Lead --}}
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">
                Description <span style="color:#e07030;">*</span>
            </label>
            <textarea name="lead" required rows="3" placeholder="Phrase d'accroche du slide..."
                      style="width:100%;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.88rem;outline:none;resize:vertical;transition:border-color 0.2s;"
                      onfocus="this.style.borderColor='#4caf7d'" onblur="this.style.borderColor='#222'">{{ old('lead', $edit ? $hero->lead : '') }}</textarea>
            @error('lead')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>

    </div>

    {{-- Colonne droite --}}
    <div style="display:flex;flex-direction:column;gap:20px;">

        {{-- CTA Label --}}
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">
                Bouton — texte <span style="color:#e07030;">*</span>
            </label>
            <input type="text" name="cta_label" value="{{ old('cta_label', $edit ? $hero->cta_label : '') }}" required
                   placeholder="ex: Voir nos services"
                   style="width:100%;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.88rem;outline:none;transition:border-color 0.2s;"
                   onfocus="this.style.borderColor='#4caf7d'" onblur="this.style.borderColor='#222'">
            @error('cta_label')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>

        {{-- CTA URL --}}
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">
                Bouton — lien <span style="color:#e07030;">*</span>
            </label>
            <input type="text" name="cta_url" value="{{ old('cta_url', $edit ? $hero->cta_url : '') }}" required
                   placeholder="/services  ou  /formations"
                   style="width:100%;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.88rem;outline:none;transition:border-color 0.2s;"
                   onfocus="this.style.borderColor='#4caf7d'" onblur="this.style.borderColor='#222'">
            @error('cta_url')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>

        {{-- Couleur accent --}}
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">
                Couleur accent <span style="color:#e07030;">*</span>
            </label>
            <div style="display:flex;align-items:center;gap:12px;">
                <input type="color" name="accent" id="accent-picker"
                       value="{{ old('accent', $edit ? $hero->accent : '#4caf7d') }}"
                       style="width:44px;height:44px;border-radius:6px;border:1px solid #222;background:#0d0d0d;cursor:pointer;padding:2px;">
                <input type="text" id="accent-text" value="{{ old('accent', $edit ? $hero->accent : '#4caf7d') }}"
                       style="flex:1;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.88rem;outline:none;"
                       placeholder="#4caf7d">
                <div style="display:flex;gap:8px;">
                    @foreach(['#4caf7d','#d4a030','#e07030','#4a90e2','#e74c3c'] as $c)
                    <button type="button" onclick="document.getElementById('accent-picker').value='{{ $c }}';document.getElementById('accent-text').value='{{ $c }}';"
                            style="width:24px;height:24px;border-radius:50%;background:{{ $c }};border:2px solid #222;cursor:pointer;padding:0;transition:transform 0.15s;"
                            onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'"></button>
                    @endforeach
                </div>
            </div>
            @error('accent')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>

        {{-- Image --}}
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">
                Image de fond
            </label>
            @if($edit && $hero->image)
            <div style="margin-bottom:10px;position:relative;border-radius:6px;overflow:hidden;height:80px;">
                <img src="{{ Storage::url($hero->image) }}" style="width:100%;height:100%;object-fit:cover;">
                <div style="position:absolute;inset:0;background:rgba(0,0,0,0.5);display:flex;align-items:center;justify-content:center;">
                    <span style="color:#fff;font-size:0.72rem;font-family:'Space Grotesk',sans-serif;">Image actuelle — remplacer ci-dessous</span>
                </div>
            </div>
            @endif
            <input type="file" name="image" accept="image/jpg,image/jpeg,image/png,image/webp"
                   id="image-input"
                   style="display:none;"
                   onchange="previewImage(this)">
            <label for="image-input"
                   style="display:flex;align-items:center;gap:10px;padding:12px 16px;background:#0d0d0d;border:1px dashed #333;border-radius:6px;cursor:pointer;transition:border-color 0.2s;"
                   onmouseover="this.style.borderColor='#4caf7d'" onmouseout="this.style.borderColor='#333'">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#555" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                <span id="image-name" style="color:#555;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;">Choisir une image (jpg, png, webp — max 4 Mo)</span>
            </label>
            <div id="image-preview" style="display:none;margin-top:8px;border-radius:6px;overflow:hidden;height:80px;">
                <img id="preview-img" style="width:100%;height:100%;object-fit:cover;">
            </div>
            @error('image')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>

        {{-- Ordre + Actif --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Ordre</label>
                <input type="number" name="ordre" value="{{ old('ordre', $edit ? $hero->ordre : 0) }}" min="0"
                       style="width:100%;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.88rem;outline:none;"
                       onfocus="this.style.borderColor='#4caf7d'" onblur="this.style.borderColor='#222'">
            </div>
            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Statut</label>
                <label style="display:flex;align-items:center;gap:10px;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;cursor:pointer;">
                    <input type="checkbox" name="actif" value="1"
                           {{ old('actif', $edit ? $hero->actif : true) ? 'checked' : '' }}
                           style="width:16px;height:16px;accent-color:#4caf7d;cursor:pointer;">
                    <span style="color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;">Actif</span>
                </label>
            </div>
        </div>

    </div>
</div>

<script>
document.getElementById('accent-picker').addEventListener('input', function() {
    document.getElementById('accent-text').value = this.value;
});
document.getElementById('accent-text').addEventListener('input', function() {
    if (/^#[0-9a-fA-F]{6}$/.test(this.value)) {
        document.getElementById('accent-picker').value = this.value;
    }
});
function previewImage(input) {
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
