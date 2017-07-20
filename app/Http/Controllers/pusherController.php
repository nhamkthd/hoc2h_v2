<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Pusher\Pusher;
class pusherController extends Controller
{
    public function pusherAuth()
    {
    	$user = auth()->user();

    	if ($user) {
    		$pusher = new Pusher(config('broadcasting.connections.pusher.key'), config('broadcasting.connections.pusher.secret'), config('broadcasting.connections.pusher.app_id'));
    		echo $pusher->socket_auth(request()->input('channel_name'), request()->input('socket_id'));
    		return;
    	}else {
    		header('', true, 403);
    		echo "Forbidden";
    		return;
    	}
    }
}
