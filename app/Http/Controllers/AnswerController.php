<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\AnswerComment;
use App\AnswerVote;
use App\AnswerCommentVote;
use Auth;
use App\Question;
use App\notifications\AnswerQuestionNotification;
use App\Notifications\LikeComentQuestionNotification;
use App\Notifications\ReplyCommentQuestionNotification;
class AnswerController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::check()) {
            $answer = new Answer;
            $answer->question_id = $request->question_id;
            $answer->user_id = Auth::user()->id;
            $answer->content = $request->content;
            $answer->save();
            if(Auth::user()->id != Question::find($request->question_id)->user->id)
                Question::find($request->question_id)->user->notify(new AnswerQuestionNotification($request->all()));
            $answer->user;
            $answer->comments;
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
        Answer::find($request->id)->delete();
        return 1;
    }

    public function vote(Request $request) {
        if (Auth::check()) {
           if ($request->isVoted == 0) {
            $answer_vote = new AnswerVote;
            $answer_vote->user_id = Auth::user()->id;
            $answer_vote->answer_id = $request->answer_id;
            $answer_vote->save();
            $question=Answer::find($request->answer_id)->question;
                if (Auth::user()->id!=Answer::find($request->answer_id)->user->id) {
                   $question->user->notify(new LikeComentQuestionNotification($question->user_id));
                }
                
                return 1;
            } else if ($request->isVoted == 1) {
                $answer_vote = AnswerVote::where('answer_id',$request->answer_id);
                $answer_vote->delete();
                return 0;
            } 
        } else {
            return -1;
        }
    	
    }
    public function addComment(Request $request){
        if (Auth::check()) {
        	$comment = new AnswerComment;
        	$comment->user_id = Auth::user()->id;
        	$comment->answer_id = $request->answer_id;
        	$comment->content = $request->content;
        	$comment->save();
            $answer=Answer::find($request->answer_id);
            if(Auth::user()->id!= $answer->user->id)
            {
                 $answer->user->notify(new ReplyCommentQuestionNotification($answer->question->id));
            }
        	return $comment;
        } else {
            return -1;
        }
    }

    public function voteCommment(Request $request){
        if (Auth::check()) {
            if ($request->isVoted == 0) {
                $comment_vote = new AnswerCommentVote;
                $comment_vote->user_id = Auth::user()->id;
                $comment_vote->answer_comment_id  = $request->comment_id;
                $answer=AnswerComment::find($request->comment_id);
                if (Auth::user()->id!=$answer->user->id) {
                    $answer->user->notify(new ReplyCommentQuestionNotification($answer->answer->question->id));
                }
                return 1;
            } else if ($request->isVoted == 1) {
                $comment_vote = AnswerCommentVote::where('answer_comment_id',$request->comment_id);
                $comment_vote->delete();
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
        AnswerComment::find($request->id)->delete();
        return 1;
    }
}
