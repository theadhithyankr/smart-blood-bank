<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blood_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('patient_name');
            $table->enum('blood_group', ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-']);
            $table->enum('component_type', ['Whole Blood', 'Packed Red Blood Cells', 'Platelets', 'Fresh Frozen Plasma'])->default('Whole Blood');
            $table->integer('units_required')->default(1);
            $table->enum('urgency_level', ['Routine', 'Urgent', 'Emergency'])->default('Routine');
            $table->enum('status', ['Pending', 'Approved', 'Fulfilled', 'Rejected'])->default('Pending');
            $table->date('required_by_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_requests');
    }
};
