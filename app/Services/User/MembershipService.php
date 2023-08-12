<?php

namespace App\Services\User;

use App\Models\User;
use App\Models\User\Subscription;

/**
 * Class MembershipService.
 */
class MembershipService
{

    static function subscription($user, $membership, $totalMonth,$amount,$payment_method,$is_life_time)
    {
        User::where('id', $user->id)->update(['subscribe_id' => $membership->id]);

        $today = now();

        $monthlyChargeDate = $today->addMonth($totalMonth);

        $subscribe = new Subscription();
        $subscribe->user_id             = $user->id;
        $subscribe->subscribe_id        = $membership->id;
        $subscribe->start_date          = $today;
        $subscribe->monthly_charge_date = $monthlyChargeDate;
        $subscribe->expire_date         = $membership->monthly_charge == 0 ? $today->addYear(1) : $today; // today mean life time
        $subscribe->total_fee           = $amount;
        $subscribe->subscribe_fee       =  $membership->membership_price;
        $subscribe->monthly_charge      = $membership->monthly_charge; // 0 mean it will call dinamicly
        $subscribe->payment_method      = $payment_method;
        $subscribe->is_life_time = $is_life_time;
        $subscribe->save();

        return $subscribe;
    }
}
