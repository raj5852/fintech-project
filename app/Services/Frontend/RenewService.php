<?php

namespace App\Services\Frontend;

use App\Models\NowPaymentOrder;
use Carbon\Carbon;

/**
 * Class RenewService.
 */
class RenewService
{

    static  function binanceRenew($userMembership, $validateData, $userDetails)
    {

        $renew =  self::renew($userMembership, $validateData, $userDetails);

        $uniqid = time() . uniqid();

        $binanceOrder = NowPaymentOrder::create([
            'user_id' => auth()->user()->id,
            'order_no' => $uniqid,
            'payment_method' => 'Binance',
            'type' => 'renew',
            'renew' => [
                'total_charge' =>  $renew['totalCharg'],
                'yearly_date' => $renew['yearly_date'],
                'monthly_date' => $renew['monthly_date'],
            ]
        ]);
        return $binanceOrder;
    }

    static function nowPaymentRenew($userMembership, $validateData, $userDetails)
    {
        $renew =  self::renew($userMembership, $validateData, $userDetails);
        $uniqid = time() . uniqid();

        $nowpaymentOrder = NowPaymentOrder::create([
            'user_id' => auth()->user()->id,
            'order_no' => $uniqid,
            'payment_method' => 'nowpayments',
            'type' => 'renew',
            'renew' => [
                'total_charge' =>  $renew['totalCharg'],
                'yearly_date' => $renew['yearly_date'],
                'monthly_date' => $renew['monthly_date'],
            ]
        ]);

        return $nowpaymentOrder;
    }


    static  function renew($userMembership, $validateData, $userDetails)
    {
        $monthlyOrYearly = $userMembership->monthly_charge == 00 ? 'year' : 'month';

        $charable =  $userMembership->monthly_charge == 00 ? $userMembership->membership_price : $userMembership->monthly_charge;
        $totalCharg = $charable * $validateData['time'];

        $yearly_charge = null;
        $monthly_charge = null;

        // return $userDetails->membership_active_exists;
        if ($userDetails->membership_active_exists == true) {

            if ($monthlyOrYearly == 'month') {

                $active_date = $userDetails->memberships[0]->pivot->monthly_charge_date;
                $originalDate = Carbon::createFromFormat('Y-m-d', $active_date);
                $monthly_charge = $originalDate->addMonths($validateData['time']);
            } else {

                $active_date = $userDetails->memberships[0]->pivot->expire_date;
                $originalDate = Carbon::createFromFormat('Y-m-d', $active_date);
                $yearly_charge = $originalDate->addYears($validateData['time']);
            }
        }

        if ($userDetails->membership_active_exists == false) {

            $originalDate = now();

            if ($monthlyOrYearly == 'month') {
                $monthly_charge = $originalDate->addMonths($validateData['time']);
            } else {
                $yearly_charge = $originalDate->addYears($validateData['time']);
            }
        }

        return [
            'totalCharg' => $totalCharg,
            'monthly_date' => $monthly_charge,
            'yearly_date' => $yearly_charge
        ];
    }
}
