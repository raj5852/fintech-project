<?php

use App\Models\Admin\ManageAPI;
use App\Models\Admin\OrderDetails;
use App\Models\Admin\Social;
use App\Models\User;
use App\Models\User\WishList;
use App\Models\WebSite;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use  Illuminate\Support\Str;


function socials()
{
    return Social::all();
}


if (!function_exists('setting')) {
    /**
     * Get setting value by key
     *
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    function setting($name, $default = null)
    {
        return \App\Models\Admin\Setting::all();
    }
}

// crisp chat

if (!function_exists('mangeCrispApi')) {
    function mangeCrispApi()
    {
        $data =  ManageAPI::query()->where('name', 'crisp')->first()->details;
        return json_decode($data);
    }
}

if (!function_exists('chatId')) {
    function chatId()
    {
        return mangeCrispApi()->website_id;
    }
}





//stripe

if (!function_exists('mangeStripeApi')) {
    function mangeStripeApi()
    {
        $data =  ManageAPI::query()->where('name', 'stripe')->first()->details;
        return json_decode($data);
    }
}


//stripe

if (!function_exists('STRIPE_KEY')) {
    function STRIPE_KEY()
    {
        return mangeStripeApi()->STRIPE_KEY;
    }
}



if (!function_exists('STRIPE_SECRET')) {
    function STRIPE_SECRET()
    {
        return mangeStripeApi()->STRIPE_SECRET;
    }
}




//edokan function



if (!function_exists('edoaknFnction')) {
    function edoaknFnction()
    {
        $data =  ManageAPI::query()->where('name', 'edokan_pay')->first()->details;
        return json_decode($data);
    }
}

if (!function_exists('edokan_api_key')) {
    function edokan_api_key()
    {
        return edoaknFnction()->API_KEY;
    }
}

if (!function_exists('edokan_client_key')) {
    function edokan_client_key()
    {
        return edoaknFnction()->CLIENT_KEY;
    }
}

if (!function_exists('edokan_secret_key')) {
    function edokan_secret_key()
    {
        return edoaknFnction()->SECRET_KEY;
    }
}




//nowpayments function


if (!function_exists('nowpaymentFnction')) {
    function nowpaymentFnction()
    {
        $data =  ManageAPI::query()->where('name', 'nowpayments')->first()->details;
        return json_decode($data);
    }
}

if (!function_exists('nowpayment_api_key')) {
    function nowpayment_api_key()
    {
        return nowpaymentFnction()->API_KEY;
    }
}

if (!function_exists('nowpayment_ipn_secret')) {
    function nowpayment_ipn_secret()
    {
        return nowpaymentFnction()->IPN_SECRET_KEY;
    }
}

if (!function_exists('nowpayment_callback_url')) {
    function nowpayment_callback_url()
    {
        return nowpaymentFnction()->IPN_CALLBACK_URL;
    }
}

//tawk

if (!function_exists('tawkFnction')) {
    function tawkFnction()
    {
        $data =  ManageAPI::query()->where('name', 'tawk')->first()->details;
        return json_decode($data);
    }
}

if (!function_exists('widget_id')) {
    function widget_id()
    {
        return tawkFnction()->WIDGET_ID;
    }
}

if (!function_exists('property_id')) {
    function property_id()
    {
        return tawkFnction()->PROPERTY_ID;
    }
}


if (!function_exists('StringManipulation')) {
    function StringManipulation($str)
    {
        $words = explode('_', $str); // split the string into words using '_' as delimiter
        $capitalized_words = array_map('ucfirst', $words); // capitalize the first letter of each word
        $result = implode(' ', $capitalized_words); // join the words back into a string with a space separator
        return $result; // outputs "Mail From Address"
    }
}

if (!function_exists('user_month_expires')) {
    function user_month_expires()
    {
        $monthleyCharge =   User::find(auth()->user()->id)?->hasOneSub?->monthly_charge_date;

        if ($monthleyCharge) {
            if ($monthleyCharge > date('Y-m-d')) {
                return 0; // not expire
            } else {
                return 1;  // expire
            }
        }
    }
}

function slugCreate($modelName, $slug_text, $slugColumn = 'slug')
{
    $slug = Str::slug($slug_text, '-');
    $i = 1;
    while ($modelName::where($slugColumn, $slug)->exists()) {
        $slug = Str::slug($slug_text, '-') . '-' . $i++;
    }
    return $slug;
}

function slugUpdate($modelName, $slug_text, $modelId, $slugColumn = 'slug')
{
    $slug = Str::slug($slug_text, '-');
    $i = 1;
    while ($modelName::where($slugColumn, $slug)->where('id', '!=', $modelId)->exists()) {
        $slug = Str::slug($slug_text, '-') . '-' . $i++;
    }
    return $slug;
}


//binance

if (!function_exists('mangeBinanceApi')) {
    function mangeBinanceApi()
    {
        $data =  ManageAPI::query()->where('name', 'binance')->first()->details;
        return json_decode($data);
    }
}

//binance key

if (!function_exists('BINANCE_KEY')) {
    function BINANCE_KEY()
    {
        return mangeBinanceApi()->key;
    }
}


//binance key

if (!function_exists('BINANCE_SECRE')) {
    function BINANCE_SECRE()
    {
        return mangeBinanceApi()->secret;
    }
}


if (!function_exists('CURRENT_TIME')) {
    function CURRENT_TIME()
    {
        $currentDateTime = Carbon::now();
        return $currentDateTime->format('Y-m-d H:i:s');
    }
}


function isProductPurchased($productId)
{
    $user = Auth::user();

    $isPurchased = "";
    if (Auth::check()) {
        $isPurchased = OrderDetails::where('product_id', $productId)
            ->whereHas('order', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->exists();
    }

    return $isPurchased;
}

function isProductWishlist($product_id) {

    $isWishlist = "";

    if (Auth::check()) {
        $isWishlist = WishList:: where('product_id', $product_id)
        ->where('user_id', Auth::id())
        ->exists();
    }
    return $isWishlist;
}
