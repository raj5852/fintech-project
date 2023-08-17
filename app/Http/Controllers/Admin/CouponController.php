<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Coupon;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =Coupon::get();
        return view('admin.coupon.index',compact('data'));
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
                'coupon_name' => 'required|unique:coupons|max:255',
                'coupon_type' => 'required',
                'coupon_rate' => 'required',
                'coupon_use'  => 'required',
                'use_amount'  => 'required',
            ]);

        $data = $request->all();
        Coupon::create($data);

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
        $data = Coupon::find($id);
        return view('admin.coupon.edit',compact('data'));
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
                'coupon_name' => 'required|unique:coupons,coupon_name,'.$id,
                'coupon_type' => 'required',
                'coupon_rate' => 'required',
                'coupon_use'  => 'required',
                'use_amount'  => 'required',
            ]);
        $data = $request->except('_token');
        Coupon::where('id',$id)->update($data);
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
        checkpermission('coupon');

        $data = Coupon::find($id)->delete();
        $notification=array(
            'messege'=>'Successfully Deleted !',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);

    }
}
