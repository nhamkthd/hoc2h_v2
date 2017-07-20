<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['title','promissions_id','discription'];
    public function user(){
    	return $this->hasMany('App\User','role_id','id');
    }
    public function permissions(){
    	return $this->hasOne('App\Permissions','role_id','id');
    }
}
