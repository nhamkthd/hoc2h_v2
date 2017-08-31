<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionFollower extends Model
{
   
   public static function isFollowing($user_id,$question_id) {
   		if (static::where('user_id',$user_id)->where('question_id',$question_id)->get()->count() > 0){
   			return true;
   		} else {
   			return false;
   		}
   }

   public function user(){
   		return $this->belongsTo('App\User','user_id','id');
   }

   public function question(){
   		return $this->belongsTo('App\Question','question_id','id');
   }
}
