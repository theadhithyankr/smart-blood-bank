<?php

namespace App\Http\Controllers;

use App\Models\BloodBag;
use Illuminate\Http\Request;

class BloodBagController extends Controller
{
    public function getAvailableStock()
    {
        $availableStock = BloodBag::where('status', 'In Storage')
            ->where('screening_status', 'Passed')
            ->where('temperature_breached', false)
            ->where('expiry_date', '>', now()->toDateString())
            ->orderBy('expiry_date', 'asc')
            ->get();

        return response()->json($availableStock);
    }

    public function updateSensorData(Request $request, $rfid)
    {
        $validated = $request->validate([
            'temperature' => 'required|numeric',
            'current_status' => 'required|string',
        ]);

        $bag = BloodBag::where('bag_rfid', $rfid)->firstOrFail();
        
        $temp = (float) $validated['temperature'];
        $bag->current_temperature_celsius = $temp;
        $bag->status = $validated['current_status'];

        if ($bag->component_type === 'Packed Red Blood Cells' && ($temp < 2.0 || $temp > 6.0)) {
            $bag->temperature_breached = true;
        } elseif ($bag->component_type === 'Platelets' && ($temp < 20.0 || $temp > 24.0)) {
            $bag->temperature_breached = true;
        }

        $bag->save();

        return response()->json([
            'message' => 'Sensor data updated successfully.',
            'alert_triggered' => (bool) $bag->temperature_breached
        ]);
    }

    public function dispatchBag($rfid)
    {
        $bag = BloodBag::where('bag_rfid', $rfid)->firstOrFail();

        // Safety rules validation
        if ($bag->screening_status !== 'Passed' || $bag->temperature_breached || $bag->expiry_date < now()->toDateString()) {
            return response()->json(['error' => '403 Forbidden: Bag cannot be issued due to safety rule violations.'], 403);
        }

        $bag->status = 'Issued';
        $bag->save();

        return response()->json(['message' => 'Bag dispatched successfully.']);
    }
}
