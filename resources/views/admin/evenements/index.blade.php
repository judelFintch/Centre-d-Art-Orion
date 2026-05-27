@extends('layouts.admin')
@section('title', 'Événements')

@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:12px;">
    <div>
        <h2 style="font-family:'Playfair Display',serif;font-size:1.5rem;font-weight:900;color:#f5f5f0;margin:0;">Événements</h2>
        <p style="color:#555;font-size:0.82rem;margin:4px 0 0;font-family:'Space Grotesk',sans-serif;">{{ $total }} événement(s) au total</p>
    </div>
    <a href="{{ route('admin.evenements.create') }}"
       style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:linear-gradient(135deg,#e07030,#c05020);color:#fff;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;border-radius:6px;transition:opacity 0.2s;"
       onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouvel événement
    </a>
</div>

@if(session('success'))
<div style="background:rgba(76,175,125,0.1);border:1px solid rgba(76,175,125,0.25);border-radius:6px;padding:12px 16px;margin-bottom:20px;color:#4caf7d;font-size:0.85rem;font-family:'Space Grotesk',sans-serif;">
    {{ session('success') }}
</div>
@endif

@php
    $sections = [
        ['label' => 'En cours',    'tag' => 'tag-green',  'color' => '#4caf7d', 'items' => $enCours],
        ['label' => 'À venir',     'tag' => 'tag-orange', 'color' => '#e07030', 'items' => $aVenir],
        ['label' => 'Passés',      'tag' => 'tag-white',  'color' => '#888',    'items' => $passes],
    ];
@endphp

@foreach($sections as $section)
@if($section['items']->count())
<div style="margin-bottom:36px;">
    <h3 style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:{{ $section['color'] }};margin:0 0 14px;display:flex;align-items:center;gap:8px;">
        <span style="width:6px;height:6px;background:{{ $section['color'] }};border-radius:50%;display:inline-block;"></span>
        {{ $section['label'] }} ({{ $section['items']->count() }})
    </h3>

    <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;overflow:hidden;">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="border-bottom:1px solid #1a1a1a;">
                    @foreach(['', 'Titre', 'Type', 'Date', 'Lieu', 'Entrée', 'Visibilité', 'Actions'] as $h)
                    <th style="padding:12px 14px;text-align:left;font-family:'Space Grotesk',sans-serif;font-size:0.7rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;">{{ $h }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($section['items'] as $ev)
                <tr style="border-bottom:1px solid #161616;transition:background 0.2s;"
                    onmouseover="this.style.background='rgba(255,255,255,0.025)'" onmouseout="this.style.background='transparent'">

                    {{-- Vignette --}}
                    <td style="padding:12px 14px;width:72px;">
                        <div style="width:60px;height:42px;border-radius:4px;overflow:hidden;background:#1a1a1a;flex-shrink:0;">
                            @if($ev->image)
                            <img src="{{ Storage::url($ev->image) }}" alt="{{ $ev->titre }}" style="width:100%;height:100%;object-fit:cover;">
                            @else
                            <div style="height:100%;display:flex;align-items:center;justify-content:center;color:#333;font-size:1.1rem;">◎</div>
                            @endif
                        </div>
                    </td>

                    {{-- Titre --}}
                    <td style="padding:12px 14px;max-width:220px;">
                        <p style="font-family:'Space Grotesk',sans-serif;font-weight:600;font-size:0.88rem;color:#f5f5f0;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $ev->titre }}</p>
                    </td>

                    {{-- Type --}}
                    <td style="padding:12px 14px;">
                        @if($ev->type)
                        <span class="{{ $section['tag'] }}" style="font-size:0.68rem;">{{ ucfirst($ev->type) }}</span>
                        @else
                        <span style="color:#444;font-size:0.78rem;">—</span>
                        @endif
                    </td>

                    {{-- Date --}}
                    <td style="padding:12px 14px;white-space:nowrap;color:#888;font-size:0.8rem;">
                        {{ $ev->date_debut->format('d/m/Y') }}
                        @if($ev->date_fin)<br><span style="color:#555;font-size:0.75rem;">→ {{ $ev->date_fin->format('d/m/Y') }}</span>@endif
                    </td>

                    {{-- Lieu --}}
                    <td style="padding:12px 14px;color:#666;font-size:0.8rem;max-width:140px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $ev->lieu ?: '—' }}</td>

                    {{-- Entrée --}}
                    <td style="padding:12px 14px;">
                        @if($ev->gratuit)
                        <span style="color:#4caf7d;font-size:0.8rem;font-weight:700;font-family:'Space Grotesk',sans-serif;">Gratuit</span>
                        @elseif($ev->prix)
                        <span style="color:#d4a030;font-size:0.8rem;font-weight:700;font-family:'Space Grotesk',sans-serif;">{{ number_format($ev->prix, 0) }} $</span>
                        @else
                        <span style="color:#555;font-size:0.78rem;">—</span>
                        @endif
                    </td>

                    {{-- Toggle actif --}}
                    <td style="padding:12px 14px;">
                        <form action="{{ route('admin.evenements.toggle', $ev) }}" method="POST" style="margin:0;">
                            @csrf @method('PATCH')
                            <button type="submit"
                                    style="padding:4px 12px;border-radius:99px;font-family:'Space Grotesk',sans-serif;font-size:0.7rem;font-weight:700;letter-spacing:0.04em;cursor:pointer;border:1px solid;transition:all 0.2s;
                                           {{ $ev->actif
                                               ? 'background:rgba(76,175,125,0.1);border-color:rgba(76,175,125,0.3);color:#4caf7d;'
                                               : 'background:rgba(255,255,255,0.04);border-color:#2a2a2a;color:#555;' }}"
                                    title="{{ $ev->actif ? 'Cliquer pour masquer' : 'Cliquer pour publier' }}">
                                {{ $ev->actif ? '● Publié' : '○ Masqué' }}
                            </button>
                        </form>
                    </td>

                    {{-- Actions --}}
                    <td style="padding:12px 14px;">
                        <div style="display:flex;gap:10px;align-items:center;">
                            @if($ev->actif)
                            <a href="{{ route('evenements.show', $ev) }}" target="_blank"
                               style="color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;text-decoration:none;"
                               title="Voir sur le site">↗</a>
                            @endif
                            <a href="{{ route('admin.evenements.edit', $ev) }}"
                               style="color:#e07030;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;text-decoration:none;">Modifier</a>
                            <form action="{{ route('admin.evenements.destroy', $ev) }}" method="POST"
                                  onsubmit="return confirm('Supprimer « {{ addslashes($ev->titre) }} » ?')" style="margin:0;">
                                @csrf @method('DELETE')
                                <button type="submit" style="background:transparent;border:0;color:#555;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;cursor:pointer;padding:0;transition:color 0.2s;"
                                        onmouseover="this.style.color='#e07030'" onmouseout="this.style.color='#555'">Suppr.</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endforeach

@if($total === 0)
<div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:64px;text-align:center;">
    <div style="font-size:2.5rem;margin-bottom:16px;">◎</div>
    <p style="color:#555;font-family:'Space Grotesk',sans-serif;margin:0 0 20px;">Aucun événement pour l'instant.</p>
    <a href="{{ route('admin.evenements.create') }}"
       style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:linear-gradient(135deg,#e07030,#c05020);color:#fff;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;border-radius:6px;">
        Créer le premier événement
    </a>
</div>
@endif

@endsection
