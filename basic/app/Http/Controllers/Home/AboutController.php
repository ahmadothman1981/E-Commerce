<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use Image;

class AboutController extends Controller
{
    //
    public function AboutPage()
    {
        $aboutpage = About::find(1);

        return view('admin.about_page.about_page_all',compact('aboutpage'));
    }//end method 

    public function UpdateAbout(Request $request)
    {
        $about_id = $request->id;

        if($request->file('about_image'))
        {
            $image = $request->file('about_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(523,605)->save('upload/home_about/'.$name_gen);
            $save_url = 'upload/home_about/'.$name_gen;
            About::findOrFail( $about_id)->update([
                'title'=> $request->title,
                'short_title'=>$request->short_title,
                'short_description'=>$request->short_description,
                'long_description'=>$request->long_description,
                'about_image' => $save_url,
            ]);

        session()->flash('message','About Page updated with image Successfully');

        return redirect()->back();
    }else
    {
     
       About::findOrFail( $about_id)->update([
                'title'=> $request->title,
                'short_title'=>$request->short_title,
                'short_description'=>$request->short_description,
                'long_description'=>$request->long_description,
              
            ]);

        session()->flash('message','about page updated without image Successfully');

        return redirect()->back();  
    }//end else

    }//end method

    public function HomeAbout()
    {
        $aboutpage = About::find(1);
        return view('frontend.about_page',compact('aboutpage'));
    }//end method
}
