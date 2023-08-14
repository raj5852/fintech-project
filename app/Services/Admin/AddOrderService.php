<?php

namespace App\Services\Admin;

use App\Models\Admin\OrderDetails;
use App\Models\Admin\Product;
use App\Models\User;
use App\Services\User\CheckoutService;

/**
 * Class AddOrderService.
 */
class AddOrderService
{
    static function addOrdertoUser($request)
    {


        $products = Product::whereIn('id', $request['product_ids'])->select('id', 'product_name', 'product_url','discount_price')->get();

        $user = User::find($request['user_id']);


        $wallet = 'Manual payment by admin';


        $producturls = $products->pluck('product_url');

        $urls = collect($producturls)
            ->map(function ($item) {
                return collect($item)->filter(function ($value, $key) {
                    return is_string($key) && is_string($value);
                })->keys()->last();
            })
            ->filter()
            ->all();
        $carCount = $products->count();
        $totalPrice = $products->sum('discount_price');
        $coupon_amount = 0;
        $coupon = '';

        CheckoutService::payment($user, $products, $carCount, $totalPrice, $coupon_amount, $wallet, $coupon, $urls);
        return "Purchase order successful";
    }
}
