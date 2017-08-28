<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class TestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        // following line retrieve all the user_ids from DB
        $users = App\User::all()->pluck('id')->all();
        $categories = App\Category::all()->pluck('id')->all();
        $number_of_questions = [10,15,20,25,30];
        $levels = [1,2,3];
        foreach(range(1,20) as $index){
            $company = App\Test::create([
                'title' => $faker->company,
                'user_id' => $faker->randomElement($users),
                'category_id' => $faker->randomElement($categories),
                'number_of_questions' => $faker->randomElement($number_of_questions),
                'total_time' => $faker->randomElement($number_of_questions),
                'level' => $faker->randomElement($levels),
                'note' => $faker->realText,
            ]);
        }
    }
}
