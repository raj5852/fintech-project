@php
    $setting = DB::table('web_sites')->first();
@endphp
@extends('layouts.front')
@section('front_content')
    <header class="header">
        <div class="container">
            <div class="header__wrapper row g-5 row-md-lg-2">
                <div class="col-12 col-lg-8">
                    <div class="header__content">

                        <center>
                            @if ($errors->any())
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        @push('js')
                                            <script>
                                                toastr.error('{{ $error }}');
                                            </script>
                                        @endpush
                                    @endforeach
                                </ul>
                            @endif
                            @if (session('error'))
                                @push('js')
                                    <script>
                                        toastr.error('{{ session('error') }}');
                                    </script>
                                @endpush
                            @endif

                        </center>
                        <h1 class="heading mb-3">{{ $setting?->title }}</h1>
                        <p class="text">
                            {{ $setting?->details }}
                        </p>

                        <!-- old style search form  -->

                        <form action="{{ url('shop') }}" method="GET" style="display:none !important"
                            class="header__search d-flex align-items-center">

                            <label for="search">
                                <i class="bi bi-search"></i>
                            </label>
                            <input type="search" name="search" value="{{ request('product') }}" id="input-field"
                                class="w-100" placeholder="Search here..." required />


                            <select name="category">
                                <option value="" {{ request('category') == '' ? 'selected' : '' }}>All Categories
                                </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}">
                                        {{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            {{-- <button type="submit">Search</button> --}}

                        </form>


                        <!-- create new search form  -->
                        <form action="{{ url('shop') }}" method="GET" class="header__search new-form">


                            <input type="search" name="search" value="{{ request('product') }}" id="input-field"
                                class="w-100" placeholder="Search for product" required />


                            <select name="category">
                                <option value="" {{ request('category') == '' ? 'selected' : '' }}>All Categories
                                </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}">
                                        {{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            <button class="button-search" type="submit"> <i class="bi bi-search"></i></button>

                        </form>
                    </div>
                </div>
                <div class="col-12 col-lg-4">

                    <div class="hello text-center">
                        @if (Auth::check())
                            <a href="{{ url('user/home') }}">
                                <div class="loader">

                                </div>
                                <div class="text">
                                    <p class="hero-dis">Personal Account FinTech </p>
                                </div>
                            </a>
                        @else
                            <a href="javascript:void(0)" class="login">
                                <div class="loader">

                                </div>
                                <div class="text">
                                    <p class="hero-dis">Personal  Account FinTech</p>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </header>
    <!-- about section -->
    <section class="section about-section">
        <div class="container">
            <h2 class="heading mb-5 text-center d-none d-lg-block">

                {{ $setting?->market_title }} <br />
                {{ $setting?->market_details }}

            </h2>

            <div class="about row g-5">
                @foreach ($marketPlaces as $marketPlace)
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="about__item">
                            <img src="{{ asset('backend/marketPlace/' . $marketPlace->image) }}" max-height="100px"
                                max-width="100px;" class="mb-3 about__img" alt="" />
                            <h3 class="heading mb-1">{{ $marketPlace->title }}</h3>
                            <p class="text">
                                {{ $marketPlace->details }}
                            </p>
                        </div>
                    </div>
                @endforeach






            </div>
        </div>
    </section>

    <!-- latest items -->
    <section class="section items-section">
        <div class="container">

            <h2 class="heading text-center">{{ $setting?->latest_product_title }} </h2>
            <p class="text mb-4 text-center">{{ $setting?->latest_product_des }} </p>

            <div class="items row g-4 mb-4">
                <div class="cards-wrap-ab">
                    @foreach ($latestProducts as $latest)
                        <div class="card-main">
                            <div class="card-item">
                                @if (isProductWishlist($latest->id))
                                    <button class="_hart-icon removeWishlist" data-id="{{ $latest->id }}">
                                        <span><i class="fa-solid fa-heart"></i></span>
                                    </button>
                                @else
                                    <button class="_hart-icon addWishlist" data-id="{{ $latest->id }}">
                                        <span><i class="fa-regular fa-heart"></i></span>
                                    </button>
                                @endif
                                <div class="image">
                                    <a href="{{ route('product.details', $latest->product_slug) }}"><img
                                            src="{{ asset($latest->thumbnail) }}" alt=""></a>
                                </div>
                                <div class="heading-content">
                                    <a href="{{ route('product.details', $latest->product_slug) }}"
                                        class="_title">{{ $latest->product_name }}</a>
                                    <div class="price-box">
                                        @if ($latest->discount_rate == 0.0)
                                            <p class="new_price">${{ $latest->product_price }}</p>
                                        @else
                                            <p class="old_price">${{ $latest->product_price }}</p>
                                            <p class="new_price">${{ $latest->discount_price }}</p>
                                        @endif
                                    </div>

                                </div>

                                <div class="sub-content">
                                    <p class="detail">{{ Str::limit($latest->product_short_desc, 100) }}</p>
                                    @if (isProductPurchased($latest->id))
                                        @php
                                            $data = $latest->product_url;

                                            if ($data !== null) {
                                                $keyLink = array_keys($data);
                                            } else {
                                                $keyLink = ['https://fintechforexea.com/user/home'];
                                            }

                                            $downloadUrl = end($keyLink);

                                        @endphp
                                        <a target="_blank" href="{{ $downloadUrl }}" class="common-btn">Download now</a>
                                    @else
                                        <form action="{{ route('add.cart') }}" method="post" class="addCard">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ encrypt($latest->id) }}">
                                            <input type="hidden" name="product_qty" value="1">
                                            @if ($latest->discount_rate == 0.0)
                                                <input type="hidden" name="product_price"
                                                    value="{{ encrypt($latest->product_price) }}">
                                            @else
                                                <input type="hidden" name="product_price"
                                                    value="{{ encrypt($latest->discount_price) }}">
                                            @endif


                                            <button class="common-btn">Add to Cart</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

            <div class="items__btn">
                <!-- <a href="#" class="btn btn-more">view more</a> -->
                <a href="{{ route('shop') }}" class="common-btn">view more</a>
            </div>
        </div>
    </section>

    <!-- latest items -->
    <section class="section items-section free-items">
        <div class="container">

            <h2 class="heading text-center">{{ $setting?->free_product_title }} </h2>
            <h3 class="heading mb-4 text-center">
                {{ $setting?->free_product_des }}
            </h3>
            <div class="items row g-4 mb-4">
                <div class="cards-wrap-ab">
                    @foreach ($freeProducts as $free)
                        <div class="card-main">
                            <div class="card-item">
                                @if (isProductWishlist($free->id))
                                    <button class="_hart-icon removeWishlist" data-id="{{ $free->id }}">
                                        <span><i class="fa-solid fa-heart"></i></span>
                                    </button>
                                @else
                                    <button class="_hart-icon addWishlist" data-id="{{ $free->id }}">
                                        <span><i class="fa-regular fa-heart"></i></span>
                                    </button>
                                @endif
                                <div class="image">
                                    <a href="{{ route('product.details', $free->product_slug) }}"><img
                                            src="{{ asset($free->thumbnail) }}" alt=""></a>
                                </div>
                                <div class="heading-content">
                                    <a href="{{ route('product.details', $free->product_slug) }}"
                                        class="_title">{{ $free->product_name }}</a>
                                    <div class="price-box">
                                        @if ($free->discount_rate == 0.0)
                                            <p class="new_price">${{ $free->product_price }}</p>
                                        @else
                                            <p class="old_price">${{ $free->product_price }}</p>
                                            <p class="new_price">${{ $free->discount_price }}</p>
                                        @endif
                                    </div>

                                </div>

                                <div class="sub-content">
                                    <p class="detail">{{ Str::limit($free->product_short_desc, 100) }}</p>
                                    @if (isProductPurchased($free->id))
                                        @php
                                            $data = $free->product_url;

                                            if ($data !== null) {
                                                $keyLink = array_keys($data);
                                            } else {
                                                $keyLink = ['https://fintechforexea.com/user/home'];
                                            }

                                            $downloadUrl = end($keyLink);

                                        @endphp
                                        <a target="_blank" href="{{ $downloadUrl }}" class="common-btn">Download
                                            now</a>
                                    @else
                                        <form action="{{ route('add.cart') }}" method="post" class="addCard">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ encrypt($free->id) }}">
                                            <input type="hidden" name="product_qty" value="1">
                                            @if ($free->discount_rate == 0.0)
                                                <input type="hidden" name="product_price"
                                                    value="{{ encrypt($free->product_price) }}">
                                            @else
                                                <input type="hidden" name="product_price"
                                                    value="{{ encrypt($free->discount_price) }}">
                                            @endif
                                            <button class="common-btn">Add to Cart</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="items__btn">
                <!-- <a href="#" class="btn btn-more">view more</a> -->
                <a href="{{ url('/shop?type=free&r_category=FREE') }}" class="btn-one">view more</a>
            </div>
        </div>
    </section>

    <!-- membership section -->
    <section class="section membership-section membership-section-bottom">
        <div class="container">
            <h2 class="heading center mb-1 text-center">FinTech Membership</h2>
            <p class="text mb-4 text-center">
                Enjoy millions of expert advisors, indicators & more with FinTech
            </p>
            @if (session('error'))
                @push('js')
                    <script>
                        toastr.error('{{ session('error') }}');
                    </script>
                @endpush
            @endif

            <div class="membership membership-plan row g-5">
                @foreach ($memberships as $key => $member)
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                        <div class="membership__item Reseller">
                            <div class="membership__top">
                                <img src="{{ asset('frontend/') }}/img/elite.png"
                                    class="membership__icon membership__icon-1" alt="" />
                                <img src="{{ asset('frontend/') }}/img/elite.png"
                                    class="membership__icon membership__icon-2" alt="" />
                                <h2 class="heading mb-1">{{ $member->membership_name }}</h2>
                                <h3 class="heading d-flex flex-column align-items-center">
                                    {{-- <span class="price">Subscription</span> --}}
                                    <span class="price">$ {{ $member->membership_price }}</span>
                                    <span class="month">Per Month</span>
                                    <span class="month">$ {{ $member->monthly_charge }}</span>
                                </h3>
                            </div>

                            @if ($key == 0)
                                <ul class="membership__list">
                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        @if ($member->expires_at == 1)
                                            <span class="text">Lifetime Membership</span>
                                        @elseif($member->expires_at == 2)
                                            <span class="text">6 Months Membership</span>
                                        @elseif($member->expires_at == 3)
                                            <span class="text">1 Year Membership</span>
                                        @elseif($member->expires_at == 4)
                                            <span class="text">2 Years Membership</span>
                                        @endif
                                    </li>
                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        <span class="text">{{ $member->short }}</span>
                                    </li>


                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        <span class="text">


                                            {{ $member->membership_details }}
                                        </span>

                                    </li>
                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        <span class="text">{{ $member->long }}</span>
                                    </li>


                                    {{-- <li>
                                <i class="bi bi-check-lg"></i>
                                <span class="text">25000+ EA Channel</span>
                            </li> --}}
                                    {{-- <li>
                                <i class="bi bi-check-lg"></i>
                                <span class="text">Source Code Channel</span>
                            </li> --}}
                                    {{-- <li>
                                <i class="bi bi-check-lg"></i>
                                <span class="text">Can request EA</span>
                            </li> --}}
                                </ul>
                            @elseif($key == 3)
                                <ul class="membership__list">
                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        @if ($member->expires_at == 1)
                                            <span class="text">Lifetime Membership</span>
                                        @elseif($member->expires_at == 2)
                                            <span class="text">6 Months Membership</span>
                                        @elseif($member->expires_at == 3)
                                            <span class="text">1 Year Membership</span>
                                        @elseif($member->expires_at == 4)
                                            <span class="text">2 Years Membership</span>
                                        @endif
                                    </li>
                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        <span class="text">{{ $member->short }}</span>
                                    </li>

                                    <li>

                                        <i class="bi bi-check-lg"></i>
                                        <span class="text">


                                            {{ $member->membership_details }}
                                        </span>
                                    </li>
                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        <span class="text">{{ $member->long }}</span>
                                    </li>

                                </ul>
                            @elseif($key == 1)
                                <ul class="membership__list">
                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        @if ($member->expires_at == 1)
                                            <span class="text">Lifetime Membership</span>
                                        @elseif($member->expires_at == 2)
                                            <span class="text">6 Months Membership</span>
                                        @elseif($member->expires_at == 3)
                                            <span class="text">1 Year Membership</span>
                                        @elseif($member->expires_at == 4)
                                            <span class="text">2 Years Membership</span>
                                        @endif
                                    </li>
                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        <span class="text">{{ $member->short }}</span>
                                    </li>
                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        <span class="text">


                                            {{ $member->membership_details }}
                                        </span>


                                    </li>
                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        <span class="text">{{ $member->long }}</span>
                                    </li>
                                </ul>
                            @elseif($key == 2)
                                <ul class="membership__list">
                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        @if ($member->expires_at == 1)
                                            <span class="text">Lifetime Membership</span>
                                        @elseif($member->expires_at == 2)
                                            <span class="text">6 Months Membership</span>
                                        @elseif($member->expires_at == 3)
                                            <span class="text">1 Year Membership</span>
                                        @elseif($member->expires_at == 4)
                                            <span class="text">2 Years Membership</span>
                                        @endif
                                    </li>
                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        <span class="text">{{ $member->short }}</span>
                                    </li>

                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        <span class="text">


                                            {{ $member->membership_details }}
                                        </span>


                                    </li>
                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        <span class="text">{{ $member->long }}</span>
                                    </li>
                                </ul>
                            @endif
                            <form action="{{ route('subscription.page') }}" method="get">


                                @if ($member->life_time_charge > 0)
                                    <ul class="membership__list">
                                        <li>
                                            <input type="checkbox" name="is_lifetime" value="1">
                                            <span class="text"><b> Lifetime :
                                                    ${{ $member->life_time_charge }}</b></span>
                                        </li>
                                    </ul>
                                @else
                                    <input type="hidden" name="is_lifetime" value="0">
                                @endif
                                <input type="hidden" name="membershipid" value="{{ $member->id }}">
                                <button type="submit" class="btn btn-membershipt">Purchase</button>
                            </form>

                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>


    <!-- request section -->
    <section class="section request-sction">
        <div class="container">

            <h2 class="heading mb-2 text-center">{{ $setting?->software_title }}</h2>
            <div class='d-flex justify-content-center '>

                {{ $setting?->software_des }}

            </div>




            <div class="custom__form mt-0 pb-0">
                <div class="row">

                    <div class="col-lg-12">
                        <h3 class="custom__form-title">Software Request Form</h3>
                        <form action="{{ url('request-store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="custom__form-field">
                                        <label for="name">Name <span>*</span></label>
                                        <input type="text" class="input-control-ibx" name="customer_name"
                                            id="customer_name">
                                        @error('customer_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="custom__form-field">
                                        <label for="name">Email <span>*</span></label>
                                        <input type="email" class="input-control-ibx" name="customer_email"
                                            id="customer_email">
                                        @error('customer_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">



                                <h3 class="custom__form-mark">What Would You Like To Do *</h3>
                                @foreach ($requestProducts as $key => $requestProduct)
                                    <div class="col-lg-4">
                                        <div class="custom__form-markcheck">
                                            <input id="g{{ $key }}" type="checkbox" name="liketodo[]"
                                                value="{{ $requestProduct->name }}">
                                            <label for="g{{ $key }}">{{ $requestProduct->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                                <h3 class="custom__form-mark">Select Platform *</h3>
                                @foreach ($requestProducttwos as $key => $requestProducttwo)
                                    <div class="col-lg-4">
                                        <div class="custom__form-markcheck">
                                            <input id="l{{ $key }}" type="checkbox" name="platform[]"
                                                value="{{ $requestProducttwo->name }}">
                                            <label for="l{{ $key }}">{{ $requestProducttwo->name }}</label>
                                        </div>
                                    </div>
                                @endforeach

                            </div>





                            <div class="custom__form-field">
                                <label for="name">Software Information</label>
                                <input type="text" class="input-control-ibx" name="software_name" id="software_name"
                                    required placeholder="Software Name">
                                @error('software_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="custom__form-field">
                                <label">Upload a zip file describing your EA or Indicator Strategy</label>
                                    <input type="file" class="input-file input-control-ibx" name="imageone">
                                    @error('imageone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>





                            <div class="custom__form-field">
                                <label>Upload EA or Indicator</label>
                                <input type="file" name="imagetwo" class="input-file input-control-ibx">
                                @error('imagetwo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="custom__form-field">
                                <label for="name">Anything Else we need to know?</label>
                                <textarea class="input-control-ibx" name="details">

							</textarea>
                                @error('details')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="custom__form-field">
                                <button class="custom-btn2" type="submit">submit</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- join telegram  -->
    <section class="telegram-section d-none">
        <div class="wrap">
            <div>
                <img src="{{ asset('frontend/img/telegram.svg') }}" alt="sadsd">
            </div>
            <div>
                <h1>Join FinTech on Telegram</h1>
                <a href="https://t.me/FinTechForexEA" target="_blank">FinTech Forex EA Channel</a>
            </div>
        </div>
    </section>

    <!-- new telegram section  -->
    <section class="join-telegram-section">
        <div class="wrap">
            <div class="image-box">
                <img src="{{ asset('frontend/img/telegram.svg') }}" alt="sadsd">
            </div>
            <div class="content-area">
                <h1 class="__title">Join FinTech on Telegram</h1>
                <div class="button-box">

                    <a class="common-button-full-rounded" href="https://t.me/FinTechForexEA" target="_blank">EA
                        Channel</a>
                    <a class="common-button-full-rounded" href="https://t.me/FinTechForexEA" target="_blank">EA
                        Channel</a>
                    <a class="common-button-full-rounded" href="https://t.me/FinTechForexEA" target="_blank">EA
                        Channel</a>
                    <a class="common-button-full-rounded" href="https://t.me/FinTechForexEA" target="_blank">EA
                        Channel</a>
                </div>
            </div>
        </div>
    </section>

    <!-- latest-terminal-update  -->

    <div class="latest-terminal-update">
        <div class="heading">
            <h1 class="_title">Latest terminal update</h1>
            <p class="_sub-title">This is a pre order. Meaning the product is not yet ready. For more info how Pre- orders
                work read <a class="here" href="#">here.</a></p>
        </div>
        <div class="table-area">
            <div class="table-responsive">
                <table class="table align-middle" style="min-height:200px">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>File Size</th>
                            <th class="db-tb">Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>21 Sep, 2022</td>
                            <td>Adobe After Effect</td>
                            <td>1.2GB</td>
                            <td>
                                <div class="dropdown">
                                    <button class=" dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">Download</button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><span>Build 1370</span><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 16 16" fill="none">
                                                    <path
                                                        d="M11.9998 5.5998H9.59979V0.799805H6.39979V5.5998H3.99979L7.99979 9.5998L11.9998 5.5998ZM15.4702 10.8254C15.3022 10.6462 14.1814 9.44701 13.8614 9.1342C13.6371 8.91925 13.3384 8.79941 13.0278 8.7998H11.6222L14.0734 11.195H11.2382C11.1997 11.1943 11.1616 11.2038 11.1279 11.2224C11.0942 11.2411 11.066 11.2684 11.0462 11.3014L10.3934 12.7998H5.60619L4.95339 11.3014C4.93344 11.2685 4.90523 11.2413 4.87155 11.2227C4.83787 11.204 4.79989 11.1945 4.76139 11.195H1.92619L4.37659 8.7998H2.97179C2.65419 8.7998 2.35099 8.927 2.13819 9.1342C1.81819 9.44781 0.697389 10.647 0.529389 10.8254C0.138189 11.2422 -0.0770106 11.5742 0.0253894 11.9846L0.474189 14.4438C0.576589 14.855 1.02699 15.1926 1.47579 15.1926H14.5254C14.9742 15.1926 15.4246 14.855 15.527 14.4438L15.9758 11.9846C16.0766 11.5742 15.8622 11.2422 15.4702 10.8254Z"
                                                        fill="white" />
                                                </svg></a>
                                        </li>
                                        <li><a class="dropdown-item" href="#"><span>Build 1370</span><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 16 16" fill="none">
                                                    <path
                                                        d="M11.9998 5.5998H9.59979V0.799805H6.39979V5.5998H3.99979L7.99979 9.5998L11.9998 5.5998ZM15.4702 10.8254C15.3022 10.6462 14.1814 9.44701 13.8614 9.1342C13.6371 8.91925 13.3384 8.79941 13.0278 8.7998H11.6222L14.0734 11.195H11.2382C11.1997 11.1943 11.1616 11.2038 11.1279 11.2224C11.0942 11.2411 11.066 11.2684 11.0462 11.3014L10.3934 12.7998H5.60619L4.95339 11.3014C4.93344 11.2685 4.90523 11.2413 4.87155 11.2227C4.83787 11.204 4.79989 11.1945 4.76139 11.195H1.92619L4.37659 8.7998H2.97179C2.65419 8.7998 2.35099 8.927 2.13819 9.1342C1.81819 9.44781 0.697389 10.647 0.529389 10.8254C0.138189 11.2422 -0.0770106 11.5742 0.0253894 11.9846L0.474189 14.4438C0.576589 14.855 1.02699 15.1926 1.47579 15.1926H14.5254C14.9742 15.1926 15.4246 14.855 15.527 14.4438L15.9758 11.9846C16.0766 11.5742 15.8622 11.2422 15.4702 10.8254Z"
                                                        fill="white" />
                                                </svg></a>
                                        </li>
                                        <li><a class="dropdown-item" href="#"><span>Build 1370</span><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 16 16" fill="none">
                                                    <path
                                                        d="M11.9998 5.5998H9.59979V0.799805H6.39979V5.5998H3.99979L7.99979 9.5998L11.9998 5.5998ZM15.4702 10.8254C15.3022 10.6462 14.1814 9.44701 13.8614 9.1342C13.6371 8.91925 13.3384 8.79941 13.0278 8.7998H11.6222L14.0734 11.195H11.2382C11.1997 11.1943 11.1616 11.2038 11.1279 11.2224C11.0942 11.2411 11.066 11.2684 11.0462 11.3014L10.3934 12.7998H5.60619L4.95339 11.3014C4.93344 11.2685 4.90523 11.2413 4.87155 11.2227C4.83787 11.204 4.79989 11.1945 4.76139 11.195H1.92619L4.37659 8.7998H2.97179C2.65419 8.7998 2.35099 8.927 2.13819 9.1342C1.81819 9.44781 0.697389 10.647 0.529389 10.8254C0.138189 11.2422 -0.0770106 11.5742 0.0253894 11.9846L0.474189 14.4438C0.576589 14.855 1.02699 15.1926 1.47579 15.1926H14.5254C14.9742 15.1926 15.4246 14.855 15.527 14.4438L15.9758 11.9846C16.0766 11.5742 15.8622 11.2422 15.4702 10.8254Z"
                                                        fill="white" />
                                                </svg></a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>21 Sep, 2022</td>
                            <td>Adobe After Effect</td>
                            <td>1.2GB</td>
                            <td>
                                <div class="dropdown">
                                    <button class=" dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">Download</button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><span>Build 1370</span><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 16 16" fill="none">
                                                    <path
                                                        d="M11.9998 5.5998H9.59979V0.799805H6.39979V5.5998H3.99979L7.99979 9.5998L11.9998 5.5998ZM15.4702 10.8254C15.3022 10.6462 14.1814 9.44701 13.8614 9.1342C13.6371 8.91925 13.3384 8.79941 13.0278 8.7998H11.6222L14.0734 11.195H11.2382C11.1997 11.1943 11.1616 11.2038 11.1279 11.2224C11.0942 11.2411 11.066 11.2684 11.0462 11.3014L10.3934 12.7998H5.60619L4.95339 11.3014C4.93344 11.2685 4.90523 11.2413 4.87155 11.2227C4.83787 11.204 4.79989 11.1945 4.76139 11.195H1.92619L4.37659 8.7998H2.97179C2.65419 8.7998 2.35099 8.927 2.13819 9.1342C1.81819 9.44781 0.697389 10.647 0.529389 10.8254C0.138189 11.2422 -0.0770106 11.5742 0.0253894 11.9846L0.474189 14.4438C0.576589 14.855 1.02699 15.1926 1.47579 15.1926H14.5254C14.9742 15.1926 15.4246 14.855 15.527 14.4438L15.9758 11.9846C16.0766 11.5742 15.8622 11.2422 15.4702 10.8254Z"
                                                        fill="white" />
                                                </svg></a>
                                        </li>
                                        <li><a class="dropdown-item" href="#"><span>Build 1370</span><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 16 16" fill="none">
                                                    <path
                                                        d="M11.9998 5.5998H9.59979V0.799805H6.39979V5.5998H3.99979L7.99979 9.5998L11.9998 5.5998ZM15.4702 10.8254C15.3022 10.6462 14.1814 9.44701 13.8614 9.1342C13.6371 8.91925 13.3384 8.79941 13.0278 8.7998H11.6222L14.0734 11.195H11.2382C11.1997 11.1943 11.1616 11.2038 11.1279 11.2224C11.0942 11.2411 11.066 11.2684 11.0462 11.3014L10.3934 12.7998H5.60619L4.95339 11.3014C4.93344 11.2685 4.90523 11.2413 4.87155 11.2227C4.83787 11.204 4.79989 11.1945 4.76139 11.195H1.92619L4.37659 8.7998H2.97179C2.65419 8.7998 2.35099 8.927 2.13819 9.1342C1.81819 9.44781 0.697389 10.647 0.529389 10.8254C0.138189 11.2422 -0.0770106 11.5742 0.0253894 11.9846L0.474189 14.4438C0.576589 14.855 1.02699 15.1926 1.47579 15.1926H14.5254C14.9742 15.1926 15.4246 14.855 15.527 14.4438L15.9758 11.9846C16.0766 11.5742 15.8622 11.2422 15.4702 10.8254Z"
                                                        fill="white" />
                                                </svg></a>
                                        </li>
                                        <li><a class="dropdown-item" href="#"><span>Build 1370</span><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 16 16" fill="none">
                                                    <path
                                                        d="M11.9998 5.5998H9.59979V0.799805H6.39979V5.5998H3.99979L7.99979 9.5998L11.9998 5.5998ZM15.4702 10.8254C15.3022 10.6462 14.1814 9.44701 13.8614 9.1342C13.6371 8.91925 13.3384 8.79941 13.0278 8.7998H11.6222L14.0734 11.195H11.2382C11.1997 11.1943 11.1616 11.2038 11.1279 11.2224C11.0942 11.2411 11.066 11.2684 11.0462 11.3014L10.3934 12.7998H5.60619L4.95339 11.3014C4.93344 11.2685 4.90523 11.2413 4.87155 11.2227C4.83787 11.204 4.79989 11.1945 4.76139 11.195H1.92619L4.37659 8.7998H2.97179C2.65419 8.7998 2.35099 8.927 2.13819 9.1342C1.81819 9.44781 0.697389 10.647 0.529389 10.8254C0.138189 11.2422 -0.0770106 11.5742 0.0253894 11.9846L0.474189 14.4438C0.576589 14.855 1.02699 15.1926 1.47579 15.1926H14.5254C14.9742 15.1926 15.4246 14.855 15.527 14.4438L15.9758 11.9846C16.0766 11.5742 15.8622 11.2422 15.4702 10.8254Z"
                                                        fill="white" />
                                                </svg></a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>21 Sep, 2022</td>
                            <td>Adobe After Effect</td>
                            <td>1.2GB</td>
                            <td>
                                <div class="dropdown">
                                    <button class=" dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">Download</button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><span>Build 1370</span><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 16 16" fill="none">
                                                    <path
                                                        d="M11.9998 5.5998H9.59979V0.799805H6.39979V5.5998H3.99979L7.99979 9.5998L11.9998 5.5998ZM15.4702 10.8254C15.3022 10.6462 14.1814 9.44701 13.8614 9.1342C13.6371 8.91925 13.3384 8.79941 13.0278 8.7998H11.6222L14.0734 11.195H11.2382C11.1997 11.1943 11.1616 11.2038 11.1279 11.2224C11.0942 11.2411 11.066 11.2684 11.0462 11.3014L10.3934 12.7998H5.60619L4.95339 11.3014C4.93344 11.2685 4.90523 11.2413 4.87155 11.2227C4.83787 11.204 4.79989 11.1945 4.76139 11.195H1.92619L4.37659 8.7998H2.97179C2.65419 8.7998 2.35099 8.927 2.13819 9.1342C1.81819 9.44781 0.697389 10.647 0.529389 10.8254C0.138189 11.2422 -0.0770106 11.5742 0.0253894 11.9846L0.474189 14.4438C0.576589 14.855 1.02699 15.1926 1.47579 15.1926H14.5254C14.9742 15.1926 15.4246 14.855 15.527 14.4438L15.9758 11.9846C16.0766 11.5742 15.8622 11.2422 15.4702 10.8254Z"
                                                        fill="white" />
                                                </svg></a>
                                        </li>
                                        <li><a class="dropdown-item" href="#"><span>Build 1370</span><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 16 16" fill="none">
                                                    <path
                                                        d="M11.9998 5.5998H9.59979V0.799805H6.39979V5.5998H3.99979L7.99979 9.5998L11.9998 5.5998ZM15.4702 10.8254C15.3022 10.6462 14.1814 9.44701 13.8614 9.1342C13.6371 8.91925 13.3384 8.79941 13.0278 8.7998H11.6222L14.0734 11.195H11.2382C11.1997 11.1943 11.1616 11.2038 11.1279 11.2224C11.0942 11.2411 11.066 11.2684 11.0462 11.3014L10.3934 12.7998H5.60619L4.95339 11.3014C4.93344 11.2685 4.90523 11.2413 4.87155 11.2227C4.83787 11.204 4.79989 11.1945 4.76139 11.195H1.92619L4.37659 8.7998H2.97179C2.65419 8.7998 2.35099 8.927 2.13819 9.1342C1.81819 9.44781 0.697389 10.647 0.529389 10.8254C0.138189 11.2422 -0.0770106 11.5742 0.0253894 11.9846L0.474189 14.4438C0.576589 14.855 1.02699 15.1926 1.47579 15.1926H14.5254C14.9742 15.1926 15.4246 14.855 15.527 14.4438L15.9758 11.9846C16.0766 11.5742 15.8622 11.2422 15.4702 10.8254Z"
                                                        fill="white" />
                                                </svg></a>
                                        </li>
                                        <li><a class="dropdown-item" href="#"><span>Build 1370</span><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 16 16" fill="none">
                                                    <path
                                                        d="M11.9998 5.5998H9.59979V0.799805H6.39979V5.5998H3.99979L7.99979 9.5998L11.9998 5.5998ZM15.4702 10.8254C15.3022 10.6462 14.1814 9.44701 13.8614 9.1342C13.6371 8.91925 13.3384 8.79941 13.0278 8.7998H11.6222L14.0734 11.195H11.2382C11.1997 11.1943 11.1616 11.2038 11.1279 11.2224C11.0942 11.2411 11.066 11.2684 11.0462 11.3014L10.3934 12.7998H5.60619L4.95339 11.3014C4.93344 11.2685 4.90523 11.2413 4.87155 11.2227C4.83787 11.204 4.79989 11.1945 4.76139 11.195H1.92619L4.37659 8.7998H2.97179C2.65419 8.7998 2.35099 8.927 2.13819 9.1342C1.81819 9.44781 0.697389 10.647 0.529389 10.8254C0.138189 11.2422 -0.0770106 11.5742 0.0253894 11.9846L0.474189 14.4438C0.576589 14.855 1.02699 15.1926 1.47579 15.1926H14.5254C14.9742 15.1926 15.4246 14.855 15.527 14.4438L15.9758 11.9846C16.0766 11.5742 15.8622 11.2422 15.4702 10.8254Z"
                                                        fill="white" />
                                                </svg></a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>21 Sep, 2022</td>
                            <td>Adobe After Effect</td>
                            <td>1.2GB</td>
                            <td>
                                <div class="dropdown">
                                    <button class=" dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">Download</button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><span>Build 1370</span><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 16 16" fill="none">
                                                    <path
                                                        d="M11.9998 5.5998H9.59979V0.799805H6.39979V5.5998H3.99979L7.99979 9.5998L11.9998 5.5998ZM15.4702 10.8254C15.3022 10.6462 14.1814 9.44701 13.8614 9.1342C13.6371 8.91925 13.3384 8.79941 13.0278 8.7998H11.6222L14.0734 11.195H11.2382C11.1997 11.1943 11.1616 11.2038 11.1279 11.2224C11.0942 11.2411 11.066 11.2684 11.0462 11.3014L10.3934 12.7998H5.60619L4.95339 11.3014C4.93344 11.2685 4.90523 11.2413 4.87155 11.2227C4.83787 11.204 4.79989 11.1945 4.76139 11.195H1.92619L4.37659 8.7998H2.97179C2.65419 8.7998 2.35099 8.927 2.13819 9.1342C1.81819 9.44781 0.697389 10.647 0.529389 10.8254C0.138189 11.2422 -0.0770106 11.5742 0.0253894 11.9846L0.474189 14.4438C0.576589 14.855 1.02699 15.1926 1.47579 15.1926H14.5254C14.9742 15.1926 15.4246 14.855 15.527 14.4438L15.9758 11.9846C16.0766 11.5742 15.8622 11.2422 15.4702 10.8254Z"
                                                        fill="white" />
                                                </svg></a>
                                        </li>
                                        <li><a class="dropdown-item" href="#"><span>Build 1370</span><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 16 16" fill="none">
                                                    <path
                                                        d="M11.9998 5.5998H9.59979V0.799805H6.39979V5.5998H3.99979L7.99979 9.5998L11.9998 5.5998ZM15.4702 10.8254C15.3022 10.6462 14.1814 9.44701 13.8614 9.1342C13.6371 8.91925 13.3384 8.79941 13.0278 8.7998H11.6222L14.0734 11.195H11.2382C11.1997 11.1943 11.1616 11.2038 11.1279 11.2224C11.0942 11.2411 11.066 11.2684 11.0462 11.3014L10.3934 12.7998H5.60619L4.95339 11.3014C4.93344 11.2685 4.90523 11.2413 4.87155 11.2227C4.83787 11.204 4.79989 11.1945 4.76139 11.195H1.92619L4.37659 8.7998H2.97179C2.65419 8.7998 2.35099 8.927 2.13819 9.1342C1.81819 9.44781 0.697389 10.647 0.529389 10.8254C0.138189 11.2422 -0.0770106 11.5742 0.0253894 11.9846L0.474189 14.4438C0.576589 14.855 1.02699 15.1926 1.47579 15.1926H14.5254C14.9742 15.1926 15.4246 14.855 15.527 14.4438L15.9758 11.9846C16.0766 11.5742 15.8622 11.2422 15.4702 10.8254Z"
                                                        fill="white" />
                                                </svg></a>
                                        </li>
                                        <li><a class="dropdown-item" href="#"><span>Build 1370</span><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 16 16" fill="none">
                                                    <path
                                                        d="M11.9998 5.5998H9.59979V0.799805H6.39979V5.5998H3.99979L7.99979 9.5998L11.9998 5.5998ZM15.4702 10.8254C15.3022 10.6462 14.1814 9.44701 13.8614 9.1342C13.6371 8.91925 13.3384 8.79941 13.0278 8.7998H11.6222L14.0734 11.195H11.2382C11.1997 11.1943 11.1616 11.2038 11.1279 11.2224C11.0942 11.2411 11.066 11.2684 11.0462 11.3014L10.3934 12.7998H5.60619L4.95339 11.3014C4.93344 11.2685 4.90523 11.2413 4.87155 11.2227C4.83787 11.204 4.79989 11.1945 4.76139 11.195H1.92619L4.37659 8.7998H2.97179C2.65419 8.7998 2.35099 8.927 2.13819 9.1342C1.81819 9.44781 0.697389 10.647 0.529389 10.8254C0.138189 11.2422 -0.0770106 11.5742 0.0253894 11.9846L0.474189 14.4438C0.576589 14.855 1.02699 15.1926 1.47579 15.1926H14.5254C14.9742 15.1926 15.4246 14.855 15.527 14.4438L15.9758 11.9846C16.0766 11.5742 15.8622 11.2422 15.4702 10.8254Z"
                                                        fill="white" />
                                                </svg></a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                        </thead>
                    <tbody>
                </table>
            </div>
        </div>
    </div>

    @if (!session()->has('popupShown'))
        <!-- modal start -->
        <section id="email_sub_modal_body" class="email_sub_modal">
            <div class="wrap">
                <img src="{{ asset('frontend/img/email-sub.svg') }}" alt="sadsd">

                <h1>{{ $setting?->test_title }}</h1>
                <p>{{ $setting?->test_desc }}</p>
                <form action="{{ url('subscriber/store') }}" method="post" class="w-100">
                    @csrf
                    <div class="sub">
                        <input type="email" placeholder="Enter your email here" name="email" required>
                        <button type="submit">Subscribe</button>
                    </div>
                </form>
                <div class="modal_close">
                    <svg id="close_modal" width="10" height="11" viewBox="0 0 10 11" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.55309 0.962918L5.19184 4.32416L1.83059 0.962918C1.68202 0.814341 1.4805 0.730872 1.27039 0.730872C1.06027 0.730872 0.858754 0.814341 0.710178 0.962918C0.561602 1.11149 0.478133 1.31301 0.478133 1.52313C0.478133 1.73324 0.561602 1.93476 0.710178 2.08333L4.07142 5.44458L0.710178 8.80583C0.561602 8.9544 0.478133 9.15592 0.478133 9.36603C0.478133 9.57615 0.561602 9.77767 0.710178 9.92624C0.858754 10.0748 1.06027 10.1583 1.27039 10.1583C1.4805 10.1583 1.68202 10.0748 1.83059 9.92624L5.19184 6.565L8.55309 9.92624C8.70166 10.0748 8.90318 10.1583 9.1133 10.1583C9.32341 10.1583 9.52493 10.0748 9.6735 9.92624C9.82208 9.77767 9.90555 9.57615 9.90555 9.36604C9.90555 9.15592 9.82208 8.9544 9.6735 8.80583L6.31226 5.44458L9.6735 2.08333C9.82208 1.93476 9.90555 1.73324 9.90555 1.52313C9.90555 1.31301 9.82208 1.11149 9.6735 0.962918C9.52493 0.814341 9.32341 0.730872 9.1133 0.730872C8.90318 0.730871 8.70166 0.814342 8.55309 0.962918Z"
                            fill="white" />
                    </svg>

                </div>
            </div>
        </section>

        <script>
            if (!localStorage.getItem('popupShown')) {
                // document.getElementById('email_sub_modal_body').style.display = 'block';
                // localStorage.setItem('popupShown', true);
                // {{ session(['popupShown' => true]) }}

                // Set a cookie with a 24-hour expiration time
                var d = new Date();
                d.setTime(d.getTime() + (24 * 60 * 60 * 1000));
                var expires = "expires=" + d.toUTCString();
                document.cookie = "popupShown=true;" + expires + ";path=/";

                document.getElementById('email_sub_modal_body').style.display = 'block';
                localStorage.setItem('popupShown', true);
                {{ session(['popupShown' => true]) }}
            }
        </script>
    @endif

    <!-- modal script  -->
    <script>
        let close_modal = document.getElementById('close_modal');
        let body = document.getElementById('email_sub_modal_body');
        if (body) {

            close_modal.addEventListener('click', () => {
                body.style.display = 'none';
            });
        }
    </script>
    <!-- modal end  -->

    <!-- client section -->
    <section class="section client-section">
        <div class="container">
            <h2 class="heading text-center">
                {{ $setting?->tesmonial }}

            </h2>

            <div class="client d-flex justify-content-between align-items-center gap-3">
                <div class="swiper">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">

                        @foreach ($testimonial as $row)
                            <div class="swiper-slide">
                                <div class="client__item">
                                    <figure class="client__profile mb-3">
                                        <img src="{{ asset($row->image) }}" alt="" />
                                    </figure>
                                    <h3 class="heading">{{ $row->name }}</h3>
                                    <p class="text title mb-2">{{ $row->designation }}</p>

                                    <div class="desc">
                                        <p class="text mb-4">
                                            {!! $row->description !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach



                    </div>

                    <!-- If we need navigation buttons -->
                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev">
                        <i class="bi bi-chevron-left"></i>
                    </div>
                    <div class="swiper-button-next">
                        <i class="bi bi-chevron-right"></i>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <div class="about__newsletter">
        <div class="about__newsletter-wrapper">

            <span class="about__newsletter-title">{{ $setting?->test_title }}</span>
            <p class="about__newsletter-dis">{{ $setting?->test_desc }}</p>

            <br>
            <form action="{{ url('subscriber/store') }}" method="post">
                @csrf
                <input type="email" placeholder="Email address" name="email" required>
                <button class="about__newsletter-btn" type="submit">Subscribe Now</button>
            </form>
        </div>
    </div>


@endsection
