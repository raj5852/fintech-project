<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Order;
use App\Models\Admin\OrderDetails;

class OrderController extends Controller
{
    public function ALlOrder()
    {
        $order_no = request('order_no');

        $orders = Order::when('order_no',function($query) use($order_no){
            $query->where('order_no', 'like', "%{$order_no}%");
        })->with('user:id,email,name')->latest()->paginate(10);
        return view('admin.order.index', compact('orders'));
    }

    public function OrderView($id)
    {
        $order = Order::find($id);
        return view('admin.order.order_view', compact('order'));
    }

    public function orderEmail()
    {
        $OrderEmail = Order::where('email_colleted', 1)->latest()->get();
        return view('admin.order.order_email', compact('OrderEmail'));
    }

    function preorders()
    {
        $preOrders =  OrderDetails::withWhereHas('order', function ($query) {
            $query->where('is_preorder', 1)
                ->select('id', 'email', 'payment_method','name','order_no');
        })->paginate(10);

        return view('admin.order.preorders', compact('preOrders'));
    }

    function orderdelete($id){
        $order = Order::find($id);
        $order->delete();

        return to_route('admin.order')->with('success','Order Deleted Successfully');
    }
}
