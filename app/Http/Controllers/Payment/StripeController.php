<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use Cart;
use Session;
use Mail;
use App\Mail\ProductEmail;
use Auth;
use App\Models\Admin\Order;
use App\Models\User;
use App\Models\Admin\OrderDetails;
use App\Models\RequestBooking;
use App\Models\User\Recharge;
use App\Models\User\Subscription;
use Helper;

class StripeController extends Controller
{
    private $stripe;
    public function __construct()
    {
        // return mangeStripeApi();
        $this->stripe = new StripeClient(STRIPE_KEY());
    }

    public function index()
    {
        return view('payment');
    }

    public function stripePayment(Request $request)
    {
        session([
            'qty'            => $request->qty,
            'price'          => $request->price,
            'url'            => $request->product_url,
            'product_name'   => $request->product_name,
            'product_qty'    => $request->product_qty,
            'unit_price'     => $request->unit_price,
            'order_no'       => $request->order_no,
            'type'           => $request->type,
            'amount'         => $request->amount,
            'subscribe_id'   => $request->subscribe_id,
            'total_fee'      => $request->total_subscription_fee,
            'subscribe_fee'  => $request->subscribe_fee,
            'monthly_charge' => $request->monthly_charge,
            'is_lifetime'    => $request->is_lifetime,
            'expired'        => $request->expired,
            'name'        => $request->name,
            'email'        => $request->email,
            'email_colleted'        => $request->email_colleted,
            'product_id'        => $request->product_id,
            'total_month' => $request->total_month,

        ]);

        $token = $this->createToken($request);
        if (!empty($token['error'])) {

            $notification = array(
                'messege' => $token['error'],
                'alert-type' => 'error'
            );
            return redirect()->route('user.home')->with($notification);
        }
        if (empty($token['id'])) {

            $notification = array(
                'messege' => 'Payment failed.',
                'alert-type' => 'error'
            );
            return redirect()->route('user.home')->with($notification);
        }
        if (session('type') == 'recharge') {

            $recharge = new Recharge();
            $recharge->user_id        = Auth::id();
            $recharge->amount         = session('amount');
            $recharge->payment_method = 'Stripe';
            $recharge->trans_id        = substr(md5(mt_rand()), 0, 12);
            $recharge->save();
            User::where('id', Auth::id())->increment('balance', session('amount'));
            // User::where('id',Auth::id())->increment('balance', Helper::refund(session('amount')));

            $request->session()->forget(['amount', 'type']);

            $notification = array(
                'messege' => 'Successfully Recharge ! Please check your balance.',
                'alert-type' => 'success'
            );
            return redirect()->route('user.home')->with($notification);
        }


        // $charge = $this->createCharge($token['id'], 2000);
        // if (!empty($charge) && $charge['status'] == 'succeeded') {

        //     if(session('type') == 'recharge'){

        //         $recharge = new Recharge();
        //         $recharge->user_id = Auth::id();
        //         $recharge->amount = session('amount');
        //         $recharge->payment_method = 'Stripe';
        //         $recharge->trans_id = substr(md5(mt_rand()), 0, 12);
        //         $recharge->save();
        //         User::where('id',Auth::id())->increment('balance', session('amount'));

        //         $request->session()->forget(['amount','type']);

        //         $notification = array(
        //             'messege'=>'Successfully Recharge ! Please check your balance.',
        //             'alert-type'=>'success'
        //         );
        //         return redirect()->route('user.home')->with($notification);

        //     }

        elseif (session('type') == 'payment') {

            $order = new Order();
            $order->user_id = Auth::id();
            $order->order_no = session('order_no');
            $order->total_qty = Cart::count();
            $order->total_price = session('price');
            $order->coupon_amount = Session::has('coupon') ? Session::get('coupon')['discount'] : 0;
            $order->payment_method = 'Stripe';
            $order->refund = Helper::refund(session('price'));
            $order->coupon = Session::has('coupon') ? Session::get('coupon')['code'] : "";
            $order->subscribe_id        = session('subscribe_id');
            $order->email_colleted        = session('email_colleted');
            $order->email       = session('email');
            $order->name       = session('name');
            $order->save();

            $order_id = $order->id;

            foreach (session('url') as $key => $url) {
                $orderDetails = new OrderDetails;
                $orderDetails->order_id = $order_id;
                $orderDetails->product_name = session('product_name')[$key];
                $orderDetails->product_qty = session('product_qty')[$key];
                $orderDetails->unit_price = session('unit_price')[$key];
                $orderDetails->product_price = session('unit_price')[$key] * session('product_qty')[$key];

                $orderDetails->product_id = session('product_id')[$key];

                $orderDetails->save();
            }

            User::where('id', Auth::id())->increment('balance', Helper::refund(session('price')));

            $emailContent = [
                "email_subject" => 'Product link',
                "product_url" => session('url'),
                "product_name"=>session('product_name')
            ];

            Mail::to(Auth::user()->email)->send(new ProductEmail($emailContent));

            Cart::destroy();
            $productUrl =  session()->get('url');
            $request->session()->forget(['qty', 'price', 'url', 'product_name', 'product_qty', 'unit_price', 'order_no', 'type']);

            $notification = array(
                'messege' => 'Product Purchase & Transaction complete. Please check your email for product link.',
                'alert-type' => 'success'
            );
            return redirect()->route('user.home')->with($notification)->with('success', $productUrl);

            // $request->session()->flash('success', 'Payment completed.');
        } elseif (session('type') == 'subscribe') {

            $user_id = Auth::id();
            $today = date("Y-m-d"); //Today
            $m_ch_date = date('Y-m-d', strtotime('' . session('total_month') . ' month', strtotime($today))); //Monthly Chrage date
            if (session('expired') == 1) {
                $expire_date = "lifetime";
            } elseif (session('expired') == 2) {
                $expire_date = date('Y-m-d', strtotime('+6 month', strtotime($today)));
            } elseif (session('expired') == 3) {
                $expire_date = date('Y-m-d', strtotime('+1 year', strtotime($today)));
            } elseif (session('expired') == 4) {
                $expire_date = date('Y-m-d', strtotime('+2 year', strtotime($today)));
            }

            if (Auth::user()->subscribe_id == 0) {

                $subscribe = new Subscription;
                $subscribe->user_id             = Auth::id();
                $subscribe->subscribe_id        = session('subscribe_id');
                $subscribe->start_date          = $today;
                $subscribe->monthly_charge_date = session('is_lifetime') == 1 ? '' : (session('monthly_charge') > 0.00 ? $m_ch_date : '');
                $subscribe->expire_date         = session('is_lifetime') == 1 ? "lifetime" : $expire_date;
                $subscribe->total_fee           = session('total_fee');
                $subscribe->subscribe_fee       = session('is_lifetime') == 1 ? 0.00 : session('subscribe_fee');
                $subscribe->monthly_charge      = session('is_lifetime') == 1 ? 0.00 : session('monthly_charge');
                $subscribe->payment_method      = 'Stripe';
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
                $subscribe->payment_method      = 'Stripe';
                $subscribe->save();
                User::where('id', $user_id)->update(['subscribe_id' => session('subscribe_id')]);

                $notification = array(
                    'messege' => 'Membership upgrade successfull !',
                    'alert-type' => 'success'
                );
                return redirect()->route('user.home')->with($notification);
            }
            //   }

        }elseif(session('bookingidType') == 'requestbooking'){
            $req =  RequestBooking::find(session('bookingid'));
            $req->status = 1;
            $req->save();

            $notification = array(
                'messege' => 'Software Request successfull !',
                'alert-type' => 'success'
            );
            return redirect()->route('user.home')->with($notification);
        }else {

            $notification = array(
                'messege' => 'Payment failed.',
                'alert-type' => 'error'
            );
            return redirect()->route('user.home')->with($notification);
        }
        $notification = array(
            'messege' => 'Something went wrong !',
            'alert-type' => 'error'
        );
        return redirect()->route('user.home')->with($notification);
    }

    private function createToken($cardData)
    {
        $token = null;
        try {
            $token = $this->stripe->tokens->create([
                'card' => [
                    'number' => $cardData['cardNumber'],
                    'exp_month' => $cardData['month'],
                    'exp_year' => $cardData['year'],
                    'cvc' => $cardData['cvv']
                ]
            ]);
        } catch (CardException $e) {
            $token['error'] = $e->getError()->message;
        } catch (Exception $e) {
            $token['error'] = $e->getMessage();
        }
        return $token;
    }

    private function createCharge($tokenId, $amount)
    {
        $charge = null;
        try {
            $charge = $this->stripe->charges->create([
                // return condition1 ? value1 : condition2 ? value2 : condition3 ? value3 : value4;
                'amount' => session('type') == "payment" ? session('price') * 100 : (session('type') == "subscribe" ? session('total_fee') * 100 : session('amount') * 100),
                'currency' => 'usd',
                'source' => $tokenId,
                'description' => session('type') == "payment" ? 'Purchase Prduct' : 'Recharge',
            ]);
        } catch (Exception $e) {
            $charge['error'] = $e->getMessage();
        }
        return $charge;
    }
}
