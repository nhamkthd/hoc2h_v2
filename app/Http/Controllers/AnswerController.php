<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\AnswerComment;
use App\AnswerVote;
use App\AnswerCommentVote;
use Auth;
class AnswerController extends Controller
{
    public function store(Request $request)
    {
    	$answer = new Answer;
    	$answer->question_id = $request->question_id;
    	$answer->user_id = Auth::user()->id;
    	$answer->content = $request->content;
    	$answer->save();
    	$answer->user;
    	$answer->comments;
    	return $answer;
    }

    public function vote(Request $request) {
    	if ($request->isVoted == 0) {
           	$answer_vote = new AnswerVote;
           	$answer_vote->user_id = Auth::user()->id;
           	$answer_vote->answer_id = $request->answer_id;
           	$answer_vote->save();
            return 1;
        } else if ($request->isVoted == 1) {
            $answer_vote = AnswerVote::where('answer_id',$request->answer_id);
            $answer_vote->delete();
            return 0;
        } 
    }
    public function addComment(Request $request){
    	$comment = new AnswerComment;
    	$comment->user_id = Auth::user()->id;
    	$comment->answer_id = $request->answer_id;
    	$comment->content = $request->content;
    	$comment->save();
    	return $comment;
    }

    public function voteCommment(Request $request){
    	if ($request->isVoted == 0) {
	    	$comment_vote = new AnswerCommentVote;
	    	$comment_vote->user_id = Auth::user()->id;
	    	$comment_vote->answer_comment_id  = $request->comment_id;
	    	return 1;
    	} else if ($request->isVoted == 1) {
    		$comment_vote = AnswerCommentVote::where('answer_comment_id',$request->comment_id);
    		$comment_vote->delete();
    		return 0;
    	}
    }
}
