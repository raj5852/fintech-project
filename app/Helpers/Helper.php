<?php

namespace App\Helpers;


use Image;
use App\Models\User\WishList;
use Illuminate\Support\Facades\Auth;

class Helper
{
    public static function upload_image($filename , $width , $height, $path = 'backend/assets/images/')
    {
        $imagename = uniqid().'.'.$filename->getClientOriginalExtension();
        $new_webp = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $imagename);

        Image::make($filename)->encode('webp', 90)->fit($width, $height)->save($path.$new_webp);
        $image_upload = $path.$new_webp;
        return $image_upload;
    }

    public static function coupon_code()
    {
        $uniqid = uniqid();
        $rand_start = rand(0,9);
        $coupon = substr($uniqid,$rand_start,6);
        return $coupon;
    }

    public static function product_code()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $result = '';
        for ($i = 0; $i < 5; $i++)
        $result .= $characters[mt_rand(0, 24)];
        return $result.'-'. rand(0,99999);
    }

    public static function discount($amount , $rate , $type)
    {
        if($type == "Flat"){
            $result = $amount - $rate ;
            return $result;
        }else{
           $result = $amount - ($amount /100 * $rate);
           return $result;
        }

    }

    public static function countWishlist()
    {
        return WishList::where('user_id',Auth::id())->count();
    }

    public static function wishlistPopup()
    {
        $data = WishList::join('products','wish_lists.product_id','products.id')
                        ->select('wish_lists.id','products.product_name','products.thumbnail','products.product_title','products.product_price','products.discount_rate','products.discount_price')
                        ->where('user_id',Auth::id())->limit(4)->get();
        return view('user.wish_list.wish_list',compact('data'));
    }


    public static function refund($amount)
    {
        if($amount >= 10){
           return $amount /100 * 10 ;
        }

        return 0.00;

    }






}
