<?php

namespace App\Http\Controllers;

use App\Models\Admin\Membership;
use App\Models\Admin\Order;
use App\Models\Admin\OrderDetails;
use Illuminate\Http\Request;
use App\Models\Admin\Product;


use App\Models\User;
use App\Models\User\Subscription;
use App\Models\User\WishList;
use App\Services\Backend\PendingUserService;
use App\Services\Frontend\UserProfileService;
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
    public function index(UserProfileService $userProfileService)
    {
        $userDetails =  $userProfileService->userWithMembership();
        $userGroups =  $userProfileService::userGroup();

        return view('user.home', compact('userDetails', 'userGroups'));
    }

    public function myOrders(UserProfileService $userProfileService)
    {
        $userDetails =  $userProfileService->userWithMembership();
        $userGroups =  $userProfileService::userGroup();

        $orders =  $userProfileService->userOrders();

        return view('user.myOrders', compact('userDetails', 'orders', 'userGroups'));
    }
    public function myOrderDetails(UserProfileService $userProfileService, int $productId)
    {
        $userDetails =  $userProfileService->userWithMembership();

        $is_exists = user_product($productId);

        if ($is_exists != 1) {
            return to_route('user.home')->with('error', 'Membership expire!');
        }

        $product = Product::findOrFail($productId);


        $userGroups =  $userProfileService::userGroup();
        $userOrder = OrderDetails::where('product_id', $productId)->withWhereHas('order', function ($query) {
            $query->where('user_id', auth()->user()->id)->select('id');
        })->first();

        return view('user.myOrderDetails', compact('userDetails', 'userOrder', 'product', 'userGroups'));
    }

    public function myWallet(UserProfileService $userProfileService)
    {
        $userDetails =  $userProfileService->userWithMembership();
        $userGroups =  $userProfileService::userGroup();

        return view('user.myWallet', compact('userDetails', 'userGroups'));
    }
    public function myWishlist(UserProfileService $userProfileService)
    {
        $userDetails =  $userProfileService->userWithMembership();
        $userGroups =  $userProfileService::userGroup();
        $wishlists = WishList::where('user_id', auth()->user()->id)->with('product', function ($query) {
            $query->select('id', 'thumbnail', 'discount_price','product_name','product_slug');
        })->paginate(10);

        return view('user.myWishlist', compact('userDetails', 'userGroups', 'wishlists'));
    }
    public function membershipProduct(UserProfileService $userProfileService)
    {
        $userDetails =  $userProfileService->userWithMembership();

        return view('user.membershipProduct', compact('userDetails'));
    }
    public function editProfile(UserProfileService $userProfileService)
    {
        $userDetails =  $userProfileService->userWithMembership();
        $userGroups =  $userProfileService::userGroup();

        return view('user.editProfile', compact('userDetails', 'userGroups'));
    }
    public function changePassword()
    {
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
        checkpermission('dashboard');

        $totalMemberShip = User::where('subscribe_id', '!=', 0)->count();

        return view('admin.adminHome', compact('totalMemberShip'));
    }

    function allusers(Request $request)
    {
        checkpermission('memberships');

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

        checkpermission('memberships');
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
        checkpermission('memberships');

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

        checkpermission('memberships');
        $user = User::find($id);
        $user->subscribe_id = 0;
        $user->save();

        $subscription = Db::table('subscriptions')->where('user_id', $user->id)->delete();

        return redirect()->back()->with('success', 'User subscription deleted');
    }


    function pendingUser()
    {
        checkpermission('pending-user');
        $users =   PendingUserService::allPendinguser();
        return view('admin.users.pendinguser', compact('users'))->with('i', (request()->input('page', 1) - 1) * 10);
    }
    function pendingToActive($id)
    {
        checkpermission('pending-user');
        $updateEmail =  PendingUserService::pendingToActive($id);
        return redirect()->back()->with('success', 'Email verified successfully!');
    }
    public function genarelMembers()
    {
        checkpermission('memberships');
        $members = User::where('subscribe_id', 0)->latest()->paginate(10);
        return view('admin.users.genarelUser', compact('members'));
    }
    public function vipMembers()
    {
        checkpermission('memberships');

        $members = User::where('subscribe_id', 3)->latest()->paginate(10);
        return view('admin.users.vipUser', compact('members'));
    }
    public function premiumMembers()
    {
        checkpermission('memberships');

        $members = User::where('subscribe_id', 4)->latest()->paginate(10);
        return view('admin.users.premiumUser', compact('members'));
    }
    public function eliteMembers()
    {
        checkpermission('memberships');

        $members = User::where('subscribe_id', 5)->latest()->paginate(10);
        return view('admin.users.eliteUser', compact('members'));
    }
    public function resellerMembers()
    {
        checkpermission('memberships');

        $members = User::where('subscribe_id', 6)->latest()->paginate(10);
        return view('admin.users.resellerUser', compact('members'));
    }
}
