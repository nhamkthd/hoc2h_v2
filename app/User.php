<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Cache;
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "users";
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $fillable = [
        'id','name', 'user_name','email','status','role_id','password'
    ];
    

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public function profile() {
      return $this->belongsTo('App\UserProfile','user_id');
    }

    public function privateSetting(){
        return $this->belongsTo('App\UserPrivate','user_id');
    }

    public function notifcationSetting(){
        return $this->belongsTo('App\UserNotificationSetting','user_id');
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

    public function messages(){
        return $this->hasMany('App\Message','user_id','id');
    }

    public function user_test()
    {
      return $this->belongsToMany('App\test', 'user_tests','user_id','test_id')
      ->withPivot('point');
    }
}
