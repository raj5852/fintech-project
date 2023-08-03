<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomePage;
class HomePageController extends Controller
{
    public function index()
    {


        $homepages=HomePage::all();
        return view('admin.website.homepage.index',compact('homepages'));
        
    }
    
    public function add()
    {
        return view('admin.website.homepage.add');
    }

    public function store(Request $request)
    {
        $homepage =new HomePage;
        $homepage->title=$request->title;
        $homepage->details =$request->details;
    
    

        $homepage->save();
         $notification=array(
          'messege'=>'HomePage Updated Successfully',
          'alert-type'=>'success'
           );
           return Redirect()->route('index.homepage')->with($notification);

    }

    public function edit($id)
    {
        $homepage =HomePage::find($id);
        return view('admin.website.homepage.edit',compact('homepage'));
    }

    public function update(Request $request,$id)
    {
        $homepage =HomePage::find($id);
        $homepage->title=$request->title;
        $homepage->details =$request->details;


      
        $homepage->save();
        $notification=array(
            'messege'=>'HomePage Updated Successfully',
            'alert-type'=>'success'
             );
           return Redirect()->route('index.homepage')->with($notification);

    }

    public function delete($id)
    {
        HomePage::find($id)->delete();
        $notification=array(
            'messege'=>'HomePage Successfully Deleted !',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);

    }

}
