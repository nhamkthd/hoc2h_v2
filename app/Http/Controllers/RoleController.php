<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use App\UserPermissions;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use DB;
class RoleController extends Controller
{
     public function index(){
		return view('admin.business.role.index');
	}
	public function getList()
	{
		$role=Role::all();
		return response()->json($role);
	}
	public function create(RoleRequest $request){
		$role = new Role;
		$role->title = $request->title;
		$role->discription = $request->description;
		$role->save();
		DB::table('user_permissions')->insert([
			'role_id' =>$role->id,
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
		return response()->json($role);
	}
	public function destroy($id){
		if($id==1||$id==2||$id==3||$id==4)
		{
			return 'false';
		}
		else
		{
			User::where('role_id', '=', $id)
			->update(['role_id' => 3]);
			$Role = Role::find($id);
			$Role->delete();
			return 'true';
		}
	}
	public function update(Request $request){
		$role=Role::find($request->id);
		$role->title=$request->title;
		$role->discription=$request->description;
		$role->save();
		return response()->json($role);
	}
}
