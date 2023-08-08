<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;
use Helper;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminProfile()
    {
        return view('admin.admin_setings.profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function adminProfileUpdate(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|mimes:jpeg,png,jpg,gif'
        ]);


        $data = User::find(Auth::id());
        $data->name   = $request->name;
        $data->email  = $request->email;
        $data->phone  = $request->phone;
        $data->mobile = $request->mobile;
        $data->address= $request->address;
        if($request->image){
            $data->image = Helper::upload_image($request->image , 100, 100);
        }
        $data->save();

        return redirect()->back()->with('success','Successfully Updated !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {
        $offer = Offer::first();
        return view('admin.admin_setings.password',compact('offer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
      $password=Auth::user()->password;
      $oldpass = $request->old_password;
      $newpass = $request->new_password;
      $confirm = $request->confirm_password;
      if (Hash::check($oldpass,$password)) {
           if ($newpass === $confirm) {
                      $user=User::find(Auth::id());
                      $user->password=Hash::make($newpass);
                      $user->save();
                      Auth::logout();
                       return Redirect()->route('admin.login')->with('success','Password Changed Successfully ! Now Login with Your New Password');
                 }else{
                       return Redirect()->back()->with('error','New password and Confirm Password not matched!');
                 }
      }else{
        return Redirect()->back()->with('error','Old Password not matched!');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
