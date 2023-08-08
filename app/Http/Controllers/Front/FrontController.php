<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Admin\Brand;
use App\Models\Admin\Testimonial;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Membership;
use App\Models\Contact;
use App\Models\Admin\Features;
use App\Models\Admin\Afeature;
use App\Models\Admin\Page;
use App\Models\Admin\Subscriber;
use App\Models\User\RequestProduct;
use App\Models\RequestBooking;
use App\Models\MarketPlace;
use App\Models\HomePage;
use App\Models\Admin\AboutTwo;
use App\Models\Admin\AboutOne;
use App\Models\Admin\Medicine;
use App\Models\FixedSpecification;
use App\Services\Frontend\ShopService;
use App\Services\Frontend\UserProfileService;
use App\Services\User\PreorderService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonial = Testimonial::all();
        $freeProducts = Product::where('is_free', 1)
            ->take(4)
            ->orderBy('is_link_updated', 'desc')
            ->get();
        $latestProducts = Product::take(8)
            ->orderBy('is_link_updated', 'desc')
            ->where('status', 1)
            ->get();
        $memberships = Membership::get();
        $requestProducts = RequestProduct::get();
        $categories = Category::get();
        $marketPlaces = MarketPlace::get();
        $requestProducttwos = Medicine::get();

        return view('front.home', compact('testimonial', 'freeProducts', 'latestProducts', 'memberships', 'requestProducts', 'categories', 'marketPlaces', 'requestProducttwos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function membership()
    {
        // $memberships = Membership::latest()->get();
        $memberships = Membership::get();
        return view('front.membership', compact('memberships'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function shop()
    {
        $shopPage = ShopService::show();
        return view('front.shop', $shopPage);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function productDetails($product_slug)
    {
        $product = Product::where([
            'product_slug' => $product_slug,
            'status' => 1,
        ])
        ->firstOrFail();



        $latest_product = Product::where('product_slug', '!=', $product_slug)
            ->latest()
            ->take(4)
            ->get();
        $fixeds = FixedSpecification::all();

        $shareComponent = \Share::page(route('product.details', $product_slug))
            ->facebook()
            ->twitter()
            ->linkedin()
            ->telegram()
            ->whatsapp();

        $userType = auth()->check() ? auth()->user()->type : 0;
        $userId = auth()->check() ? auth()->user()->id : 0;


        return view('front.product_details', compact('product', 'latest_product', 'shareComponent', 'fixeds','userType','userId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function customerRequest()
    {
        $requestProducts = RequestProduct::get();
        $homepages = HomePage::get();
        $requestProducttwos = Medicine::get();
        return view('front.customer_request', compact('requestProducts', 'homepages', 'requestProducttwos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ContatctUs()
    {
        return view('front.contact');
    }

    public function ContatctStore(Request $request)
    {
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->address = $request->address;
        $contact->description = $request->description;
        $contact->save();

        $notification = [
            'messege' => 'Successfully Conatct Sent Please Wait !',
            'alert-type' => 'success',
        ];
        return Redirect()
            ->back()
            ->with($notification);
    }

    public function PrivacyPolicy()
    {
        $privacy_policy = Features::all();
        return view('front.privacy_policy', compact('privacy_policy'));
    }

    public function TeamAndCondition()
    {
        $privacy_policy = Afeature::all();
        return view('front.team_and_condition', compact('privacy_policy'));
    }

    public function AboutUs()
    {
        $about = DB::table('abouts')->first();
        $aboutones = AboutOne::all();
        $abouttwos = AboutTwo::all();
        $products = Product::take(4)
            ->orderBy('is_link_updated', 'desc')
            ->get();

        $homepages = HomePage::get()->toArray();
        return view('front.about', compact('about', 'products', 'homepages', 'aboutones', 'abouttwos'));
    }

    public function HowToWork()
    {
        $pages = Page::all();
        return view('front.how_to_work', compact('pages'));
    }

    public function subscriberStore(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|unique:subscribers',
            ],
            [
                'email.unique' => 'Already Subscribed!',
                'email.required' => 'Please provide your email',
            ],
        );
        // $subscriber = new Subscriber();
        // $subscriber->email = $request->email;
        // $subscriber->save();
        Subscriber::create($request->except('_token'));

        $notification = [
            'messege' => 'Successfully Subscribed!',
            'alert-type' => 'success',
        ];
        return Redirect()
            ->back()
            ->with($notification);
    }

    public function MenberProduct($id)
    {
        // $product = Membership::where('id',$id)->first()->products;

        $start_price = '';
        $end_price = '';
        $category_id = '';
        $subcategory_id = '';
        $category = Category::with('product')->get();
        $products = Product::where('membership_id', $id);

        $product = Membership::where('id', $id)->first();
        $products = $product->products()->latest();

        // $products = Membership::where('id',$id)->first()->products;
        //return response()->json($products);
        if (isset($_GET['sort']) && !empty($_GET['sort'])) {
            if ($_GET['sort'] == 'product_popular') {
                $products->orderBy('products.id', 'Desc');
            } elseif ($_GET['sort'] == 'product_ratting') {
                $products->orderby('products.product_name', 'Asc');
            } elseif ($_GET['sort'] == 'price_low_to_high') {
                $products->orderby('products.product_price', 'Asc');
            } elseif ($_GET['sort'] == 'price_high_to_low') {
                $products->orderby('products.product_price', 'Desc');
            } elseif ($_GET['sort'] == 'price_high_to_low') {
                $products->orderby('products.product_name', 'Desc');
            }
        }

        $products = $products->paginate(12);

        $members = Membership::all();

        //return response()->json($products);
        return view('front.member_product', compact('members', 'products', 'start_price', 'end_price', 'category_id', 'subcategory_id', 'category'));
    }

    public function search(Request $request)
    {
        $products = Product::orderBy('id', 'desc')->where('product_name', 'LIKE', '%' . $request->product . '%');
        if ($request->category != 'ALL') {
            $products->where('category_id', $request->category);
        }
        $products = $products->paginate(12);

        $start_price = '';
        $end_price = '';
        $category_id = '';
        $subcategory_id = '';

        $category = Category::with('product')->get();

        $members = Membership::all();

        return view('front.search_product', compact('products', 'category_id', 'start_price', 'end_price', 'subcategory_id', 'category', 'members'));
    }

    public function RequestStore(Request $request)
    {
        if (Auth::check()) {
            $data = new RequestBooking();
            $data->user_id = Auth::id();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->software_name = $request->software_name;
            $data->details = $request->details;
            $data->author_name = $request->author_name;
            $data->baker_name = $request->baker_name;
            $data->trading_security = $request->trading_security;
            $data->trading_account = $request->trading_account;
            $data->trading_server = $request->trading_server;
            $data->deposite_amount = $request->deposite_amount;
            // $data->value          = $request->value;
            $data->value = json_encode($request->value);
            $data->status = 1;

            if ($request->hasFile('imageone')) {
                $image_tmp = $request->file('imageone');
                if ($image_tmp->isValid()) {
                    // Get image extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 999) . '.' . $extension;
                    $imagePath = 'backend/images/bookproduct/' . $imageName;
                    // Upload the imaage
                    Image::make($image_tmp)->save($imagePath);
                    $data->imageone = $imageName;
                } else {
                    $data->imageone = '';
                }
            }

            if ($request->hasFile('imagetwo')) {
                $image_tmp = $request->file('imagetwo');
                if ($image_tmp->isValid()) {
                    // Get image extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 999) . '.' . $extension;
                    $imagePath = 'backend/images/bookproduct/' . $imageName;
                    // Upload the imaage
                    Image::make($image_tmp)->save($imagePath);
                    $data->imagetwo = $imageName;
                } else {
                    $data->imagetwo = '';
                }
            }

            //return response()->json($data);
            $data->save();

            $data->save();
            $notification = [
                'messege' => 'Product Request Successfully  Please Wait ',
                'alert-type' => 'success',
            ];
            return Redirect()
                ->back()
                ->with($notification);
        } else {
            return redirect()
                ->route('login')
                ->with('error', 'Please Login First For Requesting Product !');
        }
    }

    public function discussion()
    {
        return view('front.discussion');
    }

    public function discussionDetails()
    {
        return view('front.discussionDetails');
    }
    public function renew_membership(UserProfileService $uerProfileService)
    {
        $userDetails = $uerProfileService->userWithMembership();

        if ($userDetails->memberships_exists != true && $userDetails ?->memberships[0]?->pivot?->is_life_time != 0) {
            return redirect('/user/home')->with('error', 'You have no access');
        }

        $membership =  $uerProfileService->userMembership();

        return view('front.renew_membership', compact('membership'));
    }
    public function preorder_view()
    {
        $preorders =    PreorderService::index();
        return view('front.preorder_view',compact('preorders'));
    }
    public function license()
    {
        return view('front.license');
    }
    public function preorder_details($slug)
    {
        $products = Product::where([
            'product_slug' => $slug,
            'status' => 1,
            'pre_order_status'=> 1
        ])
        ->with('category')
        ->select('category_id', 'id', 'product_name',  'product_price','discount_price', 'pre_order_status', 'minimum_orders', 'thumbnail','images')
        ->withCount('orders')->firstOrFail();


        $latest_product = Product::latest()
            ->take(4)
            ->get();
        $fixeds = FixedSpecification::all();

        $shareComponent = \Share::page(route('product.details', $slug))
            ->facebook()
            ->twitter()
            ->linkedin()
            ->telegram()
            ->whatsapp();

        return view('front.preorder_details', compact('products', 'latest_product', 'shareComponent', 'fixeds'));
    }
}
