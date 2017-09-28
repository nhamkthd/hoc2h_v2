<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Question extends Model
{
    protected $table = 'questions';
    
    public function user() {
    	return $this->belongsTo('App\User','user_id');
    }

    public function answers(){
        return $this->hasMany('App\Answer')->orderby('is_best','desc')->orderby('id','desc');
    }

    public function votes(){
    	return $this->hasMany('App\QuestionVote');
    }

    public function category() {
        return $this->belongsTo('App\Category','category_id');
    }

    public function followers() {
        return $this->hasMany('App\QuestionFollwer');
    }

    public static function questionsInWeek(){
        return static::where('created_at', '>=', \Carbon\Carbon::now()->subWeek())->orderby('votes_count','desc')->orderby('answers_count','desc')->orderby('views_count','desc');
    }

    public static function getTags($question_id){
         $listQuestionTags = QuestionTag::where('question_id',$question_id)->get();
         $listTags = array();
        foreach ($listQuestionTags as $questionTag) {
            $listTags[$questionTag->tag_id] = Tag::find($questionTag->tag_id);
        }
        return $listTags;
    }

    public static function questionsRelated($question_id){
        $first_question_tag = QuestionTag::where('question_id',$question_id)->first();
        $questionsRelated = QuestionTag::where('question_id','<>',$question_id)->where('tag_id',$first_question_tag->tag_id)->take(10)->get();
        foreach ($questionsRelated as $question_tag) {
            $question_tag->question;
        }
        return $questionsRelated;
    }

    public static function bestAnswer($question_id){
        $bestAnswer = Answer::where('question_id',$question_id)->where('is_best',1)->first();
        if ($bestAnswer) {
            return $bestAnswer;
        }else {
            return null;
        }
    }

}
