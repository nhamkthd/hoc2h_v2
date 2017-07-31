<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use App\User;
use DB;
class SocialAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();   
    }   

    public function callback()
    {
    	 $user = Socialite::driver('facebook')->user();
       	$us = DB::table('users')->where('provider_id', '=',$user->id )->get();
        if($us->count()==1)
        {
            $user=User::find($us->first()->id);
            Auth::login($user);
            return redirect('home');
        }
        else
        {
            $u=new User;
            $u->name=$user->name;
            $u->email=$user->id.'@email.com';
            $u->password=$user->token;
            $u->avatar=$user->avatar;
            $u->provider='facebook';
            $u->provider_id=$user->id;
            $u->save();
             Auth::login($u);
            return redirect('home');
        }
    }
}
