<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FixedSpecification;
use Illuminate\Http\Request;

class FixedSpecificationController extends Controller
{
    public function index()
    {
        checkpermission('products');
        $datas =FixedSpecification::all();
        return view('admin.fixedSpecification.index',compact('datas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
                'question' => 'required|unique:fixed_specifications|max:255',
                'answer' => 'required|max:255',
            ], [
                'question.required' => 'Question field is required',
                'question.unique' => 'Question field must be unique',
                'question.max' => 'Question field character not more then 255',
                'answer.required' => 'Answer field is required',
                'answer.max' => 'Answer field character not more then 255',
            ]);
        $data = $request->all();
        FixedSpecification::create($data);

        $notification=array(
            'messege'=>'Successfully Created !',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        $data = FixedSpecification::find($id);

        return view('admin.fixedSpecification.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
                'question' => 'required|max:255|unique:fixed_specifications,question,'.$id,
                'answer'=> 'required|max:255',
            ], [
                'question.required' => 'Question field is required',
                'question.unique' => 'Question field must be unique',
                'question.max' => 'Question field character not more then 255',
                'answer.required' => 'Answer field is required',
                'answer.max' => 'Answer field character not more then 255',
            ]);

        $data = $request->except('_token');

        FixedSpecification::where('id',$id)->update($data);

        $notification=array(
            'messege'=>'Successfully Updated !',
            'alert-type'=>'success'
             );
        return redirect()->route('specification.index')->with($notification);

    }

    public function delete($id)
    {
        checkpermission('products');

        $data = FixedSpecification::find($id);

        $data->delete();

        $notification=array(
            'messege'=>'Successfully Deleted !',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
    }
}
