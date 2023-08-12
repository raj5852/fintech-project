<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ProductEmail;
use App\Models\Admin\Membership;
use App\Models\Admin\Order;
use App\Models\Admin\OrderDetails;
use App\Models\Admin\Product;
use App\Models\NowPaymentOrder;
use App\Models\RequestBooking;
use App\Models\User;
use App\Models\User\Recharge;
use App\Models\User\Subscription;
use App\Services\API\PurchaseService;
use App\Services\User\MembershipService;
use App\Services\User\PreorderService;
use App\Services\User\UserActiveMembership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class BinanceController extends Controller
{
    function index(Request $request)
    {

        $webhookResponse = $request->all();


        if ($webhookResponse['bizStatus'] == 'PAY_SUCCESS') {

            $order_id = json_decode($webhookResponse['data'])->merchantTradeNo;


            $now_pay_order =  NowPaymentOrder::where([
                'order_no' => $order_id,
                'is_binance_payment' => null,
                'payment_method' => 'Binance'
            ])->first();

            if ($now_pay_order->type == 'purchase') {
                PurchaseService::purchase($now_pay_order,'Binance');

                $now_pay_order->update([
                    'is_binance_payment' => 1
                ]);
            }
            if ($now_pay_order == "preorder") {

                $product = Product::find($now_pay_order->product_id)->first();
                PreorderService::PreOrder($product->product_slug,'Binance');

            }


            if ($now_pay_order->type == 'recharge') {

                $user = User::find($now_pay_order->user_id);

                $recharge = new Recharge();
                $recharge->user_id        = $user->id;
                $recharge->amount         = $now_pay_order->total_price;
                $recharge->payment_method = 'Binance';
                $recharge->trans_id        = substr(md5(mt_rand()), 0, 12);
                $recharge->save();
                User::where('id', $user->id)->increment('balance', $now_pay_order->total_price);

                $now_pay_order->update([
                    'is_binance_payment' => 1
                ]);
            }
            if ($now_pay_order->type == 'request_product') {

                $orders =  RequestBooking::find($now_pay_order->request_booking_id);
                $orders->customer_price = $now_pay_order->total_price;
                $orders->payment_method = 'Binance';
                $orders->status = 1;
                $orders->save();

                $now_pay_order->update([
                    'is_binance_payment' => 1
                ]);
            }
            if ($now_pay_order->type == 'membership') {


                $user = User::find($now_pay_order->user_id);
                $membership = Membership::find($now_pay_order->subscribe_id);
                $totalMonth = $now_pay_order->total_month;
                $amount = $now_pay_order->total_price;
                $is_lifetime = $now_pay_order->is_lifetime;

                 MembershipService::subscription($user, $membership, $totalMonth, $amount, 'Binance', $is_lifetime);

                 $now_pay_order->update([
                    'is_binance_payment' => 1
                ]);
            }
            if($now_pay_order->type == 'renew' && $now_pay_order->payment_method == 'Binance'){

                $subscription = Subscription::where('user_id',$now_pay_order->user_id)->first();

                if($now_pay_order->renew['yearly_date'] != null){
                    $subscription->expire_date = $now_pay_order->renew['yearly_date'];
                }

                if($now_pay_order->renew['monthly_date'] != null){
                    $subscription->monthly_charge_date = $now_pay_order->renew['monthly_date'];
                }

                $subscription->save();

                $now_pay_order->update([
                    'is_binance_payment' => 1
                ]);
            }

        }
    }
}
