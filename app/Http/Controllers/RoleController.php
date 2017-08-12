<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\UserPermissions;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\UpdateRoleRequest;

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
		$role->level = $request->level;
		$role->discription = $request->description;
		$role->save();
		return response()->json($role);
	}
	public function destroy($id){
		$Role = Role::find($id);
		$Role->delete();
		return 'true';
	}
	public function Show($id){
		$role = Role::find($id);
		$permisstion = UserPermissions::all();
		return view('admin.business.role.show',compact('permisstion','role'));
	}

	public function update(updateUserRequest $request,User $user){

	}
}
