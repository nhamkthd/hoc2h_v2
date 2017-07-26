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
use Search;
class QuestionController extends Controller
{
    public function question_sort($questions){
        $sort = array();
        foreach($questions as $k=>$v) {
            $sort['votes_count'][$k] = $v['votes_count'];
            $sort['answers_count'][$k] = $v['answers_count'];
            $sort['view_count'][$k] = $v['view_count'];
        }
        return $sort;
    }
    public function setDateFomat($question){
       if($question->created_at->diffInWeeks(Carbon::now()) > 1){
            $question->date_created = $question->created_at->format('d/m/Y');    
        } else {
            $question->date_created = $question->created_at->diffForHumans();
        } 
    }

    public function setMoreInfo($questions){
        foreach ($questions as $question) {
            $this->setDateFomat($question);
            $question->user;
            $question->answers_count = $question->answers->count();
            $question->votes_count = $question->votes->count();
            $question->tags =  Question::getTags($question->id);
        }
    }

    public function index(Request $request)
    {
        $tabSelected = 1;
        if ($request->filter) {
            $filter = $request->filter;
           switch ($filter) {
               case "hot":
                    $tabSelected = 2;
                   break;
               case "hotinweek":
                    $tabSelected = 3;
                   break;
                case "myquestions":
                    $tabSelected = 4;
                    break;
                case "following":
                    $tabSelected = 5;
                    break;
                case "resolved":
                    $tabSelected = 6;
                    break;
                case "notresolve":
                    $tabSelected = 7;
                    break;
                case "nothaveanswer":
                    $tabSelected = 8;
                    break;
                case "hotmembers":
                    $tabSelected = 9;
                    break;
               default:
                   $tabSelected = 0;
                   break;
           }
        }
    	return view('questions.index',compact('tabSelected'));
    }
    public function getAll (Request $request) {
        if ($request->filtertab) {
            switch ($request->filtertab) {
                case 1:
                    $questions =  Question::orderby('id','desc')->get();
                    $this->setMoreInfo($questions);
                    return $questions;
                case 2:
                    $questions =  Question::orderby('id','desc')->get();
                    $this->setMoreInfo($questions);
                    $questions_array = $questions->toArray();
                    $sort = $this->question_sort($questions_array);
                    array_multisort($sort['votes_count'], SORT_DESC, $sort['answers_count'], SORT_DESC,$sort['view_count'], SORT_DESC,$questions_array);
                   return $questions_array;
                case 3:
                    $questions =  Question::questionsInWeek();
                    $this->setMoreInfo($questions);
                    $questions_array = $questions->toArray();
                    $sort = $this->question_sort($questions_array);
                    array_multisort($sort['votes_count'], SORT_DESC, $sort['answers_count'], SORT_DESC,$sort['view_count'], SORT_DESC,$questions_array);
                    return $questions_array;
                case 4:
                    $questions = Question::where('user_id',Auth::user()->id)->orderby('id','desc')->get();
                    $this->setMoreInfo($questions);
                    return $questions;
                case 5:
                    $questions =  Question::orderby('id','desc')->get();
                    $this->setMoreInfo($questions);
                    return $questions;
                case 6:
                    $questions = Question::where('is_resolved',1)->orderby('id','desc')->get();
                    $this->setMoreInfo($questions);
                    return $questions;
                case 7:
                    $questions = Question::where('is_resolved',0)->orderby('id','desc')->get();
                    $this->setMoreInfo($questions);
                    return $questions;
                case 8:
                    $allQuestions = Question::orderby('id','desc')->get();
                    $index = 0;
                    foreach ($allQuestions  as $question) {
                       if ($question->answers->count() == 0) {
                          $questions[$index] = $question;
                          $index++;
                       }
                    }
                    $this->setMoreInfo($questions);
                    return $questions;
                default:
                    break;
            }
        }
    }

    public function indexWithTagged(Request $request){
        if ($request->id) {
            $tabSelected = 0;
            $questionTag = Tag::find($request->id);
            return view('questions.indexTagged',compact('tabSelected','questionTag'));
        }else {
            $tabSelected = 1;
            return view('questions.index',compact('tabSelected'));
        }
       
    }
    public function getQuestionsTagged($tag_id){
        $questions =  Question::listWithTagg($tag_id);
        $this->setMoreInfo($questions);
        $sort = $this->question_sort($questions);
        array_multisort($sort['votes_count'], SORT_DESC, $sort['answers_count'], SORT_DESC,$sort['view_count'], SORT_DESC,$questions);
        return $questions;
    }

    public function create()
    {
        return view('questions.directives.question_create');  
    }

    public  function  showDetail($id){
        $question = Question::find($id);
        if ($question) {
            $question->view_count ++;
            $question->save();
        }
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
        $this->setDateFomat($question);
        return $question;
    }

    public function changeResolve(Request $request)
    {
        $question = Question::find($request->question_id);
        $question->is_resolved = $request->param;
        $question->save();
        return $request->param;
    }

    public function editCategory(Request $request)
    {
        $question = Question::find($request->id);
        $question->categories_id = $request->category;
        $question->save();
        $category = $question->category;
        return $category;
    }

    public function addTags(Request $request) {
        foreach ($request->tags as $key => $tag_id) {
            $questionTag = new QuestionTag;
            $questionTag->question_id = $request->question_id;
            $questionTag->tag_id = $tag_id;
            $questionTag->save();
        }
        $tags = Question::getTags($request->question_id);
        return $tags;
    }

    public function delete(Request $request)
    {
        $question = Question::find($request->id);
        $question->delete();
        return 1;
    }

    public function search(Request $request){
        $results = array();
        $questionTags = array();
        if ($request->keyword) {
            $results = Search::search(
                              "Question" ,
                              ['title' , 'content'] ,
                               $request->keyword,
                              ['id' , 'title', 'content','is_resolved','view_count','created_at'],
                              ['id'  , 'desc'] ,
                              true ,
                              30
                        );
        }
        return  $results;
    }

    public function searchWithTitle(Request $request){
        $results = array();
        if ($request->keyword) {
            $results = Search::search(
                              "Question" ,
                              ['title'] ,
                               $request->keyword,
                              ['id' , 'title'],
                              ['id'  , 'desc'] ,
                              true ,
                              10
                        );
        }
        return  $results;
    }

    public function apiQuestionWithID(Request $request){
        $question = Question::find($request->id);
        $categories = Category::all();
        $this->setDateFomat($question);
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
                if (Auth::check() && Auth::user()->answerVotes->where('answer_id',$answer->id)->count()) {
                    $answerVoted[$answer->id] = 1;
                }else
                     $answerVoted[$answer->id] = 0;
               
               if ($answer->comments->count()) {
                   foreach ($answer->comments as $comment) {
                        $commentUsers[$comment->id] = $comment->user;
                        $commentVoteCount[$comment->id] = $comment->votes->count();
                        if (Auth::check() && Auth::user()->answerCommentVotes->where('answer_comment_id',$comment->id)->count()) {
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
        if (Auth::check()) {
            if (Auth::user()->questionVotes->where('question_id',$question->id)->count()) {
                $isVoted = 1;
            }
        }
        return response()->json(array('question'=>$question,'isVoted'=>$isVoted,'answers'=>$answers,'categories'=>$categories,'tagsList'=>$tags));
    }

    public function vote(Request $request){
        if (Auth::check()) {
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
        }else {
            return -1;
        }
    }
}
