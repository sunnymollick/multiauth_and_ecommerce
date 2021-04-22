<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Coupon;


class CouponController extends Controller{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function coupon(){
        $coupons = Coupon::all();
        return view('admin_backend.pages.coupon.coupon',['coupons'=>$coupons]);
    }

    public function storeCoupon(Request $request){
        $validated = $request->validate([
            'coupon' => 'required|unique:coupons|max:255|min:2',
            'discount' => 'required|integer',
        ]);

        $coupons = new Coupon();

        $coupons->coupon = $request->coupon;
        $coupons->discount = $request->discount;
        $coupons->save();

        $notification=array(
            'messege'=>'Successfully Coupon Inserted',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);
    }

    public function couponDelete($id){
        $coupon = Coupon::find($id);
        $coupon->delete();

        $notification=array(
            'messege'=>'Successfully Coupon Deleted',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);
    }

    public function couponEdit($id){
        $coupon = Coupon::find($id);
        return view('admin_backend.pages.coupon.edit_coupon',['coupon'=>$coupon]);
    }

    public function couponUpdate(Request $request, $id){
        $validated = $request->validate([
            'coupon' => 'required|max:255|min:2',
            'discount' => 'required|integer',
        ]);

        $coupon = Coupon::find($id);

        $coupon->coupon = $request->coupon;
        $coupon->discount = $request->discount;
        $coupon->save();

        $notification=array(
            'messege'=>'Successfully Coupon Updated',
            'alert-type'=>'success'
            );
        return redirect("admin/coupon")->with($notification);
    }


}
