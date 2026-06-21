<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'user_id',
        'donation_date',
        'blood_group',
        'volume_ml',
        'status',
        'health_check_status',
        'rejection_reason',
    ];

    protected $casts = [
        'donation_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
