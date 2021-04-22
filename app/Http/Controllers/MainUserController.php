<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MainUserController extends Controller{
    public function Logout(){
        Auth::logout();
        $notification=array(
            'messege'=>'Successfully Logout',
            'alert-type'=>'success'
            );
        return redirect()->to('/')->with($notification);
    }

    // public function userProfile(){
    //     $user = User::find(Auth::user()->id);
    //     return view('user_backend.pages.view_profile',['user'=>$user]);
    // }


    // public function editUserProfile(){
    //     $user = User::find(Auth::user()->id);
    //     return view('user_backend.pages.edit_profile',['user'=>$user]);
    // }

    public function userProfile(){
        $user = User::find(Auth::user()->id);
        return view('frontend.pages.user.user_profile',['user'=>$user]);
    }

    public function editUserProfile(){
        $user = User::find(Auth::user()->id);
        return view('frontend.pages.user.edit_profile',['user'=>$user]);
    }

    public function userProfileUpdate(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
        ],
        [
            'name.required' => 'please insert name',
            'name.min' => 'Name is too short'
        ]);

        $user = User::find(Auth::user()->id);

        if($request->file('profile_photo_path')){
            $image = $request->file('profile_photo_path');

            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $path = 'uploads/user-images/';
            $image_url =  $path.$image_full_name;
            $image->move($path,$image_full_name);
            if($user->profile_photo_path){
                unlink($user->profile_photo_path);
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->profile_photo_path = $image_url;
            $user->save();
            $notification=array(
                'messege'=>'Successfully Profile Updated',
                'alert-type'=>'success'
                );
            return redirect('user/profile')->with($notification);
        }else{
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            $notification=array(
                'messege'=>'Successfully Profile Updated',
                'alert-type'=>'success'
                );
            return redirect('user/profile')->with($notification);

        }
    }

    // public function userPasswordChange(){
    //     return view('user_backend.pages.change_password');
    // }

    public function userPasswordChange(){
        return view('frontend.pages.user.change_password');
    }

    public function updateUserPassword(Request $request){
        $validated = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashed_password = Auth::user()->password;

        if (Hash::check($request->oldpassword, $hashed_password)) {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            $notification=array(
                'messege'=>'Successfully password changed',
                'alert-type'=>'success'
                );
            return redirect('/login')->with($notification);
        }else{
            $notification=array(
                'messege'=>'Password not updated',
                'alert-type'=>'alert'
                );
            return redirect()->back()->with($notification);
        }
    }
}
