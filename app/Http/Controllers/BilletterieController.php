<?php

namespace App\Http\Controllers;

use App\Models\Billet;
use App\Models\BilletCategorie;
use App\Models\Evenement;
use App\Models\PageSetting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BilletterieController extends Controller
{
    public function index()
    {
        $evenements = Evenement::actif()
            ->where('statut', '!=', 'passe')
            ->orderBy('date_debut')
            ->get();

        return view('billetterie.index', compact('evenements'));
    }

    public function show(string $locale, Evenement $evenement)
    {
        abort_if(!$evenement->actif, 404);

        $categories      = $evenement->billetCategories()->actif()->get();
        $methodesActives = $this->methodesActives();
        $toutesMethodes  = $this->toutesLesMethodes();

        return view('billetterie.event', compact('evenement', 'categories', 'methodesActives', 'toutesMethodes'));
    }

    public function store(string $locale, Request $request, Evenement $evenement)
    {
        abort_if(!$evenement->actif || $evenement->statut === 'passe', 404);

        $hasCategories   = $evenement->billetCategories()->actif()->exists();
        $methodesActives = $this->methodesActives();

        $rules = [
            'nom'            => ['required', 'string', 'max:100'],
            'prenom'         => ['required', 'string', 'max:100'],
            'email'          => ['nullable', 'email', 'max:255'],
            'telephone'      => ['nullable', 'string', 'max:30'],
            'nombre_billets' => ['required', 'integer', 'min:1', 'max:20'],
            'notes'          => ['nullable', 'string', 'max:500'],
        ];

        if ($hasCategories) {
            $rules['billet_categorie_id'] = [
                'required',
                Rule::exists('billet_categories', 'id')
                    ->where('evenement_id', $evenement->id)
                    ->where('actif', true),
            ];
        }

        // Calcul du montant avant validation paiement
        $categorieObj = null;
        if ($hasCategories && $request->filled('billet_categorie_id')) {
            $categorieObj = BilletCategorie::find($request->billet_categorie_id);
        }
        $prix   = $categorieObj ? (float)$categorieObj->prix : ($evenement->gratuit ? 0 : (float)$evenement->prix);
        $montant = $prix * (int)$request->nombre_billets;

        // Paiement requis seulement si montant > 0
        if ($montant > 0 && !empty($methodesActives)) {
            $rules['methode_paiement'] = ['required', Rule::in(array_keys($methodesActives))];
            // Référence requise pour Mobile Money
            $rules['reference_paiement'] = [
                Rule::requiredIf(fn() => in_array($request->methode_paiement, ['mpesa', 'airtel', 'orange'])),
                'nullable', 'string', 'max:80',
            ];
            $rules['preuve_paiement'] = ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:3072'];
        }

        $data = $request->validate($rules);

        // Upload preuve
        $preuvePath = null;
        if ($request->hasFile('preuve_paiement')) {
            $preuvePath = $request->file('preuve_paiement')->store('preuves-paiement', 'public');
        }

        $billet = Billet::create([
            'evenement_id'        => $evenement->id,
            'billet_categorie_id' => $data['billet_categorie_id'] ?? null,
            'reference'           => Billet::genererReference(),
            'nom'                 => $data['nom'],
            'prenom'              => $data['prenom'],
            'email'               => $data['email'],
            'telephone'           => $data['telephone'] ?? null,
            'nombre_billets'      => $data['nombre_billets'],
            'montant_total'       => $montant,
            'statut'              => 'en_attente',
            'notes'               => $data['notes'] ?? null,
            'methode_paiement'    => $montant > 0 ? ($data['methode_paiement'] ?? null) : null,
            'reference_paiement'  => $data['reference_paiement'] ?? null,
            'preuve_paiement'     => $preuvePath,
            'paiement_verifie'    => false,
        ]);

        return redirect()->route('billetterie.confirmation', $billet->reference);
    }

    public function confirmation(string $locale, string $reference)
    {
        $billet          = Billet::with(['evenement', 'categorie'])->where('reference', $reference)->firstOrFail();
        $methodesActives = $this->methodesActives();

        return view('billetterie.confirmation', compact('billet', 'methodesActives'));
    }

    // ── Helpers ─────────────────────────────────────────────────────────────

    private function toutesLesMethodes(): array
    {
        $meta = Billet::METHODES;
        $map  = [
            'mpesa'   => ['numero' => 'paiement_mpesa_numero',  'nom' => 'paiement_mpesa_nom'],
            'airtel'  => ['numero' => 'paiement_airtel_numero', 'nom' => 'paiement_airtel_nom'],
            'orange'  => ['numero' => 'paiement_orange_numero', 'nom' => 'paiement_orange_nom'],
            'especes' => ['note'   => 'paiement_especes_note'],
        ];

        $toutes = [];
        foreach ($map as $key => $keys) {
            $actif = PageSetting::get('paiement_'.$key.'_actif', '0') === '1'
                  || ($key === 'especes' && PageSetting::get('paiement_especes_actif', '') === ''); // espèces actif par défaut
            $info  = array_map(fn($k) => PageSetting::get($k, ''), $keys);
            $toutes[$key] = array_merge($meta[$key], $info, ['actif' => $actif]);
        }

        return $toutes;
    }

    private function methodesActives(): array
    {
        $actives = [];
        $map = [
            'mpesa'   => ['numero' => 'paiement_mpesa_numero',  'nom' => 'paiement_mpesa_nom'],
            'airtel'  => ['numero' => 'paiement_airtel_numero', 'nom' => 'paiement_airtel_nom'],
            'orange'  => ['numero' => 'paiement_orange_numero', 'nom' => 'paiement_orange_nom'],
            'especes' => ['note'   => 'paiement_especes_note'],
        ];

        foreach ($map as $key => $keys) {
            if (PageSetting::get('paiement_'.$key.'_actif', '0') === '1') {
                $actives[$key] = array_map(fn($k) => PageSetting::get($k, ''), $keys);
            }
        }

        // Fallback si aucun paramètre configuré : espèces uniquement
        if (empty($actives)) {
            $actives = [
                'especes' => ['note' => 'Présentez votre référence à l\'entrée.'],
            ];
        }

        return $actives;
    }
}
