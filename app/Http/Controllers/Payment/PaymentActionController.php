<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\RequestBooking;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentActionController extends Controller
{
    function paypalSuccessUrl(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if ($response['status'] == 'COMPLETED') {

            $bookingid  = session()->get('bookingid');
            $data = RequestBooking::find($bookingid);
            $data->status = 1;
            $data->save();

            session()->forget('bookingid');

            $notification = array(
                'messege' => 'Payment completed successfully !',
                'alert-type' => 'success'
            );
            return redirect()->route('user.home')->with($notification);
        }
    }
}
