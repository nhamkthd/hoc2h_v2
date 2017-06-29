<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use Auth;
class QuestionController extends Controller
{
    public function index($id)
    {
    	$question = Question::find($id);
    	return view('questions.index',compact('question'));
    }


    public function create(Request $request)
    {
    	$question = new Question;
    	$question->category = $request->category;
    	$question->user_id = Auth::user()->id;
    	$question->title = $request->title;
    	$question->content = $request->content;
    	$question->save();
    	// return redirect('')
    }

     public function apiGetAll()
    {
    	return Question::all();
    }
}
