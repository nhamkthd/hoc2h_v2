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
    protected $fillable = [
        'name', 'user_name','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

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
}
