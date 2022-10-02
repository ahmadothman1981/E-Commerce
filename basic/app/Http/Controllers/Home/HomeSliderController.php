<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlide;
use Image;
class HomeSliderController extends Controller
{
    public function HomeSlider()
    {
        $homeslide = HomeSlide::find(1);

        return view('admin.home_slide.home_slide_all',compact('homeslide'));
    }//end method 

    public function UpdateSlider(Request $request)
    {
        $slide_id = $request->id;

        if($request->file('home_slide'))
        {
            $image = $request->file('home_slide');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(636,852)->save('upload/home_slide/'.$name_gen);
            $save_url = 'upload/home_slide/'.$name_gen;
            HomeSlide::findOrFail( $slide_id)->update([
                'title'=> $request->title,
                'short_title'=>$request->short_title,
                'video_url' =>  $request->video_url,
               'home_slide' => $save_url,
            ]);

        session()->flash('message','Slide updated with image Successfully');

        return redirect()->back();
    }else
    {
     
       HomeSlide::findOrFail( $slide_id)->update([
                'title'=> $request->title,
                'short_title' =>$request->short_title,
                'video_url' => $request->video_url,
              
            ]);

        session()->flash('message','Slide updated without image Successfully');

        return redirect()->back();  
    }//end else

    }//end method

    public function HomeMain()
    {
     return view('frontend.index');  
    }//end method
}
