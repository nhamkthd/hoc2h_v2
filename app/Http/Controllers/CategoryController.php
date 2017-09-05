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
    	$category = Category::all();
    	return view('admin.business.category.index',compact('category'));
    }
    public function getList()
    {
        $arr=$this->deQuy(Category::all(),0);
        return response()->json($arr);
    }
    public function deQuy($categories, $parent_id = 0)
    {
        $branch = array();
        foreach ($categories as $key => $category) {  
            if($category->parent_id==$parent_id)
            { 
               unset($categories[$key]);
               $children =$this->deQuy($categories,$category->id);
               if ($children) {
                   $category['children'] = $children;
                }
                $branch[] = $category;
             }
        }
        return $branch;

}
    public function getcreate(){
        $category = Category::all();
        return view('admin.business.category.create',compact('category'));
    }
    public function postcreate(CategoryRequestCreate $request){
        $cate = new Category;
        $cate->parent_id = $request->super_category_id;
        $cate->title = $request->title;
        $cate->description = $request->description;
        $cate->save();
        \Session::flash('notify','Thêm thành công');
        return redirect()->route('indexCategory');
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
    	$category->parent_id = $request->super_category_id;
    	$category->title = $request->title;
    	$category->description = $request->description;
        $category->save();
        \Session::flash('notify','Sửa thành công');
        return redirect()->route('indexCategory');
    }
    public function destroy($id){
    	$category = Category::find($id);
        $category->delete();
        \Session::flash('notify','Xóa thành công');
        return redirect()->route('indexCategory');
    }
}
