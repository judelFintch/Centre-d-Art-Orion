<?php

namespace App\Http\Controllers;

class DonationController extends Controller
{
    public function index(string $locale)
    {
        // Données de démonstration en attendant l'API de paiement / la table des dons réels.
        $recentDonations = collect([
            ['name' => 'Marie K.',      'anonymous' => false, 'amount' => 50,  'minutesAgo' => 3],
            ['name' => 'Jean-Paul M.',  'anonymous' => false, 'amount' => 100, 'minutesAgo' => 18],
            ['name' => null,            'anonymous' => true,  'amount' => 25,  'minutesAgo' => 42],
            ['name' => 'Sylvie N.',     'anonymous' => false, 'amount' => 75,  'minutesAgo' => 65],
            ['name' => 'David T.',      'anonymous' => false, 'amount' => 200, 'minutesAgo' => 130],
            ['name' => 'Grace L.',      'anonymous' => false, 'amount' => 30,  'minutesAgo' => 240],
        ])->map(function (array $donation) {
            $donation['time'] = now()->subMinutes($donation['minutesAgo'])->diffForHumans();

            return $donation;
        });

        // Objectif de campagne factice — à remplacer par de vraies données une fois l'API branchée.
        $campaign = [
            'goal' => 30000,
            'raised' => 18400,
            'donors' => 214,
        ];

        return view('pages.donate', [
            'recentDonations' => $recentDonations,
            'campaign' => $campaign,
        ]);
    }
}
