<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Newsletter;
use App\Models\Admin\Product;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Web\Order;


class FrontController extends Controller{
    public function index(){
        $categories = Category::all();
        $featured = Product::where('status',1)->latest()->limit(12)->get();
        $trend = Product::where('status',1)->where('trend',1)->latest()->limit(8)->get();
        $best_rated = Product::where('status',1)->where('best_rated',1)->latest()->limit(8)->get();
        $hot_deal = Product::join('brands','products.brand_id','brands.id')
                                ->select('products.*','brands.brand_name')
                                    ->where('products.status',1)
                                        ->where('products.hot_deal',1)
                                            ->latest()
                                                ->limit(3)
                                                    ->get();

        $mid_slider = Product::join('categories','products.category_id','categories.id')
                                ->join('brands','products.brand_id','brands.id')
                                    ->select('products.*','categories.category_name','brands.brand_name')
                                        ->where('products.status',1)->where('products.mid_slider',1)
                                            ->latest()->limit(3)->get();

        return view('frontend.pages.index',['featured'=>$featured,'trend'=>$trend,'best_rated'=>$best_rated,'hot_deal'=>$hot_deal,'categories'=>$categories,'mid_slider'=>$mid_slider]);
    }

    public function storeNewsletter(Request $request){
        $validated = $request->validate([
            'email' => 'required|email'
        ]);

        $newsletters = new Newsletter();

        $newsletters->email = $request->email;
        $newsletters->save();

        $notification=array(
            'messege'=>'Thanks For Subscribs Us ',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);
    }

    public function orderTracking(Request $request){
        $code = $request->code;
        $track = Order::where('status_code',$code)->first();
        if ($track) {
            return view('frontend.pages.tracking',['track'=>$track]);
        } else {
            $notification=array(
                'messege'=>'Invalid Status Code ',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }

    public function search(Request $request){
        $item = $request->search;

        $categories = Category::all();
        $brands = Brand::all();

        $products = Product::where('product_name','LIKE',"%$item%")->paginate(20);

        return view('frontend.pages.search',['products'=>$products,'categories'=>$categories,'brands'=>$brands]);
    }
}
