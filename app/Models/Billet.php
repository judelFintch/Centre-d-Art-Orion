<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Billet extends Model
{
    protected $fillable = [
        'evenement_id', 'billet_categorie_id', 'reference', 'nom', 'prenom', 'email',
        'telephone', 'nombre_billets', 'montant_total', 'statut', 'notes',
        'methode_paiement', 'reference_paiement', 'preuve_paiement', 'paiement_verifie',
    ];

    protected $casts = [
        'montant_total'    => 'decimal:2',
        'nombre_billets'   => 'integer',
        'paiement_verifie' => 'boolean',
    ];

    // Libellés des méthodes de paiement
    const METHODES = [
        'mpesa'   => ['label' => 'M-Pesa (Vodacom)', 'couleur' => '#e2001a', 'bg' => 'rgba(226,0,26,0.08)',  'border' => 'rgba(226,0,26,0.25)'],
        'airtel'  => ['label' => 'Airtel Money',     'couleur' => '#ff0000', 'bg' => 'rgba(255,60,0,0.08)',  'border' => 'rgba(255,60,0,0.25)'],
        'orange'  => ['label' => 'Orange Money',     'couleur' => '#ff7900', 'bg' => 'rgba(255,121,0,0.08)', 'border' => 'rgba(255,121,0,0.25)'],
        'especes' => ['label' => 'Espèces sur place', 'couleur' => '#4caf7d', 'bg' => 'rgba(76,175,125,0.08)', 'border' => 'rgba(76,175,125,0.25)'],
    ];

    public function evenement()
    {
        return $this->belongsTo(Evenement::class);
    }

    public function categorie()
    {
        return $this->belongsTo(BilletCategorie::class, 'billet_categorie_id');
    }

    public static function genererReference(): string
    {
        do {
            $ref = 'ORN-' . strtoupper(Str::random(8));
        } while (static::where('reference', $ref)->exists());

        return $ref;
    }

    public function getLabelStatutAttribute(): string
    {
        return match ($this->statut) {
            'confirme' => 'Confirmé',
            'annule'   => 'Annulé',
            default    => 'En attente',
        };
    }

    public function getLabelMethodeAttribute(): string
    {
        return self::METHODES[$this->methode_paiement]['label'] ?? '—';
    }

    public function estGratuit(): bool
    {
        return (float) $this->montant_total === 0.0;
    }
}
