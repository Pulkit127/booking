<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['title', 'url', 'category_id'];   
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
