<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\User;
class TestController extends Controller
{
    public function index()
    {	
    	return view('tests.index');
    }

    public function listUser()
    {
    	return User::all();
    }
}
