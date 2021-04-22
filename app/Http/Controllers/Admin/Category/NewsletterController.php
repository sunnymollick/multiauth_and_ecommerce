<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Newsletter;

class NewsletterController extends Controller{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function newsletter(){
        $newsletters = Newsletter::all();
        return view('admin_backend.pages.coupon.newsletter',['newsletters'=>$newsletters]);
    }

    public function subscriberDelete($id){
        $subscriber = Newsletter::find($id);
        $subscriber->delete();

        $notification=array(
            'messege'=>'Successfully Subscriber Deleted',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);
    }


}
