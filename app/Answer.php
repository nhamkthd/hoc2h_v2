<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function user(){
    	return $this->belongsTo('App\User','user_id','id');
    }

    public function question() {
    	return $this->belongsTo('App\Question','question_id','id');
    }

    public function comments(){
    	return $this->hasMany('App\AnswerComment','answer_id','id');
    }
}
