<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\RequestProduct;
class ProductRequestController extends Controller
{
    public function index()
    {

        $requesstproducts=RequestProduct::all();
        return view('admin.productrequest.index',compact('requesstproducts'));
    }

    public function add()
    {
        return view('admin.productrequest.add');
    }

    public function store(Request $request)
    {
        $productrequest=new RequestProduct();

        $productrequest->name=$request->name;

        $productrequest->save();
        $notification=array(
            'messege'=>'Successfully Created !',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        $requesstproducts=RequestProduct::find($id);
        return view('admin.productrequest.edit',compact('requesstproducts'));

    }

    public function update(Request $request,$id)
    {
        $productrequest=RequestProduct::find($id);

        $productrequest->name=$request->name;
        $productrequest->save();
        $notification=array(
            'messege'=>'Successfully Updated !',
            'alert-type'=>'success'
             );
           return Redirect()->route('index.productrequest')->with($notification);
    }

    public function destroy($id)
    {


        RequestProduct::find($id)->delete();

        $notification=array(
            'messege'=>'Successfully Deleted !',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
    }
}
