<?php

namespace App\Services\User;

use App\Mail\PreOrderMail;
use App\Models\Admin\Order;
use App\Models\Admin\OrderDetails;
use App\Models\Admin\Product;
use App\Models\NowPaymentOrder;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

/**
 * Class PreorderService.
 */
class PreorderService
{

    static function index()
    {
        return   Product::latest()
            ->where(['pre_order_status' => 1, 'status' => 1])
            ->select('id', 'product_slug', 'product_name',  'product_price', 'discount_price', 'pre_order_status', 'minimum_orders', 'thumbnail')
            ->withCount('orders')
            ->paginate(10)->withQueryString();
    }

    static function PreOrder($productslug, $wellat)
    {
        $product = Product::where('product_slug', $productslug)->first();
        self::order($product, $wellat);
        return to_route('user.home');
    }


    static function order($product, $wellat)
    {

        $user = auth()->user();
        $order = new Order();
        $order->name = $user->name;
        $order->email = $user->email;
        $order->email_colleted = 0;
        $order->user_id = $user->id;
        $order->order_no = uniqid();
        $order->total_qty = 1;
        $order->total_price = $product->discount_price;
        $order->coupon_amount = 0;
        $order->payment_method = $wellat;
        $order->coupon = '';
        $order->is_preorder = 1;
        $order->save();



        $orderDetails = new OrderDetails();
        $orderDetails->order_id = $order->id;
        $orderDetails->product_name = $product->product_name;
        $orderDetails->product_id = $product->id;
        $orderDetails->product_qty = 1;
        $orderDetails->unit_price = $product->product_price;
        $orderDetails->product_price = $product->product_price;
        $orderDetails->membership_id = 0;
        $orderDetails->save();

        $emailContent = [
            "email_subject" => 'Product link',
            "product_name" => 'prodcut name'
        ];

        if ($wellat == 'My wallat') {
             User::find(auth()->user()->id)->decrement('balance', $product->product_price);
        }

        Mail::to($user->email)->send(new PreOrderMail($emailContent));

        return $order;
    }


    static function nowpaymentsOrder($productslug)
    {
        $product = Product::where('product_slug', $productslug)->first();
        $user = auth()->user();

        $nowPaymentOrder = NowPaymentOrder::create([
            'user_id' => auth()->user()->id,
            'order_no' => uniqid(),
            'total_qty' => 1,
            'total_price' => $product->discount_price,
            'coupon_amount' => 0,
            'payment_method' => '',
            'coupon' => '',
            'time' => time(),
            'type' => 'preorder',
            'product_url' => '',
            'product_id' => $product->id,
            'subscribe_id' => $user->subscribe_id == 0 ? 'General  Member' : $user->member->membership_name,
            'product_quantity' => 1
        ]);

        return $nowPaymentOrder;

    }
}
