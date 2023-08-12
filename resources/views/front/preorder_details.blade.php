@extends('layouts.front')

@section('title')
    Shop Page
@endsection
@section('front_content')
    @push('css')
    @endpush

    <div class="bredcrumb">
        <h2 class="bredcrumb__title">Pre-order Details</h2>
        <ul class="bredcrumb__items">
            <li><a href="{{ route('home') }}">Home</a> <i class="bi bi-chevron-right"></i></li>
            <li>Pre-order Details</li>
        </ul>
    </div>

    @php
        $images = json_decode($products->images, true);
        $requirementFulfil = $products->minimum_orders == $products->orders_count ? true : false;
    @endphp


    <div class="single__product">
        <div class="container">
            <div class="row g-5">
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="single__product-left">


                        <div class="slider-main-pro">
                            <!-- <p class="cashback-p">Cashback</p> -->
                            <div class="img-view slider-for">
                                @foreach ($images as $img)
                                    <img src="{{ asset($img) }}" alt="{{ $img }}">
                                @endforeach

                            </div>

                            <div class=" slider-nav">
                                @foreach ($images as $img)
                                    <div class="img-list "><img src="{{ asset($img) }}" alt="{{ $img }}"></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="single_preview_content pl-30">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">{{ $products->category->category_name }}</a>
                                </li>
                                @if ($products?->subcategory_id)
                                    <li class="breadcrumb-item"><a
                                            href="#">{{ $products->subcategory->subcategory_name }}</a></li>
                                @endif
                                <li class="breadcrumb-item active" aria-current="page">{{ $products->product_name }}</li>
                            </ol>
                        </nav>
                        <h2 class="single__product-title border-bottom-0">{{ $products->product_title }}</h2>
                        <div class="s-price pt-30 mb-30">
                            @if ($products->discount_rate == 0.0)
                                <span class="single__product-pricebtn">${{ $products->product_price }}</span>
                            @else
                                <span class="single__product-pricebtn line-through">${{ $products->product_price }}</span>
                                <span class="single__product-pricebtn">${{ $products->discount_price }}</span>
                            @endif
                        </div>
                        @php

                            $avgrating = 0;

                        @endphp

                        @foreach ($products->orderItems->where('rstatus', 1) as $orderItem)
                            @php
                                if ($orderItem->review) {
                                    $avgrating = $avgrating + $orderItem->review->rating;
                                }

                            @endphp
                        @endforeach


                        <div class="single__product-feature">
                            <p>{{ $products->product_short_desc }}</p>
                        </div>

                        <div class="progress-bar-wrap-pre details">
                            <div class="-box"><span class="__title">Ordered: {{ $products->orders_count }} </span><span
                                    class="__title">Item Available:
                                    {{ $products->minimum_orders }} </span></div>
                            @if ($requirementFulfil != true)
                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar"
                                        style="width: {{ ($products->orders_count / $products->minimum_orders) * 100 }}%">
                                    </div>
                                </div>
                            @else
                                <p class="deliver-txt">Delivery On The Way</p>
                            @endif

                        </div>

                        <div class="d-flex add-to-cart-by-now-ab pre-details">
                            @if (isProductPurchased($products->id) == false)
                                <button class="add-to-cart common-btn" style="margin-left: 0px; border-radius:10px"
                                    type="submit">Pre-Order</button>
                            @else
                            <p class="deliver-txt">Delivery On The Way</p>
                            @endif

                        </div>




                        <style>
                            #social-links ul {
                                list-style: none;
                                display: flex;
                            }
                        </style>
                        <div class="single__product-social d-flex align-items-center">
                            <span class="f-title edit-f-title">Follow Us: </span>

                            {!! $shareComponent !!}


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
