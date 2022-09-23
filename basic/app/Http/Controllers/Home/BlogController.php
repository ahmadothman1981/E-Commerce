<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use Image;
use Illuminate\Support\Carbon;

class BlogController extends Controller
{
    //
    public function AllBlog()
    {
        $blogs = Blog::latest()->get();

        return view('admin.blogs.blogs_all',compact('blogs'));
    }//End Method

    public function AddBlog()
    {
        $categories = BlogCategory::orderBy('blog_category','ASC')->get();
        return view('admin.blogs.blogs_add',compact('categories'));
    }//End Method

    public function StoreBlog(Request $request)
    {
        $image = $request->file('blog_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(430,327)->save('upload/blog/'.$name_gen);
            $save_url = 'upload/blog/'.$name_gen;
            Blog::insert([
                'blog_category_id'=> $request->blog_category_id,
                'blog_title'=>$request->blog_title,
                'blog_tags'=>$request->blog_tags,
                'blog_description' =>  $request->blog_description,
               'blog_image' => $save_url,
               'created_at'=>Carbon::now(),
            ]);

        session()->flash('message','Blog inserted  Successfully');

        return redirect()->route('all.blog');
    }//End Method

    public function EditBlog($id)
    {
        $blogs = Blog::findOrFail($id);
        $categories = BlogCategory::orderBy('blog_category','ASC')->get();

        return view('admin.blogs.blogs_edit',compact('blogs','categories')); 
    }//End Method

    public function UpdateBlog(Request $request)
    {
        $blog_id = $request->id;

        if($request->file('blog_image'))
        {
            $image = $request->file('blog_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(430,327)->save('upload/blog/'.$name_gen);
            $save_url = 'upload/blog/'.$name_gen;
           Blog::findOrFail( $blog_id)->update([
               'blog_category_id'=> $request->blog_category_id,
                'blog_title'=>$request->blog_title,
                'blog_tags'=>$request->blog_tags,
                'blog_description' =>  $request->blog_description,
               'blog_image' => $save_url,
            ]);

        session()->flash('message','Blog updated with image Successfully');

        return redirect()->route('all.blog');
    }else
    {
     
       Blog::findOrFail( $blog_id)->update([
                'blog_category_id'=> $request->blog_category_id,
                'blog_title'=>$request->blog_title,
                'blog_tags'=>$request->blog_tags,
                'blog_description' =>  $request->blog_description,
              
            ]);

        session()->flash('message','Blog updated without image Successfully');

        return redirect()->route('all.blog');  
         }//end else
    }//End Method

    public function DeleteBlog($id)
    {
         $blog =  Blog::findOrFail($id);
        $img = $blog->blog_image;
        unlink($img);
        Blog::findOrFail($id)->delete();

        session()->flash('message','Blog Image is deleted  Successfully'); 

        return redirect()->back(); 
    }//End Method

    public function BlogDetails($id)
    {
        $allblogs =  $blogs = Blog::latest()->limit(5)->get();
        $blogs = Blog::findOrFail($id);
         $categories = BlogCategory::orderBy('blog_category','ASC')->get();
        return view('frontend.blog_details',compact('blogs','allblogs','categories'));
    }//End Method
}
