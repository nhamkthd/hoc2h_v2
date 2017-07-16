<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use Auth;
use App\QuestionVote;
use Carbon\Carbon;
use App\QuestionTag;
use App\Notifications\LikeQuestionNotification;
use App\Category;
use App\Tag;
class QuestionController extends Controller
{
    public function index()
    {
    	return view('questions.index');
    }
    public function getAll () {

        $questions =  Question::orderby('id','desc')->get();
        $quetionTags = array();
        foreach ($questions as $question) {
            $question->user;
            $question->answers;
            $question->votes;
            $questionTags[$question->id] = Question::getTags($question->id);
        }
        return response()->json(array('questions'=>$questions,'questionTags'=>$questionTags));
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
    	$question->content = $request->content;
    	$question->save();
        foreach ($request->tags as $key => $tag_id) {
            $questionTag = new QuestionTag;
            $questionTag->question_id = $question->id;
            $questionTag->tag_id = $tag_id;
            $questionTag->save();
        }
        return $question;
    }

    public function edit(Request $request)
    {
        $question = Question::find($request->id);
        $question->title  = $request->title;
        $question->content = $request->content;
        $question->save();
        return $question;
    }

    public function changeResolve(Request $request)
    {
        $question = Question::find($request->question_id);
        $question->is_resolved = $request->param;
        $question->save();
        return $question;
    }

    public function editCategory(Request $request)
    {
        $question = Question::find($request->id);
        $question->categories_id = $request->category;
        $question->save();
        $question->category;
        return $question;
    }

    public function delete(Request $request)
    {
        $question = Question::find($request->question_id);
        $question->delete();
        return redirect('questions/');
    }

    public function apiQuestionWithID(Request $request){
        $question = Question::find($request->id);
        $categories = Category::all();
        $question->votes;
        $question->user;
        $question->category;
        $tags = Question::getTags($question->id);
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

        return response()->json(array('question'=>$question,'isVoted'=>$isVoted,'answers'=>$answers,'categories'=>$categories,'tagsList'=>$tags));
    }

    public function vote(Request $request){
        if ($request->isVoted == 0) {
            $questionVote = new QuestionVote;
            $questionVote->user_id = Auth::user()->id;
            $questionVote->question_id = $request->question_id;
            $questionVote->save();
            QuesTion::find($request->question_id)->user->notify(new LikeQuestionNotification($request->question_id));
            return 1;
        } else if ($request->isVoted == 1) {
            $questionVote = QuestionVote::where('question_id',$request->question_id);
            $questionVote->delete();
            return 0;
        } 
    }
}
