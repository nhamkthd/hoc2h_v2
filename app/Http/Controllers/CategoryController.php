<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\CategoryRequestUpdate;
use App\Http\Requests\CategoryRequestCreate;

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
    
    public function getParents(){
        return Category::where('parent_id',0)->get();
    }

    public function index(){
    	return view('admin.business.category.categoryTree');
    }
    public function getList()
    {
        $category=Category::all();
        foreach ($category as $categorys) {
            $categorys->text=$categorys->title;
            if($categorys->parent_id==0)
                $categorys->parent='#';
            else
                $categorys->parent=$categorys->parent_id;
        }
        return response()->json($category);
    }
    public function getcreate(){
        $category = Category::all();
        return view('admin.business.category.create',compact('category'));
    }
    public function postcreate(CategoryRequestCreate $request){
        $cate = new Category;
        $cate->parent_id = $request->parent_id;
        $cate->title = $request->title;
        $cate->description = $request->title;
        $cate->save();
        return response()->json($cate);
    }
    public function getcreateid($id){
        $category = Category::all();
        return view('admin.business.category.createid',compact('category','id'));
    }
    public function postcreateid(CategoryRequestCreate $request){
        Category::create($request->all());
        \Session::flash('notify','Thêm thành công');
        return redirect()->route('indexCategory');
    }
    public function Show($id){
    	$category = Category::find($id);
        $categoryall = Category::all();
    	return view('admin.business.category.show',compact('category','categoryall'));
    }

    public function update(CategoryRequestUpdate $request,Category $category){
    	$category->parent_id = $request->parent_id;
    	$category->title = $request->title;
    	$category->description = $request->title;
        $category->save();
        return response()->json($category);
    }
    public function destroy($id){
    	$category = Category::find($id);
        $category->delete();
        return response()->json($category);
    }
}
