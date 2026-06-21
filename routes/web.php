<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\BloodRequestController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin routes
    Route::middleware('role:admin')->group(function () {
        // Dashboard pages
        Route::get('/admin/inventory',          [DashboardController::class, 'inventory'])->name('admin.inventory');
        Route::get('/admin/testing',            [DashboardController::class, 'testing'])->name('admin.testing');
        Route::get('/admin/distribution',       [DashboardController::class, 'distribution'])->name('admin.distribution');
        Route::get('/admin/donor-registration', [DashboardController::class, 'donorRegistration'])->name('admin.donor-registration');
        Route::get('/admin/blood-collection',   [DashboardController::class, 'bloodCollection'])->name('admin.blood-collection');
        Route::get('/admin/temperature',        [DashboardController::class, 'temperature'])->name('admin.temperature');

        // Blood bag actions
        Route::post('/admin/blood-bags/{bloodBag}/reserve', [App\Http\Controllers\BloodBagActionController::class, 'reserve'])->name('admin.blood-bags.reserve');
        Route::post('/admin/blood-bags/{bloodBag}/discard', [App\Http\Controllers\BloodBagActionController::class, 'discard'])->name('admin.blood-bags.discard');
        Route::get('/admin/blood-bags/export',              [App\Http\Controllers\BloodBagActionController::class, 'export'])->name('admin.blood-bags.export');

        // Donor store
        Route::post('/admin/donors',            [App\Http\Controllers\AdminDonorController::class, 'store'])->name('admin.donors.store');

        // Distribution store
        Route::post('/admin/distribution',      [DashboardController::class, 'storeDispatch'])->name('admin.distribution.store');
    });

    // Hospital routes
    Route::middleware('role:hospital,admin')->group(function () {
        Route::resource('blood-requests', BloodRequestController::class);
    });

    // Donor routes
    Route::middleware('role:donor,admin')->group(function () {
        Route::resource('donations', DonationController::class);
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
