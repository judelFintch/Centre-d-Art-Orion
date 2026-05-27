@extends('layouts.admin')
@section('title', 'Abonnements')

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:12px;">
    <div>
        <h2 style="font-family:'Playfair Display',serif;font-size:1.5rem;font-weight:900;color:#f5f5f0;margin:0;">Abonnements</h2>
        <p style="color:#555;font-size:0.82rem;margin:4px 0 0;">
            <span style="color:#4caf7d;">{{ $counts['all'] }}</span> actif(s) au total &mdash;
            <span style="color:#4caf7d;">{{ $counts['newsletter'] }}</span> newsletter &middot;
            <span style="color:#d4a030;">{{ $counts['blog'] }}</span> blog
        </p>
    </div>

    {{-- Filtres --}}
    <div style="display:flex;gap:8px;">
        @foreach(['all' => 'Tous', 'newsletter' => 'Newsletter', 'blog' => 'Blog'] as $key => $label)
        <a href="{{ route('admin.abonnements.index', ['type' => $key]) }}"
           style="padding:7px 16px;font-family:'Space Grotesk',sans-serif;font-size:0.75rem;font-weight:700;letter-spacing:0.05em;text-transform:uppercase;border-radius:4px;text-decoration:none;transition:all 0.2s;
                  {{ $type === $key
                      ? 'background:#4caf7d;color:#0a0a0a;border:1px solid #4caf7d;'
                      : 'background:rgba(255,255,255,0.04);color:#666;border:1px solid #1a1a1a;' }}"
           @if($type !== $key) onmouseover="this.style.color='#f5f5f0';this.style.borderColor='#333'" onmouseout="this.style.color='#666';this.style.borderColor='#1a1a1a'" @endif
        >{{ $label }}</a>
        @endforeach
    </div>
</div>

@if(session('success'))
<div style="background:rgba(76,175,125,0.1);border:1px solid rgba(76,175,125,0.25);border-radius:6px;padding:12px 16px;margin-bottom:20px;color:#4caf7d;font-size:0.85rem;font-family:'Space Grotesk',sans-serif;">
    {{ session('success') }}
</div>
@endif

<div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;overflow:hidden;">
    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="border-bottom:1px solid #1a1a1a;">
                @foreach(['Nom','Email','Type','Statut','Date','Actions'] as $h)
                <th style="padding:14px 16px;text-align:left;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;">{{ $h }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse($abonnements as $abo)
            <tr style="border-bottom:1px solid #161616;transition:background 0.2s;"
                onmouseover="this.style.background='rgba(255,255,255,0.03)'" onmouseout="this.style.background='transparent'">

                <td style="padding:14px 16px;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;color:#f5f5f0;">
                    {{ $abo->nom ?? '—' }}
                </td>

                <td style="padding:14px 16px;color:#888;font-size:0.85rem;">{{ $abo->email }}</td>

                <td style="padding:14px 16px;">
                    @if($abo->type === 'newsletter')
                    <span style="display:inline-flex;align-items:center;gap:5px;padding:3px 10px;background:rgba(76,175,125,0.12);border:1px solid rgba(76,175,125,0.25);color:#4caf7d;font-size:0.72rem;font-family:'Space Grotesk',sans-serif;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;border-radius:99px;">Newsletter</span>
                    @else
                    <span style="display:inline-flex;align-items:center;gap:5px;padding:3px 10px;background:rgba(212,160,48,0.12);border:1px solid rgba(212,160,48,0.25);color:#d4a030;font-size:0.72rem;font-family:'Space Grotesk',sans-serif;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;border-radius:99px;">Blog</span>
                    @endif
                </td>

                <td style="padding:14px 16px;">
                    @if($abo->isActif())
                    <span style="display:inline-block;padding:3px 10px;background:rgba(76,175,125,0.1);border:1px solid rgba(76,175,125,0.2);color:#4caf7d;font-size:0.72rem;font-family:'Space Grotesk',sans-serif;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;border-radius:99px;">Actif</span>
                    @else
                    <span style="display:inline-block;padding:3px 10px;background:rgba(224,112,48,0.1);border:1px solid rgba(224,112,48,0.2);color:#e07030;font-size:0.72rem;font-family:'Space Grotesk',sans-serif;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;border-radius:99px;">Désabonné</span>
                    @endif
                </td>

                <td style="padding:14px 16px;color:#555;font-size:0.78rem;white-space:nowrap;">
                    {{ $abo->created_at->format('d/m/Y H:i') }}
                </td>

                <td style="padding:14px 16px;">
                    <form action="{{ route('admin.abonnements.destroy', $abo) }}" method="POST" style="margin:0;"
                          onsubmit="return confirm('Supprimer cet abonné ?')">
                        @csrf @method('DELETE')
                        <button type="submit"
                                style="padding:6px 12px;background:rgba(224,112,48,0.1);border:1px solid rgba(224,112,48,0.2);color:#e07030;font-size:0.75rem;font-family:'Space Grotesk',sans-serif;font-weight:600;cursor:pointer;border-radius:4px;transition:all 0.2s;"
                                onmouseover="this.style.background='rgba(224,112,48,0.2)'" onmouseout="this.style.background='rgba(224,112,48,0.1)'">
                            Supprimer
                        </button>
                    </form>
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding:48px;text-align:center;color:#444;font-size:0.88rem;font-family:'Space Grotesk',sans-serif;">
                    Aucun abonnement trouvé.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($abonnements->hasPages())
<div style="margin-top:20px;display:flex;justify-content:center;">
    {{ $abonnements->links() }}
</div>
@endif

@endsection
