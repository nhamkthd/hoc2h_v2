<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    public function message()
    {
    	$this->hasMany('App\Message','conversation','id');
    }
}
