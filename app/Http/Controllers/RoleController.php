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
		$role = Role::all();
		return view('admin.business.role.index',compact('role'));
	}
	public function getCreate(){
		$permisstion = UserPermissions::all();
		return view('admin.business.role.create',compact('permisstion'));
	}
	public function postCreate(RoleRequest $request,Role $role){
		$role = new Role;
		$role->title = $request->title;
		$role->promissions_id = $request->permisstion;
		$role->discription = $request->description;
		$role->save();
		\Session::flash('notify','Thêm thành công');
		return redirect()->route('indexRole');
	}
	public function destroy($id){
		$Role = Role::find($id);
		$Role->delete();
		\Session::flash('notify','Xóa thành công');
		return redirect()->route('indexRole');
	}
	public function Show($id){
		$role = Role::find($id);
		$permisstion = UserPermissions::all();
		return view('admin.business.role.show',compact('permisstion','role'));
	}

	public function update(updateUserRequest $request,User $user){

	}
}
