<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserNotificationSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_notification_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            //notifications settings
            $table->integer('peoples_following')->default(1);
            $table->integer('post_following')->default(1);
            $table->integer('your_post')->default(1);
            $table->integer('new_follower')->default(1);
            $table->integer('new_message')->default(1);
            $table->integer('question_can_answer')->default(1);
            $table->integer('request_answer')->default(1);
            $table->integer('coin_change')->default(1);
            //email settings
            $table->integer('email_peoples_following')->default(1);
            $table->integer('email_post_following')->default(1);
            $table->integer('email_your_post')->default(1);
            $table->integer('email_new_follower')->default(1);
            $table->integer('email_new_message')->default(1);
            $table->integer('email_question_can_answer')->default(1);
            $table->integer('email_request_answer')->default(1);
            $table->integer('email_coin_change')->default(1);
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
        Schema::dropIfExists('user_notification_settings');
    }
}
