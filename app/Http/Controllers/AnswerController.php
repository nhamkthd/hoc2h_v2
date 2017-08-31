<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Answer;
use App\AnswerComment;
use App\AnswerVote;
use App\AnswerCommentVote;
use Auth;
use App\Question;
use App\QuestionFollower;
use App\notifications\AnswerQuestionNotification;
use App\Notifications\LikeComentQuestionNotification;
use App\Notifications\ReplyCommentQuestionNotification;
class AnswerController extends Controller
{
     //reset date time fomat
    public function setDateFomat($object){
       if($object->created_at->diffInDays(Carbon::now()) > 1){
            $object->date_created = $object->created_at->format('d/m/Y');    
        } else {
            $object->date_created = $object->created_at->diffForHumans();
        } 
    }
    public function getUserAnswers($user_id,$sort_id){
        switch ($sort_id) {
            case 1:
                $user_answers = Answer::where('user_id',$user_id)->orderby('votes_count','desc')->get();
                break;
            case 2:
                $user_answers = Answer::where('user_id',$user_id)->orderby('created_at','desc')->get();
                break;
            case 3:
                $user_answers = Answer::where('user_id',$user_id)->where('is_best',1)->orderby('votes_count','desc')->get();
                break;
            default:
                
                break;
        }
        foreach ($user_answers as $answer) {
          $answer->question;
        }
        return $user_answers;
    }

  //show answer with id_question
    public function apiGetAnswer(Request $req)
    {
       $answers=Answer::where('question_id',$req->question_id)->orderby('id','desc')->paginate(5);
       foreach ($answers as $answer) {
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
       return response()->json($answers);
    }
    public function store(Request $request)
    {
        if (Auth::check()) {
            $answer = new Answer;
            $answer->question_id = $request->question_id;
            $answer->user_id = Auth::user()->id;
            $answer->content = $request->content;
            $answer->votes_count = 0;
            $answer->save();

            $question = Question::find($request->question_id);
            // if (QuestionFollower::isFollowing(Auth::user()->id,$question->id) == false){
            //     QuestionFollower::create(['user_id' => Auth::user()->id,'question_id' => $question->id]);
            // }

            if(Auth::user()->id != $question->user->id)
            {
               // $followers = $question->followers;
               // foreach ($followers as $follower) {
                   $question->user->notify(new AnswerQuestionNotification($answer));
              // }
            }
            $question->answers_count++;
            $question->save();

            $answer->user;
            $answer->comments;
            $answer->comments_count = 0;
            $answer->isVoted = 0;
            return $answer;
        } else {
            return -1;
        }
    	
    }

    public function edit(Request $request) 
    {
        $answer = Answer::find($request->id);
        $answer->content  = $request->content;
        $answer->save();
        return $answer;     
    }

    public function delete(Request $request)
    {
        $answer = Answer::find($request->id);
        $answer->question->answers_count--;
        $answer->question->save();
        $answer->delete();
        return 1;
    }

    public function vote(Request $request) {
        if (Auth::check()) {
            $answer = Answer::find($request->answer_id);
           if ($request->isVoted == 0) {
                $answer_vote = new AnswerVote;
                $answer_vote->user_id = Auth::user()->id;
                $answer_vote->answer_id = $request->answer_id;
                $answer_vote->save();
                if (Auth::user()->id!=Answer::find($request->answer_id)->user->id) {
                       $answer->user->notify(new LikeComentQuestionNotification($answer->user_id));
                }
                $answer->votes_count++;
                $answer->save();
                return 1;
            } else if ($request->isVoted == 1) {
                $answer_vote = AnswerVote::where('answer_id',$request->answer_id);
                $answer_vote->delete();
                $answer->votes_count--;
                $answer->save();
                return 0;
            } 
        } else {
            return -1;
        }
    	
    }

    public function setBestAnswer(Request $request){
        $answer = Answer::find($request->answer_id);
        $answer->is_best = $request->is_best;
        $answer->save();

        return $answer->is_best;
    }

    public function addComment(Request $request){
        if (Auth::check()) {
        	$comment = new AnswerComment;
        	$comment->user_id = Auth::user()->id;
        	$comment->answer_id = $request->answer_id;
        	$comment->content = $request->content;
            $comment->votes_count = 0;
        	$comment->save();
            $answer=Answer::find($request->answer_id);
            if(Auth::user()->id!= $answer->user->id)
            {
                 $answer->user->notify(new ReplyCommentQuestionNotification($answer->question->id));
            }
            $comment->user;
            $comment->isVoted = 0;
        	return $comment;
        } else {
            return -1;
        }
    }

    public function voteCommment(Request $request){
        if (Auth::check()) {
            $comment = AnswerComment::find($request->comment_id);
            if ($request->isVoted == 0) {
                $comment_vote = new AnswerCommentVote;
                $comment_vote->user_id = Auth::user()->id;
                $comment_vote->answer_comment_id  = $request->comment_id;
                $comment_vote->save();
                if (Auth::user()->id!=$comment->user->id) {
                    $comment->user->notify(new ReplyCommentQuestionNotification($comment->answer->question->id));
                }
                $comment->votes_count++;
                $comment->save();
                return 1;
            } else if ($request->isVoted == 1) {
                $comment_vote = AnswerCommentVote::where('answer_comment_id',$request->comment_id);
                $comment_vote->delete();
                $comment->votes_count--;
                $comment->save();
                return 0;
            }
        } else {
            return -1;
        }
    	
    }

    public function editComment(Request $request)
    {
        $comment = AnswerComment::find($request->id);
        $comment->content = $request->content;
        $comment->save();
        return $comment;
    }
    
    public function deleteComment(Request $request)
    {
        $comment = AnswerComment::find($request->id);
        $comment->delete();
        return 1;
    }

    public function postNotifications() {
        
    }
}
