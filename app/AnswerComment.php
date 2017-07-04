<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerComment extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User','user_id','id');
    }

    public function votes() {
    	return $this->hasMany('App\AnswerCommentVote','answer_comment_id','id');
    }
}
