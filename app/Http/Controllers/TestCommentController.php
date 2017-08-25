<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TestComment;
use App\Notifications\CommentTestNotification;
use Auth;
use Carbon\Carbon;
use App\Test;
class TestCommentController extends Controller
{
    public function setDateFomat($object){
       if($object->created_at->diffInDays(Carbon::now()) > 1){
            $object->date_created = $object->created_at->format('d/m/Y');    
        } else {
            $object->date_created = $object->created_at->diffForHumans();
        } 
    }
    public function getCommentTest($test_id)
    {
      $TestComment=TestComment::where('test_id',$test_id)->orderBy('id','DESC')->paginate(10);
       foreach ( $TestComment as $comment) {
            $comment->user;
            $this->setDateFomat($comment);
            $comment->user_like=$comment->like->pluck('user_id');
        }
        return $TestComment;
    }
      public function postCmt(Request $req)
    {
       $TestComment=new TestComment;
       $TestComment->test_id=$req->test_id;
       $TestComment->user_id=$req->user_id;
       $TestComment->content=$req->content;
       $TestComment->save();
       if(Auth::user()->id!=Test::find($req->test_id)->user->id)
        Test::find($req->test_id)->user->notify(new CommentTestNotification($TestComment));
       $this->setDateFomat($TestComment);
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
      $this->setDateFomat($TestComment);
    	return response()->json($TestComment);
    }
}
