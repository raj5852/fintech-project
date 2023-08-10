<?php

namespace App\Services\API;

use App\Mail\ProductEmail;
use App\Models\Admin\Order;
use App\Models\Admin\OrderDetails;
use App\Models\Admin\Product;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

/**
 * Class PurchaseService.
 */
class PurchaseService
{

    static function purchase($now_pay_order, $method)
    {
        $user = User::find($now_pay_order->user_id);

        $orderData = $order = new Order();
        $order->name = $user->name;
        $order->email = $user->email;
        $order->user_id = $user->id;
        $order->order_no = $now_pay_order->order_no;
        $order->total_qty = $now_pay_order->total_qty;
        $order->total_price = $now_pay_order->total_price;
        $order->coupon_amount = $now_pay_order->coupon_amount;
        $order->payment_method = $method;
        $order->coupon = $now_pay_order->coupon;
        $order->email_colleted = 0;
        $order->subscribe_id = $now_pay_order->subscribe_id;
        $order->save();



        $productGET =  Product::find(json_decode($now_pay_order->product_id));

        $emailContent = [
            "email_subject" => 'Product link',
            "product_url" => json_decode($now_pay_order->product_url),
            "product_name" => $productGET->pluck('product_name')
        ];
        Mail::to($user->email)->send(new ProductEmail($emailContent));

        foreach ($productGET as $key => $value) {
            $orderDetails = new OrderDetails();
            $orderDetails->order_id = $orderData->id;
            $orderDetails->product_name = $value->product_name;
            $orderDetails->product_id = json_decode($now_pay_order->product_id)[$key];
            $orderDetails->product_qty = 1;
            $orderDetails->unit_price = $value->discount_price; //pb
            $orderDetails->product_price = $value->discount_price;
            $orderDetails->membership_id = 0; // no membership

            $orderDetails->save();
        }
        return $orderData;
    }
}
