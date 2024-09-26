<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class Guests extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    // If 'guest_id' is not auto-incrementing, set incrementing to false
    public $incrementing = true; // Set to false if 'guest_id' is not auto-incrementing

    // If 'guest_id' is not an integer, set the correct type
    protected $keyType = 'int'; // Change to 'string' if necessary

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'password',
        'email',
        'phone_number',
        'address',
    ];

    // Mutator to hash the password when creating/updating a Guest
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
}
