<?php

namespace App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class PhotoAlbum extends Model
{
    protected $fillable =[
    	'caption','image','thumb','parent_id','priority'
    ];

        protected $appends=['image_url','thumb_url'];
    public function getImageUrlAttribute()
    {
    	if($this->image){
    		return asset(Storage::url($this->image));
    	}
    }
    public function getThumbUrlAttribute()
    {
        if($this->thumb){
            return asset($this->thumb);
        }
    }
}
