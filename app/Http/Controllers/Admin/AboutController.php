<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\About;
use App\Models\Admin\Product;
use DB;
use Image;
class AboutController extends Controller
{
    public function AboutUs()
    {
        checkpermission('about-page');
        $about=DB::table('abouts')->first();
        return view('admin.website.about',compact('about'));
    }

    public function AboutUpdate(Request $request,$id)
    {
        $about =About::find($id);
        $about->about_us=$request->about_us;
        $about->about_title =$request->about_title;
        $about->description =$request->description;
        if($request->hasFile('image')){
            $image_tmp=$request->file('image');
           if($image_tmp->isValid()){
              $extension=$image_tmp->getClientOriginalExtension();
              $imageName=rand(111,99999).''.$extension;
              $imagePath='backend/about/'.$imageName;
              Image::make($image_tmp)->save($imagePath);
              $about->image=$imageName;
          }
      }
        $about->save();
        $notification=array(
            'messege'=>'About Updated Successfully',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);

    }


}
