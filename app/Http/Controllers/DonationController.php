<?php

namespace App\Http\Controllers;

use App\Models\PageSetting;

class DonationController extends Controller
{
    public function index(string $locale)
    {
        $recentDonations = collect();
        $campaign = [
            'name' => PageSetting::get('donation.campaign_name', __('pages.donate.goal_title')),
            'goal' => (float) PageSetting::get('donation.goal', '30000'),
            'raised' => 0,
            'donors' => 0,
            'currency' => PageSetting::get('donation.currency', 'USD'),
            'status' => PageSetting::get('donation.status', 'draft'),
            'integration_status' => PageSetting::get('donation.integration_status', 'awaiting_docs'),
        ];

        return view('pages.donate', [
            'recentDonations' => $recentDonations,
            'campaign' => $campaign,
        ]);
    }
}
