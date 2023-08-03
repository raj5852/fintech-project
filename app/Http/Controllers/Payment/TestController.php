<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use CoinGate\CoinGate;
use Cart;
use Session;
use Mail;
use App\Mail\ProductEmail;
use Auth;
use App\Models\Admin\Order;
use App\Models\User;
use App\Models\Admin\OrderDetails;
use App\Models\User\Recharge;
use App\Models\User\Subscription;



use Helper;

class CryptoController extends Controller
{
    public function CoinGate() {
        //your app_id
        $app_id = "315";
        //your app_key
        $api_key = "2kxwMRvcepQW9bnsjSgGqP";
        //your api_secret
        $api_secret = "EmHW0Dt8sdpOTq9jxN4aJBlFVfGeK6iC";
        //currency you want to pay
        $currency = "eur";
        //currency you want to receive
        $receive_currency = "eur";
        //randomly generated token to secure the form
        $token = hash('sha512', 'coingate'.rand());

        $order_no = 'coingate'.rand();

        $o = Order::create([

        'user_id'   => auth()->id(),
        'order_no' => $order_no,
        'email' => request('email'),
        'name' => request('name'),
        'total_qty'=> request('qty'),
        'total_price'=> request('price'),
        'coupon_amount'=> Session::has('coupon') ? Session::get('coupon')['discount'] : 0,
        'payment_method'=>'Bitcoin',
        'refund'    =>Helper::refund(session('price')),
        'coupon'=>Session::has('coupon') ? Session::get('coupon')['code'] : "",
        'subscribe_id'=>request('subscribe_id'),
        'status' => 'paid'

        ]);

        //Post parameters , which are send to CoinGate

      $post_params = array(
        'order_id'          =>  $o->id,
        'user_id'   => auth()->id(),
        'order_no' => $order_no,
        'email' => request('email'),
        'name' => request('name'),
        'total_qty'=> request('qty'),
        'total_price'=> request('price'),
        'coupon_amount'=> Session::has('coupon') ? Session::get('coupon')['discount'] : 0,
        'payment_method'=>'Bitcoin',
        'refund'    =>Helper::refund(session('price')),
        'coupon'=>Session::has('coupon') ? Session::get('coupon')['code'] : "",
        'subscribe_id'=>request('subscribe_id'),
        'status' => 'paid',
        'currency'          =>  $currency,
        'receive_currency'  =>  $receive_currency,
        'callback_url'      => 'http://localhost:8000/user/checkout?token='.$token,
        'cancel_url'        => 'http://localhost:8000',
        'success_url'       => 'http://localhost:8000/user/home',
       );



       //Package -> coingate-php

        $order = Order::create($post_params, array(),array(
        'environment' => 'sandbox',
        'app_id' => $app_id,
        'api_key' => $api_key,
        'api_secret' => $api_secret));

        // Session::forget('cart');

        if ($order) {
            echo $order->status;
            return redirect($order->payment_url);
        } else {
            print_r($order);
        }


      }


    public function callback(Request $request)
    {

        $order = Order::find($request->input('order_id'));

        if ($request->input('token') == $order->token) {

            $status = NULL;

            if ($request->input('status') == 'paid') {

                if ($request->input('price') >= $order->total_price) {

                    $status = 'paid';
                }
            } else {

                $status = $request->input('status');
            }

            if (!is_null($status)) {

                $order->update(['status' => $status]);
            }
        }
    }
}
