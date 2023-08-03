<?php

namespace App\Console\Commands;

use App\Models\Admin\Order;
use App\Models\Admin\OrderDetails;
use App\Models\CryptoAddress;
use App\Models\CryptoOrderDetails;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class CryptoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Crypto:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $eighthours = 28800;
        // $datas = DB::table('crypto_addresses')
        //     ->where('time', '>', (time() - $eighthours))
        //     ->where('isorder', 0)
        //     ->pluck('payment_id');

        // foreach ($datas  as $data) {
        //     $response = Http::withHeaders([
        //         'x-api-key' => 'KQM857Z-AK9M058-M5FWDTP-P3ER60A',
        //     ])->get('https://api.nowpayments.io/v1/payment/' . $data . '');

        //     $body = json_decode($response->body());

        //     if ($body->payment_status == 'waiting') {
        //          DB::table('crypto_addresses')
        //             ->where('payment_id', $body->payment_id)
        //             ->update(['payment_status' => 'success', 'isorder' => 1]);

        //         $orderGet = CryptoAddress::query()->where('payment_id', $body->payment_id)->first()->cryptoOrder;



        //         $order = new Order();

        //         $order->user_id = $orderGet->user_id;
        //         $order->order_no = $orderGet->order_no;
        //         $order->total_qty =  $orderGet->total_qty;
        //         $order->total_price =  $orderGet->total_price;
        //         $order->coupon_amount =  $orderGet->coupon_amount;
        //         $order->payment_method = $orderGet->payment_method;
        //         $order->coupon = $orderGet->coupon;
        //         $order->save();


        //         $gerOrderDetails =  $orderGet->cryptoOrderDetails;


        //         foreach ($gerOrderDetails as $gerOrderDetail) {
        //             $orderdetails = new OrderDetails();
        //             $orderdetails->order_id = $order->id ;
        //             $orderdetails->product_name = $gerOrderDetail->product_name;
        //             $orderdetails->product_qty = $gerOrderDetail->product_qty;
        //             $orderdetails->unit_price = $gerOrderDetail->unit_price;
        //             $orderdetails->product_price = $gerOrderDetail->product_price;
        //             $orderdetails->save();
        //         }


        //         // Log::info('ok');
        //     }
        // }
    }
}
