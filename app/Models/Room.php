<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;    

    protected $fillable = [
        'name',
        'room_number',
        'room_type',
        'description',
        'price_per_night',
        'capacity',
        'bed_type',
        'status',
    ];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type');
    }

    public function images()
    {
        return $this->hasMany(RoomImage::class);
    }
}
