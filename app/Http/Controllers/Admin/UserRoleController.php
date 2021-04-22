<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class UserRoleController extends Controller{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function userRole(){
        $user = Admin::where('type',2)->get();
        return view('admin_backend.pages.role.all_role',['user'=>$user]);
    }

    public function userCreate(){
        return view('admin_backend.pages.role.create_role');
    }

    public function storeUser(Request $request){
        $admin = new Admin();

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->category = $request->category;
        $admin->coupon = $request->coupon;
        $admin->product = $request->product;
        $admin->blog = $request->blog;
        $admin->order = $request->order;
        $admin->other = $request->other;
        $admin->report = $request->report;
        $admin->role = $request->role;
        $admin->return = $request->return;
        $admin->contact = $request->contact;
        $admin->stock = $request->stock;
        $admin->comment = $request->comment;
        $admin->setting = $request->setting;
        $admin->type = 2;
        $admin->save();
        $notification=array(
            'messege'=>'Child Admin Created Successfully',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);
    }

    public function userDelete($id){
        $admin = Admin::find($id);
        if ($admin->profile_photo_path) {
            unlink($admin->profile_photo_path);
        }
        $admin->delete();
        $notification=array(
            'messege'=>'Child Admin Deleted Successfully',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);
    }

    public function userEdit($id){
        $admin = Admin::find($id);
        return view('admin_backend.pages.role.edit_role',['admin'=>$admin]);
    }

    public function userUpdate(Request $request, $id){
        $admin = Admin::find($id);

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->category = $request->category;
        $admin->coupon = $request->coupon;
        $admin->product = $request->product;
        $admin->blog = $request->blog;
        $admin->order = $request->order;
        $admin->other = $request->other;
        $admin->report = $request->report;
        $admin->role = $request->role;
        $admin->return = $request->return;
        $admin->stock = $request->stock;
        $admin->contact = $request->contact;
        $admin->comment = $request->comment;
        $admin->setting = $request->setting;
        $admin->save();
        $notification=array(
            'messege'=>'Child Admin Updated Successfully',
            'alert-type'=>'success'
            );
        return redirect()->route('admin.all.user')->with($notification);
    }
}
