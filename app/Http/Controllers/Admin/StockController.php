<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Contact;

class StockController extends Controller{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function productStock(){
        $products = Product::join('categories','products.category_id','categories.id')
                        ->join('brands','products.brand_id','brands.id')
                            ->select('products.*','categories.category_name','brands.brand_name')
                                ->get();
        return view('admin_backend.pages.stock.stock',['products'=>$products]);
    }

    public function allMessage(){
        $message = Contact::all();
        return view('admin_backend.pages.contact.all_message',['message'=>$message]);
    }

    public function viewMessage($id){
        $message = Contact::find($id);
        return view('admin_backend.pages.contact.view_message',['message'=>$message]);
    }
}
