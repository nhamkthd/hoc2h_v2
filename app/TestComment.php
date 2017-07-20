<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestComment extends Model
{
    public function user()
	{
		return $this->belongsTo('App\User','user_id','id');
	}

	public function like()
	{
		return $this->hasMany('App\LikeCommentTest','comment_id','id');
	}

	public function test()
	{
		return $this->belongsTo('App\Test','test_id','id');
	}
}
