<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BloodBagController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public read-only endpoint
Route::get('/blood-bank/available', [BloodBagController::class, 'getAvailableStock']);

// Secured write/action endpoints
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/blood-bank/sensor/{rfid}', [BloodBagController::class, 'updateSensorData']);
    Route::post('/blood-bank/dispatch/{rfid}', [BloodBagController::class, 'dispatchBag']);
});
