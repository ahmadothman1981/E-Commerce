<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Footer;
use App\Models\MultiImage;


class FooterController extends Controller
{
    public function FooterSetup()
    {
        $allfooter = Footer::find(1);

        return view('admin.footer.footer_all',compact('allfooter'));
    }//EndMethod

    public function UpdateFooter(Request $request)
    {
        $footer_id = $request->id;

         Footer::findOrFail( $footer_id)->update([
                'number'=> $request->number,
                'short_description'=>$request->short_description,
                'address'=>$request->address,
                'email'=>$request->email,
                'facebook'=>$request->facebook,
                'twitter'=>$request->twitter,
                'copyright'=>$request->copyright,
                
            ]);

        session()->flash('message','Footer Page updated Successfully');

        return redirect()->back();
    }//EndMethod
}
