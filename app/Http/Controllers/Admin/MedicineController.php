<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Medicine;
class MedicineController extends Controller
{
    public function index()
    {
        checkpermission('request-product');

        $requesstproducts=Medicine::all();
        return view('admin.productrequesttwo.index',compact('requesstproducts'));
    }

    public function add()
    {
        return view('admin.productrequesttwo.add');
    }

    public function store(Request $request)
    {
        $productrequesttwo=new Medicine();

        $productrequesttwo->name=$request->name;

        $productrequesttwo->save();
        $notification=array(
            'messege'=>'Successfully Created !',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        $requesstproducts=Medicine::find($id);
        return view('admin.productrequesttwo.edit',compact('requesstproducts'));

    }

    public function update(Request $request,$id)
    {
        $productrequesttwo=Medicine::find($id);

        $productrequesttwo->name=$request->name;
        $productrequesttwo->save();
        $notification=array(
            'messege'=>'Successfully Updated !',
            'alert-type'=>'success'
             );
           return Redirect()->route('index.productrequesttwo')->with($notification);
    }

    public function destroy($id)
    {


        Medicine::find($id)->delete();

        $notification=array(
            'messege'=>'Successfully Deleted !',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
    }
}
