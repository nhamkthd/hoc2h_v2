<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('user_name')->nullable();
            $table->string('email')->nullable();
            $table->integer('role_id')->default(3);
            $table->integer('phone')->nullable();
            $table->string('class')->nullable();
            $table->integer('gender')->nullable();
            $table->string('birthday')->nullable();
            $table->string('avatar')->default('http://i.imgur.com/kHn39EY.jpg');
            $table->string('local')->nullable();
            $table->integer('coin')->default(0);
            $table->integer('status')->default(1);
            $table->text('description')->nullable();
            $table->string('password');
            $table->string('code')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('provider')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
