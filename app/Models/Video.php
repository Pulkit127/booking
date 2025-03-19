<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['title', 'url', 'category_id'];   
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
