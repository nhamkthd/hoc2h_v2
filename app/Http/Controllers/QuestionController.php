<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use App\Notifications\LikeQuestionNotification;
use Search;

use App\Question;
use App\QuestionVote;
use App\QuestionTag;
use App\Category;
use App\Tag;
use App\RequestAnswer;

class QuestionController extends Controller
{   
    //reset date time fomat
    public function setDateFomat($object){
       if($object->created_at->diffInDays(Carbon::now()) > 1){
            $object->date_created = $object->created_at->format('d/m/Y');    
        } else {
            $object->date_created = $object->created_at->diffForHumans();
        } 
    }

    //direct view with tab
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

    //get questions with tab(sort)
    public function apiGetAll (Request $request) {
        if ($request->filtertab) {
            switch ($request->filtertab) {
                case 1:
                    $questions =  Question::orderby('id','desc')->paginate(15);
                    break;
                case 2:
                    $questions =  Question::orderby('votes_count','desc')->orderby('answers_count','desc')->orderby('views_count','desc')->paginate(15);
                    break;
                case 3:
                    $questions = Question::questionsInWeek()->paginate(20);
                    break;
                case 4:
                    $questions = Question::where('user_id',Auth::user()->id)->orderby('id','desc')->paginate(15);
                    break;
                case 5:
                    $questions =  Question::orderby('id','desc')->paginate(15);
                    break;
                case 6:
                    $questions = Question::where('is_resolved',1)->orderby('id','desc')->paginate(15);
                    break;
                case 7:
                    $questions = Question::where('is_resolved',0)->orderby('id','desc')->paginate(15);
                    break;
                case 8:
                    $questions = Question::where('answers_count',0)->orderby('id','desc')->paginate(15);
                    break;
                default:
                    break;
            }
        }
        foreach ($questions as $question) {
           //$question->answers_count = $question->answers->count();
          //$question->save();
            $question->user;
            $question->user->role;
            $question->category;
            $question->author_isOnline = $question->user->isOnline();
            $question->tags =  Question::getTags($question->id);
            $this->setDateFomat($question);
        }
        return response()->json($questions);
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
    //get all questions with tag id
    public function apiGetQuestionsTagged($tag_id){
        $question_id = QuestionTag::where('tag_id',$tag_id)->pluck('question_id')->all();
        $question=Question::whereIn('id',$question_id)->orderby('id','desc')->paginate(15);
        foreach ($question as $questions) {
           //$question->answers_count = $question->answers->count();
          //$question->save();
            $questions->user;
            $questions->user->role;
            $questions->category;
            $questions->author_isOnline = $questions->user->isOnline();
            $questions->tags =  Question::getTags($questions->id);
            $this->setDateFomat($questions);
        }
        return response()->json($question);
    }

    //get user-questions
    public function apiGetUserQuestions($user_id,$sort_id){
        switch ($sort_id) {
            case 1:
                $user_questions  =  Question::where('user_id',$user_id)->orderby('votes_count','desc')
                                              ->orderby('answers_count','desc')
                                              ->orderby('views_count','desc')
                                              ->paginate(15);
                break;
            case 2:
                $user_questions  =  Question::where('user_id',$user_id)
                                            ->orderby('created_at','desc')
                                            ->paginate(15);
                break;
            case 3:
                $user_questions  =  Question::where('user_id',$user_id)
                                            ->where('is_resolved',1)
                                            ->orderby('created_at','desc')
                                            ->paginate(15);
                break;
        }
        foreach ($user_questions as $question) {
            $question->tags = Question::getTags($question->id);
            $this->setDateFomat($question);
        }
        return $user_questions;
    }

    //get questions user request answer

    public function apiGetUserRequestAnswer($user_id,$sort_id){
        switch ($sort_id) {
            case 1:
                $user_request_answers = RequestAnswer::where('user_id',$user_id)->orderby('donate_coins','desc')->paginate(15);
                break;
            case 2:
                 $user_request_answers = RequestAnswer::where('user_id',$user_id)->orderby('created_at','desc')->paginate(15);
                break;
            case 3:
                $user_request_answers = RequestAnswer::where('user_id',$user_id)->where('is_confirm',1)->orderby('created_at','desc')->paginate(15);
                break;
            default:
                # code...
                break;
        }

        foreach ($user_request_answers as $user_request_answer) {
            $user_request_answer->question;
        }

        return $user_request_answers;
    }

    //direct create question form
    public function create() {
        return view('questions.directives.question_create');  
    }

    //show detail 
    public  function  showDetail($id, $answer_id = null){
        $question = Question::find($id);
        if ($question) {
            $question->views_count ++;
            $question->save();
        }
        return view('questions.directives.question_detail',compact('question','answer_id'));
    }

    //full text search
    public function apiSearch(Request $request){
        $results = array();
        $questionTags = array();
        if ($request->keyword) {
            $results = Search::search(
                              "Question" ,
                              ['title' , 'content'] ,
                               $request->keyword,
                              ['id' , 'title', 'content','is_resolved','views_count','votes_count','answers_count','created_at'],
                              ['id'  , 'desc'] ,
                              true ,
                              30
                        );
        }
        return  $results;
    }

    //search question with title keyword
    public function apiSearchWithTitle(Request $request){
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

    //store new question
    public function apiStore(Request $request)
    {
        $question = new Question;
        $question->category_id = $request->category;
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

    //show question detail with ID
    public function apiQuestionWithID(Request $request){
        $question = Question::find($request->id);
        $this->setDateFomat($question);
        $question->user;
        $question->category;
        $question->haveBestAnswer = Question::haveBestAnswer($question->id);
        $tags = Question::getTags($question->id);
        $categories = Category::all();

        $answers = array();
        $comments = array();
        if ($question->answers_count > 0 && $question->answers_count <= 15) {
            foreach ($question->answers as $answer) {
                $this->setDateFomat($answer);
                $answer->user;
                $answer->comments_count = $answer->comments->count();
                if (Auth::check() && Auth::user()->answerVotes->where('answer_id',$answer->id)->count()) {
                    $answer->isVoted = 1;
                }else
                    $answer->isVoted = 0;

                if ($answer->comments->count()) {
                    foreach ($answer->comments as $comment) { 
                        $this->setDateFomat($comment);
                        $comment->user;
                        if (Auth::check() && Auth::user()->answerCommentVotes->where('answer_comment_id',$comment->id)->count()) 
                            $comment->isVoted = 1;
                        else
                            $comment->isVoted = 0;
                    }
                }
            }
        } else $question->answers;

        $isVoted = 0;
        if (Auth::check()) {
            if (Auth::user()->questionVotes->where('question_id',$question->id)->count()) {
                $isVoted = 1;
            }
        }
        $question->isVoted = $isVoted;
        $question->tagsList = $tags;
        return response()->json(array('question'=>$question,'categories'=>$categories));
    }

    //get questions related
    public function getQuestionsRelated($question_id){
        $related_questions = Question::questionsRelated($question_id);
        return $related_questions;
    }
  
    //edit question
    public function apiEdit(Request $request)
    {
        $question = Question::find($request->id);
        $question->title  = $request->title;
        $question->content = $request->content;
        $question->save();
        $this->setDateFomat($question);
        return $question;
    }

    //vote question
    public function apiVote(Request $request){
        if (Auth::check()) {
            $question = Question::find($request->question_id);
            if ($request->isVoted == 0) {
                $questionVote = new QuestionVote;
                $questionVote->user_id = Auth::user()->id;
                $questionVote->question_id = $request->question_id;
                $questionVote->save();
                $question->votes_count++;
                if (Auth::user()->id != $question->user->id) {
                    $question->user->notify(new LikeQuestionNotification($request->question_id));
                }
                $question->save();
                return 1;
            } else if ($request->isVoted == 1) {
                $questionVote = QuestionVote::where('question_id',$request->question_id);
                $questionVote->delete();
                $question->votes_count--;
                $question->save();
                return 0;
            } 
        }else {
            return -1;
        }
    }
    //change questiong resolve state
    public function apiChangeResolve(Request $request)
    {
        $question = Question::find($request->question_id);
        $question->is_resolved = $request->param;
        $question->save();
        return $request->param;
    }

    //change question category
    public function apiEditCategory(Request $request)
    {
        $question = Question::find($request->id);
        $question->category_id = $request->category;
        $question->save();
        $category = $question->category;
        return $category;
    }

    //add new tags for question
    public function apiAddTags(Request $request) {
        foreach ($request->tags as $key => $tag_id) {
            $questionTag = new QuestionTag;
            $questionTag->question_id = $request->question_id;
            $questionTag->tag_id = $tag_id;
            $questionTag->save();
        }
        $tags = Question::getTags($request->question_id);
        return $tags;
    }

    //request answer 
    public function requestAnswer(Request $request){
        $request_answer = new RequestAnswer;
        $request_answer->question_id = $request->question_id;
        $request_answer->requester_id = $request->requester_id;
        $request_answer->user_id = $request->user_id;
        $request_answer->donate_coins = $request->donate_coins;
        $request_answer->save();
        return $request_answer;
    }

    //delete question
    public function apiDelete(Request $request)
    {
        $question = Question::find($request->id);
        $question->delete();
        return 1;
    }
}
