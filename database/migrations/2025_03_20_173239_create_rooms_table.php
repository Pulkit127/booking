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
            $table->id(); // Auto-increment primary key
            $table->string('room_number')->unique(); // Unique room number
            $table->integer('room_type'); // Room type (Deluxe, Standard, Suite, etc.)
            $table->text('description')->nullable(); // Room description
            $table->decimal('price_per_night', 10, 2); // Price per night
            $table->integer('capacity'); // Maximum guests allowed
            $table->string('bed_type')->nullable(); // Bed type (King, Queen, Twin)
            $table->enum('status', ['Available', 'Booked', 'Under Maintenance'])->default('Available'); // Room status
            $table->timestamps(); // Created_at & updated_at
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
