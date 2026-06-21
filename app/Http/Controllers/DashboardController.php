<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->user()->role;

        if ($role === 'admin') {
            // Units in Stock
            $totalStock = \App\Models\BloodBag::where('status', 'In Storage')->count();
            
            // Stock by blood group for Distribution/Overview
            $stockByGroup = \App\Models\BloodBag::where('status', 'In Storage')
                ->selectRaw('blood_group, count(*) as total')
                ->groupBy('blood_group')
                ->get()
                ->pluck('total', 'blood_group');

            // PRBC Bags Expiring Soon
            $expiringSoon = \App\Models\BloodBag::where('status', 'In Storage')
                ->where('component_type', 'Packed Red Blood Cells')
                ->where('expiry_date', '<=', now()->addDays(14)->toDateString())
                ->orderBy('expiry_date', 'asc')
                ->take(5)
                ->get();

            // Total PRBC expiring count for KPI
            $expiringSoonCount = \App\Models\BloodBag::where('status', 'In Storage')
                ->where('component_type', 'Packed Red Blood Cells')
                ->where('expiry_date', '<=', now()->addDays(14)->toDateString())
                ->count();

            // Dummy data for remaining UI sections to match Bagmo exactly
            $refrigerators = 14;
            $activeRequestsCount = 8;
            $pendingRequestsCount = 2;

            return view('dashboard.admin', compact(
                'totalStock', 
                'stockByGroup', 
                'expiringSoon', 
                'expiringSoonCount',
                'refrigerators',
                'activeRequestsCount',
                'pendingRequestsCount'
            ));
        } elseif ($role === 'hospital') {
            return view('dashboard.hospital');
        }

        return view('dashboard.donor');
    }

    public function inventory(Request $request)
    {
        if ($request->user()->role !== 'admin') abort(403);

        $totalUnits = \App\Models\BloodBag::where('status', 'In Storage')->count();
        $expiringSoonTotal = \App\Models\BloodBag::where('status', 'In Storage')->where('expiry_date', '<=', now()->addDays(7))->count();
        
        $stockByGroup = \App\Models\BloodBag::where('status', 'In Storage')
            ->selectRaw('blood_group, count(*) as total')
            ->groupBy('blood_group')
            ->get()
            ->pluck('total', 'blood_group');

        return view('dashboard.inventory', compact('totalUnits', 'expiringSoonTotal', 'stockByGroup'));
    }

    public function testing(Request $request)
    {
        if ($request->user()->role !== 'admin') abort(403);
        
        // Dummy data for KPIs
        $testsCompleted = 142;
        $pendingTests = 14;
        $safeUnits = 138;

        return view('dashboard.testing', compact('testsCompleted', 'pendingTests', 'safeUnits'));
    }

    public function distribution(Request $request)
    {
        if ($request->user()->role !== 'admin') abort(403);

        // Dummy data for KPIs
        $issuedToday = 18;
        $pendingRequests = 6;
        $totalThisMonth = 342;

        return view('dashboard.distribution', compact('issuedToday', 'pendingRequests', 'totalThisMonth'));
    }
}
