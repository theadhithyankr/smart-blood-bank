<?php

namespace App\Http\Controllers;

use App\Models\BloodBag;
use Illuminate\Http\Request;

class BloodBagActionController extends Controller
{
    public function reserve(BloodBag $bloodBag)
    {
        if ($bloodBag->status !== 'In Storage') {
            return back()->with('error', "Bag {$bloodBag->bag_rfid} cannot be reserved (current status: {$bloodBag->status}).");
        }

        $bloodBag->update(['status' => 'Reserved']);

        return back()->with('success', "Bag {$bloodBag->bag_rfid} has been reserved.");
    }

    public function discard(BloodBag $bloodBag)
    {
        if (in_array($bloodBag->status, ['Dispatched', 'Discarded'])) {
            return back()->with('error', "Bag {$bloodBag->bag_rfid} cannot be discarded (current status: {$bloodBag->status}).");
        }

        $bloodBag->update(['status' => 'Discarded']);

        return back()->with('success', "Bag {$bloodBag->bag_rfid} has been discarded.");
    }

    public function export()
    {
        $bags = BloodBag::all();

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="blood_bags_export_' . now()->format('Y-m-d_H-i') . '.csv"',
        ];

        $callback = function () use ($bags) {
            $handle = fopen('php://output', 'w');

            // Header row
            fputcsv($handle, ['ID', 'RFID', 'Blood Group', 'Component', 'Status', 'Screened', 'Temperature (°C)', 'Temp Breached', 'Expiry Date']);

            foreach ($bags as $bag) {
                fputcsv($handle, [
                    $bag->id,
                    $bag->bag_rfid,
                    $bag->blood_group,
                    $bag->component_type,
                    $bag->status,
                    $bag->is_screened ? 'Yes' : 'No',
                    $bag->current_temperature_celsius,
                    $bag->temperature_breached ? 'Yes' : 'No',
                    $bag->expiry_date?->format('Y-m-d'),
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
