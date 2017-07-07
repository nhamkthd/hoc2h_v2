<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\User;
use Auth;
class TestController extends Controller
{
    public function index()
    {	
    	$Test=Test::all();
    	return view('tests.index',compact('Test'));
    }
    public function getUserCreateTest()
    {
    	$Test=Test::where('user_id',Auth::user()->id)->get();
    	return view('tests.usercreate',compact('Test'));
    }

    public function show($id)
    {
        $test=Test::find($id);
        return view('tests.show',compact('test'));
    }

  	
}
