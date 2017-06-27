<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerCommentVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_comment_votes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('answer_comment_id')->unsigned();
            $table->foreign('answer_comment_id')->references('id')->on('answer_comments')->onDelete('cascade');
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
        Schema::dropIfExists('answer_comment_votes');
    }
}
