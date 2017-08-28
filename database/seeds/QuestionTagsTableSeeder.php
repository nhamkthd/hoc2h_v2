<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class QuestionTagsTableSeeder extends Seeder
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
        $questions = App\Question::all()->pluck('id')->all();
        $tags = App\Tag::all()->pluck('id')->all();

        foreach(range(1,150) as $index){
            $company = App\QuestionTag::create([
                'question_id' => $faker->randomElement($questions),
                'tag_id' => $faker->randomElement($tags),
            ]);
        }
    }
}
