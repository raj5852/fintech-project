<?php

namespace App\Http\Controllers;

use App\Models\Admin\Membership;
use App\Models\Admin\Order;
use Illuminate\Http\Request;
use App\Models\Admin\Product;


use App\Models\User;
use App\Models\User\Subscription;
use App\Services\Backend\PendingUserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        $products = Product::where('is_free', 1)->get();



        $UserMemberShipId = User::find(auth()->user()->id)->subscribe_id;



        if ($UserMemberShipId > 0) {
            //   $monthleyCharge =   User::find(auth()->user()->id)->hasOneSub->monthly_charge_date;
            if (user_month_expires() == 0) {
                $memberShipProducts = Membership::find($UserMemberShipId)->latestProduct;
            } else {
                $memberShipProducts = [];
            }
        } else {
            $memberShipProducts = [];
        }

        $userProducts = User::find(auth()->user()->id)
            ->load(['hasOneSub', 'orderDetails' => function ($query) {
                $query->with(['product', 'order']);
            }]);






        // $productURL =  array_keys($order->product ?->product_url);
        // $productLastUrl = end($productURL);


        return view('user.home', compact('products', 'userProducts', 'memberShipProducts'));
    }

    public function myOrders() {
        $userProducts = User::find(auth()->user()->id)
            ->load(['hasOneSub', 'orderDetails' => function ($query) {
                $query->with(['product', 'order']);
            }]);
        return view('user.myOrders', compact('userProducts'));
    }
    public function myOrderDetails($id) {
        return view('user.myOrderDetails');
    }
    public function myWallet() {
        return view('user.myWallet');
    }
    public function myWishlist() {
        return view('user.myWishlist');
    }
    public function membershipProduct() {


        $UserMemberShipId = User::find(auth()->user()->id)->subscribe_id;



        if ($UserMemberShipId > 0) {
            //   $monthleyCharge =   User::find(auth()->user()->id)->hasOneSub->monthly_charge_date;
            if (user_month_expires() == 0) {
                $memberShipProducts = Membership::find($UserMemberShipId)->latestProduct->toQuery()->paginate(6)->onEachSide(2);
            } else {
                $memberShipProducts = [];
            }
        } else {
            $memberShipProducts = [];
        }
        return view('user.membershipProduct', compact('memberShipProducts'));
    }
    public function editProfile() {
        return view('user.editProfile');
    }
    public function changePassword() {
        return view('user.changePassword');
    }
    public function order()
    {
        $products = Product::where('is_free', 1)->get();
        return view('user.order', compact('products'));
    }

    public function RequestBook(Request $request)
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome(Request $request)
    {
        $totalMemberShip = User::where('subscribe_id', '!=', 0)->count();

        return view('admin.adminHome', compact('totalMemberShip'));
    }

    function allusers(Request $request)
    {
        // return User::find(1)->hasOneSub;
        $users = User::query()
            ->latest()
            ->where('type', '!=', 'admin')
            ->when($request->emailSearch, fn ($q, $email) => $q->where('email', 'like', "%{$email}%"))
            ->with('subscriptions')
            ->paginate(10)
            ->withQueryString();
        return view('admin.all-user', compact('users'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    function addSubscription($id)
    {
        $memberships = Membership::get();
        $user = User::find($id);
        return view('admin.add-subscription', compact('user', 'memberships'));
    }
    function storeSubscription(Request $request, $id)
    {
        $checkSubscription =  Subscription::query()
            ->where('user_id', $id)
            ->exists();

        if ($checkSubscription) {
            return redirect()->back()->with('error', 'User has subscription');
        }

        $request->validate([
            'subscribe_id' => 'required',
            'start_date' => 'required',
            'expire_date' => 'required',
            'total_fee' => 'required',
            'subscribe_fee' => 'required',
            'monthly_charge' => 'required',
            'payment_method' => 'required',
            'monthly_charge_date' => 'required',
        ]);

        $user = User::find($id);
        $user->subscribe_id = $request->subscribe_id;
        $user->save();

        Subscription::create([
            'user_id' => $id,
            'subscribe_id' => $request->subscribe_id,
            'start_date' => $request->start_date,
            'expire_date' => $request->expire_date,
            'total_fee' => $request->total_fee,
            'subscribe_fee' => $request->subscribe_fee,
            'monthly_charge' => $request->monthly_charge,
            'payment_method' => $request->payment_method,
            'monthly_charge_date' => $request->monthly_charge_date
        ]);

        return redirect()->back()->with('success', 'Membership Added Successfully');
    }

    function editSubscription($id)
    {
        $user = User::find($id);

        $subscription = Subscription::find($user->hasOneSub)[0];
        $memberships = Membership::get(['id', 'membership_name']);
        return view('admin.subscription.edit', compact('subscription', 'memberships', 'user'));
    }

    function updateSubscription(Request $request, $id)
    {

        $request->validate([
            'subscribe_id' => 'required',
            'start_date' => 'required',
            'expire_date' => 'required',
            'total_fee' => 'required',
            'subscribe_fee' => 'required',
            'monthly_charge' => 'required',
            'payment_method' => 'required',
            'monthly_charge_date' => 'required',
        ]);

        $user = User::find($id);
        $user->subscribe_id = $request->subscribe_id;
        $user->save();

        Subscription::where('user_id', $id)->update(
            [
                'user_id' => $id,
                'subscribe_id' => $request->subscribe_id,
                'start_date' => $request->start_date,
                'expire_date' => $request->expire_date,
                'total_fee' => $request->total_fee,
                'subscribe_fee' => $request->subscribe_fee,
                'monthly_charge' => $request->monthly_charge,
                'payment_method' => $request->payment_method,
                'monthly_charge_date' => $request->monthly_charge_date
            ]
        );

        return redirect()->back()->with('success', 'Updated successfully');
    }

    function deleteSubscription($id)
    {
        $user = User::find($id);
        $user->subscribe_id = 0;
        $user->save();

        $subscription = Db::table('subscriptions')->where('user_id', $user->id)->delete();

        return redirect()->back()->with('success', 'User subscription deleted');
    }


    function pendingUser()
    {
        $users =   PendingUserService::allPendinguser();
        return view('admin.users.pendinguser', compact('users'))->with('i', (request()->input('page', 1) - 1) * 10);
    }
    function pendingToActive($id)
    {
        $updateEmail =  PendingUserService::pendingToActive($id);
        return redirect()->back()->with('success', 'Email verified successfully!');
    }
    public function genarelMembers() {
        $members = User::where('subscribe_id', 0)->latest()->paginate(10);
        return view('admin.users.genarelUser', compact('members'));
    }
    public function vipMembers() {

        $members = User::where('subscribe_id', 3)->latest()->paginate(10);
        return view('admin.users.vipUser', compact('members'));
    }
    public function premiumMembers() {

        $members = User::where('subscribe_id', 4)->latest()->paginate(10);
        return view('admin.users.premiumUser', compact('members'));
    }
    public function eliteMembers() {

        $members = User::where('subscribe_id', 5)->latest()->paginate(10);
        return view('admin.users.eliteUser', compact('members'));
    }
    public function resellerMembers() {

        $members = User::where('subscribe_id', 6)->latest()->paginate(10);
        return view('admin.users.resellerUser', compact('members'));
    }
}
