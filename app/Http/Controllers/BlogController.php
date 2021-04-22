<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Post;
use Session;

class BlogController extends Controller{
    public function blog(){
        $post = Post::join('post_categories','posts.category_id','post_categories.id')
                            ->select('posts.*','post_categories.category_name_en','post_categories.category_name_in')
                                ->get();
        return view('frontend.pages.blog',['post'=>$post]);
    }

    public function english(){
        Session::get('lang');
        Session()->forget('lang');
        Session::put('lang','english');
        return redirect()->back();
    }

    public function bangla(){
        Session::get('lang');
        Session()->forget('lang');
        Session::put('lang','bangla');
        return redirect()->back();
    }

    public function singleBlog($id){
        $post = Post::find($id);
        $all_post = Post::join('post_categories','posts.category_id','post_categories.id')
                            ->select('posts.*','post_categories.category_name_en','post_categories.category_name_in')
                                ->limit(3)
                                    ->latest()
                                        ->get();
        return view('frontend.pages.single_blog',['post'=>$post,'all_post'=>$all_post]);
    }
}
