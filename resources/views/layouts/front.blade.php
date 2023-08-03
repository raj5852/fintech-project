@php
    $setting = DB::table('web_sites')->first();
    $payments = App\Models\User\Recharge::where('user_id', Auth::id())->sum('amount');
    $category = App\Models\Admin\Category::take(5)
        ->with('sub_category')
        ->get();
    $category_more = App\Models\Admin\Category::orderBy('id', 'asc')
        ->with('sub_category')
        ->get()
        ->skip(5);

    // if(auth()->check()){
    //     $notifications =   auth()->user()->notifications()->orderBy('created_at', 'desc')->limit(10)->get();
    //     $notificationCount = auth()->user()->unreadnotifications()->count();
    // }else{
    //     $notifications = [];
    //     $notificationCount = 0;
    // }

@endphp
<!DOCTYPE html>
<html lang="en" class="dark">


<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title')FinTech Forex EA
    </title>


    <!-- font link -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/backToTop.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/meanmenu.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" />
    <!-- <link rel="stylesheet" href="{{ asset('frontend/css/swiper-bundle.min.css') }}" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">

    <!-- slick css  -->
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/slick-theme.css') }}" />

    <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/fav-icon.png') }}">



</head>

<body>

    <div class="loaders-axu" id="loaders">
        <div class="ring"></div>
        <span>loading...</span>
    </div>

    <main id="main" style="display:none" class="main">
        <!-- offer-notify -->
        <div class="offer-notify">
            <div class="_content">
                <p class="__text">Offer!! If you purchased an expert somewhere else, you have probably paid full price.
                </p>
                <button onclick="this.parentElement.style.display='none';" class="__close"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
        </div>
        <nav class="nav position-relative">
            <div class="main-nav">
                <div class="container">
                    <div class="nav__wrapper d-flex justify-content-between align-items-center gap-4">
                        <div class="nav__logo d-flex align-items-center gap-3">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('backend/setting/' . $setting->image) }}" alt="logo" /></a>
                        </div>
                        <div class="nav__right d-flex align-items-center">
                            <div class="top-nav-bar-all-elements-wrap">

                                <!-- add search button  -->
                                <button type="button" id="search-btn-handler"
                                    class="search-btn-handler d-none-in650px nav__icon bg-transparent">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>

                                <!-- wishlist  -->
                                <span href="#" class="nav__icon wishlist d-none-in650px">
                                    <i class="bi bi-heart"></i>

                                    <span class="wishlist__number wishlist-count">{{ Helper::countWishlist() }}</span>
                                    <div class="hovercart hovercart-wishlist">
                                        @if (Auth::check())
                                            <div class="wish_list_popup">
                                                {{ Helper::wishlistPopup() }}
                                            </div>
                                        @endif

                                    </div>
                                </span>

                                <!-- add to cart  -->
                                <span href="{{ url('cart/index') }}" class="nav__icon cart d-none-in650px">
                                    <i class="bi bi-basket2"></i>
                                    <span class="cart__number cart-count">{{ \Cart::count() }}</span>
                                    <div class="hovercart">
                                        <div class="cart_list_popup">

                                        </div>
                                    </div>

                                </span>
                                {{-- <span href="" class="nav__icon cart d-none-in650px">
                                    <i class="bi bi-bell"></i>
                                    <span class="cart__number">{{$notificationCount}}</span>
                                    <div class="hovercart">
                                       <h3><b>Notifications ({{$notificationCount}})</b> </h3><hr>

                                       <div style="width: 323px;
                                       height: 313px;overflow: scroll;border-radius: 5px 0px 5px 5px;
                                        background: #20234A;overflow-x: hidden;">
                                            <div id="posts-container">
                                                @foreach ($notifications as $notification)
                                                <p><a style="{{ $notification->read_at == null ? 'font-weight: bold':'color:#b4b4b4' }} " href="{{ route('notification.product-link',$notification->id) }}">{{ $notification->data['product_name'] }}</a>   </p>
                                                <hr>
                                            @endforeach
                                            </div>
                                       <button id="load-more-btn">Load More</button>

                                       </div>


                                    </div>

                                </span> --}}

                                <!-- notification  -->
                                <span href="#" class="nav__icon notification-wrap d-none-in650px ">
                                    <!-- <i class="fa-solid fa-bell"></i> -->
                                    <i class="fa-regular fa-bell d-none-in650px"></i>
                                    <span class="notification-count">5</span>
                                    <div class="get-all-notification">

                                        <h1 class="notify-title">Notification (4)</h1>
                                        <div class="all-notify-box">
                                            <div class="item">
                                                <p class="notify-txt">The new update of Bonnitta Gold MT4 has arrived
                                                </p>
                                                <p class="notify-time">8min</p>
                                            </div>
                                            <div class="item">
                                                <p class="notify-txt">The new update of Bonnitta Gold MT4 has arrived
                                                </p>
                                                <p class="notify-time">8min</p>
                                            </div>
                                            <div class="item">
                                                <p class="notify-txt">The new update of Bonnitta Gold MT4 has arrived
                                                </p>
                                                <p class="notify-time">8min</p>
                                            </div>
                                            <div class="item">
                                                <p class="notify-txt">The new update of Bonnitta Gold MT4 has arrived
                                                </p>
                                                <p class="notify-time">8min</p>
                                            </div>
                                            <div class="item">
                                                <p class="notify-txt">The new update of Bonnitta Gold MT4 has arrived
                                                </p>
                                                <p class="notify-time">8min</p>
                                            </div>
                                            <div class="item">
                                                <p class="notify-txt">The new update of Bonnitta Gold MT4 has arrived
                                                </p>
                                                <p class="notify-time">8min</p>
                                            </div>
                                        </div>


                                    </div>
                                </span>


                                <!-- dark light btn  -->
                                <button class="btn btn-dark d-none-in650px">
                                    <svg class="icon icon-dark">
                                        <use xlink:href="{{ asset('frontend/img/icons.svg#icon-dark') }}"></use>
                                    </svg>
                                </button>
                                <button class="btn btn-light d-none-in650px">
                                    <svg class="icon icon-dark">
                                        <use xlink:href="{{ asset('frontend/img/icons.svg#icon-light') }}"></use>
                                    </svg>
                                </button>

                                <!-- auth  -->
                                @if (Auth::check())

                                    @if (Auth::user()->type == 'user')
                                        <a class="d-none-in650px link logout" href="{{ route('user.home') }}"
                                            style="color:white">
                                            {{ Auth::user()->name }}</a>
                                        <a href="#" class="d-none-in650px top-nav-btn-balance"><span
                                                class=" ">${{ number_format(Auth::user()->balance, 2) }}</span>
                                        </a>
                                    @else
                                        <a class="d-none-in650px link logout" href="{{ route('admin.home') }}"
                                            style="color:white">
                                            dashboard </a>
                                        <button class="d-none-in650px dashboard__header-balance">
                                            {{ Auth::user()->name }}</button>
                                    @endif
                                @else
                                    <a href="#" class="d-none-in650px link login">login</a>
                                    <a href="#" class="d-none-in650px link login-two register">register</a>
                                @endif

                                <!-- add preorder  -->
                                <a href="#" class="d-none-in650px top-nav-btn-pre-order">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 16 16" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M4.66677 3.3332C4.66677 2.80253 4.87743 2.29387 5.25277 1.9192C5.4383 1.73323 5.65869 1.58568 5.90133 1.48501C6.14396 1.38434 6.40407 1.33252 6.66677 1.33252C6.92946 1.33252 7.18957 1.38434 7.43221 1.48501C7.67484 1.58568 7.89524 1.73323 8.08077 1.9192C8.4561 2.29387 8.66677 2.80253 8.66677 3.3332H10.0001C10.1664 3.33317 10.3268 3.39532 10.4496 3.50745C10.5725 3.61957 10.649 3.77356 10.6641 3.9392L10.9214 6.7732C11.7977 6.98134 12.5782 7.47882 13.1368 8.18528C13.6954 8.89173 13.9996 9.76589 14.0001 10.6665C14.0001 12.8739 12.2074 14.6665 10.0001 14.6665C9.17293 14.6661 8.36619 14.4095 7.69076 13.932C7.01534 13.4545 6.50437 12.7795 6.2281 11.9999H2.66677C2.5741 11.9999 2.48244 11.9806 2.39765 11.9432C2.31286 11.9058 2.23679 11.8511 2.17431 11.7827C2.11183 11.7142 2.06431 11.6335 2.03477 11.5457C2.00523 11.4578 1.99433 11.3648 2.00277 11.2725L2.66943 3.9392C2.68457 3.77356 2.76107 3.61957 2.88393 3.50745C3.00678 3.39532 3.16711 3.33317 3.33343 3.3332H4.66677ZM10.0001 7.99987C11.4721 7.99987 12.6668 9.19453 12.6668 10.6665C12.6668 12.1385 11.4721 13.3332 10.0001 13.3332C8.5281 13.3332 7.33343 12.1385 7.33343 10.6665C7.33343 9.19453 8.5281 7.99987 10.0001 7.99987ZM10.6668 10.3905L11.1381 10.8619C11.2595 10.9876 11.3267 11.156 11.3252 11.3308C11.3237 11.5056 11.2536 11.6728 11.13 11.7964C11.0064 11.92 10.8392 11.9901 10.6644 11.9916C10.4896 11.9932 10.3212 11.926 10.1954 11.8045L9.52877 11.1379C9.46677 11.076 9.41759 11.0026 9.38407 10.9217C9.35055 10.8408 9.33334 10.7541 9.33343 10.6665V9.99987C9.33343 9.82305 9.40367 9.65349 9.5287 9.52846C9.65372 9.40344 9.82329 9.3332 10.0001 9.3332C10.1769 9.3332 10.3465 9.40344 10.4715 9.52846C10.5965 9.65349 10.6668 9.82305 10.6668 9.99987V10.3905ZM4.66677 4.66653H3.9421L3.39677 10.6665H6.0001C6.00056 9.67933 6.36588 8.72713 7.02585 7.99296C7.68582 7.25878 8.59386 6.79445 9.57543 6.6892L9.39143 4.66653H8.66677V5.3332C8.66677 5.51001 8.59653 5.67958 8.4715 5.8046C8.34648 5.92963 8.17691 5.99987 8.0001 5.99987C7.82329 5.99987 7.65372 5.92963 7.5287 5.8046C7.40367 5.67958 7.33343 5.51001 7.33343 5.3332V4.66653H6.0001V5.3332C6.0001 5.51001 5.92986 5.67958 5.80484 5.8046C5.67981 5.92963 5.51024 5.99987 5.33343 5.99987C5.15662 5.99987 4.98705 5.92963 4.86203 5.8046C4.737 5.67958 4.66677 5.51001 4.66677 5.3332V4.66653ZM7.33343 3.3332C7.3337 3.24558 7.31663 3.15877 7.28322 3.07776C7.24981 2.99676 7.20072 2.92316 7.13876 2.86121C7.0768 2.79925 7.0032 2.75015 6.9222 2.71674C6.8412 2.68333 6.75439 2.66627 6.66677 2.66653C6.57914 2.66627 6.49233 2.68333 6.41133 2.71674C6.33033 2.75015 6.25673 2.79925 6.19477 2.86121C6.13281 2.92316 6.08372 2.99676 6.05031 3.07776C6.0169 3.15877 5.99984 3.24558 6.0001 3.3332H7.33343Z"
                                            fill="#19212F" />
                                    </svg> <span class=" ">Preorder</span>
                                </a>



                                <div class="mobile-div-control-sdflk">
                                    <div class="show-mobile-icons-asdfjk">
                                        <!-- add search button  -->
                                        <button type="button" id="search-btn-handler"
                                            class="search-btn-handler nav__icon bg-transparent">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>

                                        <!-- wishlist  -->
                                        <span href="#" class="nav__icon wishlist">
                                            <i class="bi bi-heart"></i>

                                            <span
                                                class="wishlist__number wishlist-count">{{ Helper::countWishlist() }}</span>
                                            <div class="hovercart hovercart-wishlist">
                                                @if (Auth::check())
                                                    <div class="wish_list_popup">
                                                        {{ Helper::wishlistPopup() }}
                                                    </div>
                                                @endif

                                            </div>
                                        </span>

                                        <!-- add to cart  -->
                                        <span href="{{ url('cart/index') }}" class="nav__icon cart">
                                            <i class="bi bi-basket2"></i>
                                            <span class="cart__number cart-count">{{ \Cart::count() }}</span>
                                            <div class="hovercart">
                                                <div class="cart_list_popup">

                                                </div>
                                            </div>

                                        </span>
                                        {{-- <span href="" class="nav__icon cart">
                                                        <i class="bi bi-bell"></i>
                                                        <span class="cart__number">{{$notificationCount}}</span>
                                                        <div class="hovercart">
                                                        <h3><b>Notifications ({{$notificationCount}})</b> </h3><hr>

                                                        <div style="width: 323px;
                                                        height: 313px;overflow: scroll;border-radius: 5px 0px 5px 5px;
                                                            background: #20234A;overflow-x: hidden;">
                                                                <div id="posts-container">
                                                                    @foreach ($notifications as $notification)
                                                                    <p><a style="{{ $notification->read_at == null ? 'font-weight: bold':'color:#b4b4b4' }} " href="{{ route('notification.product-link',$notification->id) }}">{{ $notification->data['product_name'] }}</a>   </p>
                                                                    <hr>
                                                                @endforeach
                                                                </div>
                                                        <button id="load-more-btn">Load More</button>

                                                        </div>


                                                        </div>

                                                    </span> --}}

                                        <!-- notification  -->
                                        <span href="#" class="nav__icon notification-wrap  ">
                                            <!-- <i class="fa-solid fa-bell"></i> -->
                                            <i class="fa-regular fa-bell"></i>
                                            <span class="notification-count">5</span>
                                            <div class="get-all-notification">

                                                <h1 class="notify-title">Notification (4)</h1>
                                                <div class="all-notify-box">
                                                    <div class="item">
                                                        <p class="notify-txt">The new update of Bonnitta Gold MT4 has
                                                            arrived</p>
                                                        <p class="notify-time">8min</p>
                                                    </div>
                                                    <div class="item">
                                                        <p class="notify-txt">The new update of Bonnitta Gold MT4 has
                                                            arrived</p>
                                                        <p class="notify-time">8min</p>
                                                    </div>
                                                    <div class="item">
                                                        <p class="notify-txt">The new update of Bonnitta Gold MT4 has
                                                            arrived</p>
                                                        <p class="notify-time">8min</p>
                                                    </div>
                                                    <div class="item">
                                                        <p class="notify-txt">The new update of Bonnitta Gold MT4 has
                                                            arrived</p>
                                                        <p class="notify-time">8min</p>
                                                    </div>
                                                    <div class="item">
                                                        <p class="notify-txt">The new update of Bonnitta Gold MT4 has
                                                            arrived</p>
                                                        <p class="notify-time">8min</p>
                                                    </div>
                                                    <div class="item">
                                                        <p class="notify-txt">The new update of Bonnitta Gold MT4 has
                                                            arrived</p>
                                                        <p class="notify-time">8min</p>
                                                    </div>
                                                </div>


                                            </div>
                                        </span>

                                        <!-- dark light btn  -->
                                        <button class="btn btn-dark  ">
                                            <svg class="icon icon-dark">
                                                <use xlink:href="{{ asset('frontend/img/icons.svg#icon-dark') }}">
                                                </use>
                                            </svg>
                                        </button>
                                        <button class="btn btn-light  ">
                                            <svg class="icon icon-dark">
                                                <use xlink:href="{{ asset('frontend/img/icons.svg#icon-light') }}">
                                                </use>
                                            </svg>
                                        </button>
                                    </div>


                                    <!-- show only mobile  -->
                                    <div class="new-show-only-mobile-sdxec">


                                        <!-- auth  -->
                                        @if (Auth::check())

                                            @if (Auth::user()->type == 'user')
                                                <a class="link logout" href="{{ route('user.home') }}"
                                                    style="color:white">
                                                    {{ Auth::user()->name }}</a>
                                                <a href="#" class="top-nav-btn-balance"><span
                                                        class=" ">${{ number_format(Auth::user()->balance, 2) }}</span>
                                                </a>
                                            @else
                                                <a class="link logout" href="{{ route('admin.home') }}"
                                                    style="color:white">
                                                    dashboard </a>
                                                <button class="dashboard__header-balance">
                                                    {{ Auth::user()->name }}</button>
                                            @endif
                                        @else
                                            <a href="#" class="link login">login</a>
                                            <a href="#" class="link login-two register">register</a>
                                        @endif

                                        <!-- add preorder  -->
                                        <a href="#" class="top-nav-btn-pre-order">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 16 16" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M4.66677 3.3332C4.66677 2.80253 4.87743 2.29387 5.25277 1.9192C5.4383 1.73323 5.65869 1.58568 5.90133 1.48501C6.14396 1.38434 6.40407 1.33252 6.66677 1.33252C6.92946 1.33252 7.18957 1.38434 7.43221 1.48501C7.67484 1.58568 7.89524 1.73323 8.08077 1.9192C8.4561 2.29387 8.66677 2.80253 8.66677 3.3332H10.0001C10.1664 3.33317 10.3268 3.39532 10.4496 3.50745C10.5725 3.61957 10.649 3.77356 10.6641 3.9392L10.9214 6.7732C11.7977 6.98134 12.5782 7.47882 13.1368 8.18528C13.6954 8.89173 13.9996 9.76589 14.0001 10.6665C14.0001 12.8739 12.2074 14.6665 10.0001 14.6665C9.17293 14.6661 8.36619 14.4095 7.69076 13.932C7.01534 13.4545 6.50437 12.7795 6.2281 11.9999H2.66677C2.5741 11.9999 2.48244 11.9806 2.39765 11.9432C2.31286 11.9058 2.23679 11.8511 2.17431 11.7827C2.11183 11.7142 2.06431 11.6335 2.03477 11.5457C2.00523 11.4578 1.99433 11.3648 2.00277 11.2725L2.66943 3.9392C2.68457 3.77356 2.76107 3.61957 2.88393 3.50745C3.00678 3.39532 3.16711 3.33317 3.33343 3.3332H4.66677ZM10.0001 7.99987C11.4721 7.99987 12.6668 9.19453 12.6668 10.6665C12.6668 12.1385 11.4721 13.3332 10.0001 13.3332C8.5281 13.3332 7.33343 12.1385 7.33343 10.6665C7.33343 9.19453 8.5281 7.99987 10.0001 7.99987ZM10.6668 10.3905L11.1381 10.8619C11.2595 10.9876 11.3267 11.156 11.3252 11.3308C11.3237 11.5056 11.2536 11.6728 11.13 11.7964C11.0064 11.92 10.8392 11.9901 10.6644 11.9916C10.4896 11.9932 10.3212 11.926 10.1954 11.8045L9.52877 11.1379C9.46677 11.076 9.41759 11.0026 9.38407 10.9217C9.35055 10.8408 9.33334 10.7541 9.33343 10.6665V9.99987C9.33343 9.82305 9.40367 9.65349 9.5287 9.52846C9.65372 9.40344 9.82329 9.3332 10.0001 9.3332C10.1769 9.3332 10.3465 9.40344 10.4715 9.52846C10.5965 9.65349 10.6668 9.82305 10.6668 9.99987V10.3905ZM4.66677 4.66653H3.9421L3.39677 10.6665H6.0001C6.00056 9.67933 6.36588 8.72713 7.02585 7.99296C7.68582 7.25878 8.59386 6.79445 9.57543 6.6892L9.39143 4.66653H8.66677V5.3332C8.66677 5.51001 8.59653 5.67958 8.4715 5.8046C8.34648 5.92963 8.17691 5.99987 8.0001 5.99987C7.82329 5.99987 7.65372 5.92963 7.5287 5.8046C7.40367 5.67958 7.33343 5.51001 7.33343 5.3332V4.66653H6.0001V5.3332C6.0001 5.51001 5.92986 5.67958 5.80484 5.8046C5.67981 5.92963 5.51024 5.99987 5.33343 5.99987C5.15662 5.99987 4.98705 5.92963 4.86203 5.8046C4.737 5.67958 4.66677 5.51001 4.66677 5.3332V4.66653ZM7.33343 3.3332C7.3337 3.24558 7.31663 3.15877 7.28322 3.07776C7.24981 2.99676 7.20072 2.92316 7.13876 2.86121C7.0768 2.79925 7.0032 2.75015 6.9222 2.71674C6.8412 2.68333 6.75439 2.66627 6.66677 2.66653C6.57914 2.66627 6.49233 2.68333 6.41133 2.71674C6.33033 2.75015 6.25673 2.79925 6.19477 2.86121C6.13281 2.92316 6.08372 2.99676 6.05031 3.07776C6.0169 3.15877 5.99984 3.24558 6.0001 3.3332H7.33343Z"
                                                    fill="#19212F" />
                                            </svg> <span class=" ">Preorder</span>
                                        </a>
                                    </div>
                                </div>





                            </div>
                        </div>
                    </div>
                </div>
            </div>






            <!-- search-wrap  -->
            <div id="search-view-box" class="search-wrap-box">
                <div class="search-field">
                    <!-- <label for="search-all"><i class="fa-solid fa-magnifying-glass"></i></label> -->
                    <input class="in-search" type="text" id="search-all" placeholder="Search for products">
                    <button id="search-close-btn-ab" class="close-btn search-close-btn-ab"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="search-result">
                    <p class="_title">Suggestion</p>
                    <ul class="items-box">
                        <li>
                            <a class="item" href="#">
                                <div>
                                    <img src="{{ asset('backend/setting/' . $setting->image) }}" alt="logo" />
                                </div>
                                <p class="res-text">Adobe Draw Down</p>
                            </a>
                        </li>
                        <li>
                            <a class="item" href="#">
                                <div>
                                    <img src="{{ asset('backend/setting/' . $setting->image) }}" alt="logo" />
                                </div>
                                <p class="res-text">Adobe Draw Down</p>
                            </a>
                        </li>
                        <li>
                            <a class="item" href="#">
                                <div>
                                    <img src="{{ asset('backend/setting/' . $setting->image) }}" alt="logo" />
                                </div>
                                <p class="res-text">Adobe Draw Down</p>
                            </a>
                        </li>
                        </li>
                        <li>
                            <a class="item" href="#">
                                <div>
                                    <img src="{{ asset('backend/setting/' . $setting->image) }}" alt="logo" />
                                </div>
                                <p class="res-text">Adobe Draw Down</p>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>

            <div class="nav__links header-sticky">
                <div class="container">
                    <ul class="nav__list d-flex justify-content-center align-items-center gap-5" id="mobile-menu">



                        @foreach ($category as $cat)
                            <li class="nav__item">

                                <a href="{{ url('shop?category=' . $cat->id . '&r_category=' . $cat->category_name . '') }}"
                                    class="nav__link">
                                    {{ $cat->category_name }} @if ($cat->sub_category->count() > 0)
                                        <i class="bi bi-chevron-down"></i>
                                    @endif
                                </a>
                                @if ($cat->sub_category->count() > 0)
                                    <ul class="nav__dropdown">
                                        @foreach ($cat->sub_category as $sub_cat)
                                            <li><a
                                                    href="{{ url('shop?sub_category=' . $sub_cat->id . '&r_category=' . $cat->category_name . '&r_sub_category=' . $sub_cat->subcategory_name . '') }}">{{ $sub_cat->subcategory_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach


                        @if ($category_more->count() > 0)
                            <li class="nav__item">
                                <a href="#" class="nav__link"> More <i class="bi bi-chevron-down"></i></a>
                                <ul class="nav__dropdown">
                                    @foreach ($category_more as $cat_more)
                                        <li class="nav__item more_category_list">
                                            <a
                                                href="{{ url('shop?category=' . $cat_more->id . '&r_category=' . $cat_more->category_name . '') }}">{{ $cat_more->category_name }}</a>
                                            <ul class="more-sub-dropdown">
                                                @foreach ($cat_more->sub_category as $sub_cat)
                                                    <li><a
                                                            href="{{ url('shop?sub_category=' . $sub_cat->id . '&r_category=' . $cat_more->category_name . '&r_sub_category=' . $sub_cat->subcategory_name . '') }}">{{ $sub_cat->subcategory_name }}</a>
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif


                        <li class="nav__item">
                            <a href="{{ url('/membership') }}" class="nav__link">Membership</a>
                        </li>
                        <li class="nav__item">
                            <a href="{{ url('customer-request') }}" class="nav__link">Custom Request</a>
                        </li>
                        <li class="nav__item">
                            <a href="{{ url('shop') }}" class="nav__link">Shop</a>
                        </li>
                        <!-- <li class="nav__item">
        <a href="{{ url('customer-request') }}" class="nav__link">Custom Request</a>
       </li> -->
                        <li class="nav__item">
                            <a class="nav__link" href="{{ url('/shop?type=free&r_category=FREE') }}">Free product</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <div class="responsive_mobile_menu">
            <div class="container">
                <div class="mobile_wrapper">
                    <div class="mobile_left">
                        <div class="logo">
                            <a href="{{ url('/') }}"><img
                                    src="{{ asset('backend/setting/' . $setting->image) }}" alt="logo"></a>
                        </div>
                    </div>
                    <div class="mobile_right">
                        <a href="javascript:void(0)">
                            <i class="fa-solid fa-bars open-mobile-menu"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="mobile_info_open">
            <div class="container">
                <div class="mobile_header">
                    <div class="mobile-logo">
                        <img src="{{ asset('backend/setting/' . $setting->image) }}" alt="">
                    </div>
                    <div class="icon">
                        <i class="bi bi-x close_info"></i>
                    </div>
                </div>
                <div class="">
                    <ul class="custom_nav__item">
                        @foreach ($category as $cat)
                            <li class="nav__item @if ($cat->sub_category->count() > 0) ms_has-submenu @endif">
                                <a href="#" class=""> <span>{{ $cat->category_name }}</span> <span
                                        class="icon_sub_menu"><i class="bi bi-chevron-down"></i></span> </a>
                                @if ($cat->sub_category->count() > 0)
                                    <ul class="ms_submenu" style="display: none">
                                        @foreach ($cat->sub_category as $sub_cat)
                                            <li><a
                                                    href="{{ url('shop?sub_category=' . $sub_cat->id . '&r_category=' . $cat->category_name . '&r_sub_category_name=' . $sub_cat->subcategory_name . '') }}">{{ $sub_cat->subcategory_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach

                        @if ($category_more->count() > 0)


                            <li class="nav__item @if ($category_more->count() > 0) ms_has-submenu @endif">
                                <a href="#" class=""> <span>More</span> <span class="icon_sub_menu"><i
                                            class="bi bi-chevron-down"></i></span> </a>
                                @if ($cat->sub_category->count() > 0)
                                    <ul class="ms_submenu" style="display: none">
                                        @foreach ($category_more as $cat_more)
                                            <li><a
                                                    href="{{ url('shop?category=' . $cat_more->id . '&r_category=' . $cat_more->category_name . '') }}">{{ $cat_more->category_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endif



                        <!-- @if ($category_more->count() > 0)
<li class="nav__item">
                                <a href="#" class=""> More <i class="bi bi-chevron-down"></i></a>
                                <ul class="nav__dropdown">
                                @foreach ($category_more as $cat_more)
<li><a href="{{ url('shop?category=' . $cat_more->id . '') }}">{{ $cat_more->category_name }}</a></li>
@endforeach
                                </ul>
                                </li>
@endif -->
                    </ul>


                    <!-- static some pages  -->
                    <ul class="custom_nav__item">
                        <li class="nav__item"><a href="{{ url('/membership') }}">Membership </a></li>
                        <li class="nav__item"><a href="{{ url('/customer-request') }}">Custom Request </a></li>
                        <li class="nav__item"><a href="{{ URL('/shop') }}">Shop </a></li>
                        <li class="nav__item"><a href="{{ url('/shop?type=free&r_category=FREE') }}">Free Product
                            </a></li>
                    </ul>











                </div>
            </div>
        </div>




        @yield('front_content')



        <!-- footer -->
        <footer class="footer-section">
            <div class="container">
                <div class="footer row g-5">
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="footer__item logo-area">
                            <img src="{{ asset('backend/setting/' . $setting->image) }}" alt=""
                                class="logo logo-black mb-3" />
                            <img src="{{ asset('backend/setting/' . $setting->image) }}" alt=""
                                class="logo logo-white mb-3" />
                            <p class="text text-white mb-3">
                                {{-- {{$setting->about}} --}}
                            </p>
                            <ul class="social d-flex align-items-center gap-2">
                                @foreach (socials() as $social)
                                    {{-- {{$social  }} --}}
                                    <li class="social__item">
                                        <a href="{{ $social->link }}" target="_blank" class="social__link">
                                            {{-- <i class="bi bi-facebook"></i> --}}
                                            <i class="{{ $social->icon_class }}"></i>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="mt-3 Payment-Partners">
                            <h3>Payment Partners</h3>
                            <div class="mt-1">
                                <svg width="312" height="32" viewBox="0 0 312 32" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M46.2113 7.66016H39.3723C38.9043 7.66016 38.5063 8.00016 38.4333 8.46216L35.6673 25.9992C35.6123 26.3452 35.8803 26.6572 36.2313 26.6572H39.4963C39.9643 26.6572 40.3623 26.3172 40.4353 25.8542L41.1813 21.1242C41.2533 20.6612 41.6523 20.3212 42.1193 20.3212H44.2843C48.7893 20.3212 51.3893 18.1412 52.0683 13.8212C52.3743 11.9312 52.0813 10.4462 51.1963 9.40615C50.2243 8.26415 48.5003 7.66016 46.2113 7.66016ZM47.0003 14.0652C46.6263 16.5192 44.7513 16.5192 42.9383 16.5192H41.9063L42.6303 11.9362C42.6733 11.6592 42.9133 11.4552 43.1933 11.4552H43.6663C44.9013 11.4552 46.0663 11.4552 46.6683 12.1592C47.0273 12.5792 47.1373 13.2032 47.0003 14.0652Z"
                                        fill="#253B80" />
                                    <path
                                        d="M66.654 13.9862H63.379C63.1 13.9862 62.859 14.1902 62.816 14.4672L62.671 15.3832L62.442 15.0512C61.733 14.0222 60.152 13.6782 58.574 13.6782C54.955 13.6782 51.864 16.4192 51.262 20.2642C50.949 22.1822 51.394 24.0162 52.482 25.2952C53.48 26.4712 54.908 26.9612 56.607 26.9612C59.523 26.9612 61.14 25.0862 61.14 25.0862L60.994 25.9962C60.939 26.3442 61.207 26.6562 61.556 26.6562H64.506C64.975 26.6562 65.371 26.3162 65.445 25.8532L67.215 14.6442C67.271 14.2992 67.004 13.9862 66.654 13.9862ZM62.089 20.3602C61.773 22.2312 60.288 23.4872 58.394 23.4872C57.443 23.4872 56.683 23.1822 56.195 22.6042C55.711 22.0302 55.527 21.2132 55.681 20.3032C55.976 18.4482 57.486 17.1512 59.351 17.1512C60.281 17.1512 61.037 17.4602 61.535 18.0432C62.034 18.6322 62.232 19.4542 62.089 20.3602Z"
                                        fill="#253B80" />
                                    <path
                                        d="M84.0955 13.9863H80.8045C80.4905 13.9863 80.1955 14.1423 80.0175 14.4033L75.4785 21.0893L73.5545 14.6643C73.4335 14.2623 73.0625 13.9863 72.6425 13.9863H69.4085C69.0155 13.9863 68.7425 14.3703 68.8675 14.7403L72.4925 25.3783L69.0845 30.1893C68.8165 30.5683 69.0865 31.0893 69.5495 31.0893H72.8365C73.1485 31.0893 73.4405 30.9373 73.6175 30.6813L84.5635 14.8813C84.8255 14.5033 84.5565 13.9863 84.0955 13.9863Z"
                                        fill="#253B80" />
                                    <path
                                        d="M94.9916 7.66016H88.1516C87.6846 7.66016 87.2866 8.00016 87.2136 8.46216L84.4476 25.9992C84.3926 26.3452 84.6606 26.6572 85.0096 26.6572H88.5196C88.8456 26.6572 89.1246 26.4192 89.1756 26.0952L89.9606 21.1242C90.0326 20.6612 90.4316 20.3212 90.8986 20.3212H93.0626C97.5686 20.3212 100.168 18.1412 100.848 13.8212C101.155 11.9312 100.86 10.4462 99.9746 9.40615C99.0036 8.26415 97.2806 7.66016 94.9916 7.66016ZM95.7806 14.0652C95.4076 16.5192 93.5326 16.5192 91.7186 16.5192H90.6876L91.4126 11.9362C91.4556 11.6592 91.6936 11.4552 91.9746 11.4552H92.4476C93.6816 11.4552 94.8476 11.4552 95.4496 12.1592C95.8086 12.5792 95.9176 13.2032 95.7806 14.0652Z"
                                        fill="#179BD7" />
                                    <path
                                        d="M115.434 13.9862H112.161C111.88 13.9862 111.641 14.1902 111.599 14.4672L111.454 15.3832L111.224 15.0512C110.515 14.0222 108.935 13.6782 107.357 13.6782C103.738 13.6782 100.648 16.4192 100.046 20.2642C99.7339 22.1822 100.177 24.0162 101.265 25.2952C102.265 26.4712 103.691 26.9612 105.39 26.9612C108.306 26.9612 109.923 25.0862 109.923 25.0862L109.777 25.9962C109.722 26.3442 109.99 26.6562 110.341 26.6562H113.29C113.757 26.6562 114.155 26.3162 114.228 25.8532L115.999 14.6442C116.053 14.2992 115.785 13.9862 115.434 13.9862ZM110.869 20.3602C110.555 22.2312 109.068 23.4872 107.174 23.4872C106.225 23.4872 105.463 23.1822 104.975 22.6042C104.491 22.0302 104.309 21.2132 104.461 20.3032C104.758 18.4482 106.266 17.1512 108.131 17.1512C109.061 17.1512 109.817 17.4602 110.315 18.0432C110.816 18.6322 111.014 19.4542 110.869 20.3602Z"
                                        fill="#179BD7" />
                                    <path
                                        d="M119.295 8.14118L116.488 25.9992C116.433 26.3452 116.701 26.6572 117.05 26.6572H119.872C120.341 26.6572 120.739 26.3172 120.811 25.8542L123.579 8.31818C123.634 7.97218 123.366 7.65918 123.017 7.65918H119.857C119.578 7.66018 119.338 7.86418 119.295 8.14118Z"
                                        fill="#179BD7" />
                                    <path
                                        d="M7.26555 30.0651L7.78855 26.7431L6.62355 26.7161H1.06055L4.92655 2.20306C4.93855 2.12906 4.97755 2.06006 5.03455 2.01106C5.09155 1.96206 5.16455 1.93506 5.24055 1.93506H14.6205C17.7345 1.93506 19.8835 2.58306 21.0055 3.86206C21.5315 4.46206 21.8665 5.08906 22.0285 5.77906C22.1985 6.50306 22.2015 7.36806 22.0355 8.42306L22.0235 8.50006V9.17606L22.5495 9.47406C22.9925 9.70906 23.3445 9.97806 23.6145 10.2861C24.0645 10.7991 24.3555 11.4511 24.4785 12.2241C24.6055 13.0191 24.5635 13.9651 24.3555 15.0361C24.1155 16.2681 23.7275 17.3411 23.2035 18.2191C22.7215 19.0281 22.1075 19.6991 21.3785 20.2191C20.6825 20.7131 19.8555 21.0881 18.9205 21.3281C18.0145 21.5641 16.9815 21.6831 15.8485 21.6831H15.1185C14.5965 21.6831 14.0895 21.8711 13.6915 22.2081C13.2925 22.5521 13.0285 23.0221 12.9475 23.5361L12.8925 23.8351L11.9685 29.6901L11.9265 29.9051C11.9155 29.9731 11.8965 30.0071 11.8685 30.0301C11.8435 30.0511 11.8075 30.0651 11.7725 30.0651H7.26555Z"
                                        fill="#253B80" />
                                    <path
                                        d="M23.0481 8.57812C23.0201 8.75713 22.9881 8.94012 22.9521 9.12812C21.7151 15.4791 17.4831 17.6731 12.0781 17.6731H9.32614C8.66514 17.6731 8.10814 18.1531 8.00514 18.8051L6.59614 27.7411L6.19714 30.2741C6.13014 30.7021 6.46014 31.0881 6.89214 31.0881H11.7731C12.3511 31.0881 12.8421 30.6681 12.9331 30.0981L12.9811 29.8501L13.9001 24.0181L13.9591 23.6981C14.0491 23.1261 14.5411 22.7061 15.1191 22.7061H15.8491C20.5781 22.7061 24.2801 20.7861 25.3621 15.2301C25.8141 12.9091 25.5801 10.9711 24.3841 9.60812C24.0221 9.19712 23.5731 8.85612 23.0481 8.57812Z"
                                        fill="#179BD7" />
                                    <path
                                        d="M21.7539 8.06216C21.5649 8.00716 21.3699 7.95716 21.1699 7.91216C20.9689 7.86816 20.7629 7.82916 20.5509 7.79516C19.8089 7.67516 18.9959 7.61816 18.1249 7.61816H10.7729C10.5919 7.61816 10.4199 7.65916 10.2659 7.73316C9.92688 7.89616 9.67488 8.21716 9.61388 8.61016L8.04988 18.5162L8.00488 18.8052C8.10788 18.1532 8.66488 17.6732 9.32588 17.6732H12.0779C17.4829 17.6732 21.7149 15.4782 22.9519 9.12816C22.9889 8.94016 23.0199 8.75716 23.0479 8.57816C22.7349 8.41216 22.3959 8.27016 22.0309 8.14916C21.9409 8.11916 21.8479 8.09016 21.7539 8.06216Z"
                                        fill="#222D65" />
                                    <path
                                        d="M9.61399 8.61013C9.67499 8.21713 9.92699 7.89613 10.266 7.73413C10.421 7.66013 10.592 7.61913 10.773 7.61913H18.125C18.996 7.61913 19.809 7.67613 20.551 7.79613C20.763 7.83013 20.969 7.86913 21.17 7.91313C21.37 7.95813 21.565 8.00813 21.754 8.06313C21.848 8.09113 21.941 8.12013 22.032 8.14913C22.397 8.27013 22.736 8.41313 23.049 8.57813C23.417 6.23113 23.046 4.63313 21.777 3.18613C20.378 1.59313 17.853 0.911133 14.622 0.911133H5.24199C4.58199 0.911133 4.01899 1.39113 3.91699 2.04413L0.00998882 26.8091C-0.0670112 27.2991 0.310989 27.7411 0.804989 27.7411H6.59599L8.04999 18.5161L9.61399 8.61013Z"
                                        fill="#253B80" />
                                    <g clip-path="url(#clip0_417_1271)">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M153.934 19.8633C153.564 19.6496 153.143 19.6058 152.761 19.7081C152.49 19.7807 152.239 19.9268 152.039 20.1374L150.661 19.3415V12.6583L152.039 11.8624C152.239 12.073 152.49 12.2191 152.761 12.2917C153.111 12.3854 153.494 12.3564 153.841 12.186H153.848L153.934 12.1364C154.305 11.9223 154.554 11.579 154.656 11.1974C154.758 10.8161 154.714 10.395 154.501 10.0249C154.287 9.65385 153.943 9.40493 153.562 9.30272C153.18 9.20041 152.758 9.24411 152.388 9.45795L152.368 9.46923C152.009 9.68385 151.767 10.0217 151.667 10.397C151.594 10.6675 151.595 10.9581 151.678 11.2362L150.298 12.0334L144.512 8.69334V7.09939C144.794 7.03164 145.045 6.88703 145.243 6.68893L145.245 6.68754C145.525 6.40739 145.698 6.02087 145.698 5.59457C145.698 5.16882 145.525 4.78236 145.245 4.50164L145.243 4.50026C144.962 4.22011 144.576 4.04688 144.15 4.04688C143.725 4.04688 143.338 4.22016 143.057 4.50026L143.056 4.50164C142.776 4.78241 142.603 5.16887 142.603 5.59457C142.603 6.02087 142.776 6.40739 143.056 6.68754L143.057 6.68893C143.255 6.88698 143.507 7.03164 143.788 7.09939V8.69334L138.003 12.0334L136.622 11.2362C136.705 10.9581 136.706 10.6675 136.634 10.3971C136.531 10.0149 136.283 9.67159 135.913 9.458C135.542 9.24411 135.121 9.20041 134.739 9.30272C134.357 9.40498 134.014 9.65385 133.8 10.0249C133.586 10.395 133.542 10.8161 133.644 11.1974C133.747 11.579 133.996 11.9223 134.367 12.1364C134.737 12.3501 135.158 12.3939 135.539 12.2917C135.81 12.2192 136.062 12.073 136.261 11.8624L137.64 12.6583V19.3415L136.261 20.1373C136.062 19.9267 135.81 19.7806 135.539 19.708C135.189 19.6143 134.806 19.6434 134.46 19.8137H134.452L134.367 19.8633C133.996 20.0774 133.747 20.4207 133.644 20.8023C133.542 21.1836 133.586 21.6047 133.8 21.9749C134.014 22.3459 134.357 22.5948 134.739 22.697C135.121 22.7993 135.542 22.7556 135.913 22.5418L135.933 22.5305C136.292 22.3158 136.533 21.978 136.634 21.6027C136.706 21.3322 136.705 21.0417 136.622 20.7635L138.003 19.9664L143.788 23.3064V24.9003C143.507 24.968 143.255 25.1127 143.057 25.3108L143.056 25.3122C142.776 25.5923 142.603 25.9788 142.603 26.4051C142.603 26.8314 142.776 27.2179 143.056 27.4981L143.057 27.4994C143.337 27.7794 143.724 27.9528 144.15 27.9528C144.577 27.9528 144.963 27.7795 145.243 27.4994L145.245 27.4981C145.525 27.2179 145.698 26.8314 145.698 26.4051C145.698 25.9788 145.525 25.5923 145.245 25.3122L145.243 25.3108C145.045 25.1127 144.794 24.9681 144.512 24.9003V23.3064L150.298 19.9664L151.678 20.7635C151.595 21.0417 151.594 21.3322 151.667 21.6027C151.769 21.9848 152.018 22.3282 152.387 22.5417C152.758 22.7556 153.18 22.7993 153.562 22.697C153.943 22.5948 154.287 22.3459 154.501 21.9749C154.714 21.6047 154.758 21.1836 154.656 20.8023C154.554 20.4207 154.305 20.0774 153.934 19.8633ZM152.366 10.5837C152.42 10.3802 152.553 10.1972 152.75 10.0834L152.759 10.0779C152.953 9.96918 153.174 9.9478 153.375 10.0016C153.579 10.0563 153.762 10.1883 153.875 10.3842C153.989 10.5809 154.012 10.8059 153.957 11.0106C153.902 11.2137 153.772 11.3957 153.578 11.5089L153.574 11.5111C153.378 11.6246 153.152 11.6476 152.948 11.5928C152.772 11.5455 152.611 11.44 152.497 11.2847V11.2803L152.436 11.1891C152.332 10.9976 152.313 10.7813 152.366 10.5837ZM135.862 11.194L135.853 11.2088C135.739 11.4057 135.556 11.5382 135.352 11.5928C135.148 11.6476 134.923 11.6247 134.726 11.5111C134.53 11.398 134.398 11.2151 134.343 11.0106C134.289 10.8059 134.311 10.5809 134.425 10.3842C134.538 10.1883 134.721 10.0563 134.925 10.0016C135.129 9.94693 135.354 9.96985 135.55 10.0833C135.748 10.1971 135.88 10.3801 135.934 10.5837C135.988 10.7829 135.968 11.0011 135.862 11.194ZM135.934 21.416C135.88 21.6196 135.748 21.8025 135.551 21.9163L135.541 21.9218C135.347 22.0306 135.126 22.0519 134.925 21.9981C134.721 21.9434 134.538 21.8114 134.425 21.6155C134.311 21.4188 134.289 21.1937 134.343 20.9891C134.398 20.7861 134.528 20.6041 134.722 20.4908L134.726 20.4886C134.923 20.375 135.148 20.3521 135.352 20.4069C135.529 20.4542 135.689 20.5597 135.803 20.715V20.7194L135.864 20.8108C135.968 21.0022 135.987 21.2185 135.934 21.416ZM143.567 6.17744C143.419 6.02862 143.327 5.82252 143.327 5.59457C143.327 5.36621 143.419 5.16041 143.567 5.01246L143.568 5.01108C143.716 4.86303 143.922 4.77139 144.15 4.77139C144.378 4.77139 144.584 4.86303 144.732 5.01108L144.733 5.01246C144.881 5.16041 144.973 5.36621 144.973 5.59457C144.973 5.82252 144.881 6.02857 144.733 6.17744C144.584 6.32585 144.378 6.4177 144.15 6.4177C143.922 6.4177 143.716 6.32585 143.567 6.17744ZM144.733 25.8223C144.881 25.9711 144.973 26.1772 144.973 26.4051C144.973 26.633 144.881 26.8391 144.733 26.9879C144.584 27.1364 144.378 27.2283 144.15 27.2283C143.922 27.2283 143.716 27.1364 143.567 26.9879C143.419 26.8391 143.327 26.633 143.327 26.4051C143.327 26.1772 143.419 25.9711 143.567 25.8223C143.716 25.6738 143.922 25.582 144.15 25.582C144.378 25.582 144.584 25.6739 144.733 25.8223ZM147.317 19.1664C146.506 19.9769 145.387 20.4782 144.15 20.4782C142.914 20.4782 141.794 19.9769 140.984 19.1664C140.173 18.3561 139.672 17.2364 139.672 15.9999C139.672 14.7633 140.173 13.6437 140.984 12.8334C141.794 12.0229 142.914 11.5216 144.15 11.5216C145.387 11.5216 146.506 12.0229 147.317 12.8334C148.127 13.6437 148.628 14.7634 148.628 15.9999C148.628 17.2364 148.127 18.3561 147.317 19.1664ZM153.875 21.6155C153.762 21.8114 153.579 21.9434 153.375 21.9981C153.171 22.0528 152.946 22.0298 152.75 21.9164C152.553 21.8026 152.42 21.6196 152.366 21.416C152.312 21.2168 152.333 20.9987 152.438 20.8057L152.447 20.7909C152.561 20.5939 152.744 20.4615 152.948 20.4069C153.152 20.3521 153.378 20.375 153.574 20.4886C153.77 20.6016 153.902 20.7846 153.957 20.9891C154.012 21.1938 153.989 21.4188 153.875 21.6155ZM144.15 12.2461C143.113 12.2461 142.175 12.6662 141.496 13.3454C140.816 14.0247 140.396 14.9632 140.396 15.9998C140.396 17.0365 140.816 17.975 141.496 18.6543C142.175 19.3335 143.113 19.7537 144.15 19.7537C145.187 19.7537 146.125 19.3335 146.805 18.6543C147.484 17.975 147.904 17.0365 147.904 15.9998C147.904 14.9632 147.484 14.0247 146.805 13.3454C146.125 12.6662 145.187 12.2461 144.15 12.2461ZM143.248 16.959C143.493 17.2044 143.833 17.3563 144.207 17.3563C144.378 17.3563 144.541 17.3253 144.689 17.2686C144.845 17.2094 144.987 17.1223 145.109 17.0135C145.258 16.8806 145.487 16.894 145.62 17.0432C145.753 17.1925 145.739 17.4211 145.59 17.554C145.446 17.6828 145.283 17.7918 145.106 17.8766V18.4563C145.106 18.6563 144.944 18.8185 144.744 18.8185C144.544 18.8185 144.382 18.6563 144.382 18.4563V18.0736C144.324 18.0784 144.266 18.0809 144.207 18.0809C144.105 18.0809 144.005 18.0735 143.908 18.0594V18.4563C143.908 18.6563 143.745 18.8185 143.545 18.8185C143.345 18.8185 143.183 18.6563 143.183 18.4563V17.8116C143.019 17.7186 142.868 17.6038 142.736 17.4713C142.359 17.0947 142.126 16.5744 142.126 15.9999C142.126 15.4254 142.359 14.9051 142.736 14.5285C142.868 14.396 143.019 14.2812 143.183 14.1882V13.5436C143.183 13.3435 143.345 13.1813 143.545 13.1813C143.745 13.1813 143.908 13.3435 143.908 13.5436V13.9404C144.005 13.9263 144.105 13.9189 144.207 13.9189C144.266 13.9189 144.324 13.9214 144.382 13.9262V13.5436C144.382 13.3435 144.544 13.1813 144.744 13.1813C144.944 13.1813 145.106 13.3435 145.106 13.5436V14.1231C145.283 14.208 145.446 14.317 145.59 14.4458C145.739 14.5786 145.753 14.8074 145.62 14.9566C145.487 15.1059 145.258 15.1192 145.109 14.9864C144.987 14.8775 144.845 14.7904 144.689 14.7312C144.541 14.6746 144.378 14.6434 144.207 14.6434C143.833 14.6434 143.493 14.7953 143.248 15.0407C143.003 15.2861 142.851 15.6253 142.851 15.9999C142.851 16.3745 143.003 16.7136 143.248 16.959Z"
                                            fill="#FFB503" />
                                    </g>
                                    <g clip-path="url(#clip1_417_1271)">
                                        <path
                                            d="M168.833 17.7967L171.294 17.7639C171.234 18.6115 171.007 19.3553 170.613 19.9951C170.225 20.6295 169.703 21.1217 169.047 21.4717C168.39 21.8217 167.636 21.9857 166.783 21.9639C166.044 21.9475 165.437 21.7889 164.962 21.4881C164.491 21.1818 164.128 20.7799 163.871 20.2822C163.613 19.7791 163.452 19.224 163.387 18.617C163.326 18.0045 163.335 17.3838 163.411 16.7549L163.698 14.901C163.797 14.2393 163.963 13.5939 164.199 12.965C164.439 12.3361 164.756 11.7729 165.15 11.2752C165.544 10.7721 166.025 10.3783 166.594 10.0939C167.163 9.8041 167.819 9.66738 168.563 9.68379C169.427 9.70019 170.119 9.8998 170.638 10.2826C171.158 10.6654 171.535 11.1768 171.77 11.8166C172.005 12.451 172.123 13.1646 172.123 13.9576L169.58 13.9412C169.613 13.5803 169.615 13.2412 169.588 12.924C169.566 12.6014 169.468 12.3389 169.293 12.1365C169.118 11.9287 168.812 11.8166 168.374 11.8002C167.958 11.7838 167.619 11.8713 167.357 12.0627C167.1 12.2541 166.897 12.5111 166.75 12.8338C166.602 13.151 166.493 13.4928 166.422 13.8592C166.351 14.2201 166.293 14.5619 166.249 14.8846L165.987 16.7631C165.949 17.0201 165.908 17.3209 165.864 17.6654C165.82 18.01 165.812 18.3463 165.839 18.6744C165.867 19.0025 165.962 19.2787 166.126 19.5029C166.29 19.7271 166.567 19.8475 166.955 19.8639C167.403 19.8803 167.756 19.7982 168.013 19.6178C168.27 19.4318 168.459 19.1803 168.579 18.8631C168.699 18.5404 168.784 18.185 168.833 17.7967ZM176.367 15.1471L175.219 21.7998H172.782L174.325 12.924H176.597L176.367 15.1471ZM178.746 12.8584L178.41 15.2865C178.284 15.2592 178.155 15.24 178.024 15.2291C177.898 15.2127 177.773 15.2018 177.647 15.1963C177.368 15.1908 177.127 15.2373 176.925 15.3357C176.728 15.4342 176.561 15.5682 176.425 15.7377C176.293 15.9072 176.187 16.1014 176.105 16.3201C176.023 16.5389 175.96 16.7713 175.916 17.0174L175.514 16.7713C175.558 16.4213 175.626 16.0193 175.719 15.5654C175.812 15.1061 175.949 14.6604 176.129 14.2283C176.31 13.7908 176.55 13.4326 176.851 13.1537C177.157 12.8748 177.546 12.7354 178.016 12.7354C178.147 12.7408 178.27 12.7545 178.385 12.7764C178.505 12.7982 178.626 12.8256 178.746 12.8584ZM181.637 20.6432L184.721 12.924H187.387L182.81 23.1287C182.679 23.435 182.528 23.7248 182.359 23.9982C182.195 24.2717 182.003 24.515 181.784 24.7283C181.566 24.9416 181.314 25.1084 181.03 25.2287C180.745 25.349 180.423 25.4092 180.062 25.4092C179.881 25.4092 179.704 25.39 179.529 25.3518C179.359 25.3135 179.184 25.2697 179.004 25.2205L179.225 23.342C179.269 23.3475 179.313 23.3502 179.356 23.3502C179.395 23.3557 179.433 23.3584 179.471 23.3584C179.695 23.3639 179.887 23.3311 180.045 23.26C180.209 23.1943 180.349 23.0959 180.464 22.9646C180.584 22.8389 180.688 22.6803 180.776 22.4889L181.637 20.6432ZM182.736 12.924L182.908 19.3307L182.728 21.9803L181.128 22.0459L180.193 12.924H182.736ZM191.18 14.7615L189.367 25.2123H186.939L189.072 12.924H191.312L191.18 14.7615ZM195.159 17.001L195.069 17.69C195.014 18.1658 194.918 18.658 194.782 19.1666C194.645 19.6752 194.448 20.1455 194.191 20.5775C193.939 21.0096 193.611 21.3541 193.207 21.6111C192.807 21.8682 192.312 21.9857 191.722 21.9639C191.23 21.9475 190.841 21.7916 190.557 21.4963C190.273 21.201 190.065 20.8346 189.933 20.3971C189.802 19.9596 189.72 19.5057 189.687 19.0354C189.655 18.565 189.646 18.1494 189.663 17.7885L189.761 17.0338C189.832 16.6291 189.936 16.1807 190.073 15.6885C190.215 15.1908 190.407 14.7178 190.647 14.2693C190.893 13.8209 191.199 13.4518 191.566 13.1619C191.932 12.8721 192.375 12.7354 192.895 12.7518C193.474 12.7627 193.928 12.9049 194.257 13.1783C194.59 13.4463 194.828 13.7936 194.97 14.2201C195.112 14.6412 195.192 15.0979 195.208 15.59C195.224 16.0822 195.208 16.5525 195.159 17.001ZM192.641 17.6982L192.714 16.9846C192.731 16.815 192.753 16.61 192.78 16.3693C192.813 16.1287 192.821 15.8881 192.805 15.6475C192.794 15.4014 192.731 15.1963 192.616 15.0322C192.507 14.8682 192.321 14.7807 192.058 14.7697C191.779 14.7588 191.549 14.8135 191.369 14.9338C191.189 15.0486 191.044 15.2072 190.934 15.4096C190.83 15.6064 190.751 15.8225 190.696 16.0576C190.647 16.2928 190.609 16.5197 190.582 16.7385L190.409 18.0756C190.382 18.3271 190.366 18.5951 190.36 18.8795C190.36 19.1639 190.42 19.41 190.541 19.6178C190.661 19.8256 190.891 19.9377 191.23 19.9541C191.525 19.965 191.76 19.8967 191.935 19.749C192.116 19.6014 192.252 19.41 192.345 19.1748C192.444 18.9342 192.509 18.6826 192.542 18.4201C192.58 18.1576 192.613 17.917 192.641 17.6982ZM201.897 12.924L201.569 14.7533H197.082L197.41 12.924H201.897ZM198.706 10.7256H201.142L199.731 19.0189C199.709 19.1611 199.698 19.2979 199.698 19.4291C199.698 19.5549 199.729 19.6615 199.789 19.749C199.854 19.8311 199.972 19.8775 200.141 19.8885C200.24 19.8885 200.336 19.883 200.429 19.8721C200.522 19.8611 200.612 19.8502 200.699 19.8393L200.502 21.7424C200.306 21.8189 200.103 21.8736 199.895 21.9064C199.688 21.9393 199.474 21.9557 199.256 21.9557C198.736 21.9447 198.323 21.8189 198.017 21.5783C197.711 21.3322 197.497 21.0096 197.377 20.6104C197.262 20.2057 197.227 19.7654 197.27 19.2896L198.706 10.7256ZM202.548 17.7146L202.63 17.0256C202.701 16.4568 202.838 15.9154 203.04 15.4014C203.243 14.8873 203.511 14.4279 203.844 14.0232C204.183 13.6131 204.594 13.2959 205.075 13.0717C205.556 12.8475 206.111 12.7436 206.74 12.76C207.342 12.7709 207.842 12.8994 208.241 13.1455C208.646 13.3861 208.963 13.7088 209.193 14.1135C209.428 14.5182 209.584 14.9721 209.66 15.4752C209.737 15.9729 209.748 16.4869 209.693 17.0174L209.611 17.7229C209.54 18.2807 209.403 18.8193 209.201 19.3389C209.004 19.8529 208.733 20.3123 208.389 20.717C208.05 21.1162 207.642 21.4279 207.167 21.6521C206.691 21.8764 206.138 21.9803 205.51 21.9639C204.908 21.9529 204.405 21.8271 204 21.5865C203.601 21.3404 203.284 21.0178 203.049 20.6186C202.819 20.2139 202.663 19.7627 202.581 19.265C202.504 18.7619 202.494 18.2451 202.548 17.7146ZM205.083 17.0174L205.001 17.7311C204.99 17.8951 204.971 18.0975 204.944 18.3381C204.922 18.5787 204.922 18.8221 204.944 19.0682C204.965 19.3143 205.034 19.5221 205.149 19.6916C205.269 19.8557 205.458 19.9432 205.715 19.9541C206.01 19.976 206.248 19.9131 206.428 19.7654C206.614 19.6178 206.756 19.4264 206.855 19.1912C206.959 18.9506 207.033 18.699 207.076 18.4365C207.12 18.174 207.156 17.9307 207.183 17.7064L207.265 17.001C207.276 16.8424 207.292 16.64 207.314 16.3939C207.336 16.1479 207.333 15.9045 207.306 15.6639C207.284 15.4232 207.213 15.2182 207.093 15.0486C206.978 14.8791 206.792 14.7861 206.535 14.7697C206.251 14.7533 206.018 14.8217 205.838 14.9748C205.663 15.1225 205.523 15.3166 205.419 15.5572C205.315 15.7979 205.239 16.0494 205.19 16.3119C205.14 16.5744 205.105 16.8096 205.083 17.0174Z"
                                            fill="#FFB503" />
                                    </g>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M224.928 10.5403C222.897 9.1918 221.084 8.71196 220.765 8.63444C220.732 8.62692 220.715 8.62338 220.715 8.62338L220.784 8.36523H220.788H227.07C228.798 8.36523 228.96 9.74053 228.96 9.74053L230.302 16.6068L230.301 16.606L230.751 18.8676L234.551 8.36523H238.84L232.499 23.6352H228.346L224.928 10.5403ZM241.89 23.6352H237.707L240.322 8.36523H244.505L241.89 23.6352ZM269.427 23.6352H264.785L264.337 21.3674H259.48L258.683 23.6352H254.7L260.399 9.50321C260.399 9.50321 260.744 8.36523 262.163 8.36523H266.368L269.427 23.6352ZM255.293 12.1767C253.671 11.2711 249.981 11.0568 249.981 12.7244C249.981 14.392 255.269 14.7491 255.269 18.5847C255.269 22.2774 251.367 23.6352 248.782 23.6352C246.196 23.6352 244.505 22.8018 244.505 22.8018L245.068 19.4899C246.619 20.7523 251.32 21.1098 251.32 19.1087C251.32 17.1077 246.079 17.0603 246.079 13.2489C246.079 9.19864 250.544 8.36523 252.425 8.36523C254.164 8.36523 255.833 9.00844 255.833 9.00844L255.293 12.1767ZM260.931 18.9368H264.329L263.106 13.0637L260.931 18.9368Z"
                                        fill="white" />
                                    <g clip-path="url(#clip2_417_1271)">
                                        <path
                                            d="M285.326 27.9473V26.3545C285.326 25.7453 284.955 25.3463 284.318 25.3463C284 25.3463 283.653 25.4514 283.415 25.7978C283.23 25.5071 282.964 25.3463 282.565 25.3463C282.299 25.3463 282.033 25.4267 281.822 25.7174V25.3989H281.266V27.9473H281.822V26.5401C281.822 26.0886 282.06 25.8752 282.432 25.8752C282.803 25.8752 282.988 26.1133 282.988 26.5401V27.9473H283.545V26.5401C283.545 26.0886 283.811 25.8752 284.154 25.8752C284.525 25.8752 284.711 26.1133 284.711 26.5401V27.9473H285.326ZM293.584 25.3989H292.681V24.6288H292.124V25.3989H291.62V25.903H292.124V27.0721C292.124 27.6566 292.363 27.9999 293 27.9999C293.238 27.9999 293.504 27.9195 293.689 27.8143L293.529 27.335C293.368 27.4401 293.182 27.4679 293.049 27.4679C292.783 27.4679 292.678 27.3071 292.678 27.0442V25.903H293.581V25.3989H293.584ZM298.31 25.3432C297.991 25.3432 297.778 25.504 297.645 25.7143V25.3958H297.088V27.9442H297.645V26.5092C297.645 26.0855 297.831 25.8442 298.177 25.8442C298.282 25.8442 298.415 25.8721 298.523 25.8968L298.684 25.3649C298.573 25.3432 298.415 25.3432 298.31 25.3432ZM291.169 25.6092C290.903 25.4236 290.532 25.3432 290.133 25.3432C289.496 25.3432 289.072 25.6618 289.072 26.1659C289.072 26.5896 289.39 26.8308 289.947 26.9082L290.213 26.936C290.504 26.9886 290.665 27.069 290.665 27.202C290.665 27.3875 290.451 27.5205 290.08 27.5205C289.709 27.5205 289.415 27.3875 289.23 27.2545L288.964 27.6783C289.254 27.8917 289.653 27.9968 290.052 27.9968C290.794 27.9968 291.221 27.6504 291.221 27.1741C291.221 26.7226 290.875 26.4844 290.346 26.404L290.08 26.3762C289.842 26.3484 289.656 26.2958 289.656 26.138C289.656 25.9525 289.842 25.8473 290.136 25.8473C290.454 25.8473 290.773 25.9803 290.934 26.0607L291.169 25.6092ZM305.98 25.3432C305.662 25.3432 305.448 25.504 305.315 25.7143V25.3958H304.758V27.9442H305.315V26.5092C305.315 26.0855 305.501 25.8442 305.847 25.8442C305.952 25.8442 306.085 25.8721 306.193 25.8968L306.354 25.371C306.246 25.3432 306.088 25.3432 305.98 25.3432ZM298.867 26.6731C298.867 27.4432 299.399 27.9999 300.221 27.9999C300.592 27.9999 300.858 27.9195 301.124 27.7092L300.858 27.2576C300.645 27.4185 300.435 27.4958 300.193 27.4958C299.742 27.4958 299.423 27.1772 299.423 26.6731C299.423 26.1937 299.742 25.8752 300.193 25.8504C300.432 25.8504 300.645 25.9308 300.858 26.0886L301.124 25.637C300.858 25.4236 300.592 25.3463 300.221 25.3463C299.399 25.3432 298.867 25.903 298.867 26.6731ZM304.016 26.6731V25.3989H303.459V25.7174C303.274 25.4793 303.008 25.3463 302.662 25.3463C301.944 25.3463 301.387 25.903 301.387 26.6731C301.387 27.4432 301.944 27.9999 302.662 27.9999C303.033 27.9999 303.299 27.8669 303.459 27.6288V27.9473H304.016V26.6731ZM301.972 26.6731C301.972 26.2216 302.263 25.8504 302.742 25.8504C303.193 25.8504 303.512 26.1968 303.512 26.6731C303.512 27.1246 303.193 27.4958 302.742 27.4958C302.266 27.4679 301.972 27.1216 301.972 26.6731ZM295.31 25.3432C294.568 25.3432 294.036 25.8752 294.036 26.67C294.036 27.4679 294.568 27.9968 295.338 27.9968C295.709 27.9968 296.08 27.8917 296.374 27.6504L296.108 27.2514C295.894 27.4123 295.629 27.5174 295.366 27.5174C295.019 27.5174 294.676 27.3566 294.596 26.9082H296.479C296.479 26.8277 296.479 26.7752 296.479 26.6947C296.504 25.8752 296.024 25.3432 295.31 25.3432ZM295.31 25.8226C295.656 25.8226 295.894 26.036 295.947 26.4319H294.62C294.673 26.0886 294.911 25.8226 295.31 25.8226ZM309.141 26.6731V24.3906H308.584V25.7174C308.399 25.4793 308.133 25.3463 307.786 25.3463C307.069 25.3463 306.512 25.903 306.512 26.6731C306.512 27.4432 307.069 27.9999 307.786 27.9999C308.157 27.9999 308.423 27.8669 308.584 27.6288V27.9473H309.141V26.6731ZM307.097 26.6731C307.097 26.2216 307.387 25.8504 307.867 25.8504C308.318 25.8504 308.637 26.1968 308.637 26.6731C308.637 27.1246 308.318 27.4958 307.867 27.4958C307.387 27.4679 307.097 27.1216 307.097 26.6731ZM288.459 26.6731V25.3989H287.903V25.7174C287.717 25.4793 287.451 25.3463 287.105 25.3463C286.387 25.3463 285.831 25.903 285.831 26.6731C285.831 27.4432 286.387 27.9999 287.105 27.9999C287.476 27.9999 287.742 27.8669 287.903 27.6288V27.9473H288.459V26.6731ZM286.39 26.6731C286.39 26.2216 286.681 25.8504 287.16 25.8504C287.612 25.8504 287.931 26.1968 287.931 26.6731C287.931 27.1246 287.612 27.4958 287.16 27.4958C286.681 27.4679 286.39 27.1216 286.39 26.6731Z"
                                            fill="white" />
                                        <path d="M299.345 6.04443H290.982V21.0692H299.345V6.04443Z" fill="#FF5A00" />
                                        <path
                                            d="M291.539 13.5567C291.539 10.5041 292.974 7.79485 295.176 6.04433C293.556 4.7701 291.511 4 289.281 4C283.999 4 279.725 8.27423 279.725 13.5567C279.725 18.8392 283.999 23.1134 289.281 23.1134C291.511 23.1134 293.556 22.3433 295.176 21.0691C292.971 19.3433 291.539 16.6093 291.539 13.5567Z"
                                            fill="#EB001B" />
                                        <path
                                            d="M310.627 13.5567C310.627 18.8392 306.353 23.1134 301.071 23.1134C298.841 23.1134 296.796 22.3433 295.176 21.0691C297.406 19.3155 298.813 16.6093 298.813 13.5567C298.813 10.5041 297.378 7.79485 295.176 6.04433C296.793 4.7701 298.838 4 301.068 4C306.353 4 310.627 8.30206 310.627 13.5567Z"
                                            fill="#F79E1B" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_417_1271">
                                            <rect width="21.1282" height="24" fill="white"
                                                transform="translate(133.586 4)" />
                                        </clipPath>
                                        <clipPath id="clip1_417_1271">
                                            <rect width="48" height="20.2" fill="white"
                                                transform="translate(162.714 5.7998)" />
                                        </clipPath>
                                        <clipPath id="clip2_417_1271">
                                            <rect width="32" height="24" fill="white"
                                                transform="translate(279.427 4)" />
                                        </clipPath>
                                    </defs>
                                </svg>


                            </div>
                        </div>
                    </div>
                    @php
                        $category_more = App\Models\Admin\Category::take(5)->get();
                    @endphp
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="footer__item service">
                            <h3 class="heading mb-2">Service</h3>
                            <ul class="list">
                                @foreach ($category_more as $cat_more)
                                    <li class="item">
                                        <a href="{{ url('shop?category=' . $cat_more->id . '&r_category=' . $cat_more->category_name . '') }}"
                                            class="link text-uppercase">{{ $cat_more->category_name }}</a>
                                    </li>
                                @endforeach





                                <li class="item">
                                    <a href="{{ url('/membership') }}" class="link text-uppercase">Membership</a>
                                </li>
                                <li class="item">
                                    <a href=" {{ url('/shop?type=free&r_category=FREE') }}"
                                        class="link text-uppercase">Free
                                        product</a>
                                </li>


                                <li class="item">
                                    <a href="{{ URL('/shop') }}" class="link text-uppercase">shop</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="footer__item company">
                            <h3 class="heading mb-2">Company</h3>
                            <ul class="list">
                                <li class="item">
                                    <a href="{{ url('/customer-request') }}" class="link">Custom Request</a>
                                </li>
                                <li class="item">
                                    <a href="{{ url('how-it-work') }}" class="link">How It Work?</a>
                                </li>
                                <li class="item">
                                    <a href="{{ url('about-us') }}" class="link">About Us</a>
                                </li>
                                <li class="item">
                                    <a href="{{ url('contact-us') }}" class="link">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-2">
                        <div class="footer__item company">
                            <h3 class="heading mb-2">Support</h3>
                            <ul class="list">
                                <li class="item">
                                    <a href="#" class="link">Help Center</a>
                                </li>
                                <li class="item">
                                    <a href="term-service" class="link">Terms of Service</a>
                                </li>
                                <li class="item">
                                    <a href="#" class="link">Legal</a>
                                </li>
                                <li class="item">
                                    <a href="{{ url('/privacy-policy') }}" class="link">Privacy policy</a>
                                </li>
                                <li class="item">
                                    <a href="#" class="link">Status</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- <div class="col-12 col-sm-12 col-lg-3">
       <div class="footer__item company">
        <h3 class="heading mb-2">Stay up to date</h3>
        <p class="text mb-3">
         The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for
         those interested
        </p>
        <div class="footer__btns d-flex align-items-center gap-2">
         <a href="#" class="btn btn-docs">View Docs</a>
         <a href="#" class="btn btn-api">API Docs</a>
        </div>
       </div>
      </div> -->
                </div>
            </div>
        </footer>
        <div class="copyright">
            <p>FinTech Forex EA © All Rights Reserved</p>
        </div>

        <div class="offcanvas-overlay"></div>
        <!-- Modal -->
        <div class="popup__login">
            <div class="container">
                <div class="popup__login-loginone">
                    <img class="popup__icon" src="{{ asset('frontend/img/404-icon.png') }}" alt="">
                    <div class="login__area-inner border-0">
                        <h4 class="login__area-title text-center">login</h4>
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="login__area-field">
                                <input class="input-control-ibx" type="email" style="text-inherit"
                                    placeholder="Enter Your Email" name="email">
                                <i class="bi bi-person login__area-icon"></i>
                            </div>
                            <div class="login__area-field">
                                <input class="input-control-ibx" id="password-field" type="password" name="password"
                                    placeholder="password">
                                <span toggle="#password-field"
                                    class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                <i class="bi bi-lock login__area-icon"></i>
                            </div>

                            <div class="form-check form-switch custom_change_switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Remember me </label>
                            </div>

                            <div class="login__area-submit">
                                <button class="login__area-submitbtn" type="submit">submit</button>
                                <a class="login__area-lostpass" href="{{ route('password.request') }}">lost
                                    password?</a>
                            </div>
                            <div class="login__area-login">
                                <a class="login__area-sign" href="{{ route('auth.google') }}"><img
                                        src="{{ asset('frontend/img/google1.png') }}" alt="">continue with
                                    google</a>
                            </div>
                        </form>
                    </div>
                    <div class="popup__login-footer">
                        <span>Don’t have an acount?</span>
                        <a href="{{ route('register') }}">Sign Up</a>
                        <!-- <img src="{{ asset('frontend/img/fly.png') }}" alt="fly"> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="popup__register">
            <div class="container">
                <div class="popup__login-loginone">
                    <img class="popup__icon" src="{{ asset('frontend/img/404-icon.png') }}" alt="">
                    <div class="login__area-right">
                        <div class="login__area-inner">
                            <h4 class="login__area-title text-center ">register</h4>

                            <form action="{{ route('register') }}" method="post">
                                @csrf
                                <div class="login__area-field">
                                    <input type="text" class="input-control-ibx" placeholder="name"
                                        name="name" class="@error('name') is-invalid @enderror" required>
                                    <i class="bi bi-person login__area-icon"></i>
                                </div>
                                <div class="login__area-field">
                                    <input type="email" class="input-control-ibx" name="email"
                                        placeholder="email" class="@error('email') is-invalid @enderror">
                                    <i class="bi bi-envelope login__area-icon"></i>
                                </div>
                                <div class="login__area-field">
                                    <input type="password" class="input-control-ibx" placeholder="password"
                                        name="password" class="@error('password') is-invalid @enderror">
                                    <i class="bi bi-lock login__area-icon"></i>
                                </div>
                                <div class="login__area-field">
                                    <input type="password" class="input-control-ibx" placeholder="Confirm password"
                                        name="password_confirmation" autocomplete="new-password">
                                    <i class="bi bi-lock login__area-icon"></i>
                                </div>
                                <div class="login__area-submit">
                                    <button class="login__area-submitbtn" type="submit">register</button>
                                </div>

                                <div class="login__area-login">
                                    <a class="login__area-sign" href="{{ route('auth.google') }}"><img
                                            src="{{ asset('frontend/img/google1.png') }}" alt="">continue
                                        with google</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="progress-wrap active-progress">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                    style="transition:stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 267.568;">
                </path>
            </svg>
        </div>


    </main>


    <style>
        .custom_nav__item {
            list-style: none;

        }

        .custom_nav__item li {
            list-style: none;

        }

        .custom_nav__item {
            margin: 5px 0;

        }

        .custom_nav__item .nav__item {
            margin: 5px;

        }

        .custom_nav__item .ms_submenu {
            margin-left: 5px;

        }

        .custom_nav__item li a {
            color: #141738;
            font-size: 1.8rem;
            line-height: 180%;

        }

        .dark .custom_nav__item li a {
            color: #141738;
            font-size: 1.8rem;
            line-height: 180%;

        }

        .icon_sub_menu {
            opacity: 0;

        }

        .ms_has-submenu .icon_sub_menu {
            opacity: 1;
        }

        .ms_has-submenu a {
            display: flex;
            justify-content: space-between;
        }

        .loaders-axu {
            display: flex;
            text-align: center;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            position: relative;
            z-index: 99999999999;
        }

        .light .loaders-axu {
            background: #fff;
        }

        .dark .loaders-axu {
            background: #20234a !important;
        }

        .loaders-axu .ring {
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            animation: ring 2s linear infinite;
        }

        @keyframes ring {
            0% {
                transform: rotate(0deg);
                box-shadow: 1px 5px 2px #6934d1;
            }

            50% {
                transform: rotate(180deg);
                box-shadow: 1px 5px 2px white;
            }

            100% {
                transform: rotate(360deg);
                box-shadow: 1px 5px 2px #00ffe2;
            }
        }

        .loaders-axu .ring:before {
            position: absolute;
            content: '';
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            border-radius: 50%;
            box-shadow: 0 0 5px rgba(255, 255, 255, .3);
        }

        .loaders-axu span {
            color: #737373;
            font-size: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
            line-height: 200px;
            animation: text 3s ease-in-out infinite;
        }

        @keyframes text {
            50% {
                color: #00ffe2;
            }
        }
    </style>








    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"
        integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('frontend/js/backToTop.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.meanmenu.min.js') }}"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script> -->
    <script src="{{ asset('frontend/js/swiper-bundle.min.js') }}"></script>

    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script>
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: false,
            centerMode: true,
            focusOnSelect: true,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 300,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }

            ]
        });
    </script>


    <script src="{{ asset('js/share.js') }}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        // document.addEventListener('contextmenu', (e) => e.preventDefault());

        // function ctrlShiftKey(e, keyCode) {
        // return e.ctrlKey && e.shiftKey && e.keyCode === keyCode.charCodeAt(0);
        // }

        // document.onkeydown = (e) => {
        // // Disable F12, Ctrl + Shift + I, Ctrl + Shift + J, Ctrl + U
        // if (
        //     event.keyCode === 123 ||
        //     ctrlShiftKey(e, 'I') ||
        //     ctrlShiftKey(e, 'J') ||
        //     ctrlShiftKey(e, 'C') ||
        //     (e.ctrlKey && e.keyCode === 'U'.charCodeAt(0))
        // )
        //     return false;
        // };



        @if (Session::has('messege'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('messege') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('messege') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('messege') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('messege') }}");
                    break;
            }
        @endif
    </script>
    <!-- top search bar   -->
    <script>
        const btn = document.querySelectorAll('.search-btn-handler')
        const box = document.getElementById('search-view-box')
        const closeBtn = document.getElementById('search-close-btn-ab')


        btn.forEach((button) => {
            button.addEventListener('click', () => {
                box.classList.toggle("active");
            })
        });

        closeBtn.addEventListener('click', () => {
            box.classList.remove("active");
        })
    </script>
    <script>
        // var swiper = new Swiper(".mySwiper", {
        //   loop: true,
        //   spaceBetween: 10,
        //   slidesPerView: 4,
        //   freeMode: true,
        //   watchSlidesProgress: true,
        // });
        // var swiper2 = new Swiper(".mySwiper2", {
        //   loop: true,
        //   spaceBetween: 10,
        //   navigation: {
        //     nextEl: ".swiper-button-next",
        //     prevEl: ".swiper-button-prev",
        //   },
        //   thumbs: {
        //     swiper: swiper,
        //   },
        // });
    </script>

    <script>
        let dbtn = document.querySelector('.dashboard-open');
        let dashboardx = document.querySelector('.dashboard__main');

        if (dbtn) {
            dbtn.addEventListener('click', () => {
                dashboardx.classList.toggle('show-hide')
            })
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.addWishlist').on('click', function() {
                var id = $(this).data('id');
                if (id) {
                    $.ajax({
                        url: "{{ url('user/add/wish-list/') }}/" + id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            if (data.success) {
                                $('._hart-icon').on('click', function() {
                                    // Find the <i> tag within the clicked button
                                    var iconElement = $(this).find('i');

                                    // Remove the "fa-solid" class and add the "fa-regular" class
                                    iconElement.removeClass('fa-regular').addClass(
                                        'fa-solid');
                                });
                                toastr.success(data.success)
                                $.ajax({
                                    type: "GET",
                                    url: "/user/count/wishlist",
                                    dataType: 'json',
                                    success: function(data) {
                                        $('.wishlist-count').text(data);
                                    },
                                });

                                $.ajax({
                                    type: "GET",
                                    url: "/user/show/wishlist",
                                    success: function(data) {
                                        $('.wish_list_popup').html(data)
                                    },
                                });
                            } else {
                                toastr.error(data.error)
                            }

                        },
                        error: function(data) {
                            toastr.error('<h3>Please Login Your Account</h3>');
                        }
                    });
                } else {

                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.removeWishlist').on('click', function() {
                var productId = $(this).data('id');

                $.ajax({
                    url: 'user/delete/wish-item/' +
                        productId, // Replace with the actual URL to delete the product
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        toastr.success("<h4>Product removed from your wishlist</h4>")
                    },
                    error: function(xhr, status, error) {

                    }
                });
            });
        });
    </script>
    <script>
        $('.addCard').on('submit', function(e) {
            e.preventDefault();
            $('.loading').removeClass('d-none');
            var url = $(this).attr('action');
            var request = $(this).serialize();
            $.ajax({
                url: url,
                type: 'post',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                    }
                    toastr.success(data);

                    $.ajax({
                        type: "GET",
                        url: "/cart/show",
                        success: function(data) {
                            $('.cart_list_popup').html(data)
                        },
                    });

                    $.ajax({
                        type: "GET",
                        url: "/cart/count",
                        success: function(data) {
                            $('.cart-count').text(data)
                        },
                    });
                },
            });
        });
    </script>
    <script>
        $(document).ready(function wishlist($) {
            $.ajax({
                type: "GET",
                url: "/user/count/wishlist",
                dataType: 'json',
                success: function(data) {
                    $('.wishlist-count').text(data)
                },
            });
        });
    </script>
    {{-- <script>
			$(document).ready(function show(){
				 $.ajax({
				   type: "GET",
				   url: "user/show/wishlist",
				   success: function (data) {
				      $('.wish_list_popup').html(data)
				   },
				});
			})
		</script> --}}

    <script>
        $(document).ready(function() {
            $.ajax({
                type: "GET",
                url: "/cart/show",
                success: function(data) {
                    $('.cart_list_popup').html(data)
                },
            });
        })
    </script>


    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-63f311cd6301e06d"></script>




    <script>
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: false,
            centerMode: true,

        })





        // notification

        var offset = 10;

        $('#load-more-btn').on('click', function() {
            $.ajax({
                url: "{{ route('notification.load-more') }}",
                type: 'GET',
                data: {
                    offset: offset
                },
                success: function(response) {
                    if (response.hasMore) {
                        offset += 10;
                        var postsContainer = $('#posts-container');
                        if (response.users && response.users.length > 0) {
                            response.users.forEach(function(post) {
                                var postHtml = '<div class="post"><h3> hello </h3></div>';
                                postsContainer.append(postHtml);
                            });
                        } else {
                            $('#load-more-btn').hide();
                        }
                    } else {
                        $('#load-more-btn').hide();
                    }
                }
            });
        });
    </script>

    {{-- <script>

</script> --}}

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/{{ property_id() }}/{{ widget_id() }}';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->


    <script>
        window.onload = function() {
            slideOne();
            slideTwo();
        };

        let sliderOne = document.getElementById('slider-1');
        let sliderTwo = document.getElementById('slider-2');
        let displayValOne = document.getElementById('range1');
        let displayValTwo = document.getElementById('range2');
        let minGap = 0;
        let sliderTrack = document.querySelector('.slider-track');
        let sliderMaxValue = document.getElementById('slider-2').max;

        function slideOne() {
            if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
                sliderOne.value = parseInt(sliderTwo.value) - minGap;
            }
            displayValOne.textContent = sliderOne.value;
            fillColor();
        }

        function slideTwo() {
            if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
                sliderTwo.value = parseInt(sliderOne.value) + minGap;
            }
            displayValTwo.textContent = sliderTwo.value;
            fillColor();
        }

        function fillColor() {
            percent1 = (sliderOne.value / sliderMaxValue) * 100;
            percent2 = (sliderTwo.value / sliderMaxValue) * 100;
            sliderTrack.style.background =
                `linear-gradient(to right, #dadae5 ${percent1}% , #3264fe ${percent1}% , #3264fe ${percent2}%, #dadae5 ${percent2}%)`;
        }
    </script>

    @stack('js')
</body>

</html>
