<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RequestBooking;
use App\Models\User;
use App\Models\CryptoAddress;
use App\Models\CryptoOrder;
use App\Models\CryptoOrderDetails;
use App\Models\NowPaymentOrder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;
use function PHPSTORM_META\type;
use Image;
use Session;
use App\Trait\Paypal as PaypalTrait;

class RequestController extends Controller
{
    use PaypalTrait;

    public function RequestStore(Request $request)
    {

        if (Auth::check()) {
            $this->validate($request, [
                'customer_name' => 'required',
                'customer_email' => 'required',
                'software_name' => 'required',
                 'imageone' => 'required',
                 'imagetwo' => 'required',
                'details' => 'required',
            ], [
                'customer_name' => 'The name field is required',
                'customer_email' => 'The email field is required',
                'software_name' => 'The software name field is required',
                'imageone' => 'This field is required',
                'imagetwo' => 'This field is required',
                'details' => 'Details field is required',
            ]);

            // return $request->all();

            $liketodo = $request->liketodo;
            $platform = $request->platform;

            $twodata = [
                'liketodo' => $liketodo,
                'platform' => $platform,
            ];

            $value =  json_encode($twodata);


            $order = new RequestBooking();
            $order->customer_name = $request->customer_name;
            $order->customer_email = $request->customer_email;
            $order->software_name = $request->software_name;

            $order->details = $request->details;
            $order->customer_price = $request->customer_price;
            $order->value      = $value;
            $order->user_id = Auth::id();

            if ($request->hasFile('imageone')) {
                $file =  $request->file('imageone');
                $fileName  = time() . '.' . $file->getClientOriginalExtension();
                $file->move('backend/RequestFile/', $fileName);
                $order->imageone = $fileName;
            }

            if ($request->hasFile('imagetwo')) {
                $file =  $request->file('imagetwo');
                $fileName  = time() . '2' . '.' . $file->getClientOriginalExtension();
                $file->move('backend/RequestFile/', $fileName);
                $order->imagetwo = $fileName;
            }

            $order->save();


            return view('customer.product', ['data' => $order]);
        } else {
            $notification = array(
                'messege' => 'At First Login',
                'alert-type' => 'success'
            );
            return redirect()->route('login')->with($notification);
        }
    }

