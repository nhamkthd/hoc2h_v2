<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TestComment;
use App\Notifications\CommentTestNotification;
use Auth;
use App\Test;
class TestCommentController extends Controller
{
      public function postCmt(Request $req)
    {
       $TestComment=new TestComment;
       $TestComment->test_id=$req->test_id;
       $TestComment->user_id=$req->user_id;
       $TestComment->content=$req->content;
       $TestComment->save();
       Test::find($req->test_id)->user->notify(new CommentTestNotification($req->all()));
       return response()->json($TestComment);
    }
    public function postDeleteCmt(Request $req)
    {
    	TestComment::find($req->cmt_id)->delete();
    	return 'true';
    }

    public function postEditComment(Request $req)
    {
    	$TestComment=TestComment::find($req->comment_id);
    	$TestComment->content=$req->content;
    	$TestComment->save();
    	return response()->json($TestComment);

    }
}
