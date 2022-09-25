<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Contact;

class ContactController extends Controller
{
    //

    public function Contact()
    {
        return view('frontend.contact');
    }//EndMethod

    public function StoreMessage(Request $request)
    {
        Contact::insert([
            'name'=> $request->name,
            'email'=> $request->email,
            'subject'=> $request->subject,
            'phone'=> $request->phone,
            'message'=> $request->message,
            'created_at'=> Carbon::now(),

        ]);

      
      $notification = array(
        'message'=>'Your Message Submitted Successfully',
        'alert-type'=>'success');

        return redirect()->back()->with($notification);
    }//EndMethod


    public function ContactMessage()
    {
      $contacts = Contact::latest()->get();
      
      return view('admin.contact.allcontact',compact('contacts'));  
    }//EndMethod


    public function DeleteMessage($id)
    {
        Contact::findOrFail($id)->delete();


        $notification = array(
        'message'=>' Message deleted Successfully',
        'alert-type'=>'success');

        return redirect()->back()->with($notification);

    }//EndMethod
}
