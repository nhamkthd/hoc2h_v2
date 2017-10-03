<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        // $permissions = App\Permission::defaultPermissions();
        // foreach ($permissions as $key => $perms) {
        //     App\Permission::firstOrCreate(['name' => $perms,'guard_name'=>'web']);
        // }
        // $roles_array = ['SuperAdmin','Admin','Editor','Member','Guest'];
        // foreach ($roles_array as $key => $role) {
        //     $role = Role::firstOrCreate(['name' => trim($role),'guard_name' => 'web']);

        //     if( $role->name == 'Admin' || $role->name == 'SuperAdmin' ) {
        //             // assign all permissions
        //         $role->syncPermissions(Permission::all());
        //     } else {
        //             // for others by default only read access
        //         $role->syncPermissions(Permission::where('name', 'LIKE', 'view_%')->get());
        //     }
        // }
        //  $this->call(CategoriesTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        //$this->call(QuestionsTableSeeder::class);
        // $this->call(QuestionTagsTableSeeder::class);
        // $this->call(AnswersTableSeeder::class);
        //$this->call(TestsSeeder::class);
        // $this->call(MultilChoiceTestSeeder::class);
         //$this->call(MultiChoiceAnswerSeeder::class);
    }

    private function createUser($role)
    {
        $user = factory(App\User::class)->create();
        $user->assignRole($role->name);

        if( $role->name == 'Admin' ) {
            $this->command->info('Here is your admin details to login:');
            $this->command->warn($user->email);
            $this->command->warn('Password is "secret"');
        }
    }
}
