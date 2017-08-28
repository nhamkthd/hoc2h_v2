<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class MultilChoiceTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();
        $tests = App\Test::all();
        $conrect_answers = [1,2,3,4];
        foreach ($tests as $test) {
        	for ($i=0; $i < $test->number_of_questions; $i++) { 
        		App\MTest::create([
	                'test_id' => $test->id,
	                'incorrect_id' => $faker->randomElement($conrect_answers),
	                'explan' => $faker->realText,
	                'content' => $faker->realText,
	            ]);
        	}
        }
    }
}
