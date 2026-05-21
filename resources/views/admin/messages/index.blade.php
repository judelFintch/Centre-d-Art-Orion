@extends('layouts.admin')
@section('title', 'Messages reçus')

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;">
    <div>
        <h2 style="font-family:'Playfair Display',serif;font-size:1.5rem;font-weight:900;color:#f5f5f0;margin:0;">Messages</h2>
        <p style="color:#555;font-size:0.82rem;margin:4px 0 0;">{{ $messages->total() }} message(s) — {{ $nonLus }} non lu(s)</p>
    </div>
</div>

<div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;overflow:hidden;">
    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="border-bottom:1px solid #1a1a1a;">
                @foreach(['Expéditeur','Sujet','Date','Statut','Actions'] as $h)
                <th style="padding:14px 16px;text-align:left;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;">{{ $h }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse($messages as $msg)
            <tr style="border-bottom:1px solid #161616;{{ $msg->statut === 'non_lu' ? 'background:rgba(224,112,48,0.03);' : '' }}transition:background 0.2s;"
                onmouseover="this.style.background='rgba(255,255,255,0.03)'" onmouseout="this.style.background='{{ $msg->statut==='non_lu'?'rgba(224,112,48,0.03)':'' }}'">
                <td style="padding:14px 16px;">
                    <div style="font-family:'Space Grotesk',sans-serif;font-weight:600;font-size:0.85rem;color:#f5f5f0;">{{ $msg->nom }}</div>
                    <div style="color:#555;font-size:0.75rem;">{{ $msg->email }}</div>
                </td>
                <td style="padding:14px 16px;color:#888;font-size:0.85rem;">{{ Str::limit($msg->sujet, 40) }}</td>
                <td style="padding:14px 16px;color:#555;font-size:0.78rem;white-space:nowrap;">{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                <td style="padding:14px 16px;">
                    @if($msg->statut === 'non_lu')
                    <span class="tag tag-orange">Non lu</span>
                    @elseif($msg->statut === 'lu')
                    <span class="tag tag-white">Lu</span>
                    @else
                    <span class="tag tag-green">Répondu</span>
                    @endif
                </td>
                <td style="padding:14px 16px;">
                    <div style="display:flex;gap:8px;">
                        <a href="{{ route('admin.messages.show', $msg) }}"
                           style="padding:6px 12px;background:rgba(76,175,125,0.1);border:1px solid rgba(76,175,125,0.2);color:#4caf7d;font-size:0.75rem;font-family:'Space Grotesk',sans-serif;font-weight:600;text-decoration:none;border-radius:4px;transition:all 0.2s;"
                           onmouseover="this.style.background='rgba(76,175,125,0.2)'" onmouseout="this.style.background='rgba(76,175,125,0.1)'">
                            Voir
                        </a>
                        <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" style="margin:0;"
                              onsubmit="return confirm('Supprimer ce message ?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    style="padding:6px 12px;background:rgba(224,112,48,0.1);border:1px solid rgba(224,112,48,0.2);color:#e07030;font-size:0.75rem;font-family:'Space Grotesk',sans-serif;font-weight:600;cursor:pointer;border-radius:4px;transition:all 0.2s;"
                                    onmouseover="this.style.background='rgba(224,112,48,0.2)'" onmouseout="this.style.background='rgba(224,112,48,0.1)'">
                                Suppr.
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="padding:48px;text-align:center;color:#555;font-size:0.88rem;">Aucun message reçu.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($messages->hasPages())
<div style="margin-top:20px;">{{ $messages->links() }}</div>
@endif

@endsection
