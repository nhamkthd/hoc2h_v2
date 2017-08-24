<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\User;
use App\UserTest;
use Auth;
use DB;
use Carbon\Carbon;
class TestController extends Controller
{
    public function setDateFomat($object){
       if($object->created_at->diffInDays(Carbon::now()) > 1){
            $object->date_created = $object->created_at->format('d/m/Y');    
        } else {
            $object->date_created = $object->created_at->diffForHumans();
        } 
    }
    public function index()
    {
        return view('tests.index',compact('test'));
    }
    public function getListTest(Request $req)
    {
        $test=[];
        switch ($req->filter) {
            case 'null':
                $test=Test::paginate(15);           
                break;
            case 'usercreate':
                $test=Test::where('user_id',Auth::user()->id)->paginate(15);
                break;
            case 'hot':
                $test=Test::paginate(15);
                break;
            case 'hotinweek':
                $test=Test::hotInWeek()->paginate(15);
                break;
            case 'Mytesting':
                $userTest=UserTest::where('user_id',Auth::user()->id)->groupBy('user_id','test_id')->select('user_id','test_id')->paginate(15);
                foreach ($userTest as $key => $value) {
                   $test[]=Test::find($value->test_id);
                }
                break;
            default:
                # code...
                break;
        }
         foreach ($test as $tests) {
            $this->setDateFomat($tests);
            $tests->user;
            $tests->category;
            $tests->user_test->count();
        }
        return response()->json($test);
    }

    public function show($id,$id_comment=null)
    {
        $test=Test::find($id);
        return view('tests.show',compact('test','id_comment'));
    }

    public function getTest(Request $req)
    {
        $test=Test::find($req->test_id);
        $test->category;
        $test->avg_rate=$test->rate->avg('rate');
        foreach ($test->comment as $comment) {
            $comment->user;
            $this->setDateFomat($comment);
            $comment->user_like=$comment->like->pluck('user_id');
        }
        return response()->json($test);
    }

    public function userTest(Request $req)
    {
       $is_time_count = $req->is_time_count;
        $test = Test::find($req->test_id);
        return view('tests.user_test',compact('test','is_time_count'));
    }
     public function search(Request $request){
        $test=Test::where('title', 'like', '%'.$request->keyword.'%')->get();
         foreach ($test as $tests) {
            $tests->user;
            $tests->category;
            $tests->user_test->count();
        }
        return response()->json($test);
    }

}
