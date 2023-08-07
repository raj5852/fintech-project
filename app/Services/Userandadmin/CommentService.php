<?php

namespace App\Services\Userandadmin;

use App\Models\Comment;
use App\Models\User;

/**
 * Class CommentService.
 */
class CommentService
{
    static function delete()
    {
        // return Comment::where('user_id',auth()->user()->id)->exists();
        $user = User::find(auth()->user()->id);
    }
}
