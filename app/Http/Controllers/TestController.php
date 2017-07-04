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
    	return view('tests.index');
    }

  	
}
