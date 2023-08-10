<?php

namespace App\Services\User;

use App\Models\Admin\Product;
use App\Models\User;
use App\Services\Frontend\UserProfileService;

/**
 * Class UserActiveMembership.
 */
class UserActiveMembership
{
    static function checkProductMembership($productId,$authId){
        // return $productId;
        $priductMembershipIds =  Product::find($productId)?->memberships?->pluck('pivot.membership_id');

        $ids  = collect($priductMembershipIds)->toArray();
        $subscribe_id = User::find($authId)->subscribe_id;


        $userExists = UserProfileService::userExists();


        if($userExists->memberships != '[]' && in_array($subscribe_id, $ids)){
            $productSubscription =  $subscribe_id;
        }else{
            $productSubscription = 0;
        }

        return $productSubscription;


    }
}
