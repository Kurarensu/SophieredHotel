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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id('feedback_id');  // Primary key
            $table->unsignedBigInteger('booking_id');  // Foreign key to bookings table
            $table->unsignedBigInteger('guest_id');    // Foreign key to guests table
            $table->text('feedback');
            $table->tinyInteger('rating')->unsigned(); // Rating between 1 and 5
            $table->boolean('late_checkout')->default(false);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('booking_id')->references('booking_id')->on('bookings')->onDelete('cascade');
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookingfeedbackandrating');
    }
};
