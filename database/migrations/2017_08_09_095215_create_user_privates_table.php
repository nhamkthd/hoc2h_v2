<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPrivatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_privates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('show_active')->default(1);
            $table->integer('show_birthday')->default(1);
            $table->integer('show_phone')->default(1);
            $table->integer('view_detail_profile')->default(1);
            $table->integer('send_message')->default(1);
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
        Schema::dropIfExists('user_privates');
    }
}
