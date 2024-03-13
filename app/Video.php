<?php

namespace App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
		'caption','youtube_video_id','video_thumb'
    ];

    protected $appends=['image_url'];
    public function getImageUrlAttribute()
    {
    	if($this->video_thumb){
    		return asset($this->video_thumb);
    	}
    	
    }
}
