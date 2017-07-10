<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserTest;
use App\MTest;
use Auth;
use App\UseMTestAnswer;
class UserTestController extends Controller
{
    public function store(Request $req)
    {
    	
    	$userTest = new UserTest;
    	$userTest->test_id = $req->test_id;
    	$userTest->user_id = Auth::user()->id;
        $userTest->save();
        $countIsCorrect=0;
    	foreach ($req->all() as $key => $value) {
    		if($key!='test_id' &&  $key!='_token')
    		{
                if(MTest::find($key)->where('incorrect_id',$value)->count())
                {
                    $countIsCorrect++;
                }

    			$UseMTestAnswer=new UseMTestAnswer;
    			$UseMTestAnswer->user_test_id=$userTest->id;
    			$UseMTestAnswer->mtest_id=$key;
    			$UseMTestAnswer->user_test_choiced=$value;
    			$UseMTestAnswer->save();
    		}
    	}
        $userTest->point=($countIsCorrect/$userTest->test->number_of_questions)*10;
        $userTest->save();
        return redirect('tests/usetest/result/'.$userTest->id.'/'.$countIsCorrect);
    }
     public function result($usertest_id, $countIsCorrect) {
        $userTest = UserTest::find($usertest_id);
        $user = $userTest->user;
        $test = $userTest->test;
        if ($test->test_type == 0) {
            $mtestAnswer = $userTest->mtestAnswer;
            return view('tests.test_result',compact('userTest','user','test','mtestAnswer','countIsCorrect'));
        }else {
            $userTestAnswers = UserWritingTestAnswer::where('user_test_id',$userTest->id)->get();
            $userTestAnswer = $userTestAnswers[0];
            return view('tests.test_result',compact('userTest','user','test','userTestAnswer'));
        }
    }

}
