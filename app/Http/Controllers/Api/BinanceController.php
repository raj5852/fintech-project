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

                $user = User::find($now_pay_order->user_id);

                $orderData = $order = new Order();
                $order->name = $user->name;
                $order->email = $user->email;
                $order->user_id = $user->id;
                $order->order_no = $now_pay_order->order_no;
                $order->total_qty = $now_pay_order->total_qty;
                $order->total_price = $now_pay_order->total_price;
                $order->coupon_amount = $now_pay_order->coupon_amount;
                $order->payment_method = 'Binance';
                $order->coupon = $now_pay_order->coupon;
                $order->email_colleted = 0;
                $order->subscribe_id = $now_pay_order->subscribe_id;
                $order->save();



                $productGET =  Product::find(json_decode($now_pay_order->product_id));

                $emailContent = [
                    "email_subject" => 'Product link',
                    "product_url" => json_decode($now_pay_order->product_url),
                    "product_name" => $productGET->pluck('product_name')
                ];

                Mail::to($user->email)->send(new ProductEmail($emailContent));

                foreach ($productGET as $key => $value) {
                    $orderDetails = new OrderDetails();
                    $orderDetails->order_id = $orderData->id;
                    $orderDetails->product_name = $value->product_name;
                    $orderDetails->product_id = json_decode($now_pay_order->product_id)[$key];
                    $orderDetails->product_qty = json_decode($now_pay_order->product_quantity)[$key];
                    $orderDetails->unit_price = $value->discount_price; //pb
                    $orderDetails->product_price = ($value->discount_price * json_decode($now_pay_order->product_quantity)[$key]);
                    $orderDetails->membership_id = UserActiveMembership::checkProductMembership($now_pay_order->product_id[$key],$user->id) ;

                    $orderDetails->save();
                }

                $now_pay_order->update([
                    'is_binance_payment' => 1
                ]);
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

                $subscribe = new Subscription();
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
