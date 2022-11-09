<?php

namespace App\Http\Controllers;
// use Cart;
// use Auth;
// use Session;
use App\Models\Web\Order;
use App\Models\Web\OrderDetails;
use App\Models\Web\Shipping;
use DB;

use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class PaymentController extends Controller{
    public function payment(){
        $cart = Cart::content();
        return view('frontend.pages.payment.payment',['cart'=>$cart]);
    }

    public function paymentProcess(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:2|max:255',
            'email' => 'email|required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'payment' => 'required',
        ]);



        $data = array();

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['city'] = $request->city;
        $data['payment'] = $request->payment;

        if ($request->payment == 'stripe') {
            return view('frontend.pages.payment.stripe',['data'=>$data]);
        } elseif ($request->payment == 'paypal') {
            # code...
        } elseif ($request->payment == 'bkash') {
            # code...
        } elseif ($request->payment == 'cash_on_delivery') {
            return view('frontend.pages.payment.cash_on_delivery',['data'=>$data]);
            // $setting = DB::table('settings')->first();
            // $charge = $setting->shipping_charge;
            // $vat = $setting->vat;

            // $order = new Order();
            // $order->user_id = Auth::id();
            // $order->payment_type = $request->payment;
            // $order->shipping = $charge;
            // $order->vat = $vat;
            // $order->status_code = mt_rand(100000,999999);


            // if (Session::has('coupon')) {
            //     $order->subtotal =  Session::get('coupon')['balance']  ;
            //     $order->total = Session::get('coupon')['balance'] + $charge + $vat;
            // }else {
            //     $order->subtotal = Cart::subtotal();
            //     $order->total = Cart::subtotal() + $charge + $vat;
            // }

            // $order->status = 0;
            // $order->date = date('d-m-y');
            // $order->month = date('F');
            // $order->year = date('Y');

            // $order->save();

            // // Insert Shipping Table

            // $shipping = new Shipping();
            // $shipping->order_id = $order->id;
            // $shipping->ship_name = $request->name;
            // $shipping->ship_email = $request->email;
            // $shipping->ship_phone = $request->phone;
            // $shipping->ship_address = $request->address;
            // $shipping->ship_city = $request->city;
            // $shipping->save();

            // // Insert Order Details Table
            // $content = Cart::content();
            // $orderDetails = new OrderDetails();
            // foreach ($content as $row) {
            //     $orderDetails->order_id = $order->id;
            //     $orderDetails->product_id = $row->id;
            //     $orderDetails->product_name = $row->name;
            //     $orderDetails->color = $row->options->color;
            //     $orderDetails->size = $row->options->size;
            //     $orderDetails->quantity = $row->qty;
            //     $orderDetails->singleprice = $row->price;
            //     $orderDetails->totalprice = $row->qty*$row->price;
            //     $orderDetails->save();
            // }

            // Cart::destroy();
            // if (Session::has('coupon')) {
            //     Session::forget('coupon');
            // }
            // $notification=array(
            //     'messege'=>'Order Successfully Completed ',
            //     'alert-type'=>'success'
            //     );
            // return redirect()->to('/')->with($notification);
        }

    }

    public function stripeCharge(Request $request){

        $email = Auth::user()->email;
        $total = $request->total;

        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        \Stripe\Stripe::setApiKey('sk_test_51Ig8FWEiuiwXWBmyXsRzAWBEnfPbKgCTv3ZS0oztm4tWSjFu0zCpzXW8l97rE6bqbw7d1i2mS5szVc63LuCTq9PQ00bzjLXaE5');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
        'amount' => $total*100,
        'currency' => 'usd',
        'description' => 'OYPN Ecommerce Website',
        'source' => $token,
        'metadata' => ['order_id' => uniqid()],
        ]);


        $order = new Order();
        $order->user_id = Auth::id();
        $order->payment_id = $charge->payment_method;
        $order->payment_type = $request->payment_type;
        $order->paying_amount = $charge->amount;
        $order->blnc_transection = $charge->balance_transaction;
        $order->stripe_order_id = $charge->metadata->order_id;
        $order->shipping = $request->shipping;
        $order->vat = $request->vat;
        $order->total = $request->total;
        $order->status_code = mt_rand(100000,999999);

        if (Session::has('coupon')) {
            $order->subtotal = Session::get('coupon')['balance'] ;
        }else {
            $order->subtotal = Cart::subtotal();
        }

        $order->status = 0;
        $order->date = date('d-m-y');
        $order->month = date('F');
        $order->year = date('Y');

        $order->save();

        // Mail send to user for invoice
        Mail::to($email)->send(new InvoiceMail($order));


        // Insert Shipping Table

        $shipping = new Shipping();
        $shipping->order_id = $order->id;
        $shipping->ship_name = $request->ship_name;
        $shipping->ship_email = $request->ship_email;
        $shipping->ship_phone = $request->ship_phone;
        $shipping->ship_address = $request->ship_address;
        $shipping->ship_city = $request->ship_city;
        $shipping->save();

        // Insert Order Details Table
        $content = Cart::content();
        $orderDetails = new OrderDetails();
        foreach ($content as $row) {
            $orderDetails->order_id = $order->id;
            $orderDetails->product_id = $row->id;
            $orderDetails->product_name = $row->name;
            $orderDetails->color = $row->options->color;
            $orderDetails->size = $row->options->size;
            $orderDetails->quantity = $row->qty;
            $orderDetails->singleprice = $row->price;
            $orderDetails->totalprice = $row->qty*$row->price;
            $orderDetails->save();
        }

        Cart::destroy();
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $notification=array(
            'messege'=>'Order Process Successfully Completed ',
            'alert-type'=>'success'
            );
        return redirect()->to('/')->with($notification);


    }


    public function cashOnDelivery(Request $request){

        $email = Auth::user()->email;
        $total = $request->total;


        $order = new Order();
        $order->user_id = Auth::id();
        $order->payment_type = $request->payment_type;
        $order->shipping = $request->shipping;
        $order->vat = $request->vat;
        $order->total = $request->total;
        $order->status_code = mt_rand(100000,999999);

        if (Session::has('coupon')) {
            $order->subtotal = Session::get('coupon')['balance'] ;
        }else {
            $order->subtotal = Cart::subtotal();
        }

        $order->status = 0;
        $order->date = date('d-m-y');
        $order->month = date('F');
        $order->year = date('Y');

        $order->save();


        // Insert Shipping Table

        $shipping = new Shipping();
        $shipping->order_id = $order->id;
        $shipping->ship_name = $request->ship_name;
        $shipping->ship_email = $request->ship_email;
        $shipping->ship_phone = $request->ship_phone;
        $shipping->ship_address = $request->ship_address;
        $shipping->ship_city = $request->ship_city;
        $shipping->save();

        // Insert Order Details Table
        $content = Cart::content();
        $orderDetails = new OrderDetails();
        foreach ($content as $row) {
            $orderDetails->order_id = $order->id;
            $orderDetails->product_id = $row->id;
            $orderDetails->product_name = $row->name;
            $orderDetails->color = $row->options->color;
            $orderDetails->size = $row->options->size;
            $orderDetails->quantity = $row->qty;
            $orderDetails->singleprice = $row->price;
            $orderDetails->totalprice = $row->qty*$row->price;
            $orderDetails->save();
        }

        Cart::destroy();
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $notification=array(
            'messege'=>'Order Process Successfully Completed ',
            'alert-type'=>'success'
            );
        return redirect()->to('/')->with($notification);


    }

    public function successList(){
        $order = Order::where('user_id',Auth::id())->where('status',3)->latest()->paginate(5);
        return view('frontend.pages.user.return_order',['order'=>$order]);

    }

    public function requestReturn($id){
        $order =Order::find($id);
        $order->return_order = 1;
        $order->save();
        $notification=array(
            'messege'=>'Requested For Return ',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);
    }
}
