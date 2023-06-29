<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\StatefulGuard;
// use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LogoutResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
 public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }



 public function destroy(Request $request): LogoutResponse
    {
        $this->guard->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        
        return app(LogoutResponse::class);



    }


public function Profile(){
   $id=Auth::user()->id;
   $adminData= user::find($id);
   return view('admin.admin_profile_view',compact('adminData'));
}


public function EditProfile(){
  $id=Auth::user()->id;
  $editData=user::find($id);
  return view('admin.admin_profile_edit',compact('editData'));
}

public function StoreProfile(Request $request){
  $id=Auth::user()->id;
  $data=user::find($id);
  $data->name=$request->name;
  $data->email=$request->email;

  if($request->file('profile_image')){
    $file = $request->file('profile_image');
    //rename the image 
    $filename = date('YmdHi').$file->getClientOriginalName();
    $file->move(public_path('upload/admin_images'),$filename);
    $data['profile_image']=$filename;
  }
  $data->save();
  $notification = array(
   'message' => 'Admin Ptrofile Updated successfuly',
   'alert-type' => 'success',

  );
  return redirect()->route('admin.profile')->with($notification);

}


public function ChangePassword()
{

return view('admin.admin_change_password');
}


public function UpdatePassword(Request $request)
{
    $validaData = $request->validate([
        'oldpassword' => 'required',
        'newpassword' => 'required',
        'confirm_password' => 'required|same:newpassword',

    ]);

    $hashedPassword = Auth::user()->password;
    if(Hash::check($request->oldpassword,$hashedPassword)){
        $users = User::find(Auth::id());
        $users ->password = bcrypt($request->newpassword);
        $users->save();

        session()->flash('message','Password Updated successfuly');
        return redirect()->back();
    }
    else{
        session()->flash('message','Old Password is not match');
        return redirect()->back();

    }
}    



}

