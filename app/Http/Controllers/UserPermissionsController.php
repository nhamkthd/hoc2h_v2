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
    	dd($req->all());
    }
}
