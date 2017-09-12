<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    public function message()
    {
    	return $this->hasMany('App\Message','conversation_id','id');
    }
}
