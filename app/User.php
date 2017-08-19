<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
    protected $table = "users";
    public function role(){
        return $this->belongsTo('App\Role','role_id','id');
    }
}
