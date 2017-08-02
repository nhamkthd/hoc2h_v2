<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionTag extends Model
{
	public static function getQuestionsCountWithTag($tag_id){
		$questions = static::where('tag_id',$tag_id)->get();
		return $questions->count();
	}

	public function question (){
		return $this->belongsTo('App\Question','question_id','id');
	}
}
