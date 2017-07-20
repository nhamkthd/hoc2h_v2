<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\MessageBag;
use App\User;
use Auth;

class LoginController extends Controller
{
    public function index(){
    	if(Auth::guard('web')->check())
    	{
    		return redirect()->route('home');
    	}
    	return view('admin.business.login.login');
    }
    public function login(LoginRequest $request){
    	$auth = Auth::attempt(['user_name'=>$request->username,'password'=>$request->password,'status'=>1]);
    	if($auth){
    		return redirect()->route('homeadmin');
    	}
    	else{
    		$errors = new MessageBag(['errorslogin'=>'Tên đăng nhập hoặc mật khẩu không đúng']);
    		return redirect()->back()->withErrors($errors);
    	}
    }
    public function signout(){
    	Auth::guard('web')->logout();
    	return redirect()->route('getlogin');
    }
}
