<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class NowPaymentRedirectController extends Controller
{

    function success()
    {
        Cart::destroy();
        return redirect('user/home')->with('success', session()->get('nopayment_product_url'));
    }
}
