<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id('guest_id'); // Primary key
            $table->string('first_name'); // Guest's first name
            $table->string('last_name'); // Guest's last name
            $table->string('gender'); // Guest's gender
            $table->string('password'); // Guest's password
            $table->string('email')->unique(); // Guest's email, must be unique
            $table->string('phone_number'); // Guest's phone number
            $table->string('address')->nullable(); // Guest's address (optional)
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
