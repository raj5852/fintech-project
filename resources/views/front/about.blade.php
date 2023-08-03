@php
    $setting = DB::table('web_sites')->first();
@endphp
@extends('layouts.front')
@section('title')
    About Us |
@endsection

@section('front_content')
    <!-- breadcrumb  -->
    <div class="bredcrumb">
        <h2 class="bredcrumb__title">About Us</h2>
        <ul class="bredcrumb__items">
            <li><a href="{{ route('home') }}">Home</a> <i class="bi bi-chevron-right"></i></li>
            <li>About us</li>
        </ul>
    </div>

    <!-- store about  -->

    <div class="about__store">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="about__store-left">
                        <span class="about__store-subtitle">{{ $about->about_us }}</span>
                        <h3 class="about__store-title">{{ $about->about_title }}</h3>
                        <p>{!! $about->description !!}</p>

                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="about__store-thumb">
                        <img src="{{ asset('backend/about/' . $about->image) }}" alt="store">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- about features  -->

    <div class="about__features">
        <div class="container">
            <div class="about__features-wrapper">
                @foreach ($aboutones as $aboutone)
                    <div class="about__features-item">
                        <div class="about__features-thumb">
                            <img src="{{ asset('backend/aboutone/' . $aboutone->image) }}" alt="ab1">
                        </div>
                        <div class="about__features-content">

                            <h4 class="about__features-title">{{ $aboutone->title }}</h4>
                            <p class="about__features-dis"> {{ $aboutone->details }}</p>

                        </div>
                    </div>
                @endforeach





            </div>
        </div>
    </div>

    <!-- about have  -->
    <div class="about__have">
        <div class="container">
            <div class="about__have-section">
                <span class="about__store-subtitle">WE HAVE GOT</span>

                <h2 class="about__store-title"></h2>

            </div>
            <div class="row">
                @foreach ($abouttwos as $abouttwo)
                    <div class="col-lg-6">

                        <div class="about__have-item">
                            <span class="about__have-title">{{ $abouttwo->title }}</span>
                            <p class="about__have-dis">{!! $abouttwo->details !!}</p>
                            <p>
                                <hr>
                                <a href="{{ url('shop') }}">GET STARTED</a><i class="bi bi-arrow-right"
                                    style="margin: 0px; padding: 0px 0px 0px 10px; outline: none; border: 0px; vertical-align: baseline; display: inline-block;"></i>
                            </p>
                        </div>

                    </div>
                @endforeach


            </div>
        </div>
    </div>

    <!-- about conpactibility  -->
    <div class="about__have">
        <div class="container">
            <div class="about__have-section">


                <h2 class="about__store-title">{{ $setting->software_title_about }}</h2>
                <p class="text mb-4 text-center">New Product Add </p>


            </div>
            <div class="row">
                <section class="section items-section free-items">
                    <div class="container">

                        <div class="cards-wrap-ab">
                            @if ($products->count() > 0)
                                @foreach ($products as $product)
                                    <div class="card-main">
                                        <div class="card-item">
                                            @if (isProductWishlist($product->id))
                                                <button class="_hart-icon removeWishlist" data-id="{{ $product->id }}">
                                                    <span><i class="fa-solid fa-heart"></i></span>
                                                </button>
                                            @else
                                                <button class="_hart-icon addWishlist" data-id="{{ $product->id }}">
                                                    <span><i class="fa-regular fa-heart"></i></span>
                                                </button>
                                            @endif
                                            <div class="image">
                                                <a href="{{ route('product.details', $product->product_slug) }}"><img
                                                        src="{{ asset($product->thumbnail) }}" alt=""></a>
                                            </div>
                                            <div class="heading-content">
                                                <a href="{{ route('product.details', $product->product_slug) }}"
                                                    class="_title">{{ $product->product_name }}</a>
                                                <div class="price-box">
                                                    @if ($product->discount_rate == 0.0)
                                                        <p class="new_price">${{ $product->product_price }}</p>
                                                    @else
                                                        <p class="old_price">${{ $product->product_price }}</p>
                                                        <p class="new_price">${{ $product->discount_price }}</p>
                                                    @endif
                                                </div>

                                            </div>

                                            <div class="sub-content">
                                                <p class="detail">
                                                    {{ Str::limit($product->product_short_desc, 100) }}
                                                </p>
                                                @if (isProductPurchased($product->id))
                                                    @php
                                                        $data = $product->product_url;

                                                        if ($data !== null) {
                                                            $keyLink = array_keys($data);
                                                        } else {
                                                            $keyLink = ['https://fintechforexea.com/user/home'];
                                                        }

                                                        $downloadUrl = end($keyLink);

                                                    @endphp
                                                    <a target="_blank" href="{{ $downloadUrl }}"
                                                        class="common-btn">Download
                                                        now</a>
                                                @else
                                                    <form action="{{ route('add.cart') }}" method="post" class="addCard">
                                                        @csrf
                                                        <input type="hidden" name="product_id"
                                                            value="{{ encrypt($product->id) }}">
                                                        <input type="hidden" name="product_qty" value="1">
                                                        @if ($product->discount_rate == 0.0)
                                                            <input type="hidden" name="product_price"
                                                                value="{{ encrypt($product->product_price) }}">
                                                        @else
                                                            <input type="hidden" name="product_price"
                                                                value="{{ encrypt($product->discount_price) }}">
                                                        @endif
                                                        <button class="common-btn">Add to Cart</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center">
                                    <p class="text-secondary">No Product found!!</p>
                                </div>
                            @endif
                        </div>
                        <div class="items__btn">
                            <!-- <a href="#" class="btn btn-more">view more</a> -->
                            <a href="{{ url('shop') }}" class="btn-one">view more</a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- about newsletter  -->

    <div class="about__newsletter">
        <div class="about__newsletter-wrapper">

            <span class="about__newsletter-title">{{ $setting->test_title }}!</span>
            <p class="about__newsletter-dis">{{ $setting->test_desc }}</p>

            <br>
            <form action="{{ url('subscriber/store') }}" method="post">
                @csrf
                <input type="email" placeholder="Email address" name="email" required>
                <button class="about__newsletter-btn" type="submit">Subscribe Now</button>
            </form>
        </div>
    </div>

    @push('js')
    @endpush
@endsection
