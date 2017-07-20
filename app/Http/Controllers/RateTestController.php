<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RateTest;
use App\Test;
class RateTestController extends Controller
{
    public function postAddRate(Request $req)
    {
    	$temp=RateTest::where(['user_id'=>$req->user_id,'test_id'=>$req->test_id])->first();
    	if(!$temp)
    	{
    		$RateTest=new RateTest;
    		$RateTest->user_id=$req->user_id;
    		$RateTest->test_id=$req->test_id;
    		$RateTest->rate=$req->rate;
    		$RateTest->save();
    	}
    	else
    	{	
    		$RateTest=RateTest::find($temp->id);
    		$RateTest->rate=$req->rate;
    		$RateTest->save();
    	}
    	$avg=round(Test::find($req->test_id)->rate->avg('rate'));
    	return response()->json($avg);
    }
}
