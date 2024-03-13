<?php

namespace App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable=[
    	'name','designation','image','description','priority'
    ];

    protected $appends=['image_url'];

    public function getImageUrlAttribute()
    {
    	if($this->image){
    		return asset(Storage::url($this->image));
    	}
    	
    }
}
