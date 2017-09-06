<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cache;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $table = "users";

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public function privateSetting(){
        return $this->belongsTo('App\UserPrivate','user_id','id');
    }

    public function notifcationSetting(){
        return $this->belongsTo('App\UserNotificationSetting','user_id','id');
    }

    public function questionVotes()
    {
      return $this->hasMany('App\QuestionVote','user_id','id');
    }

    public function answerVotes()
    {
       return $this->hasMany('App\AnswerVote','user_id','id');
    }

    public function answerCommentVotes() {
        return $this->hasMany('App\AnswerCommentVote','user_id','id');
    }
    protected $fillable = [
        'name', 'user_name','email', 'password','phone','class','local','gender','status','coin','avatar','role_id','birthday','description',
    ];
   
    public function role(){
        return $this->belongsTo('App\Role','role_id','id');
    }

    public function messages(){
        return $this->hasMany('App\Message','user_id','id');
    }

    public function user_test()
    {
      return $this->belongsToMany('App\test', 'user_tests','user_id','test_id')
      ->withPivot('point');
    }
}
