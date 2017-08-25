<?php

use Illuminate\Database\Seeder;

class rolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      	DB::table('roles')->insert([
      		'title' => 'Super Admin',
      		'discription' => 'Quản trị cao nhất']);
      	
      	DB::table('roles')->insert([
      		'title' => 'Admin',
      		'discription' => 'Quản trị viên ']);

      	DB::table('roles')->insert([
      		'title' => 'Thành viên',
      		'discription' => 'Thành viên đăng ký']);

      	DB::table('roles')->insert([
      		'title' => 'Khách',
      		'discription' => 'Khách vãng lai']);
     }
}
