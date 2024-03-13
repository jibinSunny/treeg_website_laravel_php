<?php

namespace App;
// use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
class ProjectSpecification extends Model
{
    protected $fillable = [
    	'specification_category_id','content','priority','project_id'
    ];

    protected $appends=['image_url'];

    public function getImageUrlAttribute()
    {
    	if($this->image){
    		return asset(Storage::url($this->image));
    	}
    	
    }
}
