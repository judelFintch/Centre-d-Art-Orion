<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSetting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DonationAdminController extends Controller
{
    private const SHARED = [
        'donation.status', 'donation.integration_status', 'donation.currency',
        'donation.goal', 'donation.starts_at', 'donation.ends_at',
        'donation.methods.card', 'donation.methods.mpesa', 'donation.methods.airtel',
        'donation.methods.orange', 'donation.methods.mtn', 'donation.methods.afrimoney',
    ];

    public function index()
    {
        return view('admin.donations.index');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'campaign_name' => ['required', 'string', 'max:160'],
            'campaign_name_en' => ['nullable', 'string', 'max:160'],
            'status' => ['required', Rule::in(['draft', 'published', 'paused', 'ended'])],
            'integration_status' => ['required', Rule::in(['awaiting_docs', 'sandbox', 'ready'])],
            'currency' => ['required', Rule::in(['USD', 'CDF'])],
            'goal' => ['required', 'numeric', 'min:1'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'methods' => ['nullable', 'array'],
            'methods.*' => ['nullable', 'boolean'],
        ]);

        if ($data['status'] === 'published' && $data['integration_status'] !== 'ready') {
            return back()->withErrors([
                'status' => "La campagne ne peut pas être publiée avant la validation technique de l'intégration FlexPaie.",
            ])->withInput();
        }

        PageSetting::set('donation.campaign_name', [
            'fr' => $data['campaign_name'],
            'en' => $data['campaign_name_en'] ?: $data['campaign_name'],
        ]);

        $shared = [
            'donation.status' => $data['status'],
            'donation.integration_status' => $data['integration_status'],
            'donation.currency' => $data['currency'],
            'donation.goal' => (string) $data['goal'],
            'donation.starts_at' => $data['starts_at'] ?? '',
            'donation.ends_at' => $data['ends_at'] ?? '',
        ];

        foreach (['card', 'mpesa', 'airtel', 'orange', 'mtn', 'afrimoney'] as $method) {
            $shared["donation.methods.{$method}"] = $request->boolean("methods.{$method}") ? '1' : '0';
        }

        foreach ($shared as $key => $value) {
            PageSetting::set($key, ['fr' => $value, 'en' => $value]);
        }

        return back()->with('success', 'Configuration de la campagne enregistrée.');
    }
}
