<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\portfolio;
use Image;
use Illuminate\Support\Carbon;

class PortfolioController extends Controller
{
    public function AllPortfolio()
    {
        $portfolio = portfolio::latest()->get();

        return view('admin.portfolio.portfolio_all',compact('portfolio'));
    }//end method

    public function AddPortfolio()
    {
        return view('admin.portfolio.portfolio_add');
    }//end method

    public function StorePortfolio(Request $request)
    {
        $request->validate([
            'portfolio_name'=> 'required',
            'portfolio_title'=> 'required',
            'portfolio_image'=> 'required',

        ],[
            'portfolio_name.required'=>'Portfolio Name is required',
            'portfolio_title.required'=>'Portfolio Title is required',


        ]);
        $image = $request->file('portfolio_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(1020,519)->save('upload/portfolio/'.$name_gen);
            $save_url = 'upload/portfolio/'.$name_gen;
            portfolio::insert([
                'portfolio_name'=> $request->portfolio_name,
                'portfolio_title'=>$request->portfolio_title,
                'portfolio_description' =>  $request->portfolio_description,
               'portfolio_image' => $save_url,
               'created_at'=>Carbon::now(),
            ]);

        session()->flash('message','Portfolio inserted  Successfully');

        return redirect()->route('all.portfolio');
    }//end method
}