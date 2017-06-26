<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->boolean('show_dob_year')->default(true);
            $table->boolean('show_dob_date')->default(true);
            $table->boolean('receive_admin_email')->default(true);
            $table->boolean('email_on_conversation')->default(true);
            $table->boolean('show_phone_number')->default(true);
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
        Schema::dropIfExists('user_options');
    }
}
