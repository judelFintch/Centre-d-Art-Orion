<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Rules\NotDisposableEmail;
use App\Traits\HoneypotProtection;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    use HoneypotProtection;

    public function index()
    {
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        // ── Protection anti-bot (honeypot + délai) ──────────────────
        if ($this->isBot($request)) {
            return $this->fakeSuccess($request, 'Votre message a bien été envoyé. Nous vous répondrons dans les plus brefs délais.');
        }

        // ── Validation ──────────────────────────────────────────────
        $validated = $request->validate([
            'nom'       => 'required|string|max:100',
            'email'     => [
                'required',
                'email:rfc,dns',   // vérifie format RFC + existence DNS du domaine
                'max:150',
                new NotDisposableEmail(),
            ],
            'telephone' => 'nullable|string|max:30',
            'sujet'     => 'required|string|max:200',
            'message'   => 'required|string|min:10|max:3000',
        ], [
            'nom.required'     => 'Votre nom est obligatoire.',
            'email.required'   => 'Votre adresse e-mail est obligatoire.',
            'email.email'      => 'L\'adresse e-mail n\'est pas valide (domaine inexistant ou incorrect).',
            'sujet.required'   => 'Le sujet est obligatoire.',
            'message.required' => 'Le message est obligatoire.',
            'message.min'      => 'Le message doit comporter au moins 10 caractères.',
        ]);

        // Exclure les champs de sécurité avant de persister
        $data = collect($validated)->only(['nom', 'email', 'telephone', 'sujet', 'message'])->toArray();

        Message::create($data);

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Votre message a bien été envoyé. Nous vous répondrons dans les plus brefs délais.']);
        }

        return back()->with('success', 'Votre message a bien été envoyé !');
    }
}
