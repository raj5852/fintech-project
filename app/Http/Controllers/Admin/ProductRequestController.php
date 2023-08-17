<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Medicine;
use App\Models\RequestBooking;
use Illuminate\Http\Request;
use App\Models\User\RequestProduct;
use Illuminate\Support\Facades\DB;

class ProductRequestController extends Controller
{
    public function index()
    {
        checkpermission('request-product');
        $requesstproducts = RequestProduct::all();
        return view('admin.productrequest.index', compact('requesstproducts'));
    }

    function addrequest()
    {
        checkpermission('request-product');

        $requestproducts = RequestProduct::all();
        $requesstproducts = Medicine::all();
        $users = DB::table('users')->where('type','!=','admin')->select('id','email')->get();
        return view('admin.productrequest.addrequest', compact('requestproducts', 'requesstproducts','users'));
    }

    public function add()
    {

        return view('admin.productrequest.add');
    }

    public function store(Request $request)
    {
        $productrequest = new RequestProduct();

        $productrequest->name = $request->name;

        $productrequest->save();
        $notification = array(
            'messege' => 'Successfully Created !',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        checkpermission('request-product');

        $requesstproducts = RequestProduct::find($id);
        return view('admin.productrequest.edit', compact('requesstproducts'));
    }

    public function update(Request $request, $id)
    {
        $productrequest = RequestProduct::find($id);

        $productrequest->name = $request->name;
        $productrequest->save();
        $notification = array(
            'messege' => 'Successfully Updated !',
            'alert-type' => 'success'
        );
        return Redirect()->route('index.productrequest')->with($notification);
    }

    public function destroy($id)
    {

        checkpermission('request-product');

        RequestProduct::find($id)->delete();

        $notification = array(
            'messege' => 'Successfully Deleted !',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    function requeststore(Request $request)
    {
        $this->validate($request, [
            'customer_name' => 'required',
            'customer_email' => 'required',
            'software_name' => 'required',
            'imageone' => 'required',
            'imagetwo' => 'required',
            'details' => 'required',
        ], [
            'customer_name' => 'The name field is required',
            'customer_email' => 'The email field is required',
            'software_name' => 'The software name field is required',
            'imageone' => 'This field is required',
            'imagetwo' => 'This field is required',
            'details' => 'Details field is required',
        ]);

        // return $request->all();

        $liketodo = $request->liketodo;
        $platform = $request->platform;

        $twodata = [
            'liketodo' => $liketodo,
            'platform' => $platform,
        ];

        $value =  json_encode($twodata);


        $order = new RequestBooking();
        $order->customer_name = $request->customer_name;
        $order->customer_email = $request->customer_email;
        $order->software_name = $request->software_name;

        $order->details = $request->details;
        $order->customer_price = $request->customer_price;
        $order->value      = $value;
        $order->user_id = $request->userid;
        $order->status = 1;
        $order->customer_price = $request->amount;
        $order->payment_method = 'custom';
        if ($request->hasFile('imageone')) {
            $file =  $request->file('imageone');
            $fileName  = time() . '.' . $file->getClientOriginalExtension();
            $file->move('backend/RequestFile/', $fileName);
            $order->imageone = $fileName;
        }

        if ($request->hasFile('imagetwo')) {
            $file =  $request->file('imagetwo');
            $fileName  = time() . '2' . '.' . $file->getClientOriginalExtension();
            $file->move('backend/RequestFile/', $fileName);
            $order->imagetwo = $fileName;
        }

        $order->save();

        return  redirect()->back()->with('success','Success');
    }
}
