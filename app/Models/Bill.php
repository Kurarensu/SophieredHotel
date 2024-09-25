<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $primaryKey = 'bill_id';

    protected $fillable = [
        'booking_id',
        'room_charge',
        'service_charge',
        'misc_charge',
        'late_checkout',
        'amount_due',
        'amount_paid',
        'status',
        'due_date',
        'payment_date',
        'mode',
    ];

    // Relationship with Booking
    public function booking()
    {
        return $this->belongsTo(Bookings::class, 'booking_id');
    }

    // Mutator to calculate the amount_due based on room, service, and misc charges
    public function calculateAmountDue()
    {
        $this->amount_due = $this->room_charge + $this->service_charge + $this->misc_charge;
    }
}
