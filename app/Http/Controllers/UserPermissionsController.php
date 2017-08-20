<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserPermissions;
use App\Role;
class UserPermissionsController extends Controller
{
    public function index($id)
    {
    	$role=Role::find($id);
    	$permission=UserPermissions::where('role_id',$id)->first();
    	return view('admin.business.permission.index',compact('role','permission'));
    }
    public function update(Request $req)
    {
        $arr=array_slice($req->all(),2);
        UserPermissions::where('id',$req->permission_id)->update($arr);
        \Session::flash('notify','đã cập nhập quyền thành công');
        return redirect('admin/role');
    }
}
