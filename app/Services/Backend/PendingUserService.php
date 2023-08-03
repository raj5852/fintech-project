<?php

namespace App\Services\Backend;

use App\Models\User;

class PendingUserService
{

    static function allPendinguser()
    {
        $pendinguser = User::where("email_verified_at", null)
            ->where('email', 'like', '%' . request('search') . '%')
            ->where('type', '!=', 'admin')
            ->paginate(10)
            ->withQueryString();

        return $pendinguser;
    }

    static  function pendingToActive($id)
    {
        $user =   User::find($id)->update([
            'email_verified_at' => CURRENT_TIME()
        ]);

        return $user;
    }
}
