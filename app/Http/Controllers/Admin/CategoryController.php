<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        checkpermission('category');
        $data = Category::latest()->get();
        return view('admin.category.index',compact('data'));
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
        // $validated = $request->validate([
        //         'category_name' => '|unique:categories|max:255',
        //     ]);

            $rules = [
                'category_name' => 'required|unique:categories|max:255',
            ];

            $customMessages = [
                'category_name.required' => 'Title Name required',

            ];
            $this->validate($request,$rules,$customMessages);



        $data = $request->all();
        $data['category_slug'] = Str::slug($request->category_name);
        Category::create($data);

        $notification=array(
            'messege'=>'Category Successfully Created !',
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
        $data = Category::find($id);
        return view('admin.category.edit',compact('data'));
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
                'category_name' => 'required|unique:categories,category_name,'.$id,
            ]);

        $data = $request->except('_token');
        $data['category_slug'] = Str::slug($request->category_name);
        Category::where('id',$id)->update($data);
        $notification=array(
            'messege'=>'Category Successfully Updated !',
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
        checkpermission('category');
        Category::find($id)->delete();
        $notification=array(
            'messege'=>'Category Successfully Deleted !',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);

    }
}
