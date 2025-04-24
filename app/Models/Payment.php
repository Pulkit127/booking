<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'booking_id',
        'user_id',
        'amount',
        'method',
        'status',
        'transaction_id',
        'paid_at',
        'response',
    ];

    // ✅ Cast fields to correct data types
    protected $casts = [
        'paid_at' => 'datetime',
        'response' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
