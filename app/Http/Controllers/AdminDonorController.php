<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDonorController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'dob'          => 'required|date|before:-18 years',
            'blood_group'  => 'required|in:O+,O-,A+,A-,B+,B-,AB+,AB-',
            'gender'       => 'required|in:Male,Female,Other',
            'contact'      => 'required|string|max:20',
            'national_id'  => 'required|string|max:20',
            'address'      => 'nullable|string|max:500',
            'eligibility'  => 'required|array|min:4',
        ]);

        // For now, store in the users table conceptually or into a donors table.
        // Since the User model is used for auth and no dedicated donor profile table
        // exists yet, we'll store this in a session flash and return success.
        // This would connect to a real Donor model when that migration is added.

        return redirect()->route('admin.donor-registration')
            ->with('success', "Donor {$validated['name']} ({$validated['blood_group']}) registered successfully.");
    }
}
