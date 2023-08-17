<?php

namespace App\Http\Controllers;

use App\Services\Admin\AddOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddOrderController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        checkpermission('orders');

        $users =  DB::table('users')->where('type','!=','admin')->select('id','email')->get();
        $products =  DB::table('products')->where('pre_order_status','!=',1)->select('id','product_name')->get();

        return view('admin.order.addorder',compact('users','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'=>'required',
            'product_ids'=>'required'
        ]);

        $data = AddOrderService::addOrdertoUser($request->all());
        return redirect()->back()->with('success',$data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
