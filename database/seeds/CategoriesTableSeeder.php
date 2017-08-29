<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
        	'parent_id' => 0,
        	'order_display' => 1,
      		'title' => 'Kiến Thức THPT',
      		'description' => 'Phạm vi kiến thức THPT']);
      	
      	 DB::table('categories')->insert([
        	'parent_id' => 0,
        	'order_display' => 2,
      		'title' => 'Kiến Thức THCS',
      		'description' => 'Phạm vi kiến thức THCS']);
      	  
      	DB::table('categories')->insert([
        	'parent_id' => 0,
        	'order_display' => 3,
      		'title' => 'Công Nghệ Thông Tin',
      		'description' => 'Phạm vi kiến thức CNTT']);
      	
      	DB::table('categories')->insert([
        	'parent_id' => 0,
        	'order_display' => 4,
      		'title' => 'Ngoại Ngữ',
      		'description' => 'Phạm vi kiến thức ngoại ngữ']);
  
    }
}
