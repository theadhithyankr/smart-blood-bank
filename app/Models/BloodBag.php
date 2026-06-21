<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodBag extends Model
{
    use HasFactory;

    protected $fillable = [
        'bag_rfid',
        'blood_group',
        'component_type',
        'is_screened',
        'screening_status',
        'current_temperature_celsius',
        'temperature_breached',
        'expiry_date',
        'status',
    ];

    protected $casts = [
        'is_screened' => 'boolean',
        'temperature_breached' => 'boolean',
        'expiry_date' => 'date',
    ];
}
