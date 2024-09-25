<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;

    protected $primaryKey = 'booking_id';

    protected $fillable = [
        'room_id',
        'guest_id',
        'check_in',
        'check_out',
        'number_of_adults',
        'number_of_children',
        'promo_code',
        'specialreq',
        'total_price',
    ];

    // Relationships
    public function room()
    {
        return $this->belongsTo(Rooms::class, 'room_id');
    }

    public function guest()
    {
        return $this->belongsTo(Guests::class, 'guest_id');
    }
}
