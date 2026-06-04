<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSetting;
use Illuminate\Http\Request;

class PaiementSettingAdminController extends Controller
{
    private const KEYS = [
        'paiement_mpesa_actif', 'paiement_mpesa_numero', 'paiement_mpesa_nom',
        'paiement_airtel_actif', 'paiement_airtel_numero', 'paiement_airtel_nom',
        'paiement_orange_actif', 'paiement_orange_numero', 'paiement_orange_nom',
        'paiement_especes_actif', 'paiement_especes_note',
    ];

    public function index()
    {
        $settings = [];
        foreach (self::KEYS as $key) {
            $settings[$key] = PageSetting::get($key, '');
        }

        return view('admin.paiement.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'paiement_mpesa_actif'    => ['nullable'],
            'paiement_mpesa_numero'   => ['nullable', 'string', 'max:30'],
            'paiement_mpesa_nom'      => ['nullable', 'string', 'max:80'],
            'paiement_airtel_actif'   => ['nullable'],
            'paiement_airtel_numero'  => ['nullable', 'string', 'max:30'],
            'paiement_airtel_nom'     => ['nullable', 'string', 'max:80'],
            'paiement_orange_actif'   => ['nullable'],
            'paiement_orange_numero'  => ['nullable', 'string', 'max:30'],
            'paiement_orange_nom'     => ['nullable', 'string', 'max:80'],
            'paiement_especes_actif'  => ['nullable'],
            'paiement_especes_note'   => ['nullable', 'string', 'max:200'],
        ]);

        foreach (self::KEYS as $key) {
            $val = $data[$key] ?? null;
            // Les champs _actif sont des checkboxes : présence = 1, absence = 0
            if (str_ends_with($key, '_actif')) {
                $val = $request->has($key) ? '1' : '0';
            }
            PageSetting::set($key, $val ?? '');
        }

        return back()->with('success', 'Paramètres de paiement enregistrés.');
    }
}
