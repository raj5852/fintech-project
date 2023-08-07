<?php

namespace App\Http\Controllers\AdminAndUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    function delete(Request $request)
    {
        // return response()->json($request->all());
        $checkUser = User::find(auth()->user()->id);
        $comment = Comment::find(request('commentId'));
        $commentUser = $comment->user;

        if ($checkUser->type == 'admin' ||  $commentUser->id == $checkUser->id) {
            $comment->delete();
            return response()->json('success');
        }
    }

    function store(CommentRequest $request)
    {
        $validateData = $request->validated();

        Comment::create([
            'user_id' => auth()->user()->id,
            'product_id' => $validateData['productId'],
            'comment' => $validateData['comment']
        ]);

        return response()->json(['success' => 'success']);
    }


}
