@php
    $edit = isset($equipe);
    $fs   = "width:100%;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.88rem;outline:none;box-sizing:border-box;";
    $roles = [
        'ceo'         => 'PDG / CEO',
        'chef_centre' => 'Chef de centre',
        'formateur'   => 'Formateur(trice)',
        'artiste'     => 'Artiste',
        'membre'      => 'Membre',
    ];
    $rs = $edit ? ($equipe->reseaux_sociaux ?? []) : [];
    $competencesRaw = $edit ? implode(', ', $equipe->competences ?? []) : '';
@endphp

@if($errors->any())
<div style="background:rgba(224,112,48,0.1);border:1px solid rgba(224,112,48,0.3);border-radius:6px;padding:14px 18px;margin-bottom:24px;color:#e07030;font-size:0.86rem;font-family:'Space Grotesk',sans-serif;">
    <ul style="margin:0;padding-left:18px;">
        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
    </ul>
</div>
@endif

<div style="display:grid;grid-template-columns:minmax(0,1.35fr) minmax(300px,0.75fr);gap:24px;align-items:start;">

    {{-- Colonne principale --}}
    <div style="display:flex;flex-direction:column;gap:20px;">

        <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;display:flex;flex-direction:column;gap:18px;">

            {{-- Prénom + Nom --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                <div>
                    <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Prénom <span style="color:#e07030;">*</span></label>
                    <input type="text" name="prenom" required
                           value="{{ old('prenom', $edit ? $equipe->prenom : '') }}"
                           style="{{ $fs }}" placeholder="Prénom">
                    @error('prenom')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Nom <span style="color:#e07030;">*</span></label>
                    <input type="text" name="nom" required
                           value="{{ old('nom', $edit ? $equipe->nom : '') }}"
                           style="{{ $fs }}" placeholder="Nom de famille">
                    @error('nom')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Poste --}}
            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Poste / Titre <span style="color:#e07030;">*</span></label>
                <input type="text" name="poste" required
                       value="{{ old('poste', $edit ? $equipe->poste : '') }}"
                       style="{{ $fs }}" placeholder="ex: Directeur artistique, Formateur en musique…">
                @error('poste')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>

            {{-- Biographie --}}
            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Biographie</label>
                <textarea name="bio" rows="7"
                          style="{{ $fs }}resize:vertical;line-height:1.7;"
                          placeholder="Parcours, formation, expériences, vision artistique…">{{ old('bio', $edit ? $equipe->bio : '') }}</textarea>
                @error('bio')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>

            {{-- Compétences --}}
            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Compétences</label>
                <input type="text" name="competences_raw"
                       value="{{ old('competences_raw', $competencesRaw) }}"
                       style="{{ $fs }}" placeholder="Piano, Composition, Pédagogie, Direction artistique…">
                <p style="color:#444;font-size:0.74rem;margin:5px 0 0;font-family:'Space Grotesk',sans-serif;">Séparées par des virgules.</p>
                @error('competences_raw')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>

        </div>

        {{-- Réseaux sociaux --}}
        <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;display:flex;flex-direction:column;gap:14px;">
            <h4 style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin:0;">Réseaux sociaux</h4>

            @foreach([
                ['rs_facebook',  'Facebook',  '#1877f2', 'https://facebook.com/…'],
                ['rs_instagram', 'Instagram', '#e1306c', 'https://instagram.com/…'],
                ['rs_linkedin',  'LinkedIn',  '#0a66c2', 'https://linkedin.com/in/…'],
                ['rs_twitter',   'X / Twitter','#aaa',   'https://x.com/…'],
            ] as [$name, $label, $color, $placeholder])
            <div style="display:grid;grid-template-columns:100px 1fr;gap:12px;align-items:center;">
                <label style="font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;color:{{ $color }};">{{ $label }}</label>
                <input type="url" name="{{ $name }}"
                       value="{{ old($name, $rs[str_replace('rs_', '', $name)] ?? '') }}"
                       style="{{ $fs }}" placeholder="{{ $placeholder }}">
            </div>
            @endforeach
        </div>

    </div>

    {{-- Colonne latérale --}}
    <div style="display:flex;flex-direction:column;gap:20px;">

        {{-- Rôle, Ordre, Visibilité --}}
        <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;display:flex;flex-direction:column;gap:16px;">
            <h4 style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin:0;">Rôle & Position</h4>

            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Rôle <span style="color:#e07030;">*</span></label>
                <select name="role" required style="{{ $fs }}cursor:pointer;appearance:auto;">
                    @foreach($roles as $val => $label)
                    <option value="{{ $val }}" {{ old('role', $edit ? $equipe->role : 'membre') === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('role')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>

            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Ordre d'affichage</label>
                <input type="number" name="ordre" min="0"
                       value="{{ old('ordre', $edit ? $equipe->ordre : 0) }}"
                       style="{{ $fs }}">
                <p style="color:#444;font-size:0.74rem;margin:5px 0 0;font-family:'Space Grotesk',sans-serif;">Vous pouvez aussi glisser-déposer dans la liste.</p>
                @error('ordre')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>

            <label style="display:flex;align-items:center;gap:10px;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;cursor:pointer;">
                <input type="checkbox" name="actif" value="1"
                       {{ old('actif', $edit ? $equipe->actif : true) ? 'checked' : '' }}
                       style="width:16px;height:16px;accent-color:#d4a030;cursor:pointer;">
                <span style="color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;">Afficher sur le site</span>
            </label>
        </div>

        {{-- Contact --}}
        <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;display:flex;flex-direction:column;gap:14px;">
            <h4 style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin:0;">Contact</h4>

            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">E-mail</label>
                <input type="email" name="email"
                       value="{{ old('email', $edit ? $equipe->email : '') }}"
                       style="{{ $fs }}" placeholder="prenom.nom@centreartorion.cd">
                @error('email')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>

            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Téléphone</label>
                <input type="text" name="telephone"
                       value="{{ old('telephone', $edit ? $equipe->telephone : '') }}"
                       style="{{ $fs }}" placeholder="+243 …">
                @error('telephone')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>
        </div>

        {{-- Photo --}}
        <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;">
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:12px;">Photo</label>

            @if($edit && $equipe->photo)
            <div style="margin-bottom:12px;border-radius:50%;overflow:hidden;width:100px;height:100px;border:2px solid #2a2a2a;background:#0d0d0d;">
                <img src="{{ Storage::url($equipe->photo) }}" alt="{{ $equipe->nom_complet }}" style="width:100%;height:100%;object-fit:cover;">
            </div>
            <label style="display:flex;align-items:center;gap:10px;padding:8px 12px;background:#0d0d0d;border:1px solid #222;border-radius:6px;cursor:pointer;margin-bottom:10px;">
                <input type="checkbox" name="remove_photo" value="1" style="width:14px;height:14px;accent-color:#e07030;cursor:pointer;">
                <span style="color:#e07030;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;">Supprimer la photo actuelle</span>
            </label>
            @endif

            <input type="file" name="photo" accept="image/jpg,image/jpeg,image/png,image/webp" style="{{ $fs }}padding:9px;">
            <p style="color:#555;font-size:0.74rem;margin:6px 0 0;font-family:'Space Grotesk',sans-serif;">JPG, PNG ou WebP — 4 Mo max. Portrait recommandé.</p>
            @error('photo')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
        </div>

    </div>
</div>
