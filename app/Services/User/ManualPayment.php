<?php

namespace App\Services\User;

use App\Models\Admin\Product;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;

/**
 * Class ManualPayment.
 */
class ManualPayment
{
  static  function payments($totalProductAmount, $wallet = 'No Wallet')
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

        CheckoutService::payment($user, $products, $carCount, $totalPrice, $coupon_amount, $wallet, $coupon, $urls);


        $totalCashback = $products->where('total_cashback','!=',null)->sum('total_cashback');

        $user->increment('balance',$totalCashback);

        User::where('id', $user->id)->decrement('balance', $totalPrice);

        Cart::destroy();
        $notification = array(
            'messege' => 'Product Purchase & Transaction complete. Please check your email for product link.',
            'alert-type' => 'success'
        );
        $productUrl = $urls;
        $productNmae = $products->pluck('product_name');
        return redirect()->route('user.home')->with($notification)->with('success', $productUrl)->with('successName', $productNmae);
    }

}
