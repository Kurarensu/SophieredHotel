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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('booking_id'); // Primary key
            $table->foreignId('room_id')->references('id')->on('rooms')->onDelete('cascade'); // Foreign key to the rooms table
            $table->foreignId('guest_id')->references('id')->on('guests')->onDelete('cascade'); // Foreign key to the guests table
            $table->date('check_in'); // Check-in date
            $table->date('check_out'); // Check-out date
            $table->integer('number_of_adults'); // Number of adults
            $table->integer('number_of_children')->nullable(); // Number of children (nullable)
            $table->string('promo_code')->nullable(); // Promo code (nullable)
            $table->string('specialreq')->nullable(); // Special Req (nullable)
            $table->decimal('total_price', 8, 2); // Total price of the booking
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
