<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Question extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User','user_id','id');
    }

    public function answers(){
    	return $this->hasMany('App\Answer','question_id','id');
    }

    public function votes()
    {
    	return $this->hasMany('App\QuestionVote','question_id','id');
    }

    public function category() {
        return $this->belongsTo('App\Category','categories_id','id');
    }
}
