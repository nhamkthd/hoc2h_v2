<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->integer('view_test');
            $table->integer('attend_test');
            $table->integer('comment_test');
            $table->integer('rate_test');
            $table->integer('create_test');
            $table->integer('check_user_test');
            $table->integer('edit_test_by_self');
            $table->integer('edit_test_by_everyone');
            $table->integer('delete_test_by_self');
            $table->integer('delete_test_by_everyone');
            $table->integer('approve_test_create');
            $table->integer('stick_test');
            $table->integer('view_test_explan');
            $table->integer('view_question');
            $table->integer('answer_question');
            $table->integer('comment_answer');
            $table->integer('edit_qa_by_self');
            $table->integer('edit_qa_by_everyone');
            $table->integer('delete_qa_by_self');
            $table->integer('delete_qa_by_everyone');
            $table->integer('stick_question');
            $table->integer('update_question_status_by_self');
            $table->integer('update_question_status_by_everyone');
            $table->integer('set_best_answer');
            $table->integer('like_answer');
            $table->integer('like_comment');
            $table->integer('like_question');
            $table->integer('follow_question');
            $table->integer('report_question');
            $table->integer('report_answer');
            $table->integer('qa_attachments');
            $table->integer('check_qa_report');
            $table->integer('view_my_profile');
            $table->integer('edit_my_profile');
            $table->integer('edit_other_profile');
            $table->integer('start_conversations');
            $table->integer('add_friend');
            $table->integer('follow_user');
            $table->integer('view_other_user_profile');
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
        Schema::dropIfExists('user_permissions');
    }
}
