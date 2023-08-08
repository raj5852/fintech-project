<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use Illuminate\Http\Request;

class PreOrderController extends Controller
{
    //
    function payment($slug)
    {
        $products = Product::where([
            'product_slug' => $slug,
            'status' => 1,
            'pre_order_status' => 1
        ])->firstOrFail();

        return view('user.preorder-payment');

    }
}
