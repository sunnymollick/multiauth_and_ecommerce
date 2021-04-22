<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Web\Order;

class ReturnController extends Controller{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function adminRequestReturn(){
        $order = Order::where('return_order',1)->get();
        return view('admin_backend.pages.return.request',['order'=>$order]);
    }

    public function adminApproveReturn($id){
        $order = Order::find($id);
        $order->return_order = 2;
        $order->save();
        $notification=array(
            'messege'=>'Return Request Approved ',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);
    }

    public function adminAllReturn(){
        $order = Order::where('return_order',2)->get();
        return view('admin_backend.pages.return.all_return',['order'=>$order]);
    }
}
