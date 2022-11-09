<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Newsletter;
use DB;

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

    public function deleteAllNewsletter(Request $request){
        $ids = $request->get('ids');
        $dbs = DB::delete('delete from newsletters where id in ('.implode(",",$ids).')');

        $notification=array(
            'messege'=>'Successfully Selected Subscriber Deleted',
            'alert-type'=>'info'
            );
        return redirect()->back()->with($notification);
    }


}
