<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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
class RechargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.recharge');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->payment_method){
         if($request->payment_method == 2){
             $data = $request->all();
             $type = 'recharge';
             return view('payment.paypal',compact('data','type'));
         }elseif($request->payment_method == 3){
             $data = $request->all();
             $type = 'recharge';
             return view('payment.stripe',compact('data','type'));
         }elseif($request->payment_method == 4){
           $data = $request->all();
             $type = 'recharge';
             return view('payment.edokanpay',compact('data','type'));
         }
         elseif($request->payment_method == 5){
            if(!is_numeric($request->amount)){
                return response()->json('Type must be number');
            }

            if($request->amount >=5 ){
                $uniqid = time().uniqid();
                $response = Http::withHeaders([
                    'x-api-key' => nowpayment_api_key(),
                    'Content-Type' => 'application/json'
                ])->post('https://api.nowpayments.io/v1/invoice', [
                    'price_amount' => $request->amount,
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
                    'total_price'=>$request->amount,
                    'coupon_amount'=>Session::has('coupon') ? Session::get('coupon')['discount'] : 0,
                    'payment_method'=>'Nowpayments',
                    'coupon'=>Session::has('coupon') ? Session::get('coupon')['code'] : "",
                    'time'=>time(),
                    'type'=>'recharge',
                ]);

                $jsonResult =  $responseData['invoice_url'];
                return redirect($jsonResult);


            }else{
                return "Minimum amount 5";
            }




          }elseif($request->payment_method == 6){

            if(!is_numeric($request->amount)){
                return response()->json('Type must be number');
            }

            if($request->amount >=5 ){


                $uniqid = time().uniqid();


                $nowPaymentOrder = NowPaymentOrder::create([
                    'user_id'=>auth()->user()->id,
                    'order_no'=>$uniqid,
                    'total_price'=>$request->amount,
                    'coupon_amount'=>Session::has('coupon') ? Session::get('coupon')['discount'] : 0,
                    'payment_method'=>'Binance',
                    'coupon'=>Session::has('coupon') ? Session::get('coupon')['code'] : "",
                    'time'=>time(),
                    'type'=>'recharge',
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
                    "orderAmount" => $request->amount,
                    "currency" => "USDT",
                    "returnUrl"=>url('user/home'),
                    "goods" => [
                        "goodsType" => "01",
                        "goodsCategory" => "D000",
                        "referenceGoodsId" => "7876763A3B",
                        "goodsName" => 'recharge',
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



            }else{
                return "Minimum amount 5";
            }

          }
        }else{
         return redirect()->back()->with('warning','Please Select One Payment Method');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
