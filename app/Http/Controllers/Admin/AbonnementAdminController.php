<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Abonnement;
use Illuminate\Http\Request;

class AbonnementAdminController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type', 'all');

        $query = Abonnement::latest();

        if (in_array($type, ['newsletter', 'blog'])) {
            $query->where('type', $type);
        }

        $abonnements = $query->paginate(30)->withQueryString();

        $counts = [
            'all'        => Abonnement::actifs()->count(),
            'newsletter' => Abonnement::actifs()->newsletter()->count(),
            'blog'       => Abonnement::actifs()->blog()->count(),
        ];

        return view('admin.abonnements.index', compact('abonnements', 'counts', 'type'));
    }

    public function destroy(Abonnement $abonnement)
    {
        $abonnement->delete();

        return back()->with('success', 'Abonné supprimé.');
    }
}
