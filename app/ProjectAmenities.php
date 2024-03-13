<?php

namespace App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class ProjectAmenities extends Model
{
    protected $fillable = [
    	'content','image','priority'
    ];

    protected $appends=['image_url'];

    public function getImageUrlAttribute()
    {
    	if($this->image){
            return asset(Storage::url($this->image));
        }
    }

}
