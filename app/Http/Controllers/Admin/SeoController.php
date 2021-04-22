<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\SEO;

class SeoController extends Controller{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function seo(){
        $seo = SEO::first();
        return view('admin_backend.pages.seo.seo',['seo'=>$seo]);
    }

    public function seoUpdate(Request $request, $id){
        $seo = SEO::find($id);
        $seo->meta_title = $request->meta_title;
        $seo->meta_author = $request->meta_author;
        $seo->meta_tag = $request->meta_tag;
        $seo->meta_description = $request->meta_description;
        $seo->google_analytics = $request->google_analytics;
        $seo->bing_analytics = $request->bing_analytics;
        $seo->save();

        $notification=array(
            'messege'=>'SEO Updated Successfully',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);
    }
}
