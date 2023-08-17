<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\AboutTwo;
class AboutTwoController extends Controller
{
    public function index()
    {

        checkpermission('about-page');
        $abouttwo = AboutTwo::all();
        return view('admin.website.abouttwo.index', compact('abouttwo'));
    }

    public function add()
    {
        return view('admin.website.abouttwo.add');
    }

    public function store(Request $request)
    {
        $abouttwo = new AboutTwo;
        $abouttwo->title = $request->title;
        $abouttwo->details = $request->details;



        $abouttwo->save();
        $notification = array(
            'messege' => 'AboutTwo Updated Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->route('index.abouttwo')->with($notification);
    }

    public function edit($id)
    {
        checkpermission('about-page');

        $abouttwo = AboutTwo::find($id);

        return view('admin.website.abouttwo.edit', compact('abouttwo'));
    }

    public function update(Request $request, $id)
    {
        $abouttwo = AboutTwo::find($id);
        $abouttwo->title = $request->title;
        $abouttwo->details = $request->details;



        $abouttwo->save();
        $notification = array(
            'messege' => 'AboutTwo Updated Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->route('index.abouttwo')->with($notification);
    }

    public function delete($id)
    {
        checkpermission('about-page');
        AboutTwo::find($id)->delete();
        $notification = array(
            'messege' => 'AboutTwo Successfully Deleted !',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}
