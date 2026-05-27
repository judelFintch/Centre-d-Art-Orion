@extends('layouts.admin')
@section('title', 'Équipe')

@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:12px;">
    <div>
        <h2 style="font-family:'Playfair Display',serif;font-size:1.5rem;font-weight:900;color:#f5f5f0;margin:0;">Équipe</h2>
        <p style="color:#555;font-size:0.82rem;margin:4px 0 0;font-family:'Space Grotesk',sans-serif;">{{ $membres->count() }} membre(s)</p>
    </div>
    <a href="{{ route('admin.equipe.create') }}"
       style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:linear-gradient(135deg,#d4a030,#8f6518);color:#fff;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;border-radius:6px;transition:opacity 0.2s;"
       onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Ajouter un membre
    </a>
</div>

@if(session('success'))
<div style="background:rgba(76,175,125,0.1);border:1px solid rgba(76,175,125,0.25);border-radius:6px;padding:12px 16px;margin-bottom:20px;color:#4caf7d;font-size:0.85rem;font-family:'Space Grotesk',sans-serif;">
    {{ session('success') }}
</div>
@endif

@if($membres->isEmpty())
<div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:64px;text-align:center;">
    <div style="font-size:2.5rem;margin-bottom:16px;">◈</div>
    <p style="color:#555;font-family:'Space Grotesk',sans-serif;margin:0 0 20px;">Aucun membre pour l'instant.</p>
    <a href="{{ route('admin.equipe.create') }}"
       style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:linear-gradient(135deg,#d4a030,#8f6518);color:#fff;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;border-radius:6px;">
        Ajouter le premier membre
    </a>
</div>
@else

{{-- Légende des rôles --}}
@php
    $roleLabels = [
        'ceo'         => ['label' => 'PDG / CEO',       'color' => '#d4a030'],
        'chef_centre' => ['label' => 'Chef de centre',  'color' => '#e07030'],
        'formateur'   => ['label' => 'Formateur',       'color' => '#4caf7d'],
        'artiste'     => ['label' => 'Artiste',         'color' => '#7c6af7'],
        'membre'      => ['label' => 'Membre',          'color' => '#888'],
    ];
@endphp

<div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;overflow:hidden;" id="equipe-list">
    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="border-bottom:1px solid #1a1a1a;">
                @foreach(['⇅', 'Photo', 'Membre', 'Rôle / Poste', 'Contact', 'Visibilité', 'Actions'] as $h)
                <th style="padding:12px 16px;text-align:left;font-family:'Space Grotesk',sans-serif;font-size:0.7rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;">{{ $h }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody id="sortable-body">
            @foreach($membres as $membre)
            <tr data-id="{{ $membre->id }}"
                style="border-bottom:1px solid #161616;transition:background 0.2s;cursor:grab;"
                onmouseover="this.style.background='rgba(255,255,255,0.025)'" onmouseout="this.style.background='transparent'">

                {{-- Handle drag --}}
                <td style="padding:12px 16px;color:#333;font-size:1rem;user-select:none;">⠿</td>

                {{-- Photo --}}
                <td style="padding:12px 16px;">
                    <div style="width:48px;height:48px;border-radius:50%;overflow:hidden;background:#1a1a1a;flex-shrink:0;border:2px solid #222;">
                        @if($membre->photo)
                        <img src="{{ Storage::url($membre->photo) }}" alt="{{ $membre->nom_complet }}" style="width:100%;height:100%;object-fit:cover;">
                        @else
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-family:'Playfair Display',serif;font-size:1.1rem;color:#555;font-weight:700;">
                            {{ strtoupper(substr($membre->prenom, 0, 1)) }}{{ strtoupper(substr($membre->nom, 0, 1)) }}
                        </div>
                        @endif
                    </div>
                </td>

                {{-- Nom + ordre --}}
                <td style="padding:12px 16px;min-width:160px;">
                    <p style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.92rem;color:#f5f5f0;margin:0 0 2px;">{{ $membre->nom_complet }}</p>
                    <p style="color:#555;font-size:0.75rem;margin:0;">ordre {{ $membre->ordre }}</p>
                </td>

                {{-- Rôle / Poste --}}
                <td style="padding:12px 16px;">
                    @php $r = $roleLabels[$membre->role] ?? ['label' => $membre->role, 'color' => '#888']; @endphp
                    <span style="display:inline-block;padding:3px 10px;border-radius:99px;border:1px solid {{ $r['color'] }}44;color:{{ $r['color'] }};font-family:'Space Grotesk',sans-serif;font-size:0.7rem;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;margin-bottom:4px;">{{ $r['label'] }}</span>
                    <p style="color:#666;font-size:0.78rem;margin:0;max-width:180px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $membre->poste }}</p>
                </td>

                {{-- Contact --}}
                <td style="padding:12px 16px;">
                    @if($membre->email)
                    <p style="color:#666;font-size:0.78rem;margin:0 0 3px;display:flex;align-items:center;gap:5px;">
                        <span style="color:#4caf7d;font-size:0.7rem;">✉</span> {{ $membre->email }}
                    </p>
                    @endif
                    @if($membre->telephone)
                    <p style="color:#666;font-size:0.78rem;margin:0;display:flex;align-items:center;gap:5px;">
                        <span style="color:#d4a030;font-size:0.7rem;">✆</span> {{ $membre->telephone }}
                    </p>
                    @endif
                    @if(!$membre->email && !$membre->telephone)
                    <span style="color:#333;font-size:0.78rem;">—</span>
                    @endif
                </td>

                {{-- Toggle actif --}}
                <td style="padding:12px 16px;">
                    <form action="{{ route('admin.equipe.toggle', $membre) }}" method="POST" style="margin:0;">
                        @csrf @method('PATCH')
                        <button type="submit"
                                style="padding:4px 12px;border-radius:99px;font-family:'Space Grotesk',sans-serif;font-size:0.7rem;font-weight:700;cursor:pointer;border:1px solid;transition:all 0.2s;
                                       {{ $membre->actif
                                           ? 'background:rgba(76,175,125,0.1);border-color:rgba(76,175,125,0.3);color:#4caf7d;'
                                           : 'background:rgba(255,255,255,0.04);border-color:#2a2a2a;color:#555;' }}">
                            {{ $membre->actif ? '● Visible' : '○ Masqué' }}
                        </button>
                    </form>
                </td>

                {{-- Actions --}}
                <td style="padding:12px 16px;">
                    <div style="display:flex;gap:10px;align-items:center;">
                        <a href="{{ route('admin.equipe.edit', $membre) }}"
                           style="color:#d4a030;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;text-decoration:none;transition:opacity 0.2s;"
                           onmouseover="this.style.opacity='.7'" onmouseout="this.style.opacity='1'">Modifier</a>
                        <form action="{{ route('admin.equipe.destroy', $membre) }}" method="POST"
                              onsubmit="return confirm('Supprimer {{ addslashes($membre->nom_complet) }} ?')" style="margin:0;">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    style="background:transparent;border:0;color:#555;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;cursor:pointer;padding:0;transition:color 0.2s;"
                                    onmouseover="this.style.color='#e07030'" onmouseout="this.style.color='#555'">Suppr.</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<p style="color:#444;font-size:0.75rem;font-family:'Space Grotesk',sans-serif;margin:10px 0 0;text-align:right;">Glissez-déposez les lignes pour réorganiser l'ordre d'affichage.</p>
@endif

<script>
(function () {
    var tbody = document.getElementById('sortable-body');
    if (!tbody) return;

    var dragged = null;

    [].forEach.call(tbody.querySelectorAll('tr'), function (row) {
        row.setAttribute('draggable', 'true');

        row.addEventListener('dragstart', function () {
            dragged = row;
            setTimeout(function () { row.style.opacity = '0.4'; }, 0);
        });

        row.addEventListener('dragend', function () {
            row.style.opacity = '';
            saveOrder();
        });

        row.addEventListener('dragover', function (e) {
            e.preventDefault();
            var rect = row.getBoundingClientRect();
            var mid  = rect.top + rect.height / 2;
            if (e.clientY < mid) {
                tbody.insertBefore(dragged, row);
            } else {
                tbody.insertBefore(dragged, row.nextSibling);
            }
        });
    });

    function saveOrder() {
        var ids = [].map.call(tbody.querySelectorAll('tr[data-id]'), function (r) {
            return r.dataset.id;
        });

        fetch('{{ route("admin.equipe.reorder") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ ordre: ids }),
        });
    }
})();
</script>

@endsection
