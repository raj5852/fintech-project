<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use CoinGate\CoinGate;
use Cart;
use Mail;
use Session;
use App\Models\User;
use App\Mail\ProductEmail;
use App\Models\Admin\Order;
use Illuminate\Http\Request;
use App\Models\User\Recharge;
use App\Models\User\Subscription;
use App\Models\Admin\OrderDetails;
use App\Models\RequestBooking;
use Illuminate\Support\Facades\Auth;

use Victorybiz\LaravelCryptoPaymentGateway\LaravelCryptoPaymentGateway;


use Helper;

class CryptoController extends Controller
{





    public function Edokan(Request $request)
    {

        session([
            'amount' => $request->amount * 100,
            'qty' => $request->qty,
            'price' => $request->price,
            'url' => $request->product_url,
            'product_id' => $request->product_id,
            'product_name' => $request->product_name,
            'product_qty' => $request->product_qty,
            'unit_price' => $request->unit_price,
            'order_no' => $request->order_no,
            'type' => $request->type,
            'subscribe_id' => $request->subscribe_id,
            'total_fee' => $request->total_subscription_fee,
            'monthly_charge' => $request->monthly_charge,
            'is_lifetime' => $request->is_lifetime,
            'monthly_charge' => $request->monthly_charge,
            'expired' => $request->expired,
            'name' => $request->name,
            'email' => $request->email,
            'email_colleted' => $request->email_colleted,
            'total_month' => $request->total_month,
            'bookingId'=> $request->orderid,
        ]);

        $apikey = edokan_api_key(); //Your Api Key
        $clientkey = edokan_client_key(); //Your Client Key
        $secretkey = edokan_secret_key(); //Your Secret Key

        // $cus_name = $request->name;
        // $cus_email = $request->email;

        //success url
        $success_url = url('user/edokan/done');
        //cancel url
        $cancel_url = url('user/edokan/cancell');
        $hostname = "https://futureinltd.com/";

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://pay.edokanpay.com/checkout.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('api' => $apikey, 'client' => $clientkey, 'secret' => $secretkey, 'amount' => session('amount'), 'position' => $hostname, 'success_url' => $success_url, 'cancel_url' => $cancel_url, 'name' => session('name'), 'email' => session('email')),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;
    }

