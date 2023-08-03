@extends('layouts.front')
@section('title')
    My Orders
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
        // $subscribe = App\Models\Admin\Membership::join('subscriptions','memberships.id','subscriptions.subscribe_id')
        // ->join('coupons','membership_id','subscriptions.subscribe_id')
        // ->select('subscriptions.*','memberships.membership_name','coupons.coupon_name','coupons.coupon_type','coupons.coupon_rate')
        // ->where('subscriptions.user_id',Auth::id())->first();
        //  dd($subscribe);
        $subscribe = App\Models\User\Subscription::where('user_id', auth()->user()->id)->first();

    @endphp
    <!-- breadcrumb  -->
    <div class="bredcrumb">

        @if (session()->has('success'))
            <h2 class="pt-5">Order Successfully Completed</h2>
            <h3>Here is your product link: </h3><br>
            <ul>
                @foreach (session()->get('success') as $key => $successMessage)
                    <li>
                        <div>
                            @if (session()->get('successName'))
                                <p>Name: {{ session()->get('successName')[$key] }} </p>
                            @endif
                            @if(filter_var($successMessage,FILTER_VALIDATE_URL))
                            <a style="color: #29ffdf;font-weight:bold; text-transform: lowercase;" target="_blank"
                            href="{{  $successMessage }}">{{ substr( $successMessage, 0, 30) }}....</a>

                            @else
                            <a style="color: #29ffdf;font-weight:bold; text-transform: lowercase;" target="_blank"
                            href="{{ decrypt ($successMessage) }}">{{ substr( decrypt($successMessage), 0, 30) }}....</a>

                            @endif

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
            @if (date('Y-m-d') > date('Y-m-d', strtotime('-7 day', strtotime($subscribe->monthly_charge_date))) &&
                    date('Y-m-d') < $subscribe->monthly_charge_date)
                <div class="alert alert-warning border-0 bg-warning alert-dismissible fade show">
                    <div class="text-dark"> Your <span style="font-weight: bolder;">
                            "{{ $subscribe->membership->membership_name }}" </span> monthly payment date is expired soon
                        <span style="font-weight: bolder;">( {{ date('d-m-Y', strtotime($subscribe->monthly_charge_date)) }}
                            )</span>.Please pay <span style="font-weight: bolder;"> ${{ $subscribe->monthly_charge }}
                        </span> monthly charge to continue service .</span> </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (date('Y-m-d') > $subscribe->monthly_charge_date)
                <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                    <div class="text-white"> Your <span style="font-weight: bolder;">
                            "{{ $subscribe->membership->membership_name }}" </span>monthly payment date is expired <span
                            style="font-weight: bolder;">( {{ date('d-m-Y', strtotime($subscribe->monthly_charge_date)) }}
                            )</span>. Please pay <span style="font-weight: bolder;"> ${{ $subscribe->monthly_charge }}
                        </span> monthly charge to Reactive service . </div>
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
                        <h4 class="dashboard__header-name name-ab">{{ Auth::user()->name }}</h4>
                        <h4 class="dashboard__header-name role-ab">
                            @if ($userDetails->subscribe_id == 0)
                                General User
                            @else
                                {{ $userDetails->member->membership_name }}
                            @endif
                        </h4>
                        <div class="dashboard__header-btn-box">
                            <button class="__pp">$ {{ number_format(Auth::user()->balance, 2) }}</button>
                            <a class="common-btn" href="#">
                                <span style="margin-right:5px">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M6.3335 6.99988H8.00017C8.17698 6.99988 8.34655 6.92965 8.47157 6.80462C8.5966 6.6796 8.66683 6.51003 8.66683 6.33322C8.66683 6.1564 8.5966 5.98684 8.47157 5.86181C8.34655 5.73679 8.17698 5.66655 8.00017 5.66655H7.3335V5.33322C7.3335 5.15641 7.26326 4.98684 7.13824 4.86181C7.01321 4.73679 6.84364 4.66655 6.66683 4.66655C6.49002 4.66655 6.32045 4.73679 6.19543 4.86181C6.07041 4.98684 6.00017 5.15641 6.00017 5.33322V5.69988C5.59512 5.78213 5.23507 6.01195 4.98994 6.34473C4.7448 6.6775 4.63206 7.08949 4.6736 7.50072C4.71514 7.91194 4.90799 8.29306 5.21472 8.57009C5.52146 8.84712 5.92018 9.0003 6.3335 8.99988H7.00017C7.08857 8.99988 7.17336 9.035 7.23587 9.09751C7.29838 9.16003 7.3335 9.24481 7.3335 9.33322C7.3335 9.42162 7.29838 9.50641 7.23587 9.56892C7.17336 9.63143 7.08857 9.66655 7.00017 9.66655H5.3335C5.15669 9.66655 4.98712 9.73679 4.8621 9.86181C4.73707 9.98684 4.66683 10.1564 4.66683 10.3332C4.66683 10.51 4.73707 10.6796 4.8621 10.8046C4.98712 10.9296 5.15669 10.9999 5.3335 10.9999H6.00017V11.3332C6.00017 11.51 6.07041 11.6796 6.19543 11.8046C6.32045 11.9296 6.49002 11.9999 6.66683 11.9999C6.84364 11.9999 7.01321 11.9296 7.13824 11.8046C7.26326 11.6796 7.3335 11.51 7.3335 11.3332V10.9666C7.73855 10.8843 8.09859 10.6545 8.34373 10.3217C8.58887 9.98893 8.70161 9.57694 8.66007 9.16572C8.61853 8.75449 8.42568 8.37337 8.11894 8.09634C7.81221 7.81931 7.41348 7.66613 7.00017 7.66655H6.3335C6.2451 7.66655 6.16031 7.63143 6.0978 7.56892C6.03529 7.50641 6.00017 7.42162 6.00017 7.33322C6.00017 7.24481 6.03529 7.16003 6.0978 7.09751C6.16031 7.035 6.2451 6.99988 6.3335 6.99988ZM14.0002 7.99988H12.0002V1.99988C12.0006 1.88241 11.97 1.7669 11.9115 1.66505C11.853 1.56319 11.7686 1.47862 11.6668 1.41988C11.5655 1.36137 11.4505 1.33057 11.3335 1.33057C11.2165 1.33057 11.1015 1.36137 11.0002 1.41988L9.00017 2.56655L7.00017 1.41988C6.89882 1.36137 6.78386 1.33057 6.66683 1.33057C6.54981 1.33057 6.43485 1.36137 6.3335 1.41988L4.3335 2.56655L2.3335 1.41988C2.23216 1.36137 2.11719 1.33057 2.00017 1.33057C1.88314 1.33057 1.76818 1.36137 1.66683 1.41988C1.5651 1.47862 1.48069 1.56319 1.42215 1.66505C1.36362 1.7669 1.33303 1.88241 1.3335 1.99988V12.6665C1.3335 13.197 1.54422 13.7057 1.91929 14.0808C2.29436 14.4558 2.80307 14.6665 3.3335 14.6665H12.6668C13.1973 14.6665 13.706 14.4558 14.081 14.0808C14.4561 13.7057 14.6668 13.197 14.6668 12.6665V8.66655C14.6668 8.48974 14.5966 8.32017 14.4716 8.19515C14.3465 8.07012 14.177 7.99988 14.0002 7.99988ZM3.3335 13.3332C3.15669 13.3332 2.98712 13.263 2.8621 13.138C2.73707 13.0129 2.66683 12.8434 2.66683 12.6665V3.15322L4.00017 3.91322C4.10306 3.96696 4.21742 3.99502 4.3335 3.99502C4.44958 3.99502 4.56394 3.96696 4.66683 3.91322L6.66683 2.76655L8.66683 3.91322C8.76973 3.96696 8.88409 3.99502 9.00017 3.99502C9.11625 3.99502 9.23061 3.96696 9.3335 3.91322L10.6668 3.15322V12.6665C10.6686 12.894 10.7092 13.1194 10.7868 13.3332H3.3335ZM13.3335 12.6665C13.3335 12.8434 13.2633 13.0129 13.1382 13.138C13.0132 13.263 12.8436 13.3332 12.6668 13.3332C12.49 13.3332 12.3205 13.263 12.1954 13.138C12.0704 13.0129 12.0002 12.8434 12.0002 12.6665V9.33322H13.3335V12.6665Z" fill="white"/>
                                    </svg>
                                </span>
                                <span>
                                    Recharge
                                </span>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
             <!-- mobile version 992px -->
             <div class="mobile-version-menu">
                <ul>
                    <li><a class="item common-btn" href="{{route('user.home')}}">My Profile</a></li>
                    <li><a class="item common-btn active" href="{{route('user.my-orders')}}">My Orders</a></li>
                    <li><a class="item common-btn" href="{{route('user.my-wallet')}}">My Wallet</a></li>
                    <li><a class="item common-btn" href="{{route('user.my-wishlist')}}">My Wishlist</a></li>
                    <li><a class="item common-btn" href="{{route('user.membership-product')}}">Membership Product</a></li>
                    <li><a class="item common-btn" href="{{route('user.edit-profile')}}">Edit Profile</a></li>
                    <li><a class="item common-btn" href="{{ route('logout') }}">Logout</a></li>
                </ul>
                
            </div>
            <div class="mobile-show-content">
                
                <!-- new table start  -->
                <div class="table-responsive ab-table-wrap order">
                    <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Order Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="product-rp">
                                    <div class="img">
                                        <img src="{{ asset('frontend/') }}/img/items-img-1.png" alt="">
                                    </div>
                                    <h1 class="__name">Microsoft Office</h1>
                                </div>
                            </td>
                            <td><span class="__pp">$45.00</span></td>
                            <td><a class="common-btn" href="#">Details</a></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="product-rp">
                                    <div class="img">
                                        <img src="{{ asset('frontend/') }}/img/items-img-1.png" alt="">
                                    </div>
                                    <h1 class="__name">Microsoft Office</h1>
                                </div>
                            </td>
                            <td><span class="__pp">$45.00</span></td>
                            <td><a class="common-btn" href="#">Details</a></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="product-rp">
                                    <div class="img">
                                        <img src="{{ asset('frontend/') }}/img/items-img-1.png" alt="">
                                    </div>
                                    <h1 class="__name">Microsoft Office</h1>
                                </div>
                            </td>
                            <td><span class="__pp">$45.00</span></td>
                            <td><a class="common-btn" href="#">Details</a></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="product-rp">
                                    <div class="img">
                                        <img src="{{ asset('frontend/') }}/img/items-img-1.png" alt="">
                                    </div>
                                    <h1 class="__name">Microsoft Office</h1>
                                </div>
                            </td>
                            <td><span class="__pp">$45.00</span></td>
                            <td><a class="common-btn" href="#">Details</a></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="product-rp">
                                    <div class="img">
                                        <img src="{{ asset('frontend/') }}/img/items-img-1.png" alt="">
                                    </div>
                                    <h1 class="__name">Microsoft Office</h1>
                                </div>
                            </td>
                            <td><span class="__pp">$45.00</span></td>
                            <td><a class="common-btn" href="#">Details</a></td>
                        </tr>
                            
                        
                            
                    </tbody>
                    </table>
                </div>
                <!-- new table end  -->
            </div>
            <!-- end mobile version 992px -->



            <div class="dashboard-mobile d-none">
                <button class="dashboard-open">open menu <i class="bi bi-chevron-down"></i> </button>
            </div>
            <div class="dashboard__main">
                <div class="row gx-5">
                    <div class="col-xl-4">
                         
                        <div class="dashboard__main-left nav flex-column nav-pills me-3 das-nav-sidebar-akkjlw" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            {{-- <button class="nav-link" id="v-pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                                aria-selected="true"> <img src="{{ asset('frontend/') }}/img/ic1.png" alt="ic1"> my profile</button> --}}
						    <a href="{{route('user.home')}}" class="nav-link "><span class="side-i-style-oxiz"><i class="fa-regular fa-user"></i></span> <span class="side-text-style-oxiz">my profile</span></a>
                            <a href="{{route('user.my-orders')}}" class="nav-link active justify-content-between"><span><span class="side-i-style-oxiz"><i class="fa-solid fa-wallet"></i></span> <span class="side-text-style-oxiz">my Orders</span></span> <span class="dashboard__main-count">{{ $orders->count() }}</span></a>
                            <a href="{{route('user.my-wallet')}}" class="nav-link "><span class="side-i-style-oxiz"><i class="fa-regular fa-heart"></i></span> <span class="side-text-style-oxiz">my Wallet</span></button>
                            <a href="{{route('user.my-wishlist')}}" class="nav-link justify-content-between"><span><span class="side-i-style-oxiz"><i class="fa-solid fa-folder-plus"></i></span> <span class="side-text-style-oxiz">my WishList</span>
                                </span><span class="dashboard__main-count">{{ $wishlists->count() }}</span></button>
                            @if ($userDetails->subscribe_id !== 0)
                                <a href="{{route('user.membership-product')}}" class="nav-link"><span class="side-i-style-oxiz"><i class="fa-solid fa-box-open"></i></span> <span class="side-text-style-oxiz">Membership Product</span></a>
                            @endif
                            <a href="{{route('user.edit-profile')}}" class="nav-link"><span class="side-i-style-oxiz"><i class="fa-solid fa-user-pen"></i></span> <span class="side-text-style-oxiz">Edit Profile</span></a>
                            <!-- <a href="{{route('user.change-password')}}" class="nav-link"> <img src="{{ asset('frontend/') }}/img/ic5.png" alt="ic1"> Change Password</button> -->
                            <a class="nav-link logout" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="side-i-style-oxiz"><i class="fa-solid fa-power-off"></i></span> <span class="side-text-style-oxiz">Logout</span></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel"
                                aria-labelledby="v-pills-profile-tab">
                                <div class="dashboard__profile-content ">
                                    <div class="dashboard__profile-order">
                                        <span class="dashboard__profile-bltitle">Order List</span>
                                         
                                         
  

                                        <!-- new table start  -->
                                        <div class="table-responsive ab-table-wrap order">
                                            <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Order Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="product-rp">
                                                            <div class="img">
                                                                <img src="{{ asset('frontend/') }}/img/items-img-1.png" alt="">
                                                            </div>
                                                            <h1 class="__name">Microsoft Office</h1>
                                                        </div>
                                                    </td>
                                                    <td><span class="__pp">$45.00</span></td>
                                                    <td><a class="common-btn" href="#">Details</a></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="product-rp">
                                                            <div class="img">
                                                                <img src="{{ asset('frontend/') }}/img/items-img-1.png" alt="">
                                                            </div>
                                                            <h1 class="__name">Microsoft Office</h1>
                                                        </div>
                                                    </td>
                                                    <td><span class="__pp">$45.00</span></td>
                                                    <td><a class="common-btn" href="#">Details</a></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="product-rp">
                                                            <div class="img">
                                                                <img src="{{ asset('frontend/') }}/img/items-img-1.png" alt="">
                                                            </div>
                                                            <h1 class="__name">Microsoft Office</h1>
                                                        </div>
                                                    </td>
                                                    <td><span class="__pp">$45.00</span></td>
                                                    <td><a class="common-btn" href="#">Details</a></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="product-rp">
                                                            <div class="img">
                                                                <img src="{{ asset('frontend/') }}/img/items-img-1.png" alt="">
                                                            </div>
                                                            <h1 class="__name">Microsoft Office</h1>
                                                        </div>
                                                    </td>
                                                    <td><span class="__pp">$45.00</span></td>
                                                    <td><a class="common-btn" href="#">Details</a></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="product-rp">
                                                            <div class="img">
                                                                <img src="{{ asset('frontend/') }}/img/items-img-1.png" alt="">
                                                            </div>
                                                            <h1 class="__name">Microsoft Office</h1>
                                                        </div>
                                                    </td>
                                                    <td><span class="__pp">$45.00</span></td>
                                                    <td><a class="common-btn" href="#">Details</a></td>
                                                </tr>
                                                 
                                                
                                                 
                                            </tbody>
                                            </table>
                                        </div>
                                        <!-- new table end  -->

                                         
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
 

            </div>
        </div>
    </div>

    <!-- footer -->


    @push('js')
    @endpush

@endsection
