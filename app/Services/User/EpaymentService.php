<?php

namespace App\Services\User;

use App\Models\Admin\Product;
use App\Models\NowPaymentOrder;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Http;

/**
 * Class EpaymentService.
 */
class EpaymentService
{
    static function product($totalProductAmount, $method = 'Nowpayments')
    {
        $carCount =  Cart::count();
        $totalPrice = $totalProductAmount;
        $coupon_amount = session()->has('coupon') ? session()->get('coupon')['balance'] : 0;
        $coupon = session()->has('coupon') ? session()->get('coupon')['code'] : "";

        $allproductsids =   Cart::content()->pluck('id');
        $products = Product::query()->whereIn('id', $allproductsids)->select('id', 'product_price', 'product_name', 'product_url','total_cashback')->get();

        $producturls = $products->pluck('product_url');
        $urls = collect($producturls)
            ->map(function ($item) {
                return collect($item)->filter(function ($value, $key) {
                    return is_string($key) && is_string($value);
                })->keys()->last();
            })
            ->filter()
            ->all();

        $user = auth()->user();



        session()->forget('nopayment_product_url');
        session(['nopayment_product_url' => $urls]);

        $orderId_nowp = uniqid();
        $totalCashback = $products->where('total_cashback','!=',null)->sum('total_cashback');

        $nowPaymentOrder = NowPaymentOrder::create([
            'user_id' => auth()->user()->id,
            'order_no' => $orderId_nowp,
            'total_qty' => $carCount,
            'total_price' => $totalPrice,
            'coupon_amount' => $coupon_amount,
            'payment_method' => $method,
            'coupon' => $coupon,
            'time' => time(),
            'type' => 'purchase',
            'product_url' => json_encode($urls),
            'product_id' => json_encode($allproductsids),
            'subscribe_id' => $user->subscribe_id == 0 ? 'General  Member' : $user->member->membership_name,
            'product_quantity' => json_encode(1),
            'cashback'=>$totalCashback
        ]);


        return $nowPaymentOrder;
    }

    static function membership($membershipdId, $is_lifetime, $totalMonth, $amount)
    {
        $user = auth()->user();

        $nowPaymentOrder = NowPaymentOrder::create([
            'user_id' => $user->id,
            'order_no' => uniqid(),
            'subscribe_id' => $membershipdId,
            'is_lifetime'   => $is_lifetime,
            'total_month' => $totalMonth,
            'total_price' => $amount,
        ]);
        return  $nowPaymentOrder;
    }
}
