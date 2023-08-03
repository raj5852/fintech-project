<?php

namespace App\Providers;

use App\Models\Admin\ManageAPI;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        if (env(key: 'APP_ENV') !== 'local') {
            URL::forceScheme(scheme: 'https');
        }

        $MailAPI = ManageAPI::query()->where('name', 'mail')->first()->details;
        $mailsetting =  json_decode($MailAPI);

        $PaypalData = ManageAPI::query()->where('name', 'paypal')->first()->details;
        $paypalAPI = json_decode($PaypalData);

        $googleAPI = ManageAPI::query()->where('name','google_clint')->first()->details;
        $gogleData =  json_decode($googleAPI);

        //mail
        $data = [
            'driver'            => $mailsetting->MAIL_MAILER,
            'host'              => $mailsetting->MAIL_HOST,
            'port'              => $mailsetting->MAIL_PORT,
            'encryption'        => $mailsetting->MAIL_ENCRYPTION,
            'username'          => $mailsetting->MAIL_USERNAME,
            'password'          => $mailsetting->MAIL_PASSWORD,
            'from'              => [
                'address' => $mailsetting->MAIL_FROM_ADDRESS,
                'name'   => $mailsetting->MAIL_FROM_NAME
            ]
        ];
        Config::set('mail', $data);


        //paypal
        config([
            'paypal.mode'=> $paypalAPI->PAYPAL_MODE,
            'paypal.sandbox.client_id' => $paypalAPI->PAYPAL_SANDBOX_CLIENT_ID,
            'paypal.sandbox.client_secret' => $paypalAPI->PAYPAL_SANDBOX_CLIENT_SECRET,
        ]);

        //stripe

        config([
            'services.google.client_id'=>$gogleData->GOOGLE_CLIENT_ID,
            'services.google.client_secret'=>$gogleData->GOOGLE_CLIENT_SECRET
        ]);




        Paginator::useBootstrap();

        // if (env(key: 'APP_ENV') !== 'local') {
        //     URL ::forceScheme(scheme: 'https');
        // }
    }
}
