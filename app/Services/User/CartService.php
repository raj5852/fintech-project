<?php

namespace App\Services\User;

use App\Models\Admin\Product;
use App\Services\Frontend\UserProfileService;
use Gloudemans\Shoppingcart\Facades\Cart;

/**
 * Class CartService.
 */
class CartService
{
    static  function cart()
    {
        $data = Cart::content();

        $discountForMembership = self::discountMembership();


        $cartWithMembership =  self::totalAmount();
        $total =  number_format($cartWithMembership, 2, '.', ',');

        return compact('discountForMembership', 'total', 'data');
    }


    static function discountMembership()
    {
        $data = Cart::content();

        $prdocutIds = $data->pluck('id');

        $profileDetails =  UserProfileService::userExists();
        $discountForMembership = 0;

        if (auth()->check() && $profileDetails->memberships != '[]') {

            $membershipId =  $profileDetails->subscribe_id;

            $discountForMembership = Product::query()
                ->whereIn('id', $prdocutIds)
                ->withWhereHas('memberships', function ($query) use ($membershipId) {
                    $query->where('memberships.id', $membershipId);
                })->sum('discount_price');
        }

        return $discountForMembership;
    }

    static function totalAmount()
    {
        $cartTotal = str_replace(',', '', Cart::subtotal());
        $couponBalance = session()->get('coupon') ? session()->get('coupon')['balance'] :0;

        $cartWithMembership =  ($cartTotal - self::discountMembership()) - $couponBalance;
        return $cartWithMembership;
    }
}
