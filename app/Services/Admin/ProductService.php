<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Notifications\NewProductNotification;
use App\Notifications\ProductUpdateNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

/**
 * Class ProductService.
 */
class ProductService
{
    static  function membershipNotification($product)
    {
        $memberships = (request('memberships'));
        $mailsubject =  'TExclusive Announcement: Fresh ' . $product->product_name . ' Now Available in Your Membership!';

        if (request('memberships') != \null && $product->status != 0) {
            $user =     User::query()
                ->whereIn('subscribe_id', $memberships)
                ->WithwhereHas('memberships', function ($query) {
                    $query->where('is_life_time', 1)
                        ->orWhere(function ($query) {
                            $query->where('memberships.monthly_charge', 0)
                                ->whereDate('subscriptions.expire_date', '>', now());
                        })
                        ->orWhere(function ($query) {
                            $query->where('memberships.monthly_charge', '!=', 0)
                                ->whereDate('monthly_charge_date', '>', now());
                        });
                })
                ->chunk(100, function ($users) use ($product, $mailsubject) {
                    foreach ($users as $user) {
                        Notification::send($user, new NewProductNotification($user, $product, $mailsubject));
                    }
                });

            return 1;
        }
    }


    static function editProductNotification($product)
    {

        Log::info('..');
        $mailsubject =  'Exciting News! Discover the ' . $product->product_name . ' Update!';
        $productId = $product->id;

        return   $users = User::query()
        ->where(function ($query) use ($productId) {
            $query->where(function ($subQuery) use ($productId) {
                $subQuery->whereHas('orderDetails', function ($detailQuery) use ($productId) {
                    $detailQuery->where('product_id', $productId)
                        ->where('membership_id', 0);
                });
            })->orWhere(function ($subQuery) use ($productId) {
                $subQuery->whereHas('orderDetails', function ($detailQuery) use ($productId) {
                    $detailQuery->where('product_id', $productId)
                        ->where('membership_id', '!=', 0);
                })->whereHas('memberships', function ($query) {
                    $query->where('is_life_time', 1)
                        ->orWhere(function ($query) {
                            $query->where('memberships.monthly_charge', 0)
                                ->whereDate('subscriptions.expire_date', '>', now());
                        })
                        ->orWhere(function ($query) {
                            $query->where('memberships.monthly_charge', '!=', 0)
                                ->whereDate('monthly_charge_date', '>', now());
                        });
                });
            });
        })->chunk(100, function ($users) use ($product, $mailsubject) {

            foreach ($users as $user) {

                Notification::send($user, new ProductUpdateNotification($user, $product, $mailsubject));
            }
        });
    }
}
