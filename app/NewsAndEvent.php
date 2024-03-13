<?php

namespace App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class NewsAndEvent extends Model
{
    protected $fillable=[
    	'title', 'description','image','thumb','user_id'
    ];

    protected $appends=['created_by','date','image_url','thumb_url','short_description'];

    public function getCreatedByAttribute()
    {
    	return \App\User::Find($this->user_id)->name;
    }
    public function getDateAttribute()
    {
    	return date('d M Y',strtotime($this->created_at));
    }

    public function Newsimage()
    {
    	return $this->hasMany('App\NewsImage','news_id');
    }

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
    public function getShortDescriptionAttribute()
    {
        return str_limit($this->description,153);
    }
}

