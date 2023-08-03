<?php

namespace App\Services\Frontend;

use App\Models\Admin\Product;
use Illuminate\Http\Request;

class NotificationService
{

    static function index()
    {
        $offset = request('offset', 0);
        $limit = 10;

        $users = auth()->user()->notifications()
            ->orderBy('created_at', 'desc')
            ->offset($offset)
            ->limit($limit)
            ->get();

        return response()->json([
            'users' => $users,
            'hasMore' => $users->count() === $limit,
        ]);
    }

    static function productLink($id)
    {
        auth()->user()->notifications->where('id', $id)->markAsRead();
        $productId =  auth()->user()->notifications->where('id', $id)->firstOrFail()->data['product_id'];

        $productSlug =  Product::find($productId)->product_slug;

        return redirect('product/details/' . $productSlug . '');
    }
}
