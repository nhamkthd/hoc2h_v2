<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MTest extends Model
{
    public function mTestAnswer()
    {
    	return $this->hasmany('App\MTestAnswer','mtest_id','id');
    }

    public function correctAnswer()
    {
    	return  $this->belongsTo('App\MTestAnswer','incorrect_id','id');
    }


}
