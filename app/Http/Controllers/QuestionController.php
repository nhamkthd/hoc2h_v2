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
        $questions = Question::all();
    	return view('questions.index',compact('questions'));
    }

    public function create()
    {
       return view('questions.directives.question_create');
    }

    public  function  showDetail($id){
        $question = Question::find($id);
        return view('questions.directives.question_detail',compact('question'));
    }

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

    public function edit(Request $request)
    {
        $question = Question::find($request->id);
        $question->title  = $request->title;
        $question->content = $request->content;
        $question->save();
        return $question;
    }

    public function delete(Request $request)
    {
        $question = Question::find($request->id);
        $question->delete();
        return 1;
    }

    public function apiQuestionWithID(Request $request){
        $question = Question::find($request->id);
        $question->votes;
        $question->user;
        $answer_comments = array();
        $answerUsers = array();
        $answerVoted = array();
        $answerVoteCount = array();
        $answerComments = array();
        $answerCommentCount = array();
        $commentUsers = array();
        $commentVoted = array();
        $commentVoteCount = array();
        if ($question->answers->count()) {
            
           foreach ($question->answers as $answer) {
                $answerUsers[$answer->id] = $answer->user;
                $answerVoteCount[$answer->id] = $answer->votes->count();
                $answerCommentCount[$answer->id] = $answer->comments->count();
                if (Auth::user()->answerVotes->where('answer_id',$answer->id)->count()) {
                    $answerVoted[$answer->id] = 1;
                }else
                     $answerVoted[$answer->id] = 0;
               
               if ($answer->comments->count()) {
                   foreach ($answer->comments as $comment) {
                        $commentUsers[$comment->id] = $comment->user;
                        $commentVoteCount[$comment->id] = $comment->votes->count();
                        if (Auth::user()->answerCommentVotes->where('answer_comment_id',$comment->id)->count()) {
                            $commentVoted[$comment->id] = 1;
                        }else
                             $commentVoted[$comment->id] = 0;
                    }
                }
                $comments = array('comments'=>$answer->comments,'users'=>$commentUsers,'voted'=>$commentVoted,'voteCount'=>$commentVoteCount);
                $answerComments[$answer->id] = $comments;
            }
        }  
        $answers = array('users'=>$answerUsers,'comments'=>$answerComments,'voted'=>$answerVoted,'voteCount'=>$answerVoteCount,'commentCount'=>$answerCommentCount);

        $isVoted = 0;
        if (Auth::user()->questionVotes->where('question_id',$question->id)->count()) {
                $isVoted = 1;
        }

        return response()->json(array('question'=>$question,'isVoted'=>$isVoted,'answers'=>$answers));
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
