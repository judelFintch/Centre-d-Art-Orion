@php
    use App\Models\PageSetting;
    use Illuminate\Support\Facades\Storage;

    $stored  = PageSetting::get($key, '');
    $preview = $stored ? Storage::url($stored) : ($fallback ?? null);
    $inputId = 'img_' . str_replace(['.','[',']'], '_', $key);
@endphp

<div>
    <label style="display:block;color:#888;font-size:0.75rem;font-family:'Space Grotesk',sans-serif;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:8px;">
        {{ $label }}
    </label>

    <div style="display:flex;gap:14px;align-items:flex-start;">

        {{-- Prévisualisation --}}
        <div style="width:{{ $width ?? '100px' }};height:{{ $height ?? '70px' }};border-radius:6px;overflow:hidden;background:#0a0a0a;border:1px solid #222;flex-shrink:0;position:relative;">
            @if($preview)
                <img id="prev_{{ $inputId }}"
                     src="{{ $preview }}"
                     alt="Aperçu"
                     style="width:100%;height:100%;object-fit:cover;display:block;">
            @else
                <div id="prev_{{ $inputId }}"
                     style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;flex-direction:column;gap:4px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#333" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    <span style="color:#333;font-size:0.65rem;font-family:'Space Grotesk',sans-serif;">Aucune</span>
                </div>
            @endif
        </div>

        {{-- Zone d'upload --}}
        <div style="flex:1;">
            <label for="{{ $inputId }}"
                   style="display:flex;flex-direction:column;align-items:center;justify-content:center;gap:6px;padding:14px;border:1px dashed #2a2a2a;border-radius:6px;cursor:pointer;transition:border-color 0.2s,background 0.2s;background:#0d0d0d;"
                   onmouseover="this.style.borderColor='#4caf7d55';this.style.background='#0f1a10'"
                   onmouseout="this.style.borderColor='#2a2a2a';this.style.background='#0d0d0d'">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#555" stroke-width="1.8"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                <span style="color:#555;font-size:0.75rem;font-family:'Space Grotesk',sans-serif;">Cliquer pour choisir</span>
                <span style="color:#333;font-size:0.68rem;font-family:'Space Grotesk',sans-serif;">JPG, PNG, WEBP — max 4 Mo</span>
            </label>
            <input type="file"
                   id="{{ $inputId }}"
                   name="{{ $name }}"
                   accept="image/*"
                   style="display:none;"
                   onchange="previewImage(this, 'prev_{{ $inputId }}')">

            {{-- Nom du fichier actuel --}}
            @if($stored)
            <div style="margin-top:6px;display:flex;align-items:center;justify-content:space-between;gap:8px;">
                <span style="color:#4caf7d;font-size:0.7rem;font-family:'Space Grotesk',sans-serif;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                    ✓ {{ basename($stored) }}
                </span>
                <span style="color:#444;font-size:0.68rem;">Photo enregistrée</span>
            </div>
            @else
            <p style="color:#444;font-size:0.68rem;font-family:'Space Grotesk',sans-serif;margin:6px 0 0;text-align:center;">
                Utilise actuellement l'image par défaut
            </p>
            @endif
        </div>

    </div>
</div>

@once
@push('scripts')
<script>
function previewImage(input, previewId) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        const el = document.getElementById(previewId);
        if (!el) return;
        if (el.tagName === 'IMG') {
            el.src = e.target.result;
        } else {
            // Remplacer le placeholder par une vraie image
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style = 'width:100%;height:100%;object-fit:cover;display:block;';
            el.replaceWith(img);
        }
    };
    reader.readAsDataURL(input.files[0]);
}
</script>
@endpush
@endonce
