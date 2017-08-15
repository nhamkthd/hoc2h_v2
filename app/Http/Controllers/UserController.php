<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use App\User;
use App\UserPrivate;
use App\UserNotificationSetting;
use App\Role;
use App\Question;
use App\Answer;
use App\Test;
use App\Http\Requests\UserRequest;
use App\Http\Requests\updateUserRequest;
use Hash;


class UserController extends Controller
{
  //USER
  public function userIndex($user_id, $tab){
    $currentTab = 1;
    if ($tab) {
      switch ($tab) {
        case'profile':
          $currentTab = 1;
          break;
        case'activity':
          $currentTab = 2;
          break;
        case'setting':
          $currentTab = 3;
          break;
        default:
          $currentTab = 1;
          break;
      }
    }
    return view('users.index',compact('user_id','currentTab'));
  }
  
  public function apiGetProfile($id){
    $user = User::find($id);
    $user->join_date = $user->created_at->format('d/m/Y');
    $user->private_setting = UserPrivate::where('user_id',$user->id)->get()[0];
    $user->notification_setting = UserNotificationSetting::where('user_id',$user->id)->get()[0];
    return $user;
  }

  public function getUserPrivate($id){
    return UserPrivate::where('user_id',$id)->get();
  }

  public function userEdit(Request $request){
    $user_edit = User::find($request->id);
    $user_edit->name = $request->name;
    $user_edit->phone = $request->phone;
    $user_edit->class = $request->class;
    $user_edit->birthday = $request->birthday;
    $user_edit->gender = $request->gender;
    $user_edit->local = $request->local;
    $user_edit->avatar = $request->avatar;
    $user_edit->description = $request->description;
    $user_edit->save();
    return $user_edit;
  }

  public function updateUserPrivate(Request $request){
    $user_private = UserPrivate::find($request->id);
    $user_private->show_active = $request->show_active;
    $user_private->show_birthday = $request->show_birthday;
    $user_private->show_phone = $request->show_phone;
    $user_private->view_detail_profile = $request->show_profile;
    $user_private->send_message = $request->send_message;
    $user_private->save();
    return $user_private;
  }

  public function changeEmail(Request $request){
    $user = User::find($request->user_id);
    $user->email = $request->email;
    $user->save();
    return $user;
  }

  public function changePassword(Request $request){

  }

  public function updateNotificationSetting(Request $request){
    $user_noti = UserNotificationSetting::find($request->id);
    $user_noti->peoples_following = $request->peoples_following;
    $user_noti->post_following = $request->post_following;
    $user_noti->your_post = $request->your_post;
    $user_noti->new_follower = $request->new_follower;
    $user_noti->new_message = $request->new_message;
    $user_noti->question_can_answer = $request->question_can_answer;
    $user_noti->request_answer = $request->request_answer;
    $user_noti->coin_change = $request->coin_change;

    $user_noti->email_peoples_following = $request->email_peoples_following;
    $user_noti->email_post_following = $request->email_post_following;
    $user_noti->email_your_post = $request->email_your_post;
    $user_noti->email_new_follower = $request->email_new_follower;
    $user_noti->email_new_message = $request->email_new_message;
    $user_noti->email_question_can_answer = $request->email_question_can_answer;
    $user_noti->email_request_answer = $request->email_request_answer;
    $user_noti->email_coin_change = $request->email_coin_change;

    $user_noti->save();
    return $user_noti;
  }

  public function getActivityOverview($user_id){
    $questions = Question::where('user_id',$user_id)->orderby('votes_count','desc')->take(10)->get();
    $answers = Answer::where('user_id',$user_id)->orderby('votes_count','desc')->take(10)->get();
    foreach ($answers as $answer) {
      $answer->question;
    }
    $tests = Test::where('user_id',$user_id)->orderby('user_test_count','desc')->take(10)->get();
    $result  = array('questions' => $questions,'answers' => $answers, 'test_create' => $tests );

    return $result;
  }
  //ADMIN   
  public function index(){
    //$user = User::all();
    return view('admin.business.user.index');
  }
  public function getList()
  {
    $user = User::all();
    foreach ($user as $key => $u) {
      $u->role;
    }
    return response()->json($user);
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
