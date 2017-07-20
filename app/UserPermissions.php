<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPermissions extends Model
{
    protected $table = "user_permissions";
	protected $fillable = ['role_id'];
	public function role(){
		return $this->hasOne('App\Role','permissions_id','id');
	}
}
