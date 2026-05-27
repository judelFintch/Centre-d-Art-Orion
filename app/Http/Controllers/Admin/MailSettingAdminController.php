<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use App\Models\MailSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailSettingAdminController extends Controller
{
    public function index()
    {
        $setting = MailSetting::getOrCreate();

        return view('admin.mail.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'mailer'     => ['required', 'in:smtp,log,sendmail'],
            'from_name'  => ['required', 'string', 'max:120'],
            'from_email' => ['required', 'email', 'max:200'],
            'reply_to'   => ['nullable', 'email', 'max:200'],
            'host'       => ['nullable', 'string', 'max:200'],
            'port'       => ['nullable', 'integer', 'min:1', 'max:65535'],
            'username'   => ['nullable', 'string', 'max:200'],
            'password'   => ['nullable', 'string', 'max:500'],
            'encryption' => ['nullable', 'in:tls,ssl,'],
            'actif'      => ['nullable', 'boolean'],
        ]);

        $data['actif'] = $request->boolean('actif');

        $setting = MailSetting::getOrCreate();

        // Ne pas écraser le mot de passe si le champ est vide
        if (empty($data['password'])) {
            unset($data['password']);
        }

        $setting->update($data);

        return back()->with('success', 'Configuration mail enregistrée avec succès.');
    }

    public function test(Request $request)
    {
        $request->validate([
            'test_email' => ['required', 'email'],
        ]);

        try {
            Mail::to($request->test_email)->send(new TestMail());

            return back()->with('test_success', "E-mail de test envoyé à {$request->test_email}.");
        } catch (\Throwable $e) {
            return back()->with('test_error', 'Échec de l\'envoi : ' . $e->getMessage());
        }
    }
}
