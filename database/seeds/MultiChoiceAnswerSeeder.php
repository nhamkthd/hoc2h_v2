<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class MultiChoiceAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $m_tests = App\MTest::all();
       
        foreach ($m_tests as $m_test) {
        	for ($i=1; $i < 5; $i++) { 
        		if ($m_test->incorrect_id == $i) {
        			$is_correct = 1;
        		} else $is_correct = 0;
        		App\MTestAnswer::create([
	                'mtest_id' => $m_test->id,
	                'order_id' => $i,
	                'title' => $faker->company,
	                'is_correct' => $is_correct,
	            ]);
        	}
        }

    }
}
