<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    public function getAll()
    {
    	return Category::all();
    }

    public function getWithID($id)
    {
    	return Category::find($id);
    }
}
