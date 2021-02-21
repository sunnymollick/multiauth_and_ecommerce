<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class MainAdminController extends Controller{
    public function adminProfile(){
        $admin = Admin::find(1);
        return view('admin_backend.pages.view_profile',['admin'=>$admin]);
    }

    public function editAdminProfile(){
        $admin = Admin::find(1);
        return view('admin_backend.pages.edit_profile',['admin'=>$admin]);
    }

    public function adminProfileUpdate(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
        ],
        [
            'name.required' => 'please insert name',
            'name.min' => 'Name is too short'
        ]);

        $admin = Admin::find(1);

        if($request->file('profile_photo_path')){
            $image = $request->file('profile_photo_path');

            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $path = 'uploads/admin-images/';
            $image_url =  $path.$image_full_name;
            $image->move($path,$image_full_name);
            if($admin->profile_photo_path){
                unlink($admin->profile_photo_path);
            }
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->profile_photo_path = $image_url;
            $admin->save();
            $notification=array(
                'messege'=>'Successfully Profile Updated',
                'alert-type'=>'success'
                );
            return redirect('admin/profile')->with($notification);
        }else{
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->save();
            $notification=array(
                'messege'=>'Successfully Profile Updated',
                'alert-type'=>'success'
                );
            return redirect('admin/profile')->with($notification);

        }
    }

    public function adminPasswordChange(){
        return view('admin_backend.pages.view_change_password');
    }

    public function updateAdminPassword(Request $request){
        $validated = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashed_password = Admin::find(1)->password;

        if (Hash::check($request->oldpassword, $hashed_password)) {
            $admin = Admin::find(1);
            $admin->password = Hash::make($request->password);
            $admin->save();

            $notification=array(
                'messege'=>'Successfully password changed',
                'alert-type'=>'success'
                );
            return redirect()->route('admin.logout')->with($notification);
        }else{
            $notification=array(
                'messege'=>'Password not updated',
                'alert-type'=>'alert'
                );
            return redirect()->back()->with($notification);
        }
    }


}
