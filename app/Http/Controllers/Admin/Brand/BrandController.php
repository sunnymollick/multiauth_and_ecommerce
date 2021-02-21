<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Brand;
use Intervention\Image\Facades\Image;

class BrandController extends Controller{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function brand(){
        $brands = Brand::all();
        return view('admin_backend.pages.brand.brand',['brands'=>$brands]);
    }

    public function storeBrand(Request $request){
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|max:50|min:2',
            'brand_logo' => 'required|mimes:png,jpg',

        ]);

        $brand = new Brand();

        if($request->file('brand_logo')){
            $image = $request->file('brand_logo');
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $path = 'uploads/brand-images/';
            $image_url =  $path.$image_full_name;
            Image::make($image)->save($image_url);

            $brand->brand_name = $request->brand_name;
            $brand->brand_logo = $image_url;
            $brand->save();

            $notification=array(
                'messege'=>'Brand Inserted Successfully',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);


        }else{
            $notification=array(
                'messege'=>'Brand Not Inserted',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }

    }

    public function brandDelete($id){
        $brand = Brand::find($id);
        $image = $brand->brand_logo;
        unlink($image);
        if($brand->delete()){
            $notification=array(
                'messege'=>'Brand Deleted Successfully',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Brand Not Deleted',
                'alert-type'=>'alert'
                );
            return redirect()->back()->with($notification);
        }
    }

    public function brandEdit($id){
        $brand = Brand::find($id);
        return view('admin_backend.pages.brand.brand_edit',['brand'=>$brand]);
    }

    public function brandUpdate(Request $request, $id){
        $validated = $request->validate([
            'brand_name' => 'required|max:50|min:2',
            'brand_logo' => 'mimes:png,jpg',

        ]);

        $brand = Brand::find($id);

        if($request->file('brand_logo')){
            $image = $request->file('brand_logo');

            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $path = 'uploads/brand-images/';
            $image_url =  $path.$image_full_name;
            Image::make($image)->save($image_url);
            if($brand->brand_logo){
                unlink($brand->brand_logo);
            }
            $brand->brand_name = $request->brand_name;
            $brand->brand_logo = $image_url;
            $brand->save();

            $notification=array(
                'messege'=>'Successfully Brand Updated',
                'alert-type'=>'success'
                );
            return redirect('admin/brand')->with($notification);
        }else{
            $brand->brand_name = $request->brand_name;
            $brand->save();
            $notification=array(
                'messege'=>'Successfully Brand Updated',
                'alert-type'=>'success'
                );
            return redirect('admin/brand')->with($notification);

        }
    }


}
