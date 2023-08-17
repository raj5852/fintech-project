<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Testimonial;
use File;
use App\Helpers\Helper;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        checkpermission('testimonial');
        $data = Testimonial::latest()->get();
        return view('admin.testimonial.index',compact('data'));
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
                'name'       => 'required',
                'designation'=> 'required',
                'description'=> 'required',
            ]);

        $data = $request->all();
        if($request->image){
            $data['image'] = Helper::upload_image($request->image , 100 , 100);
        }
        Testimonial::create($data);
        $notification=array(
            'messege'=>'Successfully Created  !',
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
        $data = Testimonial::find($id);
        return view('admin.testimonial.edit',compact('data'));
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
                'name' => 'required',
                'designation' => 'required',
                'description' => 'required',
            ]);
        $old_image = Testimonial::find($id);
        $data = $request->except('_token');
        if($request->image){
            $data['image'] = Helper::upload_image($request->image , 100 , 100);
            if(File::exists($old_image->image)){
                File::delete($old_image->image);
            }
        }
        Testimonial::where('id',$id)->update($data);
        $notification=array(
            'messege'=>'Successfully Updated  !',
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
        checkpermission('testimonial');

        $data = Testimonial::find($id);
        if(File::exists($data->image)){
            File::delete($data->image);
        }
        $data->delete();
        $notification=array(
            'messege'=>'Successfully Deleted  !',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);

    }
}
