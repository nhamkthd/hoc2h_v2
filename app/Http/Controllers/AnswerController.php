<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\AnswerComment;
use Auth;
class AnswerController extends Controller
{
    public function store(Request $request)
    {
    	$answer = new Answer;
    	$answer->question_id = $request->question_id;
    	$answer->user_id = Auth::user()->id;
    	$answer->content = $request->content;
    	$answer->save();
    	return $answer;
    }

    public function checkVote(Request $request) {
    	if (Auth::user()->answerVotes->where('answer_id',$request->answer_id)->count()) {
               return 1;
        }else {
        	return 0;
        }
    }
    public function commnets (Request $request){
    	$commnets = AnswerComment::where('answer_id',$request->answer_id)->get();
    	return $commnets;
    }
}
