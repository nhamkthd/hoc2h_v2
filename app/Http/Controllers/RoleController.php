<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Authorizable;
use App\Permission;
use App\Role;

class RoleController extends Controller
{
    use Authorizable;
    public function __construct() {
        $this->middleware(['auth']);
    }
    
    public function index(){
		return view('admin.business.role.index');
	}
	public function getList()
	{
		$role=Role::all();
		return response()->json($role);
	}


    public function create() {
        $permissions = Permission::all();
        return view('admin.business.role.create',compact('permissions'));
    }

	public function store(Request $request){
        $this->validate($request, [
            'name'=>'required|unique:roles|max:10',
            ]
        );
		if( $role = Role::create($request->only('name')) ) {
            $permissions = $request->get('permissions', []);
            $role->syncPermissions($permissions);
            flash('Role Added');
        }
		return response()->json(array('role' => $role ,'permissions' => $permissions ));
	}

    public function edit($id) {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('admin.business.role.directives.edit',compact('roles','permissions'));
    }

    public function update(Request $request) {
        $this->validate($request, [
            'id'=>'required',
        ]);
        if($role = Role::findOrFail($request->id)) {
            // admin role has everything
            if($role->name === 'Admin') {
                $role->syncPermissions(Permission::all());
                return $role;
            }
            $permissions = $request->get('permissions', []);

            $role->syncPermissions($permissions);
            return $role;
            flash( $role->name . ' permissions has been updated.');
        } else {
            flash()->error( 'Role with id '. $request->id .' note found.');
        }

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
}
