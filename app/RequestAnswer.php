<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestAnswer extends Model
{
    public function question(){
    	return $this->belongsTo('App\Question','question_id','id');
    }
}
