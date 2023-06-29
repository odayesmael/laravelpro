<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    //

    public function Contact(){
     return view('frontend.contactus');
    }//end method


    public function StoreMessage(Request $request){

        $request->validate([
        
        'name' =>'required',
        'email' =>'required',
        'phone' =>'required',

        
    ], 
    [

         'name.required'=> 'The Name Is Required', 
        'email.required'=> 'The email  Is Required', 
        'phone.required'=> 'The Phone number Is Required', 

    ]);

         Contact::insert([
                'name' => $request->name ,
                'email' => $request->email ,
                'phone' => $request->phone ,
                'subject' => $request->subject,
                'message' => $request->message,
                'created_at'=> Carbon::now()
            ]);

             $notification = array(
             'message' => 'Your Message Submited successfuly',
             'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
    }// end method 


public function ContactMessage(){

   $contact= Contact::latest()->get();
   return view('admin.contact.allcontact',compact('contact'));
}// end method 


public function DeleteMessage($id){

   Contact::findOrFail($id)->delete();
      $notification = array(
             'message' => 'Your Message Deleted successfuly',
             'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);


}// end method 

}
