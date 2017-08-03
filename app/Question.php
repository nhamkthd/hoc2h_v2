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
        return $this->belongsTo('App\Category','category_id','id');
    }

    public static function questionsInWeek(){
        return static::where('created_at', '>=', \Carbon\Carbon::now()->subWeek())->orderby('votes_count','desc')->orderby('answers_count','desc')->orderby('views_count','desc')->get();
    }

    public static function getTags($question_id){
         $listQuestionTags = QuestionTag::where('question_id',$question_id)->get();
         $listTags = array();
        foreach ($listQuestionTags as $questionTag) {
            $listTags[$questionTag->tag_id] = Tag::find($questionTag->tag_id);
        }
        return $listTags;
    }

}
