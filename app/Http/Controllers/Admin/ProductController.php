<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Brand;
use App\Models\Admin\Product;
use App\Models\Admin\SubCategory;
use Intervention\Image\Facades\Image;

class ProductController extends Controller{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function create(){
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin_backend.pages.product.create_product',['categories'=>$categories,'brands'=>$brands]);
    }

    public function getSubcategory($id){
        $subcategory = SubCategory::where('category_id',$id)->get();

        return json_encode($subcategory);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'product_name' => 'required|max:255|min:2',
            'product_code' => 'required',
            'product_quantity' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            'product_size' => 'required',
            'product_color' => 'required',
            'selling_price' => 'required',
            'product_details' => 'required',
            'image_one' => 'required|mimes:jpg,bmp,png',
            'image_two' => 'required|mimes:jpg,bmp,png',
            'image_three' => 'required|mimes:jpg,bmp,png',
        ]);

        $products = new Product();

        $products->product_name = $request->product_name;
        $products->product_code = $request->product_code;
        $products->product_quantity = $request->product_quantity;
        $products->discount_price = $request->discount_price;
        $products->category_id = $request->category_id;
        $products->subcategory_id = $request->subcategory_id;
        $products->brand_id = $request->brand_id;
        $products->product_size = $request->product_size;
        $products->product_color = $request->product_color;
        $products->selling_price = $request->selling_price;
        $products->product_details = $request->product_details;
        $products->video_link = $request->video_link;
        $products->main_slider = $request->main_slider;
        $products->hot_deal = $request->hot_deal;
        $products->best_rated = $request->best_rated;
        $products->trend = $request->trend;
        $products->mid_slider = $request->mid_slider;
        $products->hot_new = $request->hot_new;
        $products->buyone_getone = $request->buyone_getone;
        $products->status = 1;

        $image_one = $request->file('image_one');
        $image_two = $request->file('image_two');
        $image_three = $request->file('image_three');

        if ($image_one && $image_two && $image_three) {
            $image_one = $request->file('image_one');
            $image_one_name = hexdec(uniqid());
            $ext = strtolower($image_one->getClientOriginalExtension());
            $image_full_name = $image_one_name.'.'.$ext;
            $path = 'uploads/product-images/';
            $image_url_1 =  $path.$image_full_name;
            Image::make($image_one)->resize(300,300)->save($image_url_1);

            $products->image_one = $image_url_1;


            $image_two = $request->file('image_two');
            $image_two_name = hexdec(uniqid());
            $ext = strtolower($image_two->getClientOriginalExtension());
            $image_full_name = $image_two_name.'.'.$ext;
            $path = 'uploads/product-images/';
            $image_url_2 =  $path.$image_full_name;
            Image::make($image_two)->resize(300,300)->save($image_url_2);

            $products->image_two = $image_url_2;



            $image_three = $request->file('image_three');
            $image_three_name = hexdec(uniqid());
            $ext = strtolower($image_three->getClientOriginalExtension());
            $image_full_name = $image_three_name.'.'.$ext;
            $path = 'uploads/product-images/';
            $image_url_3 =  $path.$image_full_name;
            Image::make($image_three)->resize(300,300)->save($image_url_3);

            $products->image_three = $image_url_3;

        }

        $products->save();
        $notification=array(
            'messege'=>'Products Inserted Successfully',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);

        // return response()->json($products);
    }

    public function index(){
        $products = Product::join('categories','products.category_id','categories.id')
                        ->join('brands','products.brand_id','brands.id')
                            ->select('products.*','categories.category_name','brands.brand_name')
                                ->get();
        return view('admin_backend.pages.product.index',['products'=>$products]);

    }

    public function inactive($id){
        $products = Product::find($id);
        $products->status = 0;
        $products->save();

        $notification=array(
            'messege'=>'Products Inactivated Successfully',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);
    }

    public function active($id){
        $products = Product::find($id);
        $products->status = 1;
        $products->save();

        $notification=array(
            'messege'=>'Products Activated Successfully',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);
    }

    public function deleteProduct($id){
        $products = Product::find($id);
        $image_one = $products->image_one;
        $image_two = $products->image_two;
        $image_three = $products->image_three;
        if ($image_one) {
            unlink($image_one);
        }
        if ($image_two) {
            unlink($image_two);
        }
        if ($image_three) {
            unlink($image_three);
        }

        $products->delete();

        $notification=array(
            'messege'=>'Products Deleted Successfully',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);
    }

    public function viewProduct($id){
        $product = Product::join('categories','products.category_id','categories.id')
                    ->join('sub_categories','products.subcategory_id','sub_categories.id')
                        ->join('brands','products.brand_id','brands.id')
                            ->select('products.*','categories.category_name','brands.brand_name','sub_categories.subcategory_name')
                                ->where('products.id',$id)
                                    ->first();

        return view('admin_backend.pages.product.show_product',['product'=>$product]);
    }

    public function editProduct($id){
        $product = Product::find($id);
        $categories = Category::all();
        $brands = Brand::all();
        $subcategories = SubCategory::all();
        return view('admin_backend.pages.product.edit_product',['product'=>$product,'categories'=>$categories,'brands'=>$brands,'subcategories'=>$subcategories]);
    }

    public function updateProductWithoutImage(Request $request, $id){
        $products = Product::find($id);

        $products->product_name = $request->product_name;
        $products->product_code = $request->product_code;
        $products->product_quantity = $request->product_quantity;
        $products->discount_price = $request->discount_price;
        $products->category_id = $request->category_id;
        $products->subcategory_id = $request->subcategory_id;
        $products->brand_id = $request->brand_id;
        $products->product_size = $request->product_size;
        $products->product_color = $request->product_color;
        $products->selling_price = $request->selling_price;
        $products->product_details = $request->product_details;
        $products->video_link = $request->video_link;
        $products->main_slider = $request->main_slider;
        $products->hot_deal = $request->hot_deal;
        $products->best_rated = $request->best_rated;
        $products->trend = $request->trend;
        $products->mid_slider = $request->mid_slider;
        $products->hot_new = $request->hot_new;
        $products->buyone_getone = $request->buyone_getone;

        $products->save();

        $notification=array(
            'messege'=>'Products Updated Successfully',
            'alert-type'=>'success'
            );
        return redirect('admin/all/product')->with($notification);

    }

    public function updateProductWithImage(Request $request,$id){
        $products = Product::find($id);
        $image_one = $request->file('image_one');
        $image_two = $request->file('image_two');
        $image_three = $request->file('image_three');

        if ($image_one &&  $image_two &&  $image_three) {
            $image_one = $request->file('image_one');
            $image_one_name = hexdec(uniqid());
            $ext = strtolower($image_one->getClientOriginalExtension());
            $image_full_name = $image_one_name.'.'.$ext;
            $path = 'uploads/product-images/';
            $image_url_1 =  $path.$image_full_name;
            unlink($products->image_one);
            Image::make($image_one)->resize(300,300)->save($image_url_1);

            $products->image_one = $image_url_1;


            $image_two = $request->file('image_two');
            $image_two_name = hexdec(uniqid());
            $ext = strtolower($image_two->getClientOriginalExtension());
            $image_full_name = $image_two_name.'.'.$ext;
            $path = 'uploads/product-images/';
            $image_url_2 =  $path.$image_full_name;
            unlink($products->image_two);
            Image::make($image_two)->resize(300,300)->save($image_url_2);

            $products->image_two = $image_url_2;



            $image_three = $request->file('image_three');
            $image_three_name = hexdec(uniqid());
            $ext = strtolower($image_three->getClientOriginalExtension());
            $image_full_name = $image_three_name.'.'.$ext;
            $path = 'uploads/product-images/';
            $image_url_3 =  $path.$image_full_name;
            unlink($products->image_three);
            Image::make($image_three)->resize(300,300)->save($image_url_3);

            $products->image_three = $image_url_3;

        }elseif($image_one &&  $image_two){
            $image_one = $request->file('image_one');
            $image_one_name = hexdec(uniqid());
            $ext = strtolower($image_one->getClientOriginalExtension());
            $image_full_name = $image_one_name.'.'.$ext;
            $path = 'uploads/product-images/';
            $image_url_1 =  $path.$image_full_name;
            unlink($products->image_one);
            Image::make($image_one)->resize(300,300)->save($image_url_1);

            $products->image_one = $image_url_1;


            $image_two = $request->file('image_two');
            $image_two_name = hexdec(uniqid());
            $ext = strtolower($image_two->getClientOriginalExtension());
            $image_full_name = $image_two_name.'.'.$ext;
            $path = 'uploads/product-images/';
            $image_url_2 =  $path.$image_full_name;
            unlink($products->image_two);
            Image::make($image_two)->resize(300,300)->save($image_url_2);

            $products->image_two = $image_url_2;

        }elseif ($image_one &&  $image_three) {
            $image_one = $request->file('image_one');
            $image_one_name = hexdec(uniqid());
            $ext = strtolower($image_one->getClientOriginalExtension());
            $image_full_name = $image_one_name.'.'.$ext;
            $path = 'uploads/product-images/';
            $image_url_1 =  $path.$image_full_name;
            unlink($products->image_one);
            Image::make($image_one)->resize(300,300)->save($image_url_1);

            $products->image_one = $image_url_1;

            $image_three = $request->file('image_three');
            $image_three_name = hexdec(uniqid());
            $ext = strtolower($image_three->getClientOriginalExtension());
            $image_full_name = $image_three_name.'.'.$ext;
            $path = 'uploads/product-images/';
            $image_url_3 =  $path.$image_full_name;
            unlink($products->image_three);
            Image::make($image_three)->resize(300,300)->save($image_url_3);

            $products->image_three = $image_url_3;

        }elseif ($image_two && $image_three) {
            $image_two = $request->file('image_two');
            $image_two_name = hexdec(uniqid());
            $ext = strtolower($image_two->getClientOriginalExtension());
            $image_full_name = $image_two_name.'.'.$ext;
            $path = 'uploads/product-images/';
            $image_url_2 =  $path.$image_full_name;
            unlink($products->image_two);
            Image::make($image_two)->resize(300,300)->save($image_url_2);

            $products->image_two = $image_url_2;

            $image_three = $request->file('image_three');
            $image_three_name = hexdec(uniqid());
            $ext = strtolower($image_three->getClientOriginalExtension());
            $image_full_name = $image_three_name.'.'.$ext;
            $path = 'uploads/product-images/';
            $image_url_3 =  $path.$image_full_name;
            unlink($products->image_three);
            Image::make($image_three)->resize(300,300)->save($image_url_3);

            $products->image_three = $image_url_3;
        }
        elseif ($image_one) {
            $image_one = $request->file('image_one');
            $image_one_name = hexdec(uniqid());
            $ext = strtolower($image_one->getClientOriginalExtension());
            $image_full_name = $image_one_name.'.'.$ext;
            $path = 'uploads/product-images/';
            $image_url_1 =  $path.$image_full_name;
            unlink($products->image_one);
            Image::make($image_one)->resize(300,300)->save($image_url_1);

            $products->image_one = $image_url_1;
        }elseif ($image_two) {
            $image_two = $request->file('image_two');
            $image_two_name = hexdec(uniqid());
            $ext = strtolower($image_two->getClientOriginalExtension());
            $image_full_name = $image_two_name.'.'.$ext;
            $path = 'uploads/product-images/';
            $image_url_2 =  $path.$image_full_name;
            unlink($products->image_two);
            Image::make($image_two)->resize(300,300)->save($image_url_2);

            $products->image_two = $image_url_2;
        }elseif ($image_three) {
            $image_three = $request->file('image_three');
            $image_three_name = hexdec(uniqid());
            $ext = strtolower($image_three->getClientOriginalExtension());
            $image_full_name = $image_three_name.'.'.$ext;
            $path = 'uploads/product-images/';
            $image_url_3 =  $path.$image_full_name;
            unlink($products->image_three);
            Image::make($image_three)->resize(300,300)->save($image_url_3);

            $products->image_three = $image_url_3;
        }

        $products->save();

        $notification=array(
            'messege'=>'Products Updated Successfully',
            'alert-type'=>'success'
            );
        return redirect('admin/all/product')->with($notification);

    }

}
