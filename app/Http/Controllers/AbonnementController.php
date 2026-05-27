<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AbonnementController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'max:255'],
            'nom'   => ['nullable', 'string', 'max:100'],
            'type'  => ['required', 'in:newsletter,blog'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $existing = Abonnement::where('email', $request->email)
            ->where('type', $request->type)
            ->first();

        if ($existing) {
            if ($existing->unsubscribed_at) {
                $existing->update(['unsubscribed_at' => null, 'nom' => $request->nom]);
                return response()->json([
                    'success' => true,
                    'message' => 'Votre abonnement a été réactivé avec succès.',
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Cette adresse e-mail est déjà abonnée.',
            ], 409);
        }

        Abonnement::create([
            'email' => $request->email,
            'nom'   => $request->nom,
            'type'  => $request->type,
        ]);

        $label = $request->type === 'blog' ? 'aux articles du blog' : 'à notre newsletter';

        return response()->json([
            'success' => true,
            'message' => "Merci ! Vous êtes désormais abonné(e) {$label}.",
        ]);
    }

    public function unsubscribe(string $token)
    {
        $abonnement = Abonnement::where('token', $token)->first();

        if (! $abonnement) {
            abort(404);
        }

        $alreadyUnsubscribed = ! is_null($abonnement->unsubscribed_at);

        if (! $alreadyUnsubscribed) {
            $abonnement->update(['unsubscribed_at' => now()]);
        }

        return view('pages.desinscription', compact('abonnement', 'alreadyUnsubscribed'));
    }
}
