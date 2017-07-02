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
            $table->string('user_name');
            $table->string('email')->unique();
            $table->integer('role_id')->default(4);
            $table->integer('phone')->nullable();
            $table->string('class')->nullable();
            $table->integer('gender')->nullable();
            $table->string('birthday')->nullable();
            $table->string('avatar')->nullable();
            $table->string('local')->nullable();
            $table->integer('coin')->default(0);
            $table->integer('status')->default(1);
            $table->text('description')->nullable();
            $table->string('password');
            $table->string('code')->nullable();
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
