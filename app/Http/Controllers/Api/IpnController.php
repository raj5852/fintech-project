<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ProductEmail;
use App\Models\Admin\Order;
use App\Models\Admin\OrderDetails;
use App\Models\Admin\Product;
use App\Models\NowPaymentOrder;
use App\Models\RequestBooking;
use App\Models\User;
use App\Models\User\Recharge;
use App\Models\User\Subscription;
use App\Services\API\PurchaseService;
use App\Services\User\UserActiveMembership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class IpnController extends Controller
{
    //
    function index()
    {
        $payload = file_get_contents('php://input');

        // Decode the JSON payload
        $data = json_decode($payload, true);



        // Log::info($data);

        if ($data['payment_status'] == 'finished') {

            $now_pay_order =  NowPaymentOrder::where('order_no', $data['order_id'])->first();

            if ($now_pay_order->type == 'purchase') {

                PurchaseService::purchase($now_pay_order,'Nowpayments');

            if($now_pay_order->type == 'recharge'){

                $user = User::find($now_pay_order->user_id);

                $recharge = new Recharge();
                $recharge->user_id        = $user->id;
                $recharge->amount         = $now_pay_order->total_price;
                $recharge->payment_method = 'Nowpayments';
                $recharge->trans_id        = substr(md5(mt_rand()), 0, 12);
                $recharge->save();
                User::where('id', $user->id)->increment('balance', $now_pay_order->total_price);
            }
            if($now_pay_order->type == 'request_product'){
                // $user = User::find($now_pay_order->user_id);

                $orders =  RequestBooking::find($now_pay_order->request_booking_id);
                $orders->customer_price = $now_pay_order->total_price;
                $orders->payment_method = 'Nowpayments';
                $orders->status = 1;
                $orders->save();


            }
            if($now_pay_order->type == 'membership'){

                $subscribe = new Subscription;
                $subscribe->user_id             = $now_pay_order->user_id;
                $subscribe->subscribe_id        = $now_pay_order->subscribe_id;
                $subscribe->start_date          = $now_pay_order->start_date;
                $subscribe->monthly_charge_date = $now_pay_order->monthly_charge_date;
                $subscribe->expire_date         = $now_pay_order->expire_date;
                $subscribe->total_fee           = $now_pay_order->total_fee;
                $subscribe->subscribe_fee       =  $now_pay_order->subscribe_fee;
                $subscribe->monthly_charge      = $now_pay_order->monthly_charge;
                $subscribe->payment_method      = $now_pay_order->payment_method;
                $subscribe->save();
                User::where('id', $now_pay_order->user_id)->update(['subscribe_id' => $now_pay_order->subscribe_id]);


            }

            if($now_pay_order->type == 'renew' ){
                $subscription = Subscription::where('user_id',$now_pay_order->user_id)->first();
                $subscription->expire_date = YearMonthDate($now_pay_order->renew['new_membership_date']);
                $subscription->start_date = YearMonthDate($now_pay_order->created_at);
                $subscription->save();

            }

        }
    }
}
