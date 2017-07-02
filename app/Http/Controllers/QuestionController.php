<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use Auth;
class QuestionController extends Controller
{
    public function index()
    {
    	return view('questions.index');
    }


    public function create(Request $request)
    {
    	$question = new Question;
    	$question->categories_id = $request->category_id;
    	$question->user_id = Auth::user()->id;
    	$question->title = $request->title;
    	$question->content = $request->content;
    	$question->save();
    	return $question;
    }

     public function apiGetAll()
    {
    	return Question::all();
    }
}
