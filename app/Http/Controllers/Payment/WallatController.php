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
use App\Models\User\Recharge;
use App\Models\User\Subscription;
use Helper;

class WallatController extends Controller
{
    public function WallatPayment(Request $request)
    {

        session(['qty'            => $request->qty,
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
                 'must'        => $request->must,


                ]);


        $user_id = Auth::id();
        $today = date("Y-m-d"); //Today
        $m_ch_date = date('Y-m-d', strtotime('+1 month', strtotime($today))); //Monthly Chrage date
        if(session('expired') == 1){
             $expire_date = "lifetime";
        }elseif(session('expired') == 2){
             $expire_date = date('Y-m-d', strtotime('+6 month', strtotime($today)));
        }elseif(session('expired') == 3){
             $expire_date = date('Y-m-d', strtotime('+1 year', strtotime($today)));
        }elseif(session('expired') == 4){
             $expire_date = date('Y-m-d', strtotime('+2 year', strtotime($today)));
        }
        if($balance >= $request->total_subscription_fee){
        if(Auth::user()->subscribe_id  == 0){

            $subscribe = New Subscription;
            $subscribe->user_id             = Auth::id();
            $subscribe->subscribe_id         = session('subscribe_id');
            $subscribe->start_date          = $today;
            $subscribe->monthly_charge_date = session('is_lifetime') == 1 ? '' : (session('monthly_charge') > 0.00 ? $m_ch_date : '');
            $subscribe->expire_date         = session('is_lifetime') == 1 ? "lifetime" : $expire_date;
            $subscribe->total_fee           = session('total_fee');
            $subscribe->subscribe_fee       = session('is_lifetime') == 1 ? 0.00 : session('subscribe_fee');
            $subscribe->monthly_charge      = session('is_lifetime') == 1 ? 0.00 : session('monthly_charge');
            $subscribe->payment_method      = 'Wallat';
            $subscribe->save();
            User::where('id',$user_id)->update(['subscribe_id' => session('subscribe_id')]);
            User::where('id',$user_id)->decrement('balance',$request->total_fee);

            $notification = array(
                'messege'=>'Membership upgrade successfull !' ,
                'alert-type'=>'success'
            );
            return redirect()->route('user.home')->with($notification);
          }else{

            $subs_id = Subscription::where('user_id',Auth::id())->first();

            $subscribe = Subscription::find($subs_id->id);
            $subscribe->subscribe_id        = session('subscribe_id');
            $subscribe->start_date          = $today;
            $subscribe->monthly_charge_date = session('is_lifetime') == 1 ? '' : (session('monthly_charge') > 0.00 ? $m_ch_date : '');
            $subscribe->expire_date         = session('is_lifetime') == 1 ? "lifetime" : $expire_date;
            $subscribe->total_fee           = session('total_fee');
            $subscribe->subscribe_fee       = session('is_lifetime') == 1 ? 0.00 : session('subscribe_fee');
            $subscribe->monthly_charge      = session('is_lifetime') == 1 ? 0.00 : session('monthly_charge');
            $subscribe->payment_method      = 'Wallat';
            $subscribe->save();
            User::where('id',$user_id)->update(['subscribe_id ' => session('subscribe_id ')]);
            User::where('id',$user_id)->decrement('balance',$request->total_subscription_fee);



            $notification = array(
                'messege'=>'Membership upgrade successfull !' ,
                'alert-type'=>'success'
            );
            return redirect()->route('user.home')->with($notification);
        }
        }
    }
}
