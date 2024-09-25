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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id('room_id'); // Primary key
            $table->string('room_number'); // Room number (e.g., "101")
            $table->string('room_type'); // Type of room (e.g., "Single", "Double", "Suite")
            $table->decimal('price_per_night', 8, 2); // Price per night
            $table->enum('status', ['available', 'occupied', 'maintenance'])->default('available'); // Room status
            $table->string('image')->nullable(); // Image file path for the room
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
