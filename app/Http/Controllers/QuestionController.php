<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use Auth;
use App\QuestionVote;
use Carbon\Carbon;
class QuestionController extends Controller
{
    public function index()
    {
    	return view('questions.index');
    }

    public function create()
    {
       return view('questions.directives.question_create');
    }

    public  function  showDetail($id){
        $question = Question::find($id);
        $votes_count = $question->votes->count();
        $answers_count = $question->answers->count();
        $isVoted = 0;
        if (Auth::user()->questionVotes->where('question_id',$question->id)->count()) {
                $isVoted = 1;
        }
        return view('questions.directives.question_detail',compact('question','votes_count','answers_count','isVoted'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
    	$question = new Question;
    	$question->categories_id = $request->category;
    	$question->user_id = Auth::user()->id;
    	$question->title = $request->title;
    	$question->content = $request->q_content;
    	$question->save();
    	return redirect('questions/question/'.$question->id);
    }

     public function apiGetAll()
    {
    	return Question::all();
    }

    public function vote(Request $request){
        if ($request->isVoted == 0) {
            $questionVote = new QuestionVote;
            $questionVote->user_id = Auth::user()->id;
            $questionVote->question_id = $request->question_id;
            $questionVote->save();
            return 1;
        } else if ($request->isVoted == 1) {
            $questionVote = QuestionVote::where('question_id',$request->question_id);
            $questionVote->delete();
            return 0;
        } 
    }
}
