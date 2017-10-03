<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends \Spatie\Permission\Models\Permission
{
   public static function defaultPermissions(){
		return [

			'view_users',
			'add_users',
			'edit_users',
			'delete_users',
			'set_role',

			'view_roles',
	        'add_roles',
	        'edit_roles',
	        'delete_roles',

	        'view_permissions',
	        'add_perrmissions',
	        'edit_permissions',
	        'delete_permissions',
	        'reset_permissions',

	        'view_categories',
	        'add_categories',
	        'edit_categories',
	        'delete_categories',

	        'view_tags',
	        'add_tags',
	        'edit_tags',
	        'delete_tags',

	        'view_questions',
	        'add_quesstions',
	        'edit_questions',
	        'delete_questions',
	        'set_best_answer',
	        'request_answer',
	        'vote_questions',
	        'set_rosolved',

	        'view_answers',
	        'add_answers',
	        'edit_answers',
	        'delete_answers',
	        'vote_answers',
	        'report_answers',

	        'view_answer_comments',
	        'add_answer_comments',
	        'edit_answer_comments',
	        'delete_answer_comments',
	        'vote_answers_comments',


	        'view_tests',
	        'add_tests',
	        'edit_tests',
	        'delete_tests',
	        'rate_tests',
	        'commemt_tests',
	        'attend_tests',
	        'show_test_results',
	        'check_test_result',
		];
	}	
}
