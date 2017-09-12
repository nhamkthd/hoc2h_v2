<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Conversation;
use App\Message;
use Auth;
use Illuminate\Http\Response;
use Cookie;
class MessageController extends Controller
{
     //reset date time fomat
    public function setDateFomat($object){
       if($object->created_at->diffInDays(Carbon::now()) > 1){
            $object->date_created = $object->created_at->format('d/m/Y');    
        } else {
            $object->date_created = $object->created_at->diffForHumans();
        } 
    }
    public function create(Request $req)
    {
        $message=new Message;
        $message->conversation_id=$req->conversation;
        $message->user_id=Auth::user()->id;
        $message->message=$req->message;
        $message->save();
        $this->setDateFomat($message);
        $message->user;
        return response()->json($message);

    }
    public function getconversation($id_user)
    {
        $Conversation=Conversation::where(['from_user_id'=>Auth::user()->id,'to_user_id'=>$id_user])->orwhere(['to_user_id'=>Auth::user()->id,'from_user_id'=>$id_user])->first();
            foreach ($Conversation->message as $messages) {
                $this->setDateFomat($messages);
                $messages->user;
            }
        return response()->json($Conversation);
    }
    public function getMessage($id_user)
    {
    	$cvs=Conversation::where(['from_user_id'=>Auth::user()->id,'to_user_id'=>$id_user])->first();
    	if(count($cvs))
    	{
    		$message=Conversation::find($cvs->id)->message;
    	}
    	else
    	{
    		
    	}
        foreach ($message as $messages) {
            $this->setDateFomat($messages);
             $messages->user;
        }
    	return response()->json($message);
    }
}
