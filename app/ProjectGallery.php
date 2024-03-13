<?php

namespace App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class ProjectGallery extends Model
{
    protected $fillable = [
    	'project_id','priority','image'
    ];

    protected $appends=['image_url'];

    public function getImageUrlAttribute()
    {
        if($this->image){
            return asset(Storage::url($this->image));
        }
        
    }


}
