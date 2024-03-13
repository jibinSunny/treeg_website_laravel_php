<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeyInformation extends Model
{
    protected $fillable = [
    	'project_id','content','priority'
    ];

}
