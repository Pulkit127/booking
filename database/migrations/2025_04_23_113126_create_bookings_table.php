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
            $table->id();
            $table->string('guest_name');
            $table->string('email')->nullable();
            $table->string('phone_number');
            
            $table->unsignedBigInteger('room_id'); // foreign key to rooms table
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->tinyInteger('number_of_guests');
        
            $table->decimal('price_per_night', 8, 2);
            $table->decimal('total_price', 10, 2);
        
            $table->enum('payment_status', ['Pending', 'Paid', 'Failed'])->default('Pending');
            $table->enum('booking_status', ['Pending', 'Checked-in', 'Checked-out', 'Cancelled'])->default('Pending');
        
            $table->text('notes')->nullable();
        
            $table->timestamps();
        
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
