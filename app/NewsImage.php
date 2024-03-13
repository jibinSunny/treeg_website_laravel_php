<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class NewsImage extends Model
{
    protected $fillable = [
    	'news_id','image','thumb'
    ];

     protected $appends=['image_url'];

    public function getImageUrlAttribute()
    {
        if($this->image){
            return asset(Storage::url($this->image));
        }
        
    }
}
