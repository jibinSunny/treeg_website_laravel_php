<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    protected $table='permission_role';

    public function Permission()
    {
    	return $this->hasOne('App\Permission','id');
    }
    public function Role()
    {
    	return $this->hasOne('App\Role','id','role_id');
    }
}
