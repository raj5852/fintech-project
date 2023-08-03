<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Brand;
use Str;
use Helper;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =Brand::latest()->get();
        return view('admin.brand.index',compact('data'));
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
    public function store(Request $request)
    {
        $validated = $request->validate([
                'brand_name' => 'required|unique:brands|max:255',
                'brand_image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        $data = $request->all();
        $data['brand_slug'] = Str::slug($request->brand_name);
        if($request->brand_image){
            $data['brand_image'] = Helper::upload_image($request->brand_image , 400 , 400);
        }
        Brand::create($data);
        $notification=array(
            'messege'=>'Successfully Created !',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Brand::find($id);
        return view('admin.brand.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
                'brand_name' => 'required|unique:brands,brand_name,'.$id,
                'brand_image'=> '|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
        $old_image = Brand::find($id);
        $data = $request->except('_token');
        $data['brand_slug'] = Str::slug($request->brand_name);
        if($request->brand_image){
            $data['brand_image'] = Helper::upload_image($request->brand_image , 400 , 400);
            if(file_exists($old_image->brand_image)){
                unlink($old_image->brand_image);
            }
        }
        Brand::where('id',$id)->update($data);
        $notification=array(
            'messege'=>'Successfully Updated !',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Brand::find($id);
        if(file_exists($data->brand_image)){
            unlink($data->brand_image);
        }
        $data->delete();
        $notification=array(
            'messege'=>'Successfully Deleted !',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
   
    }
}
