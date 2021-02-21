<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function category(){
        $categories = Category::all();
        return view('admin_backend.pages.category.category',['categories'=>$categories]);
    }

    public function storeCategory(Request $request){
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255|min:2'
        ]);

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();
        $notification=array(
            'messege'=>'Successfully Category Inserted',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);
    }

    public function categoryDelete($id){
        $category = Category::find($id);
        $category->delete();
        $notification=array(
            'messege'=>'Category Deleted Successfully',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);
    }

    public function categoryEdit($id){
        $category = Category::find($id);
        return view('admin_backend.pages.category.edit_category',['category'=>$category]);

    }

    public function categoryUpdate(Request $request,$id){
        $validated = $request->validate([
            'category_name' => 'required|max:255|min:2'
        ]);

        $category = Category::find($id);
        $category->category_name = $request->category_name;
        if($category->save()){
            $notification=array(
                'messege'=>'Category Updated Successfully',
                'alert-type'=>'success'
                );
            return redirect('admin/category')->with($notification);
        }else{
            $notification=array(
                'messege'=>'Nothing To Update',
                'alert-type'=>'alert'
                );
            return redirect('admin/category')->back()->with($notification);
        }
    }
}
