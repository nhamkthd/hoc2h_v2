<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTest extends Model
{
    public function test()
    {
    	return $this->belongsTo('App\Test','test_id','id');
    }

    public function mtestAnswer()
    {
    	return $this->hasMany('App\UseMTestAnswer','user_test_id','id');
    }
}
