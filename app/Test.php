<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
	public function category()
	{
		return $this->belongsTo('App\category','category_id','id');
	}
	public function user()
	{
		return $this->belongsTo('App\User','user_id','id');
	}
}
