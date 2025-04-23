<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
   protected $fillable = [
      'guest_name',
      'email',
      'phone_number',
      'room_id',
      'check_in_date',
      'check_out_date',
      'number_of_guests',
      'payment_status',
      'booking_status',
      'notes',
      'price_per_night',
      'total_price'
   ];

   public function room()
   {
      return $this->belongsTo(Room::class);
   }
}
