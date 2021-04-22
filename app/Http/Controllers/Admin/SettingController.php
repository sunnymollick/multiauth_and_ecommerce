<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Setting;
use Image;

class SettingController extends Controller{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function siteSetting(){
        $setting = Setting::first();
        return view('admin_backend.pages.setting.site_setting',['setting'=>$setting]);
    }

    public function updateSiteSetting(Request $request, $id){
        $setting = Setting::find($id);

        if($request->file('logo')){
            $image = $request->file('logo');
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $path = 'uploads/site_logo/';
            $image_url =  $path.$image_full_name;
            Image::make($image)->save($image_url);

            $setting->company_name = $request->company_name;
            $setting->email = $request->email;
            $setting->phone_one = $request->phone_one;
            $setting->phone_two = $request->phone_two;
            $setting->company_address = $request->company_address;
            $setting->vat = $request->vat;
            $setting->shipping_charge = $request->shipping_charge;
            $setting->facebook = $request->facebook;
            $setting->youtube = $request->youtube;
            $setting->instagram = $request->instagram;
            $setting->twitter = $request->twitter;
            if ($setting->logo) {
                unlink($setting->logo);
            }
            $setting->logo = $image_url;
            $setting->save();

            $notification=array(
                'messege'=>'Setting Updated Successfully',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);


        }else {
            $setting->company_name = $request->company_name;
            $setting->email = $request->email;
            $setting->phone_one = $request->phone_one;
            $setting->phone_two = $request->phone_two;
            $setting->company_address = $request->company_address;
            $setting->vat = $request->vat;
            $setting->shipping_charge = $request->shipping_charge;
            $setting->facebook = $request->facebook;
            $setting->youtube = $request->youtube;
            $setting->instagram = $request->instagram;
            $setting->twitter = $request->twitter;
            $setting->save();

            $notification=array(
                'messege'=>'Setting Updated Successfully',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }
    }
}
