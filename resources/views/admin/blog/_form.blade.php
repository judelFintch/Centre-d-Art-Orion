@php
    $edit = isset($blog);
    $fieldStyle = "width:100%;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.88rem;outline:none;";
@endphp

@if($errors->any())
<div style="background:rgba(224,112,48,0.1);border:1px solid rgba(224,112,48,0.3);border-radius:6px;padding:14px 18px;margin-bottom:24px;color:#e07030;font-size:0.86rem;font-family:'Space Grotesk',sans-serif;">
    Certains champs doivent être corrigés.
</div>
@endif

<div style="display:grid;grid-template-columns:minmax(0,1.35fr) minmax(300px,0.75fr);gap:24px;align-items:start;">
    <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;display:flex;flex-direction:column;gap:18px;">
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Titre <span style="color:#e07030;">*</span></label>
	            <input type="text" name="title" id="blog-title" value="{{ old('title', $edit ? $blog->title : '') }}" required style="{{ $fieldStyle }}" placeholder="Titre de l'article">
            @error('title')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>

        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Slug</label>
	            <input type="text" name="slug" id="blog-slug" value="{{ old('slug', $edit ? $blog->slug : '') }}" style="{{ $fieldStyle }}" placeholder="généré automatiquement depuis le titre">
                <p style="color:#555;font-size:0.74rem;margin:6px 0 0;font-family:'Space Grotesk',sans-serif;">Le slug se génère automatiquement tant que vous ne le modifiez pas manuellement.</p>
            @error('slug')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>

        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Résumé <span style="color:#e07030;">*</span></label>
            <textarea name="excerpt" rows="4" required style="{{ $fieldStyle }}resize:vertical;line-height:1.6;" placeholder="Résumé affiché sur la liste du blog">{{ old('excerpt', $edit ? $blog->excerpt : '') }}</textarea>
            @error('excerpt')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>

        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Éditeur de texte <span style="color:#e07030;">*</span></label>
            <input type="hidden" name="content" id="blog-content-input" value="{{ old('content', $edit ? $blog->content : '') }}">
            <div style="border:1px solid #222;border-radius:8px;overflow:hidden;background:#0d0d0d;">
                <div style="display:flex;align-items:center;gap:6px;flex-wrap:wrap;padding:10px;border-bottom:1px solid #222;background:#111;">
                    @foreach([
                        ['H2', 'formatBlock', 'h2'],
                        ['H3', 'formatBlock', 'h3'],
                        ['P', 'formatBlock', 'p'],
                        ['B', 'bold', null],
                        ['I', 'italic', null],
                        ['U', 'underline', null],
                        ['"', 'formatBlock', 'blockquote'],
                        ['•', 'insertUnorderedList', null],
                        ['1.', 'insertOrderedList', null],
                    ] as $button)
                    <button type="button" class="editor-command" data-command="{{ $button[1] }}" data-value="{{ $button[2] }}"
                            style="min-width:34px;height:32px;padding:0 9px;background:#0d0d0d;border:1px solid #262626;border-radius:4px;color:#d4a030;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:700;cursor:pointer;">
                        {{ $button[0] }}
                    </button>
                    @endforeach
                    <button type="button" id="editor-link"
                            style="height:32px;padding:0 10px;background:#0d0d0d;border:1px solid #262626;border-radius:4px;color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:700;cursor:pointer;">
                        Lien
                    </button>
                    <button type="button" id="editor-clear"
                            style="height:32px;padding:0 10px;background:#0d0d0d;border:1px solid #262626;border-radius:4px;color:#777;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:700;cursor:pointer;">
                        Nettoyer
                    </button>
                </div>
                <div id="blog-editor" contenteditable="true"
                     style="min-height:420px;padding:22px;background:#0d0d0d;color:#f5f5f0;font-family:'Inter',sans-serif;font-size:1rem;line-height:1.85;outline:none;overflow:auto;">
                    {!! old('content', $edit ? $blog->content : '<p>Commencez la rédaction de votre article ici...</p>') !!}
                </div>
            </div>
            @error('content')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>

        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Citation</label>
            <textarea name="quote" rows="3" style="{{ $fieldStyle }}resize:vertical;line-height:1.6;" placeholder="Citation mise en avant dans l'article">{{ old('quote', $edit ? $blog->quote : '') }}</textarea>
            @error('quote')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>
    </div>

    <div style="display:flex;flex-direction:column;gap:20px;">
        <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;display:flex;flex-direction:column;gap:18px;">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                <div>
                    <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Catégorie</label>
                    <input type="text" name="category" value="{{ old('category', $edit ? $blog->category : '') }}" style="{{ $fieldStyle }}" placeholder="Coulisses">
                    @error('category')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Auteur</label>
                    <input type="text" name="author" value="{{ old('author', $edit ? $blog->author : 'Équipe Orion') }}" style="{{ $fieldStyle }}">
                    @error('author')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                <div>
                    <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Temps lecture</label>
                    <input type="text" name="read_time" value="{{ old('read_time', $edit ? $blog->read_time : '4 min') }}" style="{{ $fieldStyle }}">
                    @error('read_time')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Ordre</label>
                    <input type="number" name="ordre" value="{{ old('ordre', $edit ? $blog->ordre : 0) }}" min="0" style="{{ $fieldStyle }}">
                    @error('ordre')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Date de publication</label>
                <input type="datetime-local" name="published_at" value="{{ old('published_at', $edit && $blog->published_at ? $blog->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}" style="{{ $fieldStyle }}">
                @error('published_at')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                <label style="display:flex;align-items:center;gap:10px;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;cursor:pointer;">
                    <input type="checkbox" name="actif" value="1" {{ old('actif', $edit ? $blog->actif : true) ? 'checked' : '' }} style="width:16px;height:16px;accent-color:#d4a030;cursor:pointer;">
                    <span style="color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;">Publié</span>
                </label>
                <label style="display:flex;align-items:center;gap:10px;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;cursor:pointer;">
                    <input type="checkbox" name="featured" value="1" {{ old('featured', $edit ? $blog->featured : false) ? 'checked' : '' }} style="width:16px;height:16px;accent-color:#d4a030;cursor:pointer;">
                    <span style="color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;">À la une</span>
                </label>
            </div>
        </div>

        <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;">
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Image principale</label>
            @if($edit && $blog->image)
            <div style="margin-bottom:12px;border-radius:6px;overflow:hidden;height:130px;background:#0d0d0d;">
                <img src="{{ Storage::url($blog->image) }}" alt="{{ $blog->title }}" style="width:100%;height:100%;object-fit:cover;">
            </div>
            @endif
            <input type="file" name="image" accept="image/jpg,image/jpeg,image/png,image/webp" style="{{ $fieldStyle }}padding:9px;">
            @error('image')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>

        <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;">
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Images correspondantes</label>
            @if($edit && $blog->gallery)
            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin-bottom:12px;">
                @foreach($blog->gallery as $image)
                <label style="display:block;position:relative;border-radius:6px;overflow:hidden;background:#0d0d0d;cursor:pointer;">
                    <img src="{{ Storage::url($image) }}" alt="" style="width:100%;height:72px;object-fit:cover;display:block;">
                    <span style="display:flex;align-items:center;gap:6px;padding:6px;background:rgba(0,0,0,0.72);color:#e07030;font-size:0.68rem;font-family:'Space Grotesk',sans-serif;">
                        <input type="checkbox" name="remove_gallery[]" value="{{ $image }}" style="accent-color:#e07030;"> Retirer
                    </span>
                </label>
                @endforeach
            </div>
            @endif
            <input type="file" name="gallery_images[]" accept="image/jpg,image/jpeg,image/png,image/webp" multiple style="{{ $fieldStyle }}padding:9px;">
            @error('gallery_images.*')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>
    </div>
