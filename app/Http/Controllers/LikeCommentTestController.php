<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LikeCommentTest;
use Auth;
use App\TestComment;
use App\Notifications\LikeCommentTestNotification;
class LikeCommentTestController extends Controller
{
    public function postLikeComment(Request $req)
    {
    	$LikeCommentTest=new LikeCommentTest;
    	$LikeCommentTest->comment_id=$req->comment_id;
    	$LikeCommentTest->user_id=Auth::user()->id;
    	$LikeCommentTest->save();
        $TestComment=TestComment::find($req->comment_id);
        if (Auth::user()->id!=$TestComment->user->id) {
            $TestComment->user->notify(new LikeCommentTestNotification($TestComment->test->id));
        }
        
    	return response()->json($LikeCommentTest);
    }

    public function postDislikeComment(Request $req)
    {
    	LikeCommentTest::find(LikeCommentTest::where(['comment_id'=>$req->comment_id,'user_id'=>Auth::user()->id])->first()->id)->delete();
    }
}
