@extends('layouts.front')
@section('title')
Wish   List
@endsection
@section('front_content')
@push('css')

@endpush

    <!-- breadcrumb  -->
    <div class="bredcrumb">
        <h2 class="bredcrumb__title">Wishlist </h2>
        <ul class="bredcrumb__items">
            <li><a href="{{ url('/') }}">Home</a> <i class="bi bi-chevron-right"></i></li>
            <li><a href="#">Wishlist</a></li>
        </ul>
    </div>

    <!-- cart page  -->

    <div class="cart__area">
        <div class="container">
            <div class="cart__area-wrapper" style="grid-template-columns: 1fr;">
                <div class="cart__area-center flex-grow-1">
                    <div class="cart__area-inner">
                        <div class="dashboard__title-info">
                            <span>Product</span>
                            <span>Unit Price</span>
                            <span>Stock Status</span>
                            <span></span>

                        </div>
                        @foreach($data as $product)
                        <div class="dashboard__profile-wrapper">
                            <div class="dashboard__profile-itemm product-order">

                                <div>

                                    <img src="{{ asset($product->thumbnail) }}" height="80px;" width="80px;" alt="">
                                </div>
                                <div>
                                    <span>	{{ $product->product_name }}</span>
                                    <h4>O	{{ $product->product_title }}
                                        </h4>
                                </div>
                            </div>
                            <div class="dashboard__profile-itemm">
                                <h4>

                                    @if($product->discount_rate == 0.00)
                                    <span>$ {{ $product->product_price }}</span>
                                    @else
                                    <span>$ {{ $product->discount_price }}</span>
                                    @endif

                                </h4>
                            </div>

                            <div class="dashboard__profile-itemm">
                                <h4>Unlimited</h4>
                            </div>

                            <div>
                                <form action="{{ route('add.cart') }}" method="post" class="addCard">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                    <input type="hidden" name="product_qty" value="1">
                                    @if($product->discount_rate == 0.00 )
                                    <input type="hidden" name="product_price" value="{{ $product->product_price }}">
                                    @else
                                    <input type="hidden" name="product_price" value="{{ $product->discount_price }}">
                                    @endif
                                    <button class="cart-btn-wishlist" type="submit">add to cart</button>
                                </form>
                            </div>



                        </div>

                        @endforeach


                    </div>
                </div>

            </div>
        </div>
    </div>

    @push('js')


@endpush

@endsection


