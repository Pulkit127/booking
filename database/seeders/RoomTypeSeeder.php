<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RoomType;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoomType::insert([
            ['name' => 'Standard', 'description' => 'Basic room with essential amenities', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Deluxe', 'description' => 'Spacious room with extra facilities', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Suite', 'description' => 'Luxury room with premium services', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
