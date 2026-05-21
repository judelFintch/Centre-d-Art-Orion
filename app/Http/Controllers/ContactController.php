<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom'       => 'required|string|max:100',
            'email'     => 'required|email|max:150',
            'telephone' => 'nullable|string|max:30',
            'sujet'     => 'required|string|max:200',
            'message'   => 'required|string|min:10|max:3000',
        ], [
            'nom.required'     => 'Votre nom est obligatoire.',
            'email.required'   => 'Votre adresse email est obligatoire.',
            'email.email'      => 'L\'adresse email n\'est pas valide.',
            'sujet.required'   => 'Le sujet est obligatoire.',
            'message.required' => 'Le message est obligatoire.',
            'message.min'      => 'Le message doit comporter au moins 10 caractères.',
        ]);

        Message::create($validated);

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Votre message a bien été envoyé. Nous vous répondrons dans les plus brefs délais.']);
        }

        return back()->with('success', 'Votre message a bien été envoyé !');
    }
}
