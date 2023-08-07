<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

/**
 * Class BinanceService.
 */
class PaymentService
{

  static  function binance($uniqid,$price,$serviceName ){


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
            "orderAmount" => $price,
            "currency" => "USDT",
            "returnUrl" => url('user/nowpayment-product-success'),
            "goods" => [
                "goodsType" => "01",
                "goodsCategory" => "D000",
                "referenceGoodsId" => "7876763A3B",
                "goodsName" => $serviceName,
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

   static function nowpayments($uniqid,$price,$serviceName){

        $response = Http::withHeaders([
            'x-api-key' => nowpayment_api_key(),
            'Content-Type' => 'application/json'
        ])->post('https://api.nowpayments.io/v1/invoice', [
            'price_amount' => $price,
            'price_currency' => 'usd',
            'order_id' => $uniqid,
            'order_description' => $serviceName,
            'ipn_callback_url' => nowpayment_callback_url(),
            'success_url' => url('user/nowpayment-product-success'),
            'cancel_url' => url('user/home'),
            "is_fixed_rate" => true,
        ]);

        $responseData = $response->json();

        $jsonResult =  $responseData['invoice_url'];
        return redirect($jsonResult);
    }
}
