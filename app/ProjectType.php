<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{
	protected $table='project_type';
    protected $fillable = [
    	'name','description'
    ];
}
