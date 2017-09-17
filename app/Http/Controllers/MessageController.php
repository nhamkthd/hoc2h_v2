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
use App\User;
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
    public function getConversationOpen(Request $req)
    {
        $Conversation=Conversation::whereIn('id',$req->conversation_id)->get();
        foreach ($Conversation as $Conv) {
           foreach ($Conv->message as $messages) {
                $this->setDateFomat($messages);
                $messages->user;
            }
            $Conv->users=User::find(($Conv->from_user_id==Auth::user()->id)?$Conv->to_user_id:$Conv->from_user_id);
        }
        return response()->json($Conversation);
    }
    public function listUserOnline()
    {
        return response()->json(User::all()->diffAssoc(Auth::user()));
    }
    public function getconversation($id_user)
    {
        $conversation1=Conversation::where(['to_user_id'=>Auth::user()->id,'from_user_id'=>$id_user])->first();
        $conversation2=Conversation::where(['from_user_id'=>Auth::user()->id,'to_user_id'=>$id_user])->first();
        if(count($conversation1)==1)
        {
            $Conversation=$conversation1;
        }
        else
        {
            $Conversation=$conversation2;
        }
        if(count($Conversation))
        {
            foreach ($Conversation->message as $messages) {
                $this->setDateFomat($messages);
                $messages->user;
            }
        }
        else
        {
            $conversation=new Conversation;
            $conversation->from_user_id=Auth::user()->id;
            $conversation->to_user_id=$id_user;
            $conversation->save();
            $conversation->message=[];
            return response()->json($conversation);
        }
         $Conversation->users=User::find($id_user);
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
