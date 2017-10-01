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
        $permissions = App\UserPermissions::defaultPermissions();
        foreach ($permissions as $key => $perm) {
            App\UserPermissions::firstOrCreate(['name' => $perms],'guard_name'=>'Web');
        }
        $this->call(CategoriesTableSeeder::class);
        // $this->call(TagsTableSeeder::class);
        //$this->call(QuestionsTableSeeder::class);
        // $this->call(QuestionTagsTableSeeder::class);
        // $this->call(AnswersTableSeeder::class);
        // $this->call(TestsSeeder::class);
        // $this->call(MultilChoiceTestSeeder::class);
        // $this->call(MultiChoiceAnswerSeeder::class);
    }
}
