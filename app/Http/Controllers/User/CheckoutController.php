<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\MembershipRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Membership;
use App\Models\User;
use App\Models\User\Subscription;

use App\Models\NowPaymentOrder;
use App\Services\PaymentService;
use App\Services\User\CartService;
use App\Services\User\CheckoutService;
use App\Services\User\EpaymentService;
use App\Services\User\ManualPayment;
use App\Services\User\MembershipService;
use App\Services\User\PreorderService;
use Illuminate\Contracts\Encryption\DecryptException;

use Illuminate\Support\Facades\Http;


class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $totalProductAmount =  CartService::totalAmount();
        $preorder = 0;

        //when balance will 0.
        if ($totalProductAmount == 0) {
            return   ManualPayment::payments($totalProductAmount);
        } else {
            return view('user.checkout', compact('totalProductAmount', 'preorder'));
        }
    }




    public function store(Request $request)
    {
        $totalProductAmount =  CartService::totalAmount();

        if (!$request->payment_method) {
            $notification = array(
                'messege' => 'Please Select One Payment Method!',
                'alert-type' => 'warning'
            );
            return to_route('index.cart')->with($notification);
        }


        // manual
        if ($request->payment_method == 1) {
            if (auth()->user()->balance >= $totalProductAmount) {
                if (request('is_preorder') == 1) {
                    $productSlug  = request('product_slug');
                    return  PreorderService::PreOrder($productSlug, 'My wallat');
                }
                return   ManualPayment::payments($totalProductAmount, 'My wallet');
            } else {
                $notification = array(
                    'messege' => 'Not enough balance!',
                    'alert-type' => 'warning'
                );
                return to_route('index.cart')->with($notification);
            }
        }


        // nowpayments
        if ($request->payment_method == 7) {

            if (request('is_preorder') == 1) {

                $productSlug  = request('product_slug');
                $preorderorder =   PreorderService::nowpaymentsOrder($productSlug);

                return PaymentService::nowpayments($preorderorder->order_no,$preorderorder->total_price,'Pre-Order');
            }

            $order =  EpaymentService::product($totalProductAmount, 'Nowpayments');
            return  PaymentService::nowpayments($order->order_no, $totalProductAmount, 'Product purchase');
        }


        // binance
        if ($request->payment_method == 8) {
            if (request('is_preorder') == 1) {

                $productSlug  = request('product_slug');
                $preorderorder =   PreorderService::nowpaymentsOrder($productSlug);
                return PaymentService::binance($preorderorder->order_no,$preorderorder->total_price,'Pre-Order');

            }

            $order =  EpaymentService::product($totalProductAmount, 'Binance');
            return  PaymentService::binance($order->order_no, $totalProductAmount, 'Product purchase');
        }


        return back();



        // if ($request->payment_method) {

        //     $request->validate([
        //         'product_url' => 'array',
        //         'product_name' => 'array',
        //         'product_id' => 'array',
        //         'unit_price' => 'array',
        //     ]);


        //     $user = auth()->user();
        //     $balance = Auth::user()->balance;
        //     $user_id = Auth::id();
        //     try {
        //         $price = decrypt($request->price);
        //     } catch (DecryptException $e) {
        //         return "Balance Error";
        //     }
        //     $subscribe_id = $user->subscribe_id == 0 ? 'General  Member' : $user->member->membership_name;

        //     $product_url = [];
        //     try {
        //         foreach ($request->product_url as $url) {
        //             $decryptedUrl = decrypt($url);

        //             $data = array_keys($decryptedUrl);
        //             $product_url[] = end($data);
        //         }
        //     } catch (DecryptException $e) {
        //         return "Product Url Error";
        //     }
        //     // name
        //     $product_name = [];
        //     try {
        //         foreach ($request->product_name as $name) {
        //             $ProductName = decrypt($name);
        //             $product_name[] = $ProductName;
        //         }
        //     } catch (DecryptException $e) {
        //         return "Product Name";
        //     }

        //     // product_id
        //     $product_id = [];
        //     try {
        //         foreach ($request->product_id as $productId) {
        //             $id = decrypt($productId);
        //             $product_id[] = $id;
        //         }
        //     } catch (DecryptException $e) {
        //         return "Error Product id";
        //     }

        //     // unit_price
        //     $unit_price = [];
        //     try {
        //         foreach ($request->unit_price as $untPrice) {
        //             $untPrice = decrypt($untPrice);
        //             $unit_price[] = $untPrice;
        //         }
        //     } catch (DecryptException $e) {
        //         return "Error Product unit_price";
        //     }

        //     if ($request->payment_method == 1) {




        //         if ($balance >= $price) {


        //             $order = new Order();
        //             $order->name = $user->name;
        //             $order->email = $user->email;
        //             $order->email_colleted = $request->email_colleted;
        //             $order->subscribe_id = $subscribe_id;
        //             $order->user_id = Auth::id();
        //             $order->order_no = date('ymdhis');
        //             $order->total_qty = Cart::count();
        //             $order->total_price = $price;
        //             $order->coupon_amount = Session::has('coupon') ? Session::get('coupon')['discount'] : 0;
        //             $order->payment_method = 'My Wallet';
        //             $order->coupon = Session::has('coupon') ? Session::get('coupon')['code'] : "";
        //             $order->save();

        //             $order_id = $order->id;

        //             $urls = $product_url;
        //             foreach ($urls as $key => $url) {
        //                 $orderDetails = new OrderDetails;
        //                 $orderDetails->order_id = $order_id;
        //                 $orderDetails->product_name = $product_name[$key];
        //                 $orderDetails->product_id = $product_id[$key];
        //                 $orderDetails->product_qty = 1;
        //                 $orderDetails->unit_price = $unit_price[$key];
        //                 $orderDetails->product_price = $unit_price[$key];
        //                 $orderDetails->membership_id = UserActiveMembership::checkProductMembership($product_id[$key], Auth::id());

        //                 $orderDetails->save();
        //             }

        //             $emailContent = [
        //                 "email_subject" => 'Product link',
        //                 "product_url" => $product_url,
        //                 "product_name" => $product_name
        //             ];
        //             Mail::to(Auth::user()->email)->send(new ProductEmail($emailContent));
        //             Cart::destroy();
        //             $request->session()->forget(['qty', 'price', 'url']);
        //             User::where('id', $user_id)->decrement('balance', $price);

        //             $notification = array(
        //                 'messege' => 'Product Purchase & Transaction complete. Please check your email for product link.',
        //                 'alert-type' => 'success'
        //             );
        //             $productUrl = $product_url;
        //             $productNmae = $product_name;

        //             return redirect()->route('user.home')->with($notification)->with('success', $productUrl)->with('successName', $productNmae);
        //         } else {
        //             $notification = array(
        //                 'messege' => 'Insufficient balance please recharge !',
        //                 'alert-type' => 'error'
        //             );
        //             return redirect()->route('user.home')->with($notification);
        //         }
        //     } elseif ($request->payment_method == 2) {
        //         $data = $request->all();
        //         $type = 'payment';
        //         return view('payment.paypal', compact('data', 'type'));
        //     } elseif ($request->payment_method == 3) {
        //         $data = $request->all();
        //         $type = 'payment';
        //         return view('payment.stripe', compact('data', 'type'));
        //     } elseif ($request->pyment_method == 4) {  // pyment_method ta thik kre niyen
        //         $type = 'payment';
        //         return (new CryptoController)->index($request, $type);
        //     } elseif ($request->payment_method == 5) {
        //         $data = $request->all();
        //         $type = 'payment';
        //         return view('payment.wallat', compact('data', 'type'));
        //     } elseif ($request->payment_method == 6) {

        //         $data = $request->all();
        //         $type = 'payment';
        //         return view('payment.edokanpay', compact('data', 'type'));
        //     } elseif ($request->payment_method == 7) {

        //         session()->forget('nopayment_product_url');
        //         session(['nopayment_product_url' => $product_url]);

        //         $orderId_nowp = date('ymdhis');


        //         $response = Http::withHeaders([
        //             'x-api-key' => nowpayment_api_key(),
        //             'Content-Type' => 'application/json'
        //         ])->post('https://api.nowpayments.io/v1/invoice', [
        //             'price_amount' => $price,
        //             'price_currency' => 'usd',
        //             'order_id' => $orderId_nowp,
        //             'order_description' => $product_name[0],
        //             'ipn_callback_url' => nowpayment_callback_url(),
        //             'success_url' => url('user/nowpayment-product-success'),
        //             'cancel_url' => url('user/home'),
        //             "is_fixed_rate" => true,
        //         ]);

        //         $responseData = $response->json();


        //         $nowPaymentOrder = NowPaymentOrder::create([
        //             'user_id' => auth()->user()->id,
        //             'order_no' => $orderId_nowp,
        //             'total_qty' => Cart::count(),
        //             'total_price' => $price,
        //             'coupon_amount' => Session::has('coupon') ? Session::get('coupon')['discount'] : 0,
        //             'payment_method' => 'Nowpayments',
        //             'coupon' => Session::has('coupon') ? Session::get('coupon')['code'] : "",
        //             'time' => time(),
        //             'type' => 'purchase',
        //             'product_url' => json_encode($product_url),
        //             'product_id' => json_encode($product_id),
        //             'product_quantity' => json_encode($request->product_qty),
        //             'subscribe_id' => $user->subscribe_id == 0 ? 'General  Member' : $user->member->membership_name

        //         ]);

        //         $jsonResult =  $responseData['invoice_url'];
        //         return redirect($jsonResult);
        //     } elseif ($request->payment_method == 8) {

        //         session()->forget('nopayment_product_url');
        //         session(['nopayment_product_url' => $product_url]);

        //         $uniqid = time() . uniqid();

        //         $binanceOrder = NowPaymentOrder::create([
        //             'user_id' => auth()->user()->id,
        //             'order_no' => $uniqid,
        //             'total_qty' => Cart::count(),
        //             'total_price' => $price,
        //             'coupon_amount' => Session::has('coupon') ? Session::get('coupon')['discount'] : 0,
        //             'payment_method' => 'Binance',
        //             'coupon' => Session::has('coupon') ? Session::get('coupon')['code'] : "",
        //             'time' => time(),
        //             'type' => 'purchase',
        //             'product_url' => json_encode($product_url),
        //             'product_id' => json_encode($product_id),
        //             'product_quantity' => json_encode($request->product_qty),
        //             'subscribe_id' => $user->subscribe_id == 0 ? 'General  Member' : $user->member->membership_name

        //         ]);



        //         $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';


        //         $nonce = '';
        //         for ($i = 1; $i <= 32; $i++) {
        //             $pos = mt_rand(0, strlen($chars) - 1);
        //             $char = $chars[$pos];
        //             $nonce .= $char;
        //         }

        //         $timestamp = round(microtime(true) * 1000);

        //         $requestData = [
        //             "env" => [
        //                 "terminalType" => "APP"
        //             ],
        //             "merchantTradeNo" => $uniqid,
        //             "orderAmount" => $price,
        //             "currency" => "USDT",
        //             "returnUrl" => url('user/nowpayment-product-success'),
        //             "goods" => [
        //                 "goodsType" => "01",
        //                 "goodsCategory" => "D000",
        //                 "referenceGoodsId" => "7876763A3B",
        //                 "goodsName" => $product_name[0],
        //                 "goodsDetail" => ""
        //             ]
        //         ];

        //         $json_request = json_encode($requestData);
        //         $payload = $timestamp . "\n" . $nonce . "\n" . $json_request . "\n";

        //         $binance_pay_key = BINANCE_KEY();
        //         $binance_pay_secret = BINANCE_SECRE();
        //         $signature = strtoupper(hash_hmac('SHA512', $payload, $binance_pay_secret));

        //         $headers = [
        //             "Content-Type" => "application/json",
        //             "BinancePay-Timestamp" => $timestamp,
        //             "BinancePay-Nonce" => $nonce,
        //             "BinancePay-Certificate-SN" => $binance_pay_key,
        //             "BinancePay-Signature" => $signature
        //         ];

        //         $response = Http::withHeaders($headers)
        //             ->post("https://bpay.binanceapi.com/binancepay/openapi/v2/order", $requestData);

        //         if ($response->failed()) {
        //             echo 'Error: ' . $response->body();
        //         }

        //         $result = $response->json();
        //         return redirect($result['data']['checkoutUrl']);
        //     }
        // } else {
        // $notification = array(
        //     'messege' => 'Please Select One Payment Method!',
        //     'alert-type' => 'warning'
        // );
        // return redirect()->back()->with($notification);
        // }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subscriptionIndex(Request $request)
    {

        $request->validate([
            'membershipid' => 'required|integer'
        ], [
            'membershipid' => 'Something is wrong'
        ]);

        if (Subscription::where('user_id', auth()->user()->id)->exists()) {

            return redirect()->back()->with('error', 'You are not able to buy another membership');
        }
        $data = $request->all();

        if (Membership::where('id', $data['membershipid'])->exists()) {
            return view('user.subscription', compact('data'));
        } else {
            return redirect()->back()->with('error', 'Not Found');
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function subscriptionStore(MembershipRequest $request)
    {

        $validatedData = $request->validated();

        $membership =  Membership::find($validatedData['membership_id']);
        $totalMonth =  ($validatedData['total_month'] ?? 1);


        if ($validatedData['is_lifetime'] == 1) {
            $amount = $membership->life_time_charge;
        } else {
            $amount = $membership->membership_price * $totalMonth;
        }


        $user = auth()->user();
        $is_lifetime =  $validatedData['is_lifetime'];

        if ($validatedData['payment_method'] == 1) {
            if (auth()->user()->balance < $amount) {
                $notification = array(
                    'messege' => 'Insufficient balance please recharge !',
                    'alert-type' => 'error'
                );
                return redirect()->route('user.home')->with($notification);
            }

            User::where('id', $user->id)->decrement('balance', $amount);

            MembershipService::subscription($user, $membership, $totalMonth, $amount, 'My Wallet', $is_lifetime);
            $notification = array(
                'messege' => 'Membership upgrade successfull !',
                'alert-type' => 'success'
            );
            return redirect()->route('user.home')->with($notification);
        }

        if ($validatedData['payment_method'] == 7) {

            $nowPaymentOrder = EpaymentService::membership($membership->id, $is_lifetime, $totalMonth, $amount);

            return  PaymentService::nowpayments($nowPaymentOrder->order_no, $amount, 'Membership');
        }

        if ($validatedData['payment_method'] == 8) {

            $nowPaymentOrder = EpaymentService::membership($membership->id, $is_lifetime, $totalMonth, $amount);

            return  PaymentService::binance($nowPaymentOrder->order_no, $amount, 'Membership');
        }




        // if ($request->payment_method) {

        //     $request->validate([
        //         'membership_id' => 'required',
        //         'is_lifetime' => 'required|integer'
        //     ]);

        //     // return $request->all();

        //     try {
        //         $membership_id = decrypt($request->membership_id);
        //     } catch (DecryptException $e) {
        //         return "Wrong encrypt";
        //     }

        //     $total_month = 0;
        //     $membership =  Membership::find($membership_id);
        //     if ($membership->monthly_charge != 0) {
        //         if ($request->total_month != '') {

        //             if (!is_numeric($request->total_month)) {
        //                 return 'Wrong';
        //             }

        //             if ($request->total_month > 0) {
        //                 $total_month =  $request->total_month;
        //             } else {
        //                 return "Month is not valid";
        //             }
        //         }
        //     }



        //     $balance = Auth::user()->balance;
        //     $user_id = Auth::id();

        //     $today = date("Y-m-d"); //Today

        //     $m_ch_date = date('Y-m-d', strtotime('+' . $total_month . ' month', strtotime($today))); //Monthly Chrage date

        //     if ($request->is_lifetime == 1) {
        //         $expire_date = "lifetime";
        //     }

        //     $expire_one_year = date('Y-m-d', strtotime('+1 year', strtotime($today)));

        //     if ($request->is_lifetime == 1) {
        //         $total_subscription_fee = $membership->life_time_charge;
        //     } else {
        //         $total_subscription_fee = $membership->membership_price + ($total_month * $membership->monthly_charge);
        //     }

        //     if ($request->payment_method == 1) {







        //         if ($balance >= $total_subscription_fee) {

        //             if (Auth::user()->subscribe_id == 0) {

        //                 $subscribe = new Subscription;
        //                 $subscribe->user_id             = Auth::id();
        //                 $subscribe->subscribe_id        = $membership->id;
        //                 $subscribe->start_date          = $today;
        //                 $subscribe->monthly_charge_date = $request->is_lifetime == 1 ? '' : ($membership->monthly_charge > 0.00 ? $m_ch_date : '');
        //                 $subscribe->expire_date         = $request->is_lifetime == 1 ? "lifetime" : $expire_one_year;
        //                 $subscribe->total_fee           = $total_subscription_fee;
        //                 $subscribe->subscribe_fee       = $request->is_lifetime == 1 ? 0.00 : $membership->life_time_charge;
        //                 $subscribe->monthly_charge      = $request->is_lifetime == 1 ? 0.00 : ($total_month * $membership->monthly_charge);
        //                 $subscribe->payment_method      = 'My Wallet';
        //                 $subscribe->save();
        //                 User::where('id', $user_id)->update(['subscribe_id' => $membership->id]);
        //                 User::where('id', $user_id)->decrement('balance', $total_subscription_fee);
        //                 $notification = array(
        //                     'messege' => 'Membership upgrade successfull !',
        //                     'alert-type' => 'success'
        //                 );
        //                 return redirect()->route('user.home')->with($notification);
        //             } else {
        //                 $subs_id = Subscription::where('user_id', Auth::id())->first();

        //                 $subscribe = Subscription::find($subs_id->id);
        //                 $subscribe->subscribe_id        = $request->subscribe_id;
        //                 $subscribe->start_date          = $today;
        //                 $subscribe->monthly_charge_date = $request->is_lifetime == 1 ? '' : ($request->monthly_charge > 0.00 ? $m_ch_date : '');
        //                 $subscribe->expire_date         = $request->is_lifetime == 1 ? "lifetime" : $expire_date;
        //                 $subscribe->total_fee           = $request->total_subscription_fee;
        //                 $subscribe->subscribe_fee       = $request->is_lifetime == 1 ? 0.00 : $request->subscribe_fee;
        //                 $subscribe->monthly_charge      = $request->is_lifetime == 1 ? 0.00 : $request->monthly_charge;
        //                 $subscribe->payment_method      = 'My Wallet';
        //                 $subscribe->save();
        //                 User::where('id', $user_id)->update(['subscribe_id' => $request->subscribe_id]);
        //                 User::where('id', $user_id)->decrement('balance', $request->total_subscription_fee);
        //                 $notification = array(
        //                     'messege' => 'Membership upgrade successfull !',
        //                     'alert-type' => 'success'
        //                 );
        //                 return redirect()->route('user.home')->with($notification);
        //             }
        //         } else {
        //             $notification = array(
        //                 'messege' => 'Insufficient balance please recharge !',
        //                 'alert-type' => 'error'
        //             );
        //             return redirect()->route('user.home')->with($notification);
        //         }
        //     } elseif ($request->payment_method == 2) {
        //         $data = $request->all();
        //         $type = 'subscribe';
        //         return view('payment.paypal', compact('data', 'type'));
        //     } elseif ($request->payment_method == 3) {
        //         $data = $request->all();
        //         $type = 'subscribe';
        //         return view('payment.stripe', compact('data', 'type'));
        //     } elseif ($request->payment_method == 4) {
        //         $data = $request->all();
        //         $type = 'subscribe';
        //         return view('payment.bitcoin', compact('data', 'type'));
        //     } elseif ($request->payment_method == 5) {
        //         $data = $request->all();
        //         $type = 'subscribe';
        //         return view('payment.wallat', compact('data', 'type'));
        //     } elseif ($request->payment_method == 6) {
        //         $data = $request->all();
        //         $type = 'subscribe';
        //         return view('payment.edokanpay', compact('data', 'type'));
        //     } elseif ($request->payment_method == 7) {


        //         $response = Http::withHeaders([
        //             'x-api-key' => nowpayment_api_key(),
        //             'Content-Type' => 'application/json'
        //         ])->post('https://api.nowpayments.io/v1/invoice', [
        //             'price_amount' => $total_subscription_fee,
        //             'price_currency' => 'usd',
        //             'order_id' => $request->order_no ?? time(),
        //             'order_description' => '',
        //             'ipn_callback_url' => nowpayment_callback_url(),
        //             'success_url' => url('user/home'),
        //             'cancel_url' => url('user/home'),
        //             "is_fixed_rate" => true,

        //         ]);

        //         $responseData = $response->json();
        //         $today = date("Y-m-d"); //Today
        //         $m_ch_date = date('Y-m-d', strtotime('+' . $total_month . ' month', strtotime($today))); //Monthly Chrage date


        //         $nowPaymentOrder = NowPaymentOrder::create([
        //             'user_id' => auth()->user()->id,
        //             'subscribe_id' => $membership->id,
        //             'start_date'   => $today,
        //             'monthly_charge_date' => $request->is_lifetime == 1 ? '' : ($membership->monthly_charge > 0.00 ? $m_ch_date : ''),
        //             'expire_date' => $request->is_lifetime == 1 ? "lifetime" : $expire_one_year,
        //             'total_fee' => $total_subscription_fee,
        //             'subscribe_fee' => $request->is_lifetime == 1 ? 0.00 : $membership->life_time_charge,
        //             'monthly_charge' => $request->is_lifetime == 1 ? 0.00 : ($total_month * $membership->monthly_charge),
        //             'payment_method' => 'Nowpayments',
        //             'order_no' => $request->order_no ? $request->order_no : time(),
        //         ]);

        //         $jsonResult =  $responseData['invoice_url'];
        //         return redirect($jsonResult);
        //     } elseif ($request->payment_method == 8) {



        //         $uniqid = time() . uniqid();


        //         $today = date("Y-m-d"); //Today
        //         $m_ch_date = date('Y-m-d', strtotime('+' . $total_month . ' month', strtotime($today))); //Monthly Chrage date


        //         $nowPaymentOrder = NowPaymentOrder::create([
        //             'user_id' => auth()->user()->id,
        //             'subscribe_id' => $membership->id,
        //             'start_date'   => $today,
        //             'monthly_charge_date' => $request->is_lifetime == 1 ? '' : ($membership->monthly_charge > 0.00 ? $m_ch_date : ''),
        //             'expire_date' => $request->is_lifetime == 1 ? "lifetime" : $expire_one_year,
        //             'total_fee' => $total_subscription_fee,
        //             'subscribe_fee' => $request->is_lifetime == 1 ? 0.00 : $membership->life_time_charge,
        //             'monthly_charge' => $request->is_lifetime == 1 ? 0.00 : ($total_month * $membership->monthly_charge),
        //             'payment_method' => 'Binance',
        //             'order_no' => $uniqid,
        //             'type' => 'membership'
        //         ]);


        //         $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';


        //         $nonce = '';
        //         for ($i = 1; $i <= 32; $i++) {
        //             $pos = mt_rand(0, strlen($chars) - 1);
        //             $char = $chars[$pos];
        //             $nonce .= $char;
        //         }

        //         $timestamp = round(microtime(true) * 1000);

        //         $requestData = [
        //             "env" => [
        //                 "terminalType" => "APP"
        //             ],
        //             "merchantTradeNo" => $uniqid,
        //             "orderAmount" => $total_subscription_fee,
        //             "currency" => "USDT",
        //             "returnUrl" => url('user/home'),
        //             "goods" => [
        //                 "goodsType" => "01",
        //                 "goodsCategory" => "D000",
        //                 "referenceGoodsId" => "7876763A3B",
        //                 "goodsName" => "Subscription",
        //                 "goodsDetail" => ""
        //             ]
        //         ];

        //         $json_request = json_encode($requestData);
        //         $payload = $timestamp . "\n" . $nonce . "\n" . $json_request . "\n";

        //         $binance_pay_key = BINANCE_KEY();
        //         $binance_pay_secret = BINANCE_SECRE();
        //         $signature = strtoupper(hash_hmac('SHA512', $payload, $binance_pay_secret));

        //         $headers = [
        //             "Content-Type" => "application/json",
        //             "BinancePay-Timestamp" => $timestamp,
        //             "BinancePay-Nonce" => $nonce,
        //             "BinancePay-Certificate-SN" => $binance_pay_key,
        //             "BinancePay-Signature" => $signature
        //         ];

        //         $response = Http::withHeaders($headers)
        //             ->post("https://bpay.binanceapi.com/binancepay/openapi/v2/order", $requestData);

        //         if ($response->failed()) {
        //             echo 'Error: ' . $response->body();
        //         }

        //         $result = $response->json();
        //         return redirect($result['data']['checkoutUrl']);
        //     }
        // } else {
        //     $notification = array(
        //         'messege' => 'Please Select One Payment Method!',
        //         'alert-type' => 'warning'
        //     );
        //     return redirect()->back()->with($notification);
        // }
    }
    function redirectToCheckout()
    {
        return redirect('cart/index');
    }
}
