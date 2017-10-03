<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('job')->nullable();
            $table->string('local')->nullable();
            $table->integer('phone')->nullable();
            $table->string('birthday')->nullable();
            $table->string('avatar')->default('https://imgur.com/a/djlvB');
            $table->integer('coins')->default(0);
            $table->integer('reputation')->default(0);
            $table->text('introduction')->nullable();
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
        Schema::dropIfExists('user_profiles');
    }
}
