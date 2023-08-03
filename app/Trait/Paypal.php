<?php
namespace App\Trait;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


trait Paypal{
    function processTransaction($amount){

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal-success'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $amount,
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            $notification = array(
                'messege'=>'Something went wrong.',
                'alert-type'=>'error'
            );
            return redirect()->route('user.home')->with($notification);
        } else {

            $notification = array(
                'messege'=>$response['message'] ?? 'Something went wrong.',
                'alert-type'=>'error'
            );
            return redirect()->route('user.home')->with($notification);
        }
    }
}
