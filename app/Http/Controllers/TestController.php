<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\User;
use Auth;
use DB;
class TestController extends Controller
{
    public function index()
    {
        return view('tests.index');
    }
    public function getListTest(Request $req)
    {
        $test=[];
        switch ($req->filter) {
            case 'null':
                $test=Test::all();           
                break;
            case 'usercreate':
                $test=Test::where('user_id',Auth::user()->id)->get();
                break;
            default:
                # code...
                break;
        }
         foreach ($test as $tests) {
            $tests->user;
            $tests->category;
            $tests->user_test->count();
        }
        return response()->json($test);
    }

    public function show($id)
    {
        $test=Test::find($id);
        return view('tests.show',compact('test'));
    }

    public function getTest(Request $req)
    {
        $Test_arr=[];
        $test=Test::find($req->test_id);

        $Test_arr['test']=$test;
        $Test_arr['test_comment']=$test->comment;
        foreach ($Test_arr['test_comment'] as $index=>$cmt) {
           $Test_arr['test_comment'][$index]['user']=$cmt->user;
           $Test_arr['test_comment'][$index]['user_like']=$cmt->like->pluck('user_id');
        }
        $Test_arr['test_category']=$test->category;
        $Test_arr['rate_avg']=round($test->rate->avg('rate'));
        $user_rate=$test->rate->where('user_id',Auth::user()->id)->first();
        if($user_rate)
        {
            $Test_arr['user_rate']=$user_rate->rate;
        }
        else
        {
            $Test_arr['user_rate']=0;
        }

       return response()->json($Test_arr);
    }

    public function userTest(Request $req)
    {
       $is_time_count = $req->is_time_count;
        $test = Test::find($req->test_id);
        return view('tests.user_test',compact('test','is_time_count'));
    }
     public function search(Request $request){
        return response()->json(DB::table('tests')
                ->where('title', 'like', '%'.$request->keyword.'%')
                ->get());
    }

}
