<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Setting;
use App\Models\Contact;

class ContactController extends Controller{
    public function contact(){
        $setting = Setting::first();
        return view('frontend.pages.contact',['setting'=>$setting]);
    }

    public function contactForm(Request $request){
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->save();

        $notification=array(
            'messege'=>'Thanks For Contacting With Us ',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);
    }


}
