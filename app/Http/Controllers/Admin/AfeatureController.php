<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Afeature;
use Illuminate\Http\Request;
use Helper;

class AfeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Afeature::latest()->get();
        return view('admin.afeature.index', compact('datas'));
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
                'title' => 'required|unique:afeatures|max:255',
                'description' => 'required',
               
            ]);

        $data = $request->all();
        // if($request->photo){
        //     $data['photo'] = Helper::upload_image($request->photo , 30, 30);
        // }
        Afeature::create($data);
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
        return view('admin.afeature.edit',[
            'data' => Afeature::find($id),
        ]);
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
            'title' => 'required|unique:afeatures,title,'.$id,
            'description' => 'required',
            
            ]);
        $old_image = Afeature::find($id);
        $data = $request->except('_token');
        // if($request->photo){
        //     $data['photo'] = Helper::upload_image($request->photo , 30, 30);
        //     if(file_exists($old_image->photo)){
        //         unlink($old_image->photo);
        //     }
        // }
        Afeature::where('id',$id)->update($data);
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
        $data = Afeature::find($id);
        if(file_exists($data->photo)){
            unlink($data->photo);
        }
        $data->delete();
        $notification=array(
            'messege'=>'Successfully Deleted !',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
       
    }
}
