<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->user()->role;

        if ($role === 'admin') {
            return view('dashboard.admin');
        } elseif ($role === 'hospital') {
            return view('dashboard.hospital');
        }

        return view('dashboard.donor');
    }
}