    public function EdokanDOne(Request $request)
    {


        $transactionId = $_GET['transactionId'];
        $paymentAmount = $_GET['paymentAmount'];
        $paymentFee = $_GET['paymentFee'];

        $transaction_id_edokanpay = $transactionId;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://pay.edokanpay.com/verify.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('transaction_id' => $transaction_id_edokanpay),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        if ($response == 1) {
            if (session('type') == 'recharge') {

                $recharge = new Recharge();
                $recharge->user_id        = Auth::id();
                $recharge->amount         = session('amount');
                $recharge->payment_method = 'Edokan';
                $recharge->trans_id       = substr(md5(mt_rand()), 0, 12);
                $recharge->save();
                User::where('id', Auth::id())->increment('balance', session('amount'));
                // User::where('id',Auth::id())->increment('balance', Helper::refund(session('amount')));

                $request->session()->forget(['amount', 'type']);

                $notification = array(
                    'messege' => 'Successfully Recharge ! Please check your balance.',
                    'alert-type' => 'success'
                );
                return redirect()->route('user.home')->with($notification);
            } elseif (session('type') == 'payment') {

                $order = new Order();
                $order->user_id        = Auth::id();
                $order->order_no       = session('order_no');
                $order->email       = session('email');
                $order->name       = session('name');
                $order->total_qty      = Cart::count();
                $order->total_price    = session('price');
                $order->coupon_amount  = Session::has('coupon') ? Session::get('coupon')['discount'] : 0;
                $order->payment_method = 'Edokan';
                $order->refund         = Helper::refund(session('price'));
                $order->coupon         = Session::has('coupon') ? Session::get('coupon')['code'] : "";
                $order->subscribe_id        = session('subscribe_id');
                $order->email_colleted        = session('email_colleted');
                $order->save();

                $order_id = $order->id;

                foreach (session('url') as $key => $url) {
                    $orderDetails = new OrderDetails;
                    $orderDetails->order_id      = $order_id;
                    $orderDetails->product_name  = session('product_name')[$key];
                    $orderDetails->product_qty   = session('product_qty')[$key];
                    $orderDetails->unit_price    = session('unit_price')[$key];
                    $orderDetails->product_id    = session('product_id')[$key];
                    $orderDetails->product_price = session('unit_price')[$key] * session('product_qty')[$key];

                    //return response()->json($orderDetails);
                    $orderDetails->save();
                }


                User::where('id', Auth::id())->increment('balance', Helper::refund(session('price')));


                $emailContent = [
                    "email_subject" => 'Product link',
                    "product_url"   => session('url'),
                    "product_name"=>session('product_name')
                ];

                Mail::to(Auth::user()->email)->send(new ProductEmail($emailContent));

                Cart::destroy();
                $request->session()->forget(['qty', 'price', 'url', 'product_name', 'product_qty', 'unit_price', 'order_no', 'type']);

                $notification = array(
                    'messege' => 'Product Purchase & Transaction complete. Please check your email for product link.',
                    'alert-type' => 'success'
                );
                return redirect()->route('user.home')->with($notification);
            } elseif (session('type') == 'subscribe') {
                $user_id = Auth::id();
                $today = date("Y-m-d"); //Today
                $m_ch_date = date('Y-m-d', strtotime('+'.session('total_month').' month', strtotime($today))); //Monthly Chrage date


              $expire_date = session(['is_lifetime'=>1]); //life time

                if (Auth::user()->subscrbe_id == 0) {

                    $subscribe = new Subscription;
                    $subscribe->user_id             = Auth::id();
                    $subscribe->subscribe_id        = session('subscribe_id');
                    $subscribe->start_date          = $today;
                    $subscribe->monthly_charge_date = session('is_lifetime') == 1 ? '' : (session('monthly_charge') > 0.00 ? $m_ch_date : '');
                    $subscribe->expire_date         = session('is_lifetime') == 1 ? "lifetime" : $expire_date;
                    $subscribe->total_fee           = session('total_fee');
                    $subscribe->subscribe_fee       = session('is_lifetime') == 1 ? 0.00 : session('subscribe_fee');
                    $subscribe->monthly_charge      = session('is_lifetime') == 1 ? 0.00 : session('monthly_charge');
                    $subscribe->payment_method      = 'Edokan';
                    $subscribe->save();
                    User::where('id', $user_id)->update(['subscribe_id' => session('subscribe_id')]);

                    $notification = array(
                        'messege' => 'Membership upgrade successfull !',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('user.home')->with($notification);
                } else {

                    $subs_id = Subscription::where('user_id', Auth::id())->first();

                    $subscribe = Subscription::find($subs_id->id);
                    $subscribe->subscribe_id        = session('subscribe_id');
                    $subscribe->start_date          = $today;
                    $subscribe->monthly_charge_date = session('is_lifetime') == 1 ? '' : (session('monthly_charge') > 0.00 ? $m_ch_date : '');
                    $subscribe->expire_date         = session('is_lifetime') == 1 ? "lifetime" : $expire_date;
                    $subscribe->total_fee           = session('total_fee');
                    $subscribe->subscribe_fee       = session('is_lifetime') == 1 ? 0.00 : session('subscribe_fee');
                    $subscribe->monthly_charge      = session('is_lifetime') == 1 ? 0.00 : session('monthly_charge');
                    $subscribe->payment_method      = 'Edokan';
                    $subscribe->save();
                    User::where('id', $user_id)->update(['subscrbe_id' => session('subscribe_id')]);

                    $notification = array(
                        'messege' => 'Membership upgrade successfull !',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('user.home')->with($notification);
                }
            }elseif(session('type') == 'customerrequestEdoken'){
                $req = RequestBooking::find(session('bookingId'));
                $req->status = 1;
                $req->customer_price = session('amount')/100; //convate to doller
                $req->payment_method = 'Edokan';
                $req->save();

                $notification = array(
                    'messege' => 'Request successfull',
                    'alert-type' => 'success'
                );
                return redirect()->route('user.home')->with($notification);
            }

            $notification = array(
                'messege' => $response['message'] ?? 'Something went wrong.',
                'alert-type' => 'error'
            );
            return redirect()->route('user.home')->with($notification);
        } else {
            echo "Failed. Id Not Match";
        }


        // if (isset($response['status']) && $response['status'] == 'COMPLETED') {


        // } else {

        //     session()->forget('coupon');
        //     $notification = array(
        //         'messege'=> $response['message'] ?? 'Something went wrong.',
        //         'alert-type'=>'error'
        //     );
        //     return redirect()->route('user.home')->with($notification);
        // }

    }



    public function EdokanCalcell()
    {
        $notification = array(
            'messege' => 'payment cancelled',
            'alert-type' => 'error'
        );
        return redirect()->route('user.home')->with($notification);
    }

    public function index($data, $type)
    {

        $payment_url = LaravelCryptoPaymentGateway::startPaymentSession([
            'amountUSD' => intval($data->price), // OR 'amount' when sending BTC value
            'orderID' => $data->order_no,
            'userID' => auth()->id(),
            'redirect' => url()->full(),
        ]);


        // redirect to the payment page
        return redirect()->to($payment_url);
    }

    public function CoinGate()
    {
        echo "Paypal er Moto Korte hobe";
    }



    public function callback(Request $request)
    {
        return LaravelCryptoPaymentGateway::callback();


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

    public static function ipn($cryptoPaymentModel, $payment_details, $box_status)
    {
        if ($cryptoPaymentModel) {
            /*
            // ADD YOUR CODE HERE
            // ------------------
            // For example, you have a model `UserOrder`, you can create new Bitcoin payment record to this model
            $userOrder = UserOrder::where('payment_id', $cryptoPaymentModel->paymentID)->first();
            if (!$userOrder)
            {
                UserOrder::create([
                    'payment_id' => $cryptoPaymentModel->paymentID,
                    'user_id'    => $payment_details["user"],
                    'order_id'   => $payment_details["order"],
                    'amount'     => floatval($payment_details["amount"]),
                    'amountusd'  => floatval($payment_details["amountusd"]),
                    'coinlabel'  => $payment_details["coinlabel"],
                    'txconfirmed'  => $payment_details["confirmed"],
                    'status'     => $payment_details["status"],
                ]);
            }
            // ------------------

            // Received second IPN notification (optional) - Bitcoin payment confirmed (6+ transaction confirmations)
            if ($userOrder && $box_status == "cryptobox_updated")
            {
                $userOrder->txconfirmed = $payment_details["confirmed"];
                $userOrder->save();
            }
            // ------------------
            */

            // Onetime action when payment confirmed (6+ transaction confirmations)
            if (!$cryptoPaymentModel->processed && $payment_details["confirmed"]) {
                // Add your custom logic here to give value to the user.

                // ------------------
                // set the status of the payment to processed
                // $cryptoPaymentModel->setStatusAsProcessed();

                // ------------------
                // Add logic to send notification of confirmed/processed payment to the user if any
            }
        }
        return true;
    }
}
