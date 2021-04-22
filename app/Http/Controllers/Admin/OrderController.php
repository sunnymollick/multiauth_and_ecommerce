<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Web\Order;
use App\Models\Web\OrderDetails;
use App\Models\Web\Shipping;
use DB;

class OrderController extends Controller{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function newOrder(){
        $order = Order::where('status',0)->get();
        return view('admin_backend.pages.order.pending_order',['order'=>$order]);
    }

    public function viewOrder($id){
        $order = Order::join('users','orders.user_id','users.id')
                            ->select('orders.*','users.name')
                            ->where('orders.id',$id)->first();


        $shipping = Shipping::where('order_id',$id)->first();


        $orderDetails = OrderDetails::join('products','order_details.product_id','products.id')
                                        ->select('order_details.*','products.product_code','products.image_one')
                                        ->where('order_details.order_id',$id)
                                        ->get();

        return view('admin_backend.pages.order.view_order',['order'=>$order,'shipping'=>$shipping,'orderDetails'=>$orderDetails]);
    }

    public function paymentAccept($id){
        $order = Order::find($id);
        $order->status = 1;
        $order->save();
        $notification=array(
            'messege'=>'Payment Accepted',
            'alert-type'=>'success'
            );
        return redirect()->route('admin.neworder')->with($notification);
    }

    public function paymentCancel($id){
        $order = Order::find($id);
        $order->status = 4;
        $order->save();
        $notification=array(
            'messege'=>'Order Canceled',
            'alert-type'=>'error'
            );
        return redirect()->route('admin.neworder')->with($notification);
    }

    public function acceptPayment(){
        $order = Order::where('status',1)->get();
        return view('admin_backend.pages.order.pending_order',['order'=>$order]);
    }

    public function cancelOrder(){
        $order = Order::where('status',4)->get();
        return view('admin_backend.pages.order.pending_order',['order'=>$order]);
    }

    public function processPayment(){
        $order = Order::where('status',2)->get();
        return view('admin_backend.pages.order.pending_order',['order'=>$order]);
    }

    public function successPayment(){
        $order = Order::where('status',3)->get();
        return view('admin_backend.pages.order.pending_order',['order'=>$order]);
    }

    public function deliveryProcess($id){
        $order = Order::find($id);
        $order->status = 2;
        $order->save();
        $notification=array(
            'messege'=>'Send to delivery',
            'alert-type'=>'success'
            );
        return redirect()->route('admin.accept.payment')->with($notification);
    }

    public function deliveryDone($id){

        $product = DB::table('order_details')->where('order_id',$id)->get();
        foreach ($product as $row) {
            DB::table('products')
                ->where('id',$row->product_id)
                ->update(['product_quantity' => DB::raw('product_quantity-'.$row->quantity)]);
        }


        $order = Order::find($id);
        $order->status = 3;
        $order->save();
        $notification=array(
            'messege'=>'Product Delivery Done',
            'alert-type'=>'success'
            );
        return redirect()->route('admin.success.payment')->with($notification);
    }
}
