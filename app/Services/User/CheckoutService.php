<?php

namespace App\Services\User;

use App\Mail\ProductEmail;
use App\Models\Admin\Order;
use App\Models\Admin\OrderDetails;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

/**
 * Class CheckoutService.
 */
class CheckoutService
{
    static function payment($user, $products, $carCount, $totalPrice, $coupon_amount, $wallet, $coupon,$producturls)
    {

        $order = new Order();
        $order->name = $user->name;
        $order->email = $user->email;
        $order->email_colleted = 0;
        $order->user_id = $user->id;
        $order->order_no = uniqid();
        $order->total_qty = $carCount;
        $order->total_price = $totalPrice;
        $order->coupon_amount = $coupon_amount;
        $order->payment_method = $wallet;
        $order->coupon = $coupon;
        $order->save();

        foreach ($products as $key => $product) {
            $orderDetails = new OrderDetails();
            $orderDetails->order_id = $order->id;
            $orderDetails->product_name = $product->product_name;
            $orderDetails->product_id = $product->id;
            $orderDetails->product_qty = 1;
            $orderDetails->unit_price = $product->product_price;
            $orderDetails->product_price = $product->product_price;
            $orderDetails->membership_id = UserActiveMembership::checkProductMembership($product->id, $user->id);
            $orderDetails->save();
        }


        $emailContent = [
            "email_subject" => 'Product link',
            "product_url" => $producturls,
            "product_name" => $products->pluck('product_name')
        ];
        Mail::to($user->email)->send(new ProductEmail($emailContent));


        return $order;
    }
}
