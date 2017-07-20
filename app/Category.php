<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    protected $fillable = ['super_category_id','title','description','oder_display'];

    public function children()
    {
    	return $this->hasMany('App\Categories','super_category_id','id');
    }

    public function superCategory() {
        return $this->belongsTo('App\Categories','super_category_id','id');
    }

    public static function superCategories () {
    	return static::where('super_category_id',0)
    								->orderBy('order_display')
    								->get();
    }
    public function questions() {
        return $this->hasMany('App\Question','categories_id','id');
    }
}
