<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LikeCommentTest;
use Auth;
class LikeCommentTestController extends Controller
{
    public function postLikeComment(Request $req)
    {
    	$LikeCommentTest=new LikeCommentTest;
    	$LikeCommentTest->comment_id=$req->comment_id;
    	$LikeCommentTest->user_id=Auth::user()->id;
    	$LikeCommentTest->save();
    	return response()->json($LikeCommentTest);
    }

    public function postDislikeComment(Request $req)
    {
    	LikeCommentTest::find(LikeCommentTest::where(['comment_id'=>$req->comment_id,'user_id'=>Auth::user()->id])->first()->id)->delete();
    }
}
