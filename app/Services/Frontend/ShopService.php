<?php

namespace App\Services\Frontend;

use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\Membership;
use App\Models\Admin\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class ShopService
{
    static function show()
    {
        $category_id = '';
        $start_price = '';
        $end_price = '';
        $subcategory_id = '';
        $brand_id = '';

        $category = Category::withCount('product')->get();

        $all_category = $category->sum('product_count');

        $products = Product::where(['status'=> 1,'pre_order_status'=>0])
            ->select('id','category_id','subcategory_id','product_name','product_slug','product_price','discount_price','thumbnail','product_url')
            ->when(request('sort') == 'product_popular', function ($q) {
                return $q->withCount('orderItems')->orderBy('order_items_count', 'desc');
            })
            ->when(request('sort') == 'product_ratting', function ($q) {
                return $q->withCount('reviews')->orderBy('reviews_count', 'desc');
            })
            ->when(request('sort') == 'price_high_to_low', function ($q) {
                return $q->orderby('discount_price', 'desc');
            })
            ->when(request('sort') == 'price_low_to_high', function ($q) {
                return $q->orderby('discount_price', 'asc');
            })
            ->when(request('category') != null, function ($q) {
                return $q->where('category_id', request('category'));
            })
            ->when(request('start_price'), function ($q) {
                return $q->whereBetween('discount_price', [request('start_price'), request('end_price')]);
            })
            ->when(request('membership_id'), function ($q) {
                return $q->whereHas('memberships', function ($subQ) {
                    $subQ->where('membership_id', request('membership_id'));
                });
            })
            ->when(request('search'), function ($q, $product_name) {
                $q->where('product_name', 'like', "%{$product_name}%");
            })
            ->when(request('sub_category') != null, function ($q) {
                return $q->where('subcategory_id', request('sub_category'));
            })
            ->when(request('type') == 'free', function ($q) {
                return $q->where('is_free', 1);
            })

            ->orderBy('is_link_updated', 'desc')
            ->paginate(12)
            ->withQueryString();

        $brands = Brand::all();
        $members = Membership::all();
        $largeProductAmount = Product::orderBy('discount_price', 'desc')->first();
        return compact('category', 'start_price', 'end_price', 'products', 'brands', 'category_id', 'subcategory_id', 'brand_id', 'members', 'all_category', 'largeProductAmount');
    }
}
