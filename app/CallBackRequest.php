<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CallBackRequest extends Model
{
    protected $fillable =[
    	'name','phone','email','subject','status','message','is_callback'
    ];
}
