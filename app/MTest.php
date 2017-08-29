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

    public static function correctAnswer($m_test_id)
    {
    	return mTestAnswer::where('mtest_id',$m_test_id)->where('is_correct',1)->first();
    }
}
