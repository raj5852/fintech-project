<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MarketPlace;
use Image;
class MarketController extends Controller
{
    public function index()
    {

        $markets=MarketPlace::all();
        return view('admin.website.market.index',compact('markets'));

    }

    public function add()
    {
        return view('admin.website.market.add');
    }

    public function store(Request $request)
    {
        $marketPlace =new MarketPlace;
        $marketPlace->title=$request->title;
        $marketPlace->details =$request->details;

        if($request->hasFile('image')){
            $image_tmp=$request->file('image');
           if($image_tmp->isValid()){
              $extension=$image_tmp->getClientOriginalExtension();
              $imageName=rand(111,99999).''.$extension;
              $imagePath='backend/marketPlace/'.$imageName;
              Image::make($image_tmp)->save($imagePath);
              $marketPlace->image=$imageName;
          }
      }

      $marketPlace->save();
      $notification=array(
          'messege'=>'MarketPlace Updated Successfully',
          'alert-type'=>'success'
           );
           return Redirect()->route('index.market')->with($notification);

    }

    public function edit($id)
    {
        $market =MarketPlace::find($id);
        return view('admin.website.market.edit',compact('market'));
    }

    public function update(Request $request,$id)
    {
        $marketPlace =MarketPlace::find($id);
        $marketPlace->title=$request->title;
        $marketPlace->details =$request->details;


        if($request->hasFile('image')){
            $image_tmp=$request->file('image');
           if($image_tmp->isValid()){
              $extension=$image_tmp->getClientOriginalExtension();
              $imageName=rand(111,99999).''.$extension;
              $imagePath='backend/marketPlace/'.$imageName;
              Image::make($image_tmp)->save($imagePath);
              $marketPlace->image=$imageName;
          }
      }
        $marketPlace->save();
        $notification=array(
            'messege'=>'marketPlace Updated Successfully',
            'alert-type'=>'success'
             );
           return Redirect()->route('index.market')->with($notification);

    }

    public function delete($id)
    {
        MarketPlace::find($id)->delete();
        $notification=array(
            'messege'=>'MarketPlace Successfully Deleted !',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);

    }

}
