@extends('layouts.admin')
@section('title', 'Rôles équipe')

@section('content')

@php $fs = "width:100%;padding:10px 12px;background:#0d0d0d;border:1px solid #222;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;outline:none;box-sizing:border-box;"; @endphp

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:12px;">
    <div>
        <h2 style="font-family:'Playfair Display',serif;font-size:1.5rem;font-weight:900;color:#f5f5f0;margin:0;">Rôles équipe</h2>
        <p style="color:#555;font-size:0.82rem;margin:4px 0 0;font-family:'Space Grotesk',sans-serif;">Gérez les rôles/postes utilisés pour classer les membres de l'équipe.</p>
    </div>
    <a href="{{ route('admin.equipe.index') }}"
       style="color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;">
        Voir les membres →
    </a>
</div>

@if($errors->any())
<div style="background:rgba(224,112,48,0.1);border:1px solid rgba(224,112,48,0.3);border-radius:6px;padding:14px 18px;margin-bottom:20px;color:#e07030;font-size:0.85rem;font-family:'Space Grotesk',sans-serif;">
    <ul style="margin:0;padding-left:18px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<div style="display:grid;grid-template-columns:minmax(0,1fr) minmax(300px,0.45fr);gap:24px;align-items:start;">
    <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;overflow:hidden;">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="border-bottom:1px solid #1a1a1a;">
                    @foreach(['Rôle', 'Slug', 'Couleur', 'Membres', 'Statut', 'Actions'] as $h)
                    <th style="padding:12px 16px;text-align:left;font-family:'Space Grotesk',sans-serif;font-size:0.7rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;">{{ $h }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse($roles as $role)
                <tr style="border-bottom:1px solid #161616;">
                    <td style="padding:12px 16px;">
                        <p style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.9rem;color:#f5f5f0;margin:0 0 2px;">{{ $role->nom }}</p>
                        <p style="color:#555;font-size:0.74rem;margin:0;">ordre {{ $role->ordre }}</p>
                    </td>
                    <td style="padding:12px 16px;color:#666;font-size:0.78rem;font-family:'Space Grotesk',sans-serif;">{{ $role->slug }}</td>
                    <td style="padding:12px 16px;">
                        <span style="display:inline-flex;align-items:center;gap:8px;color:#888;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;">
                            <span style="width:18px;height:18px;border-radius:4px;background:{{ $role->couleur }};border:1px solid rgba(255,255,255,0.12);"></span>
                            {{ $role->couleur }}
                        </span>
                    </td>
                    <td style="padding:12px 16px;color:#888;font-size:0.82rem;">{{ $role->membres_count }}</td>
                    <td style="padding:12px 16px;">
                        <form action="{{ route('admin.equipe-roles.toggle', $role) }}" method="POST" style="margin:0;">
                            @csrf @method('PATCH')
                            <button type="submit"
                                    style="padding:4px 12px;border-radius:99px;font-family:'Space Grotesk',sans-serif;font-size:0.7rem;font-weight:700;cursor:pointer;border:1px solid;transition:all 0.2s;{{ $role->actif ? 'background:rgba(76,175,125,0.1);border-color:rgba(76,175,125,0.3);color:#4caf7d;' : 'background:rgba(255,255,255,0.04);border-color:#2a2a2a;color:#555;' }}">
                                {{ $role->actif ? '● Actif' : '○ Inactif' }}
                            </button>
                        </form>
                    </td>
                    <td style="padding:12px 16px;">
                        <div style="display:flex;gap:10px;align-items:center;">
                            <button type="button" onclick="toggleRoleEdit({{ $role->id }})"
                                    style="background:transparent;border:0;color:#d4a030;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;cursor:pointer;padding:0;">
                                Modifier
                            </button>
                            <form action="{{ route('admin.equipe-roles.destroy', $role) }}" method="POST" style="margin:0;" onsubmit="return confirm('Supprimer ce rôle ?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        style="background:transparent;border:0;color:#555;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;cursor:pointer;padding:0;"
                                        {{ $role->membres_count > 0 ? 'disabled title=Utilisé' : '' }}>
                                    Suppr.
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <tr id="role-edit-{{ $role->id }}" style="display:none;border-bottom:1px solid #161616;background:#0d0d0d;">
                    <td colspan="6" style="padding:16px;">
                        <form action="{{ route('admin.equipe-roles.update', $role) }}" method="POST" style="display:grid;grid-template-columns:1fr 1fr 120px 90px auto;gap:12px;align-items:end;">
                            @csrf @method('PUT')
                            <div>
                                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;margin-bottom:6px;">Nom</label>
                                <input type="text" name="nom" value="{{ $role->nom }}" required style="{{ $fs }}">
                            </div>
                            <div>
                                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#4caf7d;margin-bottom:6px;">Name (EN)</label>
                                <input type="text" name="nom_en" value="{{ $role->getTranslation('nom', 'en', false) }}" style="{{ $fs }}">
                            </div>
                            <div>
                                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;margin-bottom:6px;">Couleur</label>
                                <input type="color" name="couleur" value="{{ $role->couleur }}" required style="{{ $fs }}padding:5px;height:40px;">
                            </div>
                            <div>
                                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.68rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;margin-bottom:6px;">Ordre</label>
                                <input type="number" name="ordre" value="{{ $role->ordre }}" min="0" style="{{ $fs }}">
                            </div>
                            <label style="display:flex;align-items:center;gap:8px;padding:10px 12px;background:#111;border:1px solid #222;border-radius:6px;height:40px;">
                                <input type="checkbox" name="actif" value="1" {{ $role->actif ? 'checked' : '' }} style="accent-color:#4caf7d;">
                                <span style="color:#888;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;">Actif</span>
                            </label>
                            <div style="grid-column:1/-1;display:flex;justify-content:flex-end;">
                                <button type="submit" style="padding:9px 18px;background:linear-gradient(135deg,#d4a030,#8f6518);color:#fff;font-family:'Space Grotesk',sans-serif;font-size:0.8rem;font-weight:700;border:none;border-radius:6px;cursor:pointer;">
                                    Enregistrer
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding:34px;text-align:center;color:#555;font-size:0.86rem;">Aucun rôle enregistré.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <form action="{{ route('admin.equipe-roles.store') }}" method="POST" style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;display:flex;flex-direction:column;gap:16px;">
        @csrf
        <h3 style="font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:800;letter-spacing:0.1em;text-transform:uppercase;color:#f5f5f0;margin:0;">Nouveau rôle</h3>

        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Nom <span style="color:#e07030;">*</span></label>
            <input type="text" name="nom" value="{{ old('nom') }}" required style="{{ $fs }}" placeholder="Directeur artistique">
        </div>

        <div>
            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#4caf7d;margin-bottom:8px;">Name (EN) <span style="color:#555;text-transform:none;">optionnel</span></label>
            <input type="text" name="nom_en" value="{{ old('nom_en') }}" style="{{ $fs }}" placeholder="Artistic Director">
        </div>

        <div style="display:grid;grid-template-columns:1fr 90px;gap:12px;">
            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Couleur</label>
                <input type="color" name="couleur" value="{{ old('couleur', '#4caf7d') }}" required style="{{ $fs }}padding:5px;height:40px;">
            </div>
            <div>
                <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Ordre</label>
                <input type="number" name="ordre" value="{{ old('ordre') }}" min="0" style="{{ $fs }}">
            </div>
        </div>

        <label style="display:flex;align-items:center;gap:10px;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;cursor:pointer;">
            <input type="checkbox" name="actif" value="1" checked style="width:16px;height:16px;accent-color:#4caf7d;cursor:pointer;">
            <span style="color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;">Disponible dans le formulaire équipe</span>
        </label>

        <button type="submit" style="padding:11px 18px;background:linear-gradient(135deg,#d4a030,#8f6518);color:#fff;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;font-weight:700;border:none;border-radius:6px;cursor:pointer;">
            Ajouter le rôle
        </button>
    </form>
</div>

@push('scripts')
<script>
function toggleRoleEdit(id) {
    var row = document.getElementById('role-edit-' + id);
    if (!row) return;
    row.style.display = row.style.display === 'none' ? 'table-row' : 'none';
}
</script>
@endpush

@endsection
