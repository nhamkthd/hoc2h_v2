<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\QuestionTag;
class TagController extends Controller
{
	
	public function build_sorter($key) {
		return function ($a, $b) use ($key) {
		    if ($a[$key] == $b[$key]) {
	            return 0;
	        }
	        return ($a[$key] < $b[$key]) ? +1 : -1;
		};
	}

    public function getAll()
    {
    	$tags =  Tag::all();
    	$questions_count = array();
    	foreach ($tags as $tag) {
    		$tag->questions_count = QuestionTag::getQuestionsCountWithTag($tag->id);
    	}
    	$tagsArray = $tags->toArray();
    	usort($tagsArray,$this->build_sorter('questions_count'));

    	return response()->json($tagsArray);
    }

    
}
