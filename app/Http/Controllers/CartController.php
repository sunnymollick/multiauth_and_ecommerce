<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Coupon;
use App\Models\Web\Wishlist;
// use Cart;
// use Response;
// use Auth;
// use Session;
use Gloudemans\Shoppingcart\Facades\Cart;
// use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

class CartController extends Controller{
    public function addToCart($id){
        $product = Product::find($id);
        $data = array();

        if ($product->discount_price == NULL) {
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = 1;
            $data['price'] = $product->selling_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = '';
            $data['options']['size'] = '';
            Cart::add($data);
            return Response::json(['success' => 'Successfully Added On Your Cart']);
        }else {
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = 1;
            $data['price'] = $product->discount_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = '';
            $data['options']['size'] = '';
            Cart::add($data);
            return Response::json(['success' => 'Successfully Added On Your Cart']);
        }
    }

    public function checkCart(){
        $content = Cart::content();
        return response()->json($content);
    }

    public function showCart(){
        $cart = Cart::content();
        return view('frontend.pages.cart.show_cart',['cart'=>$cart]);
    }

    public function removeCart($rowId){
        Cart::remove($rowId);
        $notification=array(
            'messege'=>'Successfully Removed From Cart ',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);
    }

    public function updateCart(Request $request ,$rowId){
        $qty = $request->qty;
        Cart::update($rowId,$qty);
        $notification=array(
            'messege'=>'Successfully Quantity Updated ',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);
    }

    public function viewProduct($id){
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

        return response::json(array(
            'product' => $product,
            'color' => $product_color,
            'size' => $product_size,
        ));
    }

    public function insertCart(Request $request){
        $id = $request->product_id;
        $product = Product::find($id);
        $color = $request->color;
        $size = $request->size;
        $qty = $request->qty;
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



    public function checkout(){
        if (Auth::check()) {
            $cart = Cart::content();
            return view('frontend.pages.cart.checkout',['cart'=>$cart]);
        }else{
            $notification=array(
                'messege'=>'At First Login Your Account ',
                'alert-type'=>'error'
                );
            return redirect()->route('login')->with($notification);
        }
    }

    public function wishlist(){
        $userid = Auth::id();
        $product = Wishlist::join('products','wishlists.product_id','products.id')
                                ->select('products.*','wishlists.user_id')
                                    ->where('wishlists.user_id',$userid)
                                        ->get();
        return view('frontend.pages.cart.wishlist',['product'=>$product]);
    }

    public function coupon(Request $request){
        $coupon = $request->coupon;

        $check = Coupon::where('coupon',$coupon)->first();
        if ($check) {
            Session::put('coupon',[
                'name' => $check->coupon,
                'discount' => $check->discount,
                'balance' => Cart::subtotal() - $check->discount,
            ]);
            $notification=array(
                'messege'=>'Successfully Coupon Applied ',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Invalid Coupon ',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }
    }

    public function couponRemove(){
        Session::forget('coupon');
        $notification=array(
            'messege'=>'Successfully Coupon Removed ',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);
    }


}
