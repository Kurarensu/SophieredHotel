<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    protected $primaryKey = 'room_id';

    // Specify the fillable attributes for mass assignment
    protected $fillable = [
        'room_number',
        'room_type',
        'price_per_night',
        'status',
        'image',
    ];
}
