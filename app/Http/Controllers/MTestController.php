<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\MTest;
use App\MTestAnswer;
use Auth;
class MTestController extends Controller
{
	public function store(Request $req)
	{
		//dd($req);
		$test=new Test;	
  		$test->user_id=Auth::user()->id;
  		$test->title=$req->test['title'];
  		$test->number_of_questions=$req->test['number_of_questions'];
  		$test->total_time=$req->test['time'];
  		$test->category_id=$req->test['category_id'];
  		$test->level=$req->test['level_id'];
  		$test->state=1;
  		$test->save();
		foreach ($req->mtests as $key => $reqs) {

				$MTest=new MTest;
				$MTest->test_id=$test->id;
				$MTest->content=$reqs['content'];
				$MTest->explan=$reqs['explan'];
				$MTest->state=1;
				$MTest->save();

				foreach ($reqs['answer'] as $key => $value) {
					$MTestAnswer=new MTestAnswer;
					$MTestAnswer->mtest_id=$MTest->id;
					$MTestAnswer->title=$value['title'];
					$MTestAnswer->order_id=1;
					if($value['is_correct'])
					{
						$MTestAnswer->is_correct=1;
						$MTestAnswer->save();
						$MTest->incorrect_id=$MTestAnswer->id;
					}
					else
					{
						$MTestAnswer->is_correct=0;
					}
					$MTestAnswer->save();
					$MTest->save();
				}
			}
		}
		public function edit(Request $req)
		{
			$test=Test::find($req->test['id']);	
			$test->user_id=Auth::user()->id;
			$test->title=$req->test['title'];
			$test->number_of_questions=$req->test['number_of_questions'];
			$test->total_time=$req->test['total_time'];
			$test->category_id=$req->test['category_id'];
			$test->level=$req->test['level'];
			$test->state=1;
			$test->save();
			foreach ($req->mtests as $key => $mtest) {
				if(isset($mtest['id']))
				{
					$MTest=MTest::find($mtest['id']);
					$MTest->test_id=$test->id;
					$MTest->content=$mtest['content'];
					$MTest->explan=$mtest['explan'];
					$MTest->state=1;
					foreach ($mtest['m_test_answer'] as $key => $value) {
						if(!isset($value['id']))
						{
							$MTestAnswer=new MTestAnswer;
							$MTestAnswer->mtest_id=$MTest->id;
							$MTestAnswer->title=$value['title'];
							$MTestAnswer->order_id=1;
							if($value['is_correct'])
							{
								$MTestAnswer->is_correct=1;
								$MTestAnswer->save();
								$MTest->incorrect_id=$MTestAnswer->id;
							}
							else
							{
								$MTestAnswer->is_correct=0;
							}
						}
						else
						{
							$MTestAnswer=MTestAnswer::find($value['id']);
							$MTestAnswer->mtest_id=$MTest->id;
							$MTestAnswer->title=$value['title'];
							$MTestAnswer->order_id=1;
							if($value['is_correct'])
							{
								$MTestAnswer->is_correct=1;
								$MTestAnswer->save();
								$MTest->incorrect_id=$MTestAnswer->id;
							}
							else
							{
								$MTestAnswer->is_correct=0;
							}
						}
						$MTestAnswer->save();
						$MTest->save();
					}
				}
				else
				{
					$MTest=new MTest;
					$MTest->test_id=$test->id;
					$MTest->content=$mtest['content'];
					$MTest->explan=$mtest['explan'];
					$MTest->state=1;
					$MTest->save();
					foreach ($mtest['m_test_answer'] as $key => $value) {
						$MTestAnswer=new MTestAnswer;
						$MTestAnswer->mtest_id=$MTest->id;
						$MTestAnswer->title=$value['title'];
						$MTestAnswer->order_id=1;
						if(isset($value['is_correct']))
						{
							$MTestAnswer->is_correct=1;
							$MTestAnswer->save();
							$MTest->incorrect_id=$MTestAnswer->id;
						}
						else
						{
							$MTestAnswer->is_correct=0;
						}
						$MTestAnswer->save();
						$MTest->save();
					}
					$MTest->save();
				}
			}	
		}
		public function getMtests($id)
		{
			$test=Test::find($id);
			foreach ($test->mtest as $key => $value) {
				$value->mTestAnswer;
			};
			return response()->json($test);
		}
		public function delete(Request $req)
		{
			MTest::find($req->id)->delete();
		}
		public function deleteanswer(Request $req)
		{
			$as=MTestAnswer::find($req->id);
			if($as)
			{
				$as->delete();
			}
			else{

			}
		}

}
