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
	public function comment()
	{
		return $this->hasMany('App\TestComment','test_id','id');
	}
	public function rate()
	{
		return $this->hasMany('App\RateTest','test_id','id');
	}

	public function mtest()
	{
		return $this->hasMany('App\MTest','test_id','id');
	}
	// public function user_test()
	// {
	// 	return $this->belongsToMany('App\User', 'user_tests', 'test_id' ,'user_id')->withPivot('point');
	// }
	public static function hotInWeek()
	{
		  return static::where('created_at', '>=', \Carbon\Carbon::now()->subWeek());
	}
	public function user_test()
	{
		return $this->hasMany('App\UserTest','test_id','id');
	}
}
