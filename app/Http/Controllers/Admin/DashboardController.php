<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use App\Models\Evenement;
use App\Models\Message;
use App\Models\GalerieItem;
use App\Models\EquipeMembre;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'formations'  => Formation::count(),
            'evenements'  => Evenement::count(),
            'galerie'     => GalerieItem::count(),
            'membres'     => EquipeMembre::count(),
            'messages'    => Message::count(),
            'non_lus'     => Message::nonLu()->count(),
        ];

        $derniers_messages = Message::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'derniers_messages'));
    }
}
