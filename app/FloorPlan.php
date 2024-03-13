<?php

namespace App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class FloorPlan extends Model
{
    protected $fillable=[
    	'project_id','title','priority','image'
    ];

    protected $appends=['image_url'];

    public function getImageUrlAttribute()
    {
    	if($this->image){
    		return asset(Storage::url($this->image));
    	}
    	
    }
}
