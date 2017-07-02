<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\AnswerComment;
class AnswerController extends Controller
{
    public function index(Request $request)
    {
    	$answers = Answer::where('question_id',$request->question_id)->get();
    	return $answers;
    }

    public function commnets (Request $request){
    	$commnets = AnswerComment::where('answer_id',$request->answer_id)->get();
    	return $commnets;
    }
}
