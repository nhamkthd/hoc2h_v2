<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\MTestAnswer;
class MTest extends Model
{
    public function mTestAnswer()
    {
    	return $this->hasmany('App\MTestAnswer','mtest_id','id');
    }

    public function correctAnswer()
    {
    	return MTestAnswer::where('mtest_id', 746)->where('is_correct',1)->get();
  
    }
}
