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
            return $this->fakeSuccess($request, __('pages.contact.messages.fake_success'));
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
            'nom.required'     => __('pages.contact.messages.name_required'),
            'email.required'   => __('pages.contact.messages.email_required'),
            'email.email'      => __('pages.contact.messages.email_invalid'),
            'sujet.required'   => __('pages.contact.messages.subject_required'),
            'message.required' => __('pages.contact.messages.message_required'),
            'message.min'      => __('pages.contact.messages.message_min'),
        ]);

        // Exclure les champs de sécurité avant de persister
        $data = collect($validated)->only(['nom', 'email', 'telephone', 'sujet', 'message'])->toArray();

        Message::create($data);

        if ($request->expectsJson()) {
            return response()->json(['message' => __('pages.contact.messages.fake_success')]);
        }

        return back()->with('success', __('pages.contact.messages.sent'));
    }
}
