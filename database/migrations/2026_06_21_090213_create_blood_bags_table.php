<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blood_bags', function (Blueprint $table) {
            $table->id();
            $table->string('bag_rfid')->unique();
            $table->enum('blood_group', ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-']);
            $table->enum('component_type', ['Whole Blood', 'Packed Red Blood Cells', 'Platelets', 'Fresh Frozen Plasma']);
            $table->boolean('is_screened')->default(false);
            $table->enum('screening_status', ['Pending', 'Passed', 'Failed'])->default('Pending');
            $table->float('current_temperature_celsius');
            $table->boolean('temperature_breached')->default(false);
            $table->date('expiry_date');
            $table->enum('status', ['In Storage', 'In Transit', 'Issued', 'Discarded'])->default('In Storage');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blood_bags');
    }
};
