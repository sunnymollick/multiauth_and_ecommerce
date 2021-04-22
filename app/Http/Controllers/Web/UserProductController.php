<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Category;
use Cart;

class UserProductController extends Controller{
    public function productView($id,$product_name){
        $product = Product::join('categories','products.category_id','categories.id')
                            ->join('sub_categories','products.subcategory_id','sub_categories.id')
                            ->join('brands','products.brand_id','brands.id')
                            ->select('products.*','categories.category_name','sub_categories.subcategory_name','brands.brand_name')
                            ->where('products.id',$id)
                            ->first();

        $color = $product->product_color;
        $product_color = explode(',',$color);

        $size = $product->product_size;
        $product_size = explode(',',$size);

        return view('frontend.pages.product_details',['product'=>$product,'product_color'=>$product_color,'product_size'=>$product_size]);
    }

    public function addCart(Request $request, $id){
        $product = Product::find($id);
        $data = array();

        if ($product->discount_price == NULL) {
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = $request->qty;
            $data['price'] = $product->selling_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = $request->color;
            $data['options']['size'] = $request->size;
            Cart::add($data);
            $notification=array(
                'messege'=>'Successfully Added On Your Cart ',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else {
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = $request->qty;
            $data['price'] = $product->discount_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = $request->color;
            $data['options']['size'] = $request->size;
            Cart::add($data);
            $notification=array(
                'messege'=>'Successfully Added On Your Cart ',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }
    }

    public function productsView($id){
        $products = Product::where('subcategory_id',$id)->latest()->paginate(15);
        $sub_cat = SubCategory::find($id);
        $categories = Category::all();
        $brands = Product::where('subcategory_id',$id)->select('brand_id')->groupBy('brand_id')->get();

        return view('frontend.pages.cat_all_products',['products'=>$products,'sub_cat'=>$sub_cat,'categories'=>$categories,'brands'=>$brands]);
    }

    public function categoryProductView($id){
        $products = Product::where('category_id',$id)->paginate(10);
        $cat = Category::find($id);
        $categories = Category::all();
        $brands = Product::where('category_id',$id)->select('brand_id')->groupBy('brand_id')->get();
        return view('frontend.pages.category_products',['products'=>$products,'cat'=>$cat,'categories'=>$categories,'brands'=>$brands]);
    }
}
