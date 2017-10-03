<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;
class PermissionController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']); 
    }

    public function index(){
    	$permissions = Permission::all();
    	return  view('admin.permission.index', compact('permissions'));
    }

    public function create() {
    	$roles = Role::get();
    	return view('admin.permission.create',compact('roles'));
    }

    public function store(Request $request) {
    	$this->validate($request, [
            'name'=>'required|max:40',
        ]);

        $name = $request->name;
        $permission = new Permission();
        $permission->name = $name;
        $permission->guard_name = 'Web';
        $permission->save();

        $roles = $request->roles;
        if (!empty($request->roles)) {
        	foreach ($roles as $key => $role) {
        		$r = Role::where('name',role)->firstOrFail();
        		$r->givePermissionTo($permission);
        	}
        }
    }

    public function show($id) {
    	$permission = Permission::findOrFail($id);
    	return $permission;
    }

    public function update(Request $request) {

    	$this->validate($request, [
            'name'=>'required|max:40',
        ]);
    	$permission = Permission::find($request->id);
    	$permission->name = $request->name;
    	$permission->save();

    	return $permission;
    }

    public function destroy($id) {
    	$permission = Permission::findOrFail($id);
    	$permission->delete();
    	return 1;
    }
}
