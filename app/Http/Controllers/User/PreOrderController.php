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
        $product = Product::where([
            'product_slug' => $slug,
            'status' => 1,
            'pre_order_status' => 1
        ])->firstOrFail();

        $totalProductAmount = $product->discount_price;
        $preorder = 1;
        $productSlug = $product->product_slug;
        return view('user.checkout', compact('totalProductAmount','preorder','productSlug'));
    }

    function store(){
        return request()->all();
    }

}
