<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
     $this->call(CategoriesTableSeeder::class);
     $this->call(rolesTableSeeder::class);
     $this->call(TagsTableSeeder::class);
     $this->call(user_permissionTableSeeder::class);
     $this->call(QuestionsTableSeeder::class);
     $this->call(QuestionTagsTableSeeder::class);
     $this->call(AnswersTableSeeder::class);
     $this->call(TestsSeeder::class);
     $this->call(MultilChoiceTestSeeder::class);
     $this->call(MultiChoiceAnswerSeeder::class);
    }
}
