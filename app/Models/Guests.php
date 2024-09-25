<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Guests extends Model
{
    use HasFactory;

    protected $primaryKey = 'guest_id';

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
