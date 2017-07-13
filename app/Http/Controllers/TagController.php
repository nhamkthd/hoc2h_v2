<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
class TagController extends Controller
{
    public function getAll()
    {
    	$tags =  Tag::all();
    	return $tags;
    }
}
