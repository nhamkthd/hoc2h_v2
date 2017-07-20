<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UseMTestAnswer extends Model
{
    public function mtest()
    {
    	return $this->belongsTo('App\MTest','mtest_id','id');
    }
}
