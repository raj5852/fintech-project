<?php

namespace App\Services;

use App\Models\CryptoAddress;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class Crypto
{

    function CryptoShow($request)
    {
        $response = Http::withHeaders([
            'x-api-key' => 'KQM857Z-AK9M058-M5FWDTP-P3ER60A',
            'Content-Type' => 'application/json',
        ])->post('https://api.nowpayments.io/v1/payment', [
            'price_amount' => $request->price,
            'price_currency' => 'usd',
            'pay_currency' => 'btc',
            'ipn_callback_url' => 'https://6c68-103-78-254-85.in.ngrok.io/api/ipn',
            'order_id' => auth()->user()->id,
            'order_description' => 'Apple Macbook Pro 2019 x 1',
        ]);

        $cryptoDetails =  json_decode($response);

        CryptoAddress::create([
            'payment_id' => $cryptoDetails->payment_id,
            'payment_status' => $cryptoDetails->payment_status,
            'pay_address' => $cryptoDetails->pay_address,
            'price_amount' => $cryptoDetails->price_amount,
            'price_currency' => $cryptoDetails->price_currency,
            'pay_amount' => $cryptoDetails->pay_amount,
            'amount_received' => $cryptoDetails->amount_received,
            'pay_currency' => $cryptoDetails->pay_currency,
            'order_id' => $cryptoDetails->order_id,
            'order_description' => $cryptoDetails->order_description,
            'time' => time()
        ]);
        return $cryptoDetails;
    }
}