</div>

<div style="margin-top:24px;">
    <x-admin.translation-panel label="Version anglaise de l'article (optionnel)">
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Title (EN)</label>
            <input type="text" name="title_en" value="{{ old('title_en', $edit ? $blog->getTranslation('title', 'en', false) : '') }}" style="{{ $fieldStyle }}" placeholder="Article title">
        </div>
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Excerpt (EN)</label>
            <textarea name="excerpt_en" rows="4" style="{{ $fieldStyle }}resize:vertical;line-height:1.6;">{{ old('excerpt_en', $edit ? $blog->getTranslation('excerpt', 'en', false) : '') }}</textarea>
        </div>
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Content (EN)</label>
            <textarea name="content_en" rows="12" style="{{ $fieldStyle }}resize:vertical;line-height:1.7;" placeholder="Plain text (blank line = new paragraph) or HTML">{{ old('content_en', $edit ? $blog->getTranslation('content', 'en', false) : '') }}</textarea>
        </div>
        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Quote (EN)</label>
            <textarea name="quote_en" rows="3" style="{{ $fieldStyle }}resize:vertical;line-height:1.6;">{{ old('quote_en', $edit ? $blog->getTranslation('quote', 'en', false) : '') }}</textarea>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Category (EN)</label>
                <input type="text" name="category_en" value="{{ old('category_en', $edit ? $blog->getTranslation('category', 'en', false) : '') }}" style="{{ $fieldStyle }}" placeholder="Behind the scenes">
            </div>
            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Read time (EN)</label>
                <input type="text" name="read_time_en" value="{{ old('read_time_en', $edit ? $blog->getTranslation('read_time', 'en', false) : '') }}" style="{{ $fieldStyle }}" placeholder="4 min">
            </div>
        </div>
    </x-admin.translation-panel>
</div>

<style>
#blog-editor p { margin: 0 0 18px; }
#blog-editor h2,
#blog-editor h3 {
    color: #f5f5f0;
    font-family: 'Playfair Display', Georgia, serif;
    line-height: 1.2;
    margin: 26px 0 14px;
}
#blog-editor h2 { font-size: 2rem; }
#blog-editor h3 { font-size: 1.5rem; }
#blog-editor blockquote {
    margin: 24px 0;
    padding: 18px 22px;
    border-left: 3px solid #d4a030;
    background: #111;
    color: #f5f5f0;
}
#blog-editor ul,
#blog-editor ol {
    margin: 0 0 18px 22px;
}
</style>

<script>
(function() {
    const form = document.currentScript.closest('form') || document.querySelector('form[method="POST"]');
    const title = document.getElementById('blog-title');
    const slug = document.getElementById('blog-slug');
    const editor = document.getElementById('blog-editor');
    const hiddenContent = document.getElementById('blog-content-input');
    let slugTouched = Boolean(slug.value);

    function makeSlug(value) {
        return value
            .normalize('NFD')
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

    document.querySelectorAll('.editor-command').forEach(button => {
        button.addEventListener('click', () => {
            editor.focus();
            document.execCommand(button.dataset.command, false, button.dataset.value || null);
            syncContent();
        });
    });

    document.getElementById('editor-link').addEventListener('click', () => {
        const url = window.prompt('URL du lien');
        if (!url) return;
        editor.focus();
        document.execCommand('createLink', false, url);
        syncContent();
    });

    document.getElementById('editor-clear').addEventListener('click', () => {
        editor.focus();
        document.execCommand('removeFormat', false, null);
        syncContent();
    });

    function syncContent() {
        hiddenContent.value = editor.innerHTML.trim();
    }

    editor.addEventListener('input', syncContent);
    form.addEventListener('submit', syncContent);
    syncContent();
})();
</script>
