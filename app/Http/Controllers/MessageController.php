<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Conversation;
use Auth;
class MessageController extends Controller
{
    public function getMessage($id_user)
    {
    	$message={};
    	$cvs=Conversation::where(['from_user_id'=>Auth::user()->id,'to_user_id'=>$id_user])->first();
    	if($cvs->count())
    	{
    		$message=$cvs->message;
    	}
    	else
    	{
    		Conversation::create([
    			'from_user_id'=>Auth::user()->id,
    			'to_user_id'=>$id_user
    			]);
    	}
    	return response()->json($message);
    }
}
