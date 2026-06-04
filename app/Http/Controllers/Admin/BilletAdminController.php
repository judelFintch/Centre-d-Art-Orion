<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Billet;
use App\Models\Evenement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BilletAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Billet::with(['evenement', 'categorie'])->latest();

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }
        if ($request->filled('evenement_id')) {
            $query->where('evenement_id', $request->evenement_id);
        }
        if ($request->filled('date_debut')) {
            $query->whereDate('created_at', '>=', $request->date_debut);
        }
        if ($request->filled('date_fin')) {
            $query->whereDate('created_at', '<=', $request->date_fin);
        }
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('nom', 'like', "%$s%")
                  ->orWhere('prenom', 'like', "%$s%")
                  ->orWhere('email', 'like', "%$s%")
                  ->orWhere('reference', 'like', "%$s%");
            });
        }

        $billets    = $query->paginate(25)->withQueryString();
        $evenements = Evenement::orderBy('date_debut', 'desc')->get(['id', 'titre', 'date_debut']);

        $stats = [
            'total'         => Billet::count(),
            'en_attente'    => Billet::where('statut', 'en_attente')->count(),
            'confirmes'     => Billet::where('statut', 'confirme')->count(),
            'annules'       => Billet::where('statut', 'annule')->count(),
            'total_billets' => (int) Billet::sum('nombre_billets'),
            'revenus'       => (float) Billet::where('statut', '!=', 'annule')->sum('montant_total'),
        ];

        $parEvenement = Billet::select(
                'evenement_id',
                DB::raw('COUNT(*) as nb_reservations'),
                DB::raw('SUM(nombre_billets) as nb_billets'),
                DB::raw('SUM(montant_total) as revenus')
            )
            ->with('evenement:id,titre,date_debut')
            ->groupBy('evenement_id')
            ->orderByDesc('nb_reservations')
            ->get();

        return view('admin.billets.index', compact('billets', 'stats', 'evenements', 'parEvenement'));
    }

    public function show(Billet $billet)
    {
        $billet->load(['evenement', 'categorie']);
        return view('admin.billets.show', compact('billet'));
    }

    public function updateStatut(Request $request, Billet $billet)
    {
        $request->validate(['statut' => ['required', 'in:en_attente,confirme,annule']]);
        $billet->update(['statut' => $request->statut]);

        return back()->with('success', 'Statut mis à jour.');
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'ids'    => ['required', 'array'],
            'ids.*'  => ['integer'],
            'statut' => ['required', 'in:en_attente,confirme,annule'],
        ]);

        $count = Billet::whereIn('id', $request->ids)->update(['statut' => $request->statut]);

        return back()->with('success', "{$count} réservation(s) mise(s) à jour.");
    }

    public function byEvent(Evenement $evenement)
    {
        $billets = Billet::with('evenement')
            ->where('evenement_id', $evenement->id)
            ->latest()
            ->paginate(50);

        $stats = [
            'total'         => Billet::where('evenement_id', $evenement->id)->count(),
            'en_attente'    => Billet::where('evenement_id', $evenement->id)->where('statut', 'en_attente')->count(),
            'confirmes'     => Billet::where('evenement_id', $evenement->id)->where('statut', 'confirme')->count(),
            'annules'       => Billet::where('evenement_id', $evenement->id)->where('statut', 'annule')->count(),
            'total_billets' => (int) Billet::where('evenement_id', $evenement->id)->sum('nombre_billets'),
            'revenus'       => (float) Billet::where('evenement_id', $evenement->id)->where('statut', '!=', 'annule')->sum('montant_total'),
        ];

        return view('admin.billets.by-event', compact('evenement', 'billets', 'stats'));
    }

    public function export(Request $request): StreamedResponse
    {
        $query = Billet::with(['evenement', 'categorie'])->latest();

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }
        if ($request->filled('evenement_id')) {
            $query->where('evenement_id', $request->evenement_id);
        }
        if ($request->filled('date_debut')) {
            $query->whereDate('created_at', '>=', $request->date_debut);
        }
        if ($request->filled('date_fin')) {
            $query->whereDate('created_at', '<=', $request->date_fin);
        }

        $billets = $query->get();

        return response()->streamDownload(function () use ($billets) {
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF"); // UTF-8 BOM for Excel

            fputcsv($handle, [
                'Référence', 'Prénom', 'Nom', 'Email', 'Téléphone',
                'Événement', 'Date événement', 'Nb billets', 'Montant total (FC)',
                'Statut', 'Date réservation', 'Notes',
            ], ';');

            foreach ($billets as $b) {
                fputcsv($handle, [
                    $b->reference,
                    $b->prenom,
                    $b->nom,
                    $b->email,
                    $b->telephone ?? '',
                    $b->evenement?->titre ?? '',
                    $b->evenement?->date_debut?->format('d/m/Y H:i') ?? '',
                    $b->nombre_billets,
                    $b->montant_total,
                    $b->label_statut,
                    $b->created_at->format('d/m/Y H:i'),
                    $b->notes ?? '',
                ], ';');
            }

            fclose($handle);
        }, 'reservations-' . now()->format('Y-m-d') . '.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function verifierPaiement(Billet $billet)
    {
        $billet->update(['paiement_verifie' => !$billet->paiement_verifie]);
        $msg = $billet->paiement_verifie ? 'Paiement marqué comme vérifié.' : 'Paiement marqué comme non vérifié.';
        return back()->with('success', $msg);
    }

    public function destroy(Billet $billet)
    {
        if ($billet->preuve_paiement) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($billet->preuve_paiement);
        }
        $billet->delete();
        return redirect()->route('admin.billets.index')->with('success', 'Réservation supprimée.');
    }
}
