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
        Schema::create('bill', function (Blueprint $table) {
            $table->id('bill_id'); // Primary key
            $table->foreignId('booking_id')->references('booking_id')->on('bookings')->onDelete('cascade'); // Foreign key to bookings
            $table->decimal('room_charge', 10, 2); // Room charge
            $table->decimal('service_charge', 10, 2)->nullable(); // Service charge (nullable if no services)
            $table->decimal('misc_charge', 10, 2)->nullable(); // Miscellaneous charge (nullable)
            $table->boolean('late_checkout')->default(false); // Whether there's a late checkout fee
            $table->decimal('amount_due', 10, 2); // Total amount to be paid
            $table->decimal('amount_paid', 10, 2)->nullable(); // Amount already paid (nullable if not paid)
            $table->enum('status', ['pending', 'paid', 'overdue'])->default('pending'); // Bill status
            $table->date('due_date'); // Due date for the bill
            $table->date('payment_date')->nullable(); // Payment date (nullable until paid)
            $table->enum('mode', ['cash', 'card', 'online'])->nullable(); // Mode of payment (nullable)
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill');
    }
};
