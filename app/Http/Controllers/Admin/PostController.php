<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\PostCategory;
use App\Models\Admin\Post;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function BlogCatList(){
        $blogcats = PostCategory::all();
        return view('admin_backend.pages.blog.category.index',['blogcats'=>$blogcats]);
    }

    public function BlogCatStore(Request $request){
        $validated = $request->validate([
            'category_name_en' => 'required|max:255',
            'category_name_in' => 'required|max:255',
        ]);

        $blogcat = new PostCategory();

        $blogcat->category_name_en = $request->category_name_en;
        $blogcat->category_name_in = $request->category_name_in;
        $blogcat->save();

        $notification=array(
            'messege'=>'Category Inserted Successfully',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);
    }

    public function DeleteBlogCat($id){
        $blogcat = PostCategory::find($id);
        $blogcat->delete();
        $notification=array(
            'messege'=>'Blog Category Deleted Successfully',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);
    }

    public function EditBlogCat($id){
        $blogcat = PostCategory::find($id);
        return view('admin_backend.pages.blog.category.edit',['blogcat'=>$blogcat]);
    }

    public function UpdateBlogCat(Request $request, $id){
        $validated = $request->validate([
            'category_name_en' => 'required|max:255',
            'category_name_in' => 'required|max:255',
        ]);

        $blogcat = PostCategory::find($id);
        $blogcat->category_name_en = $request->category_name_en;
        $blogcat->category_name_in = $request->category_name_in;
        $blogcat->save();
        $notification=array(
            'messege'=>'Blog Category Updated Successfully',
            'alert-type'=>'success'
            );
        return redirect('blog/category/list')->with($notification);
    }

    public function create(){
        $blogcats = PostCategory::all();
        return view('admin_backend.pages.blog.post.create',['blogcats'=>$blogcats]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'post_title_en' => 'required|max:255',
            'post_title_in' => 'required|max:255',
            'category_id' => 'required',
            'details_en' => 'required',
            'details_in' => 'required',
            'post_image' => 'required|mimes:jpg,bmp,png',
        ]);

        $post = New Post();

        if ($request->file('post_image')) {
            $image = $request->file('post_image');
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $path = 'uploads/post-images/';
            $image_url =  $path.$image_full_name;
            Image::make($image)->resize(1920,460)->save($image_url);

            $post->post_title_en = $request->post_title_en;
            $post->post_title_in = $request->post_title_in;
            $post->category_id = $request->category_id;
            $post->details_en = $request->details_en;
            $post->details_in = $request->details_in;
            $post->post_image = $image_url;
            $post->save();
            $notification=array(
                'messege'=>'Post Inserted Successfully',
                'alert-type'=>'success'
                );
            return redirect('all/blog/post')->with($notification);
        }
    }

    public function index(){
        $posts = Post::join('post_categories','posts.category_id','post_categories.id')
                                ->select('posts.*','post_categories.category_name_en as category')
                                        ->get();
        return view('admin_backend.pages.blog.post.index',['posts'=>$posts]);
    }

    public function delete($id){
        $post = Post::find($id);
        $image = $post->post_image;
        unlink($image);
        $post->delete();
        $notification=array(
            'messege'=>'Blog Post Deleted Successfully',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);
    }

    public function EditPost($id){
        $post = Post::find($id);
        $blogcats = PostCategory::all();

        return view('admin_backend.pages.blog.post.edit',['post'=>$post,'blogcats'=>$blogcats]);

    }

    public function updatePost(Request $request, $id){
        $validated = $request->validate([
            'post_title_en' => 'required|max:255',
            'post_title_in' => 'required|max:255',
            'category_id' => 'required',
            'details_en' => 'required',
            'details_in' => 'required',
        ]);

        $post = Post::find($id);

        if ($request->file('post_image')) {
            $image = $request->file('post_image');
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $path = 'uploads/post-images/';
            $image_url =  $path.$image_full_name;
            unlink($post->post_image);
            Image::make($image)->resize(1920,460)->save($image_url);

            $post->post_title_en = $request->post_title_en;
            $post->post_title_in = $request->post_title_in;
            $post->category_id = $request->category_id;
            $post->details_en = $request->details_en;
            $post->details_in = $request->details_in;
            $post->post_image = $image_url;
            $post->save();
            $notification=array(
                'messege'=>'Post Updated Successfully',
                'alert-type'=>'success'
                );
            return redirect('all/blog/post')->with($notification);
        }else{
            $post->post_title_en = $request->post_title_en;
            $post->post_title_in = $request->post_title_in;
            $post->category_id = $request->category_id;
            $post->details_en = $request->details_en;
            $post->details_in = $request->details_in;
            $post->save();
            $notification=array(
                'messege'=>'Post updated Successfully',
                'alert-type'=>'success'
                );
            return redirect('all/blog/post')->with($notification);
        }
    }

    public function viewPost($id){
        $post = Post::find($id);
        $blogcats = PostCategory::all();
        return view('admin_backend.pages.blog.post.view',['post'=>$post,'blogcats'=>$blogcats]);
    }
}
