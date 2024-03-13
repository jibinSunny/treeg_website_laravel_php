<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectSpecification_category extends Model
{
    protected $fillable = [
    	'title','project_id','content','priority'
    ];
}
