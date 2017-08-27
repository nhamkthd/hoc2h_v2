<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\QuestionTag;
class TagController extends Controller
{
	//admin
    public function index()
    {
       return view('admin.business.tag.index');
    }
	public function build_sorter($key) {
		return function ($a, $b) use ($key) {
		    if ($a[$key] == $b[$key]) {
	            return 0;
	        }
	        return ($a[$key] < $b[$key]) ? +1 : -1;
		};
	}

    public function getAll($category_id)
    {
        if ($category_id == 0) {
            $tags =  Tag::all();
        }else {
            $tags = Tag::where('category_id',$category_id)->get();
        }
    	$questions_count = array();
    	foreach ($tags as $tag) {
    		$tag->questions_count = QuestionTag::getQuestionsCountWithTag($tag->id);
    	}
    	$tagsArray = $tags->toArray();
    	usort($tagsArray,$this->build_sorter('questions_count'));

    	return response()->json($tagsArray);
    }

    
}
