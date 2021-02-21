<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;

class SubCategoryController extends Controller{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function subCategory(){
        $categories = Category::all();
        $subCats = SubCategory::join('categories','sub_categories.category_id','categories.id')
                                    ->select('sub_categories.*','categories.category_name')
                                            ->get();
        return view('admin_backend.pages.category.sub_category',['categories'=>$categories,'subCats'=>$subCats]);
    }

    public function storeSubCategory(Request $request){
        $validated = $request->validate([
            'subcategory_name' => 'required|unique:sub_categories|max:255|min:2',
            'category_id' => 'required',
        ]);

        $subCats = new SubCategory();
        $subCats->category_id = $request->category_id;
        $subCats->subcategory_name = $request->subcategory_name;
        if ($subCats->save()) {
            $notification=array(
                'messege'=>'Successfully Sub Category Inserted',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else {
            $notification=array(
                'messege'=>'Failed to insert Subb Category ',
                'alert-type'=>'alert'
                );
            return redirect()->back()->with($notification);
        }
    }

    public function subCategoryDelete($id){
        $subCats = SubCategory::find($id);
        $subCats->delete();

        $notification=array(
            'messege'=>'Successfully Sub Category Deleted',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);
    }

    public function subCategoryEdit(Request $request, $id){
        $subCats = SubCategory::find($id);
        $categories = Category::all();
        return view('admin_backend.pages.category.edit_sub_category',['subCats'=>$subCats,'categories'=>$categories]);
    }

    public function subCategoryUpdate(Request $request, $id){
        $validated = $request->validate([
            'subcategory_name' => 'required|max:255|min:2',
            'category_id' => 'required',
        ]);

        $subCats = SubCategory::find($id);
        $subCats->category_id = $request->category_id;
        $subCats->subcategory_name = $request->subcategory_name;
        if ($subCats->save()) {
            $notification=array(
                'messege'=>'Successfully Sub Category Updated',
                'alert-type'=>'success'
                );
            return redirect('admin/sub/category')->with($notification);
       }
    }

}
