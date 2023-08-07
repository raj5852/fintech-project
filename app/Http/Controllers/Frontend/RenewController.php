<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\RenewRequest;
use App\Models\NowPaymentOrder;
use App\Services\PaymentService;
use App\Services\Frontend\RenewService;
use App\Services\Frontend\UserProfileService;
use Illuminate\Http\Request;

class RenewController extends Controller
{
    function store(RenewRequest $request, UserProfileService $userProfileService)
    {
        $validateData =  $request->validated();

        $userMembership =   $userProfileService->userMembership();
        $userDetails =   $userProfileService->userWithMembership();

        // binance
        if ($validateData['payment_method'] == 6) {

            $storeDate =  RenewService::binanceRenew($userMembership, $validateData, $userDetails);

            return  PaymentService::binance($storeDate->order_no, $storeDate->renew['total_charge'], 'Renew');
        }



        // nowpayments

        if($validateData['payment_method'] == 5){

            $storeDate =  RenewService::nowPaymentRenew($userMembership, $validateData, $userDetails);

            return  PaymentService::nowpayments($storeDate->order_no, $storeDate->renew['total_charge'], 'Renew');

        }
    }
}
