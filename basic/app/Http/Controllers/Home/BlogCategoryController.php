<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    //

    public function AllBlogCategory()
    {
        $blogcategory = BlogCategory::latest()->get();

        return view('admin.blog_category.blog_category_all',compact('blogcategory'));
    }//end method

    public function AddBlogCategory()
    {
        return view('admin.blog_category.blog_category_add');   
    }//end method

    public function StoreBlogCategory(Request $request)
    {
       
       
            BlogCategory::insert([
                'blog_category'=> $request->blog_category,
               
            ]);

            session()->flash('message','Blog Category Name inserted  Successfully');

            return redirect()->route('all.blog.category');

    }//end method

    public function EditBlogCategory($id)
    {
        
        $blogcategory = BlogCategory::findOrFail($id);

        return view('admin.blog_category.blog_category_edit',compact('blogcategory'));
    }//end method
    public function UpdateBlogCategory(Request $request,$id)
    {

         BlogCategory::findOrFail($id)->update([
                'blog_category'=> $request->blog_category,
               
            ]);

            session()->flash('message','Blog Category Name updated  Successfully');

            return redirect()->route('all.blog.category');

    }//end method

    public function DeleteBlogCategory($id)
    {
         BlogCategory::findOrFail($id)->delete();

        session()->flash('message','Blog Category is deleted  Successfully'); 

        return redirect()->back(); 
    }//end method
}
