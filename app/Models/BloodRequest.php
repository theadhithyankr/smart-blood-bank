<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodRequest extends Model
{
    protected $fillable = [
        'user_id',
        'patient_name',
        'blood_group',
        'component_type',
        'units_required',
        'urgency_level',
        'status',
        'required_by_date',
    ];

    protected $casts = [
        'required_by_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
