<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserTest;
use App\MTest;
use App\Test;
use App\User;
use Auth;
use Carbon\Carbon;
use App\UseMTestAnswer;
use Illuminate\Pagination;
class UserTestController extends Controller
{
     //reset date time fomat
    public function setDateFomat($object){
       if($object->created_at->diffInDays(Carbon::now()) > 1){
            $object->date_created = $object->created_at->format('d/m/Y');    
        } else {
            $object->date_created = $object->created_at->diffForHumans();
        } 
    }
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
                if(MTest::find($key)->incorrect_id == $value)
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
        $mtestAnswers = $userTest->mtestAnswers;
        return view('tests.test_result',compact('userTest','user','test','mtestAnswers','countIsCorrect'));
    }
    public function getMyTests($user_id,$tab)
    {
        switch ($tab) {
            case '1':
               $test_ids=User::find($user_id)->user_test->pluck('id')->all();
               $test=Test::whereIn('id',$test_ids)->orderBy('id','desc')->paginate(15);
               foreach ($test as $tests) {
                   $tests->user_test;
                   $tests->maxpoint=$tests->user_test->pluck('point')->max();
                   $tests->category;
                   $this->setDateFomat($tests);
               }
                break;
            
            default:
                # code...
                break;
        }
        return response()->json($test);
    }

}