    public function RequestDOne(Request $request)
    {
        if ($request->payment_method) {
            if ($request->payment_method == 1) {

                if(!is_numeric($request->customer_price)){
                    return response()->json('Type Must be number');
                }

                if( $request->customer_price >= 1){
                    // return $request->all();
                    $orders =  RequestBooking::find(decrypt($request->orderid));
                    $orders->customer_price = $request->customer_price;
                    $orders->payment_method = 'My Wallet';
                    $orders->status = 1;
                    $orders->save();
                    $userid = User::find(auth()->user()->id)->decrement('balance',$request->customer_price);

                    $notification = array(
                        'messege' => 'Customer Product  Request Successfully please Wait .',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('home')->with($notification);
                }else{
                    return "Minimum amount 1";
                }

            } elseif ($request->payment_method == 2) {


                $orders =  RequestBooking::find($request->orderid);
                $orders->customer_price = $request->customer_price;
                $orders->payment_method = 'Paypal';
                $orders->save();

                session()->put('bookingid', $orders->id);
                return $this->processTransaction($request->customer_price);


                // return view('payment.paypal', compact('orders', 'type'));

            } elseif ($request->payment_method == 3) {

                $data = $request->all();
                $type = 'requestbooking';

                $orders =  RequestBooking::find($request->orderid);
                $orders->customer_price = $request->customer_price;
                $orders->payment_method = 'Stripe';
                $orders->save();
                $price = $request->customer_price;
                session()->put('bookingidType', 'requestbooking');
                session()->put('bookingid', $orders->id);

                return view('payment.stripe', compact('data', 'type', 'price'));
            } elseif ($request->payment_method == 6) {
                $amount =  $request->customer_price;
                $booking = RequestBooking::find($request->orderid);
                $name = $booking->customer_name;
                $email = $booking->customer_email;
                $type = 'customerrequestEdoken';

                return view('payment.edokanpay', compact('name','email','type','amount','booking'));
            } elseif ($request->payment_method == 7) {
                if(!is_numeric($request->customer_price)){
                    return response()->json('Type Must be number');
                }

                if( $request->customer_price >= 1){

                    $uniqid = time().uniqid();
                    $response = Http::withHeaders([
                        'x-api-key' => nowpayment_api_key(),
                        'Content-Type' => 'application/json'
                    ])->post('https://api.nowpayments.io/v1/invoice', [
                        'price_amount' => $request->customer_price,
                        'price_currency' => 'usd',
                        'order_id' => $uniqid ,
                        'order_description' => '',
                        'ipn_callback_url' => nowpayment_callback_url(),
                        'success_url' => url('user/home'),
                        'cancel_url' => url('user/home'),
                        "is_fixed_rate"=> true,

                    ]);

                    $responseData = $response->json();


                    $nowPaymentOrder = NowPaymentOrder::create([
                        'user_id'=>auth()->user()->id,
                        'order_no'=>$uniqid,
                        'total_price'=>$request->customer_price,
                        'coupon_amount'=>Session::has('coupon') ? Session::get('coupon')['discount'] : 0,
                        'payment_method'=>'Nowpayments',
                        'coupon'=>Session::has('coupon') ? Session::get('coupon')['code'] : "",
                        'time'=>time(),
                        'type'=>'request_product',
                        'request_booking_id'=>decrypt($request->orderid)
                    ]);

                    $jsonResult =  $responseData['invoice_url'];
                    return redirect($jsonResult);
                }



            }elseif ($request->payment_method == 8){
                if(!is_numeric($request->customer_price)){
                    return response()->json('Type Must be number');
                }

                if( $request->customer_price >= 1){


                $uniqid = time().uniqid();

                    $nowPaymentOrder = NowPaymentOrder::create([
                        'user_id'=>auth()->user()->id,
                        'order_no'=>$uniqid,
                        'total_price'=>$request->customer_price,
                        'coupon_amount'=>Session::has('coupon') ? Session::get('coupon')['discount'] : 0,
                        'payment_method'=>'Binance',
                        'coupon'=>Session::has('coupon') ? Session::get('coupon')['code'] : "",
                        'time'=>time(),
                        'type'=>'request_product',
                        'request_booking_id'=>decrypt($request->orderid)
                    ]);






                $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';


                $nonce = '';
                for ($i = 1; $i <= 32; $i++) {
                    $pos = mt_rand(0, strlen($chars) - 1);
                    $char = $chars[$pos];
                    $nonce .= $char;
                }

                $timestamp = round(microtime(true) * 1000);

                $requestData = [
                    "env" => [
                        "terminalType" => "APP"
                    ],
                    "merchantTradeNo" => $uniqid,
                    "orderAmount" => $request->customer_price,
                    "currency" => "USDT",
                    "returnUrl"=>url('user/home'),
                    "goods" => [
                        "goodsType" => "01",
                        "goodsCategory" => "D000",
                        "referenceGoodsId" => "7876763A3B",
                        "goodsName" => "Custom Request",
                        "goodsDetail" => ""
                    ]
                ];

                $json_request = json_encode($requestData);
                $payload = $timestamp . "\n" . $nonce . "\n" . $json_request . "\n";

                $binance_pay_key = BINANCE_KEY();
                $binance_pay_secret = BINANCE_SECRE();
                $signature = strtoupper(hash_hmac('SHA512', $payload, $binance_pay_secret));

                $headers = [
                    "Content-Type" => "application/json",
                    "BinancePay-Timestamp" => $timestamp,
                    "BinancePay-Nonce" => $nonce,
                    "BinancePay-Certificate-SN" => $binance_pay_key,
                    "BinancePay-Signature" => $signature
                ];

                $response = Http::withHeaders($headers)
                    ->post("https://bpay.binanceapi.com/binancepay/openapi/v2/order", $requestData);

                if ($response->failed()) {
                    echo 'Error: ' . $response->body();
                }

                $result = $response->json();
                return redirect($result['data']['checkoutUrl']);






                }

            }
        } else {
            $notification = array(
                'messege' => 'Please Select One Payment Method!',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }
    }
}
