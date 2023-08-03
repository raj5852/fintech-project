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
            <li><a href="{{route('home')}}">Home</a> <i class="bi bi-chevron-right"></i></li>
            <li>Pre-order Details</li>
        </ul>
    </div>
 

    <div class="single__product">
		<div class="container">
			<div class="row g-5">
				<div class="col-xl-6 col-lg-6 col-md-12">
					<div class="single__product-left">
 

					 

						 <div class="slider-main-pro">
							<!-- <p class="cashback-p">Cashback</p> -->
							<div class="img-view slider-for">
								<img src="{{ asset('frontend/img/items-img-1.png') }}" alt="">
								<img src="{{ asset('frontend/img/items-img-2.png') }}" alt="">
								<img src="{{ asset('frontend/img/items-img-3.png') }}" alt="">
								<img src="{{ asset('frontend/img/items-img-4.png') }}" alt="">
								<img src="{{ asset('frontend/img/items-img-1.png') }}" alt="">
								<img src="{{ asset('frontend/img/items-img-2.png') }}" alt=""> 
							</div>
						 
							<div class=" slider-nav">
								<div class="img-list "><img src="{{ asset('frontend/img/items-img-1.png') }}" alt=""></div>
								<div class="img-list "><img src="{{ asset('frontend/img/items-img-2.png') }}" alt=""></div>
								<div class="img-list "><img src="{{ asset('frontend/img/items-img-3.png') }}" alt=""></div>
								<div class="img-list "><img src="{{ asset('frontend/img/items-img-4.png') }}" alt=""></div>
								<div class="img-list "><img src="{{ asset('frontend/img/items-img-1.png') }}" alt=""></div>
								<div class="img-list "><img src="{{ asset('frontend/img/items-img-2.png') }}" alt=""></div> 
							</div>
						 </div>
						 
  
 

 


						 




					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-md-12">
					<div class="single_preview_content pl-30">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
							<li  class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
							<li class="breadcrumb-item"><a href="#">{{ $product->category->category_name }}</a></li>
							@if( $product->subcategory_id)
							<li class="breadcrumb-item"><a href="#">{{  $product->subcategory->subcategory_name }}</a></li>
							@endif
							<li class="breadcrumb-item active" aria-current="page">{{ $product->product_name }}</li>
							</ol>
						</nav>
						<h2 class="single__product-title border-bottom-0">{{ $product->product_title }}</h2>
						<div class="s-price pt-30 mb-30">
							@if($product->discount_rate == 0.00)
							<span class="single__product-pricebtn">${{ $product->product_price }}</span>
							@else
							<span class="single__product-pricebtn line-through">${{ $product->product_price }}</span>
							<span class="single__product-pricebtn">${{ $product->discount_price }}</span>
							@endif
						</div>
						@php

						$avgrating=0;

			     		@endphp

                    @foreach ($product->orderItems->where('rstatus',1) as $orderItem )
						@php
                            // print_r($orderItem);
                            // return false;
                            if($orderItem->review){
                                $avgrating=$avgrating + $orderItem->review->rating;
                            }

						@endphp
						@endforeach

						 
						<div class="single__product-feature">
							<p>{{ $product->product_short_desc }}</p>
							{{-- <ul class="single__product-featurlist">
								@foreach($specifiactions as $key=> $specific)
								<li>{{ $specific }} : {{ json_decode($product->specification_ans, true)[$key] }}.</li>
								@endforeach
							</ul> --}}
						</div>

                        <div class="progress-bar-wrap-pre details">
                            <div class="-box"><span class="__title">Ordered: 2</span><span class="__title">Item Available: 8</span></div>
                            <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" style="width: 60%"></div>
                            </div>
                        </div>
						 
						<div class="d-flex add-to-cart-by-now-ab pre-details">
                            <button class="add-to-cart common-btn" style="margin-left: 0px; border-radius:10px" type="submit">Pre-Order</button>
                        </div>

					 

 
                        <style>
                            #social-links ul {
                                list-style: none;
                                display: flex;
                            }
                        </style>
						<div class="single__product-social d-flex align-items-center">
							<span class="f-title edit-f-title">Follow Us: </span>

                            {!! $shareComponent!!}


						    {{-- <a href="#">{!!  Share::page('http://jorenvanhocht.be')->facebook(); !!}<i class="bi bi-facebook"></i></a>
							<a href="#">{!! Share::page('http://jorenvanhocht.be')->whatsapp() !!}<i class="bi bi-whatsapp"></i></a>
							<a href="#"> {!! Share::page('http://jorenvanhocht.be', 'Share title')->linkedin('Extra linkedin summary can be passed here') !!}<i class="bi bi-linkedin"></i></a>
							<a href="#">{!!   Share::page('http://jorenvanhocht.be', 'Your share text can be placed here')->twitter();!!}<i class="bi bi-twitter"></i></a> --}}
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
