<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->user()->role;

        if ($role === 'admin') {
            // Metrics for the Admin Dashboard
            $totalStock = \App\Models\BloodBag::where('status', 'In Storage')->count();
            
            // Stock by blood group
            $stockByGroup = \App\Models\BloodBag::where('status', 'In Storage')
                ->selectRaw('blood_group, count(*) as total')
                ->groupBy('blood_group')
                ->get()
                ->pluck('total', 'blood_group');

            $alerts = \App\Models\BloodBag::where('temperature_breached', true)
                ->where('status', '!=', 'Discarded')
                ->get();

            $expiringSoon = \App\Models\BloodBag::where('status', 'In Storage')
                ->where('expiry_date', '<=', now()->addDays(7)->toDateString())
                ->orderBy('expiry_date', 'asc')
                ->get();

            return view('dashboard.admin', compact('totalStock', 'stockByGroup', 'alerts', 'expiringSoon'));
        } elseif ($role === 'hospital') {
            return view('dashboard.hospital');
        }

        return view('dashboard.donor');
    }
}
