<?php

namespace App\Services\User;

use App\Models\Admin\Product;

/**
 * Class PreorderService.
 */
class PreorderService
{

    static function index()
    {
      return   Product::latest()
        ->where(['pre_order_status'=> 1,'status'=>1])
        ->select( 'id', 'product_slug','product_name',  'product_price','discount_price', 'pre_order_status', 'minimum_orders', 'thumbnail')
        ->withCount('orders')
        ->paginate(10)->withQueryString();
    }
}
