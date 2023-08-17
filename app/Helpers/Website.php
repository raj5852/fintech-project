<?php

use App\Models\Admin\ManageAPI;
use App\Models\Admin\OrderDetails;
use App\Models\Admin\Product;
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

function isProductWishlist($product_id)
{

    $isWishlist = "";
    $authId =  Auth::id();
    if (Auth::check()) {
        $isWishlist = WishList::where('product_id', $product_id)
            ->where('user_id', $authId)
            ->exists();
    }
    return $isWishlist;
}

if (!function_exists('YearMonthDate')) {

    function YearMonthDate($value)
    {
        $carbonDate = \Carbon\Carbon::parse($value);

        return $carbonDate->toDateString();
    }
}
if (!function_exists('HumanReadableDate')) {
    function HumanReadableDate($value)
    {
        return  $formattedDate = Carbon::parse($value)->isoFormat('DD MMM, YYYY');
    }
}


if (!function_exists('authcheck')) {
    function authcheck()
    {
        return auth()->check() ? 1 : 0;
    }
}

if (!function_exists('usertype')) {
    function usertype()
    {
        return auth()->user()->type;
    }
}

if (!function_exists('user_product')) {
    function user_product($productId)
    {

        if (auth()->check()) {
            return  User::find(auth()->user()->id)
                ->where(function ($query) use ($productId) {
                    $query->where(function ($subQuery) use ($productId) {
                        $subQuery->whereHas('orderDetails', function ($detailQuery) use ($productId) {
                            $detailQuery->where('product_id', $productId)
                                ->where('membership_id', 0);
                        });
                    })->orWhere(function ($subQuery) use ($productId) {
                        $subQuery->whereHas('orderDetails', function ($detailQuery) use ($productId) {
                            $detailQuery->where('product_id', $productId)
                                ->where('membership_id', '!=', 0);
                        })->whereHas('memberships', function ($query) {
                            $query->where('is_life_time', 1)
                                ->orWhere(function ($query) {
                                    $query->where('memberships.monthly_charge', 0)
                                        ->whereDate('subscriptions.expire_date', '>', now());
                                })
                                ->orWhere(function ($query) {
                                    $query->where('memberships.monthly_charge', '!=', 0)
                                        ->whereDate('monthly_charge_date', '>', now());
                                });
                        });
                    });
                })->exists();
        }
        return null;
    }
}


if (!function_exists('date_readable')) {
    function date_readable($userOrder)
    {
        // Convert input string to a Carbon instance
        $inputDatetime = Carbon::createFromFormat('Y-m-d H:i:s', $userOrder);

        // Format the Carbon instance as desired ("12 Jan, 2023")
        return   $outputDateStr = $inputDatetime->format('d M, Y');
    }
}


if (!function_exists('product_time')) {
    function product_time($timestamp)
    {
        $carbonInstance = Carbon::parse($timestamp);

        // Format the Carbon instance as "d M, Y"
        return $formattedDate = $carbonInstance->format('d M, Y');
    }
}


if (!function_exists('checkpermission')) {

    function checkpermission($permissionname)
    {
        $user = auth()->user();
        if($user->type == 'admin'){
            return true;
        }
        return abort_if(auth()->user()->hasPermissionTo($permissionname) != 1, 403);
    }
}
