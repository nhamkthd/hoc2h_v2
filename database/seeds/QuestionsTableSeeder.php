<?php


use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Question;
class QuestionsTableSeeder extends Seeder
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

        foreach(range(1,50) as $index){
            $company = Question::create([
                'title' => $faker->company,
                'user_id' => $faker->randomElement($users),
                'category_id' => $faker->randomElement($categories),
                'content' => $faker->realText,
            ]);
        }
    }
}
