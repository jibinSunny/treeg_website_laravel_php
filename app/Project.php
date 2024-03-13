<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
	use SoftDeletes;
    protected $fillable = [
    	'title','booking_image','show_booking_status_tab','category_id','description','image','logo','location','status','type','active','address','phone','latitude','longitude','priority','caption','slug','brochure'
    ];

    protected $appends = ['status_value','thumb_image','short_description'];

    public function Type()
    {
    	return $this->hasOne('App\ProjectType','id','type');
    }

    public function Spec()
    {
        return $this->hasMany('App\ProjectSpecification');
    }

    public function location()
    {
        return $this->belongsTo('App\Location','location','id');
    }

    public function Gallery()
    {
        return $this->hasMany('App\ProjectGallery');
    }

    public function Floorplan()
    {
        return $this->hasMany('App\FloorPlan');
    }
    public function keyInformation()
    {
        return $this->hasMany('App\KeyInformation');
    }

    // public function Location()
    // {
    //     return $this->hasMany('App\Location');
    // }

    public function getStatusValueAttribute()
    {
    	return ($this->status =='1') ? 'Ongoing Projects' : 'Completed Projects';
    }

    public function getThumbImageAttribute()
    {
        return asset('thumbs/'.basename($this->image));
    }
    public function getShortDescriptionAttribute()
    {
        return str_limit($this->description,153);
    }
}
