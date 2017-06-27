<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMTestAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //table multichoice test answer
        Schema::create('m_test_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mtest_id')->unsigned();
            $table->foreign('mtest_id')->references('id')->on('m_tests')->onDelete('cascade');
            $table->string('title');
            $table->integer('order_id');
            $table->boolean('is_correct')->default(false);
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
        Schema::dropIfExists('m_test_answers');
    }
}
