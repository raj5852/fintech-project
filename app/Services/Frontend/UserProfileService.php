<?php

namespace App\Services\Frontend;

use App\Models\Admin\Membership;
use App\Models\Admin\Order;
use App\Models\Admin\Product;
use App\Models\Discussion;
use App\Models\User;

class UserProfileService
{
    function userWithMembership()
    {

        $user = User::query()
            ->select('id', 'name', 'subscribe_id', 'image', 'email')
            ->withExists('memberships')
            ->with(['MembershipActive:id', 'memberships:id,membership_name'])
            ->withCount(['orderDetails', 'wishlists'])
            ->find(auth()->user()->id);

        $hasActiveMemberships = $user->relationLoaded('MembershipActive') && $user->MembershipActive->isNotEmpty();

        $user->membership_active_exists = $hasActiveMemberships;

        return $user;
    }

    static   function userGroup()
    {
        $user = auth()->user();
        return    Discussion::whereHas('discussionUsers', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();
    }

    function userMembershipProduct()
    {
        $userDetails = $this->userWithMembership();
        if ($userDetails->membership_active_exists == true && $userDetails->memberships_exists == true) {

            return  Product::query()
                ->select('id', 'product_name', 'product_slug', 'product_price', 'discount_price', 'thumbnail')
                ->where('status', 1)
                ->whereHas('memberships', function ($query) use ($userDetails) {
                    $query->where('memberships.id', $userDetails->subscribe_id);
                })
                ->latest()
                ->paginate(12);
        }
    }


    function userMembership()
    {
        return Membership::find(auth()->user()->subscribe_id);
    }

    function userOrders()
    {
        return  Product::query()
            ->select('id', 'product_name', 'thumbnail', 'discount_price', 'product_slug')
            ->whereHas('orders', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->latest()
            ->paginate(12);
    }

    static  function userExists()
    {
        if (auth()->check()) {
            $user = User::query()

                ->with('memberships', function ($query) {
                    $query->where('is_life_time', 1)
                        ->orWhere(function ($query) {
                            $query->where('memberships.monthly_charge', 0)
                                ->whereDate('subscriptions.expire_date', '>', now());
                        })
                        ->orWhere(function ($query) {
                            $query->where('memberships.monthly_charge', '!=', 0)
                                ->whereDate('monthly_charge_date', '>', now());
                        });
                })->find(auth()->user()->id);
            return $user;
        }

        return null;
    }
}
