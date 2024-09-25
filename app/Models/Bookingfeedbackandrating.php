<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookingfeedbackandrating extends Model
{
    use HasFactory;

    protected $primaryKey = 'feedback_id';

    protected $fillable = [
        'booking_id',
        'guest_id',
        'feedback',
        'rating',
        'late_checkout',
    ];

    // Relationship with Booking
    public function booking()
    {
        return $this->belongsTo(Bookings::class, 'booking_id');
    }

    // Relationship with Guest
    public function guest()
    {
        return $this->belongsTo(Guests::class, 'guest_id', 'guest_id');
    }
}
