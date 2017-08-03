<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Role;
use App\Http\Requests\UserRequest;
use App\Http\Requests\updateUserRequest;
use Hash;

class UserController extends Controller
{

  //USER
  public function userIndex($user_id){
    return view('users.index',compact('user_id'));
  }
    

  //ADMIN   
  public function index(){
    $user = User::all();
    //dd($user);
    return view('admin.business.user.index',compact('user'));
  }

  public function getCreate(){
    $role = Role::all();
    return view('admin.business.user.create',compact('role'));
  }

  public function postCreate(UserRequest $request,User $user){

    $user = new User();
    $user->name=$request->name;
    $user->user_name=$request->user_name;
    $user->email=$request->email;
    $user->role_id=$request->role;
    $user->phone=$request->phone;
    $user->class=$request->class;
    $user->gender=$request->gender;
    $user->birthday=$request->birthday;
    if($request->hasFile('avatar')){
      $path = 'images/user/';
      $file = $request->file('avatar');
      $name = $file->getClientOriginalName();
      do{
        $filename = str_random(4)."_".$name;
      }while(file_exists("images/user/".$filename));
      $file->move($path,$filename);
      $user->avatar = $filename;    
    }
    else {
      $user->avatar="";
    }
    $user->local=$request->local;
    $user->coin=$request->coin;
    $user->status=$request->status;
    $user->description=$request->description;
    $user->password=Hash::make($request->password);
    $user->code=$request->code;
    $user->save();
    return redirect('admin/user');
  }

  public function destroy($id){
    $User = User::find($id);
    $User->delete();
    \Session::flash('notify','Xóa thành công');
    return redirect()->route('indexUser');
  }

  public function Show($id){
    $user = User::find($id);
    $role = Role::all();
    return view('admin.business.user.show',compact('user','role'));
  }

  public function update(updateUserRequest $request,User $user){

  }
}
