<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use App\Rules\NotDisposableEmail;
use App\Traits\HoneypotProtection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AbonnementController extends Controller
{
    use HoneypotProtection;

    public function store(Request $request)
    {
        // ── Protection anti-bot (honeypot + délai) ──────────────────
        if ($this->isBot($request)) {
            return $this->fakeSuccess($request, __('common.newsletter.bot_fake_success'));
        }

        // ── Validation ──────────────────────────────────────────────
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email:rfc,dns',   // vérifie le format RFC + existence du domaine (MX/A)
                'max:255',
                new NotDisposableEmail(),
            ],
            'nom'  => ['nullable', 'string', 'max:100'],
            'type' => ['required', 'in:newsletter,blog'],
        ], [
            'email.required'  => __('common.newsletter.email_required'),
            'email.email'     => __('common.newsletter.email_invalid'),
            'email.max'       => __('common.newsletter.email_max'),
            'type.required'   => __('common.newsletter.type_required'),
            'type.in'         => __('common.newsletter.type_invalid'),
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        // ── Vérification doublon ─────────────────────────────────────
        $existing = Abonnement::where('email', $request->email)
            ->where('type', $request->type)
            ->first();

        if ($existing) {
            if ($existing->unsubscribed_at) {
                $existing->update(['unsubscribed_at' => null, 'nom' => $request->nom]);
                return response()->json([
                    'success' => true,
                    'message' => __('common.newsletter.reactivated'),
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => __('common.newsletter.already_subscribed'),
            ], 409);
        }

        // ── Création ─────────────────────────────────────────────────
        Abonnement::create([
            'email' => $request->email,
            'nom'   => $request->nom,
            'type'  => $request->type,
        ]);

        return response()->json([
            'success' => true,
            'message' => $request->type === 'blog'
                ? __('common.newsletter.subscribed_blog')
                : __('common.newsletter.subscribed_newsletter'),
        ]);
    }

    public function unsubscribe(string $locale, string $token)
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
