<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikeCommentTest extends Model
{
    protected $table='like_comment_test';
    public function comment()
    {
       return $this->belongsTo('App\TestComment','comment_id','id');
    }
}
