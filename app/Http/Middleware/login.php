<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         // if(Auth::check()&&(Auth::user()->role_id==1||Auth::user()->role_id==2)){
        if(Auth::check()){
              return $next($request);
        }
        else
        {
            return redirect()->route('getlogin');
        }
    }
}
