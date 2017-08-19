<?php

use Illuminate\Database\Seeder;

class user_permissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//super
    	DB::table('user_permissions')->insert([
    		'role_id' =>1,
    		'view_test' => 1,
    		'attend_test' => 1,
    		'comment_test' => 1,
    		'rate_test' => 1,
    		'create_test' => 1,
    		'check_user_test' => 1,
    		'edit_test_by_self' => 1,
    		'edit_test_by_everyone' => 1,
    		'delete_test_by_self' => 1,
    		'delete_test_by_everyone' => 1,
    		'approve_test_create' => 1,
    		'stick_test' => 1,
    		'view_test_explan' => 1,
    		'view_question' => 1,
    		'answer_question' => 1,
    		'comment_answer' => 1,
    		'edit_qa_by_self' => 1,
    		'edit_qa_by_everyone' => 1,
    		'delete_qa_by_self' => 1,
    		'delete_qa_by_everyone' => 1,
    		'stick_question' => 1,
    		'update_question_status_by_self' => 1,
    		'update_question_status_by_everyone' => 1,
    		'set_best_answer' => 1,
    		'like_answer' => 1,
    		'like_comment' => 1,
    		'like_question' => 1,
    		'follow_question' => 1,
    		'report_question' => 1,
    		'report_answer' => 1,
    		'qa_attachments' => 1,
    		'view_my_profile' => 1,
    		'edit_my_profile' => 1,
    		'edit_other_profile' => 1,
    		'start_conversations' => 1,
    		'add_friend' => 1,
    		'follow_user' => 1,
    		'view_other_user_profile' => 1,
    		'check_qa_report' => 1,
    		]);
    	//admin
    DB::table('user_permissions')->insert([
    		'role_id' =>2,
    		'view_test' => 1,
    		'attend_test' => 1,
    		'comment_test' => 1,
    		'rate_test' => 1,
    		'create_test' => 1,
    		'check_user_test' => 1,
    		'edit_test_by_self' => 1,
    		'edit_test_by_everyone' => 1,
    		'delete_test_by_self' => 1,
    		'delete_test_by_everyone' => 1,
    		'approve_test_create' => 1,
    		'stick_test' => 1,
    		'view_test_explan' => 1,
    		'view_question' => 1,
    		'answer_question' => 1,
    		'comment_answer' => 1,
    		'edit_qa_by_self' => 1,
    		'edit_qa_by_everyone' => 1,
    		'delete_qa_by_self' => 1,
    		'delete_qa_by_everyone' => 1,
    		'stick_question' => 1,
    		'update_question_status_by_self' => 1,
    		'update_question_status_by_everyone' => 1,
    		'set_best_answer' => 1,
    		'like_answer' => 1,
    		'like_comment' => 1,
    		'like_question' => 1,
    		'follow_question' => 1,
    		'report_question' => 1,
    		'report_answer' => 1,
    		'qa_attachments' => 1,
    		'view_my_profile' => 1,
    		'edit_my_profile' => 1,
    		'edit_other_profile' => 1,
    		'start_conversations' => 1,
    		'add_friend' => 1,
    		'follow_user' => 1,
    		'view_other_user_profile' => 1,
    		'check_qa_report' => 1,
    		]);
    //register
    DB::table('user_permissions')->insert([
    		'role_id' =>3,
    		'view_test' => 1,
    		'attend_test' => 1,
    		'comment_test' => 1,
    		'rate_test' => 1,
    		'create_test' => 1,
    		'check_user_test' => 1,
    		'edit_test_by_self' => 1,
    		'edit_test_by_everyone' => 0,
    		'delete_test_by_self' => 1,
    		'delete_test_by_everyone' => 0,
    		'approve_test_create' => 1,
    		'stick_test' => 1,
    		'view_test_explan' => 1,
    		'view_question' => 1,
    		'answer_question' => 1,
    		'comment_answer' => 1,
    		'edit_qa_by_self' => 1,
    		'edit_qa_by_everyone' => 1,
    		'delete_qa_by_self' => 1,
    		'delete_qa_by_everyone' => 1,
    		'stick_question' => 1,
    		'update_question_status_by_self' => 1,
    		'update_question_status_by_everyone' =>0,
    		'set_best_answer' => 1,
    		'like_answer' => 1,
    		'like_comment' => 1,
    		'like_question' => 1,
    		'follow_question' => 1,
    		'report_question' => 1,
    		'report_answer' => 1,
    		'qa_attachments' => 1,
    		'view_my_profile' => 1,
    		'edit_my_profile' => 1,
    		'edit_other_profile' => 0,
    		'start_conversations' => 1,
    		'add_friend' => 1,
    		'follow_user' => 1,
    		'view_other_user_profile' => 1,
    		'check_qa_report' => 0,
    		]);
    //khách
    DB::table('user_permissions')->insert([
    		'role_id' =>4,
    		'view_test' => 0,
    		'attend_test' => 0,
    		'comment_test' => 0,
    		'rate_test' => 0,
    		'create_test' => 0,
    		'check_user_test' => 0,
    		'edit_test_by_self' => 0,
    		'edit_test_by_everyone' => 0,
    		'delete_test_by_self' => 0,
    		'delete_test_by_everyone' => 0,
    		'approve_test_create' => 0,
    		'stick_test' => 0,
    		'view_test_explan' => 0,
    		'view_question' => 0,
    		'answer_question' => 0,
    		'comment_answer' => 0,
    		'edit_qa_by_self' => 0,
    		'edit_qa_by_everyone' => 0,
    		'delete_qa_by_self' => 0,
    		'delete_qa_by_everyone' => 0,
    		'stick_question' => 0,
    		'update_question_status_by_self' => 0,
    		'update_question_status_by_everyone' => 0,
    		'set_best_answer' => 0,
    		'like_answer' => 0,
    		'like_comment' => 0,
    		'like_question' => 0,
    		'follow_question' => 0,
    		'report_question' => 0,
    		'report_answer' => 0,
    		'qa_attachments' => 0,
    		'view_my_profile' => 0,
    		'edit_my_profile' => 0,
    		'edit_other_profile' => 0,
    		'start_conversations' => 0,
    		'add_friend' => 0,
    		'follow_user' => 0,
    		'view_other_user_profile' => 0,
    		'check_qa_report' => 0,
    		]);
    }
}
