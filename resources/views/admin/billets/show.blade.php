@extends('layouts.admin')
@section('title', 'Réservation — ' . $billet->reference)

@section('content')
<div style="max-width:700px;">
    <div style="margin-bottom:20px;">
        <a href="{{ route('admin.billets.index') }}" style="color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;text-decoration:none;">← Retour aux réservations</a>
    </div>

    {{-- En-tête --}}
    <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:32px;margin-bottom:20px;">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:16px;margin-bottom:28px;flex-wrap:wrap;">
            <div>
                <p style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#555;margin:0 0 6px;">Référence de réservation</p>
                <h2 style="font-family:'Space Grotesk',sans-serif;font-size:1.4rem;font-weight:900;color:#4caf7d;letter-spacing:0.06em;margin:0;">{{ $billet->reference }}</h2>
            </div>
            <div style="text-align:right;">
                <p style="color:#555;font-size:0.78rem;margin:0 0 8px;">{{ $billet->created_at->format('d/m/Y à H:i') }}</p>
                @if($billet->statut === 'confirme')
                <span class="tag tag-green">Confirmé</span>
                @elseif($billet->statut === 'annule')
                <span class="tag tag-orange">Annulé</span>
                @else
                <span class="tag tag-white">En attente</span>
                @endif
            </div>
        </div>

        {{-- Détails --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:24px;">
            <div>
                <p style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#555;margin:0 0 6px;">Participant</p>
                <p style="font-family:'Space Grotesk',sans-serif;font-size:0.95rem;font-weight:600;color:#f5f5f0;margin:0;">{{ $billet->prenom }} {{ $billet->nom }}</p>
            </div>
            <div>
                <p style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#555;margin:0 0 6px;">Email</p>
                <p style="font-size:0.9rem;color:#ccc;margin:0;">{{ $billet->email }}</p>
            </div>
            @if($billet->telephone)
            <div>
                <p style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#555;margin:0 0 6px;">Téléphone</p>
                <p style="font-size:0.9rem;color:#ccc;margin:0;">{{ $billet->telephone }}</p>
            </div>
            @endif
            @if($billet->categorie)
            <div>
                <p style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#555;margin:0 0 6px;">Catégorie</p>
                <p style="margin:0;">
                    <span style="display:inline-block;padding:3px 10px;background:rgba(176,122,255,0.1);border:1px solid rgba(176,122,255,0.2);color:#b07aff;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:700;border-radius:20px;">{{ $billet->categorie->nom }}</span>
                </p>
                @if($billet->categorie->description)
                <p style="font-size:0.78rem;color:#555;margin:4px 0 0;">{{ $billet->categorie->description }}</p>
                @endif
            </div>
            @endif
            <div>
                <p style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#555;margin:0 0 6px;">Nombre de billets</p>
                <p style="font-size:0.9rem;color:#ccc;margin:0;">{{ $billet->nombre_billets }} billet{{ $billet->nombre_billets > 1 ? 's' : '' }}</p>
            </div>
            <div>
                <p style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#555;margin:0 0 6px;">Montant total</p>
                <p style="font-family:'Playfair Display',serif;font-size:1rem;font-weight:700;color:#d4a030;margin:0;">
                    {{ $billet->montant_total > 0 ? number_format($billet->montant_total, 0, ',', ' ').' FC' : 'Gratuit' }}
                </p>
            </div>
        </div>

        {{-- Événement --}}
        <div style="background:#0d0d0d;border-radius:8px;padding:20px;border:1px solid #1a1a1a;margin-bottom:24px;">
            <p style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#555;margin:0 0 10px;">Événement</p>
            <p style="font-family:'Playfair Display',serif;font-size:1.05rem;font-weight:700;color:#f5f5f0;margin:0 0 6px;">{{ $billet->evenement?->titre ?? '—' }}</p>
            @if($billet->evenement)
            <p style="font-family:'Space Grotesk',sans-serif;font-size:0.82rem;color:#666;margin:0;">
                {{ $billet->evenement->date_debut->isoFormat('dddd D MMMM YYYY [à] HH:mm') }}
                @if($billet->evenement->lieu) · {{ $billet->evenement->lieu }} @endif
            </p>
            @endif
        </div>

        @if($billet->notes)
        <div style="background:#0d0d0d;border-radius:8px;padding:16px;border:1px solid #1a1a1a;">
            <p style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#555;margin:0 0 8px;">Notes</p>
            <p style="color:#aaa;font-size:0.88rem;line-height:1.6;margin:0;">{{ $billet->notes }}</p>
        </div>
        @endif
    </div>

    {{-- ── Paiement ── --}}
    @if($billet->montant_total > 0)
    @php $meta = \App\Models\Billet::METHODES; $m = $billet->methode_paiement; @endphp
    <div style="background:#111;border:1px solid {{ $billet->paiement_verifie ? 'rgba(76,175,125,0.3)' : '#1a1a1a' }};border-radius:8px;padding:24px;margin-bottom:20px;">
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
            <h3 style="font-family:'Space Grotesk',sans-serif;font-size:0.85rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#888;margin:0;">Paiement</h3>
            @if($billet->paiement_verifie)
            <span style="display:inline-flex;align-items:center;gap:5px;padding:4px 12px;background:rgba(76,175,125,0.12);border:1px solid rgba(76,175,125,0.3);color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.75rem;font-weight:700;border-radius:20px;">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                Vérifié
            </span>
            @else
            <span style="padding:4px 12px;background:rgba(212,160,48,0.1);border:1px solid rgba(212,160,48,0.25);color:#d4a030;font-family:'Space Grotesk',sans-serif;font-size:0.75rem;font-weight:700;border-radius:20px;">En attente de vérification</span>
            @endif
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:20px;">
            <div>
                <p style="font-family:'Space Grotesk',sans-serif;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#555;margin:0 0 5px;">Méthode</p>
                @if($m && isset($meta[$m]))
                <div style="display:flex;align-items:center;gap:6px;">
                    <div style="width:8px;height:8px;border-radius:50%;background:{{ $meta[$m]['couleur'] }};flex-shrink:0;"></div>
                    <span style="font-family:'Space Grotesk',sans-serif;font-size:0.88rem;font-weight:600;color:#f5f5f0;">{{ $meta[$m]['label'] }}</span>
                </div>
                @else
                <span style="color:#555;font-size:0.88rem;">—</span>
                @endif
            </div>
            <div>
                <p style="font-family:'Space Grotesk',sans-serif;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#555;margin:0 0 5px;">Référence transaction</p>
                <p style="font-family:'Space Grotesk',sans-serif;font-size:0.9rem;font-weight:700;color:{{ $billet->reference_paiement ? '#f5f5f0' : '#444' }};margin:0;letter-spacing:0.04em;">
                    {{ $billet->reference_paiement ?? '—' }}
                </p>
            </div>
        </div>

        @if($billet->preuve_paiement)
        <div style="margin-bottom:20px;">
            <p style="font-family:'Space Grotesk',sans-serif;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#555;margin:0 0 8px;">Preuve de paiement</p>
            @php $ext = pathinfo($billet->preuve_paiement, PATHINFO_EXTENSION); @endphp
            @if(in_array(strtolower($ext), ['jpg','jpeg','png']))
            <a href="{{ Storage::url($billet->preuve_paiement) }}" target="_blank">
                <img src="{{ Storage::url($billet->preuve_paiement) }}" alt="Preuve"
                     style="max-width:280px;max-height:200px;object-fit:contain;border-radius:6px;border:1px solid #1a1a1a;">
            </a>
            @else
            <a href="{{ Storage::url($billet->preuve_paiement) }}" target="_blank"
               style="display:inline-flex;align-items:center;gap:6px;padding:7px 14px;background:rgba(74,144,226,0.1);border:1px solid rgba(74,144,226,0.2);color:#4a90e2;font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:600;border-radius:6px;text-decoration:none;">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg>
                Ouvrir le fichier PDF
            </a>
            @endif
        </div>
        @endif

        {{-- Bouton vérifier/annuler vérification --}}
        <form action="{{ route('admin.billets.verifier', $billet) }}" method="POST" style="margin:0;">
            @csrf @method('PATCH')
            @if($billet->paiement_verifie)
            <button type="submit"
                    style="padding:8px 18px;background:rgba(224,112,48,0.08);border:1px solid rgba(224,112,48,0.2);color:#e07030;font-family:'Space Grotesk',sans-serif;font-size:0.8rem;font-weight:600;border-radius:6px;cursor:pointer;">
                Annuler la vérification
            </button>
            @else
            <button type="submit"
                    style="padding:8px 18px;background:rgba(76,175,125,0.12);border:1px solid rgba(76,175,125,0.3);color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.8rem;font-weight:700;border-radius:6px;cursor:pointer;">
                ✓ Marquer comme payé
            </button>
            @endif
        </form>
    </div>
    @endif

    {{-- Changer le statut --}}
    <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;margin-bottom:20px;">
        <h3 style="font-family:'Space Grotesk',sans-serif;font-size:0.85rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#888;margin:0 0 16px;">Modifier le statut</h3>
        <form action="{{ route('admin.billets.statut', $billet) }}" method="POST" style="display:flex;gap:10px;flex-wrap:wrap;align-items:center;">
            @csrf @method('PATCH')
            <select name="statut" style="padding:9px 14px;background:#0d0d0d;border:1px solid #1a1a1a;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;outline:none;cursor:pointer;">
                <option value="en_attente" {{ $billet->statut === 'en_attente' ? 'selected' : '' }}>En attente</option>
                <option value="confirme"   {{ $billet->statut === 'confirme'   ? 'selected' : '' }}>Confirmé</option>
                <option value="annule"     {{ $billet->statut === 'annule'     ? 'selected' : '' }}>Annulé</option>
            </select>
            <button type="submit" class="btn-primary" style="font-size:0.82rem;">Mettre à jour</button>
        </form>
    </div>

    {{-- Actions --}}
    <div style="display:flex;gap:12px;flex-wrap:wrap;">
        <a href="mailto:{{ $billet->email }}?subject=Votre réservation {{ $billet->reference }}" class="btn-primary">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
            Écrire au participant
        </a>
        <form action="{{ route('admin.billets.destroy', $billet) }}" method="POST"
              onsubmit="return confirm('Supprimer cette réservation ?')" style="margin:0;">
            @csrf @method('DELETE')
            <button type="submit" class="btn-outline" style="border-color:#e0703044;color:#e07030;">Supprimer</button>
        </form>
    </div>
</div>
@endsection
