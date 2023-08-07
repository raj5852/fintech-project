<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Admin\Product;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{


    function comments(Request $request)
    {
        $comments = Product::find($request->product_id)
            ->comments()
            ->latest()
            ->with('user:id,name,image,type')
            ->get();

        foreach ($comments as $comment) {
            $comment->formatted_date = HumanReadableDate($comment->created_at);
        }

        return response()->json($comments);
    }
}
