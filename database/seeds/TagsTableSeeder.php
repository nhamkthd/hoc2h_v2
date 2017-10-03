<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $categories = App\Category::all()->pluck('id')->all();

        foreach(range(1,50) as $index){
            $company =App\Tag::create([
                'name' => $faker->name,
                'category_id' => $faker->randomElement($categories),
            ]);
        }
    }
}
