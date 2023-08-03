@extends('layouts.front')
@section('title')
    User Home
@endsection
@section('front_content')
    @push('css')
    @endpush

    @php
        $orders = App\Models\Admin\Order::where('user_id', Auth::id())
            ->latest()
            ->get();
        $wishlists = App\Models\User\WishList::join('products', 'wish_lists.product_id', 'products.id')
            ->select('products.*', 'wish_lists.id', 'wish_lists.product_id')
            ->where('user_id', Auth::id())
            ->get();
        $payments = App\Models\User\Recharge::where('user_id', Auth::id())
            ->latest()
            ->get();
        $subscribe = App\Models\Admin\Membership::join('subscriptions', 'memberships.id', 'subscriptions.subscribe_id')
            ->join('coupons', 'membership_id', 'subscriptions.subscribe_id')
            ->select('subscriptions.*', 'memberships.membership_name', 'coupons.coupon_name', 'coupons.coupon_type', 'coupons.coupon_rate')
            ->where('subscriptions.user_id', Auth::id())
            ->first();
        //dd($subscribe);
    @endphp
    <!-- breadcrumb  -->
    <div class="bredcrumb">

        @if (session()->has('success'))
        <h2 class="pt-5">Order Successfully Completed</h2>
        <h3>Here is your product link: </h3><br>
            <ul>
                @foreach (session()->get('success') as $key=>$successMessage)

                    <li>
                      <div>
                        @if (session()->get('successName'))
                        <p >Name: {{ session()->get('successName')[$key] }} </p>

                        @endif
                        <a style="color: #29ffdf;font-weight:bold; text-transform: lowercase;" target="_blank" href="{{ $successMessage }}">{{ substr($successMessage, 0, 30) }}....</a>

                      </div>
                    </li><br>
                @endforeach
            </ul>
            <br><br>
        @endif
        <h2 class="bredcrumb__title">my account</h2>
        <ul class="bredcrumb__items">
            <li>Home <i class="bi bi-chevron-right"></i></li>
            <li>my account</li>
        </ul>
    </div>

    @php
        $userDetails = App\Models\User::where('email', Auth::user()->email)->first();
    @endphp



    @if ($subscribe)
        @if ($subscribe->monthly_charge_date != null)
            @if (date('Y-m-d') > date('Y-m-d', strtotime('-5 day', strtotime($subscribe->monthly_charge_date))) &&
                    date('Y-m-d') < $subscribe->monthly_charge_date)
                <div class="alert alert-warning border-0 bg-warning alert-dismissible fade show">
                    <div class="text-dark"> Your <span style="font-weight: bolder;"> "{{ $subscribe->membership_name }}"
                        </span> monthly payment date is expired soon <span style="font-weight: bolder;">(
                            {{ date('d-m-Y', strtotime($subscribe->monthly_charge_date)) }} )</span>.Please pay <span
                            style="font-weight: bolder;"> ${{ $subscribe->monthly_charge }} </span> monthly charge to
                        continue service . <span><a class="badgr bg-info" style="padding:5px;" href="">For
                                Pay</a></span> </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (date('Y-m-d') > $subscribe->monthly_charge_date)
                <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                    <div class="text-white"> Your <span style="font-weight: bolder;"> "{{ $subscribe->membership_name }}"
                        </span>monthly payment date is expired <span style="font-weight: bolder;">(
                            {{ date('d-m-Y', strtotime($subscribe->monthly_charge_date)) }} )</span>. Please pay <span
                            style="font-weight: bolder;"> ${{ $subscribe->monthly_charge }} </span> monthly charge to
                        Reactive service . <span style="float:right;"><a class="badgr bg-info p-1 mr-1 " href="">For
                                Pay</a></span> </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        @else
        @endif
    @endif
    </div>
    <!-- dashboard  -->

    <div class="dashboard">
        <div class="container">
            <div class="dashboard__header">
                <div class="dashboard__header-left">
                    <div class="dashboard__header-thumb">
                        <img src="{{ asset(Auth::user()->image) }}" alt="profile">
                    </div>
                    <div class="dashboard__header-content">
                        <h4 class="dashboard__header-name">{{ Auth::user()->name }}</h4>
                        <h4 class="dashboard__header-name">
                            @if ($userDetails->subscribe_id == 0)
                                General User
                            @else
                                {{ $userDetails->member->membership_name }}
                            @endif
                        </h4>
                        <button class="common_btn"><span style="font-size :18px;" class="px-4">$
                                {{ Auth::user()->balance }}
                            </span></button>
                    </div>
                </div>
            </div>
            <div class="dashboard-mobile">
                <button class="dashboard-open">open menu <i class="bi bi-chevron-down"></i> </button>
            </div>
            <div class="dashboard__main">
                <div class="row gx-5">
                    <div class="col-xl-4">
                        <div class="dashboard__main-left nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-link active" href="{{ url('user/order') }}"> <img
                                    src="{{ asset('frontend/') }}/img/ic2.png" alt="ic1">My Order</a>
                            <a class="nav-link" href="{{ url('user/home') }}"> <img
                                    src="{{ asset('frontend/') }}/img/ic1.png" alt="ic1"> my profile</a>

                            <a class="nav-link" href="{{ url('user/home') }}"> <img
                                    src="{{ asset('frontend/') }}/img/ic3.png" alt="ic1"> <span>My wallet</span></a>
                            <a class="nav-link" href="{{ url('user/home') }}"><span> <img
                                        src="{{ asset('frontend/') }}/img/ic4.png" alt="ic1"> <span>My wishlist</span>
                                </span><span class="dashboard__main-count">{{ $wishlists->count() }}</span></button>
                                @if ($userDetails->subscribe_id == 0)
                                @else
                                    <a class="nav-link" href="{{ url('user/home') }}"> <img class=" "
                                            src="{{ asset('frontend/') }}/img/membership.png" alt="ic1"> Membership
                                        Product</a>
                                @endif
                                <a class="nav-link" href="{{ url('user/home') }}"> <img
                                        src="{{ asset('frontend/') }}/img/ic6.png" alt="ic1"> Edit Profile</a>
                                <a class="nav-link" href="{{ url('user/home') }}"> <img
                                        src="{{ asset('frontend/') }}/img/ic5.png" alt="ic1"> Change Password</a>

                                <a class="nav-link logout" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><img
                                        src="{{ asset('frontend/') }}/img/power.png" alt="ic1"> Logout</span></a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                aria-labelledby="v-pills-home-tab">
                                <div class="dashboard__profile-oder">
                                    <span class="dashboard__profile-bltitle">Order List</span>
                                    <div class="dashboard__title-info">
                                        <span>Order No</span>
                                        <span>Order Date</span>
                                        <span>Total Price</span>
                                        <span>Payment By</span>

                                    </div>


                                    @foreach ($orders as $key => $order)
                                        <div class="dashboard__profile-wrapper">
                                            <div class="dashboard__profile-itemm product-order">
                                                <div>
                                                    <img class="order-close-icon" src="img/close.png" alt="">
                                                    <img src="img/sm-p.png" alt="">
                                                </div>
                                                <div>

                                                    <h4>{{ $order->order_no }}
                                                    </h4>
                                                </div>
                                            </div>
                                            <div class="dashboard__profile-itemm">
                                                <h4> {{ $order->created_at->format('d-m-Y') }}</h4>
                                            </div>
                                            <div class="dashboard__profile-itemm">
                                                <h4> <span>$</span>{{ $order->total_price }}</h4>
                                            </div>
                                            <div class="dashboard__profile-itemm">
                                                <h4>{{ $order->payment_method }}</h4>
                                            </div>
                                            <div class="dashboard__profile-itemm">
                                                <a href="{{ url('user/order/view', $order->id) }}"
                                                    class="common_btn">view</a>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                        {{-- wallet start --}}

                        {{-- wallte end --}}

                        {{-- Wish start --}}

                        <!-- GOOGLE_CLIENT_ID=440141517372-6ar7ru5iiat50jen9b7vjs54880tcjf9.apps.googleusercontent.co
        GOOGLE_CLIENT_SECRET=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 -->


                        {{-- Wish end --}}



                        <div class="tab-pane fade" id="v-pills-log" role="tabpanel" aria-labelledby="v-pills-log-tab">
                            ...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- footer -->


    @push('js')
    @endpush

@endsection
