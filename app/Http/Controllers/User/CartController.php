<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Http\Requests\CouponRequest;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Coupon;
use App\Models\Admin\Membership;
use App\Models\Admin\Order;
use App\Models\User;
use App\Models\User\Subscription;
use App\Services\Frontend\UserProfileService;
use App\Services\User\CartService;
use Cart;
use Session;
use Auth;
use DB;
use Gloudemans\Shoppingcart\Facades\Cart as FacadesCart;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $productPrice = CartService::cart();

        return view('front.cart.index', $productPrice);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CartRequest $request)
    {

        $validate = $request->validated();

        $product = Product::where('product_slug', $validate['product_slug'])->first();

        $productIdSearch = $product->id;
        $item = FacadesCart::search(function ($cartItem, $rowId) use ($productIdSearch) {
            return $cartItem->id === $productIdSearch;
        });

        if ($item->isNotEmpty()) {
            $message = "<h4 style='color: red;'>The product is already on the Cart!</h4>";
            return response()->json($message);
        }

        $discountPrice =  $product->discount_price;

        Cart::add([
            'id' => $product->id,
            'name' => $product->product_name,
            'qty' => 1,
            'price' => $discountPrice,
            'weight' => 1,
            'options' => ['title' => $product->product_title, 'image' => $product->thumbnail, 'url' => $product->product_url]

        ]);
        session()->forget('coupon');

        return response()->json("<h3>Product Added on Cart!</h3>");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data =  Cart::content();
        return view('front.cart.cart_list', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cartCount()
    {
        $count = Cart::count();
        return response()->json($count);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->rowId;
        $qty  = $request->qty;
        $newdata = array_combine($data, $qty);
        foreach ($newdata as $index => $row) {
            Cart::update($index, $row);
        }
        session()->forget('coupon');
        $notification = array(
            'messege' => 'Card successfully Update!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        session()->forget('coupon');
        $notification = array(
            'messege' => 'Product Remove From Cart!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }


    /**
     * Coupon Apply the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function applyCoupon(CouponRequest $request)
    {

        $validatedData = $request->validated();


        $invalid = array(
            'messege' => 'Invalid Coupon !',
            'alert-type' => 'warning'
        );

        $couponCount = Order::where('coupon', $validatedData['coupon'])->count();
        $exists = Coupon::where('coupon_name', $validatedData['coupon'])->exists();

        $coupon = Coupon::where('coupon_name', $validatedData['coupon'])->first();


        if (!$exists) {
            return back()->with($invalid);
        }

        if ($coupon->coupon_use <= $couponCount) {
            return back()->with($invalid);
        }

        if (session()->get('coupon')) {
            $couponUsed = array(
                'messege' => 'Coupon already used !',
                'alert-type' => 'warning'
            );
            return back()->with($couponUsed);
        }

        $totalAmount =  CartService::totalAmount();

        if ($coupon->use_amount >  $totalAmount) {
            return back()->with($invalid);
        }


        session()->put('coupon', [
            'code' => $coupon->coupon_name,
            'discount' => $coupon->coupon_rate,
            'type' => $coupon->coupon_type,
            'balance' => ($coupon->coupon_type == 'Percent' ? ($totalAmount / 100) * $coupon->coupon_rate :  $coupon->coupon_rate),
        ]);

        $success = array(
            'messege' => 'Coupon used successfully!',
            'alert-type' => 'success'
        );
        return back()->with($success);
    }

    public function Buystore(CartRequest $request)
    {
        $validateData = $request->validated();


        $product = Product::where('product_slug',$validateData['product_slug'])->first();

        $productIdSearch = $product->id;
        $item = FacadesCart::search(function ($cartItem, $rowId) use ($productIdSearch) {
            return $cartItem->id === $productIdSearch;
        });

        $notification = array(
            'messege' => 'Your Buy Now Sucessfully !',
            'alert-type' => 'success'
        );

        if ($item->isNotEmpty()) {
            return Redirect()->route('index.cart')->with($notification);
        }



        Cart::add([
            'id' => $product->id,
            'name' => $product->product_name,
            'qty' => 1,
            'price' => $product->discount_price,
            'weight' => 1,
            'options' => ['title' => $product->product_title, 'image' => $product->thumbnail, 'url' => $product->product_url,]

        ]);


        return Redirect()->route('index.cart')->with($notification);
    }
}
