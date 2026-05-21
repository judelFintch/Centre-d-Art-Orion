@extends('layouts.admin')
@section('title', 'Message — ' . $message->nom)

@section('content')
<div style="max-width:700px;">
    <div style="margin-bottom:20px;">
        <a href="{{ route('admin.messages.index') }}" style="color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;">← Retour aux messages</a>
    </div>

    <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:32px;margin-bottom:20px;">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:24px;gap:16px;flex-wrap:wrap;">
            <div>
                <h2 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1.1rem;color:#f5f5f0;margin:0 0 4px;">{{ $message->sujet }}</h2>
                <p style="color:#666;font-size:0.85rem;margin:0;">De : <strong style="color:#ccc;">{{ $message->nom }}</strong> &lt;{{ $message->email }}&gt;</p>
                @if($message->telephone)
                <p style="color:#666;font-size:0.82rem;margin:4px 0 0;">Tél. : {{ $message->telephone }}</p>
                @endif
            </div>
            <div style="text-align:right;">
                <p style="color:#555;font-size:0.78rem;margin:0 0 8px;">{{ $message->created_at->format('d/m/Y à H:i') }}</p>
                @if($message->statut === 'non_lu')
                <span class="tag tag-orange">Non lu</span>
                @elseif($message->statut === 'lu')
                <span class="tag tag-white">Lu</span>
                @else
                <span class="tag tag-green">Répondu</span>
                @endif
            </div>
        </div>

        <div style="padding:24px;background:#0d0d0d;border-radius:6px;border:1px solid #1a1a1a;">
            <p style="color:#ccc;font-size:0.9rem;line-height:1.8;margin:0;white-space:pre-wrap;">{{ $message->message }}</p>
        </div>
    </div>

    <div style="display:flex;gap:12px;flex-wrap:wrap;">
        <a href="mailto:{{ $message->email }}?subject=Re: {{ urlencode($message->sujet) }}"
           class="btn-primary">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
            Répondre par email
        </a>
        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST"
              onsubmit="return confirm('Supprimer ce message ?')" style="margin:0;">
            @csrf @method('DELETE')
            <button type="submit" class="btn-outline" style="border-color:#e0703044;color:#e07030;">
                Supprimer
            </button>
        </form>
    </div>
</div>
@endsection
