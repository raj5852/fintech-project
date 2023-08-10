@extends('layouts.front')
@section('title')
    Cart List
@endsection

@section('front_content')
    @push('css')
    @endpush
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- breadcrumb  -->
    <div class="bredcrumb">
        <h2 class="bredcrumb__title">shopping cart</h2>
        <ul class="bredcrumb__items">
            <li>Home <i class="bi bi-chevron-right"></i></li>
            <li>shopping cart</li>
        </ul>
    </div>

    <div class="container">
        @include('alert.alert')
    </div>
    <!-- cart page  -->

    <div class="cart__area">
        <div class="container">
            <div class="cart__area-wrapper">
                <div class="cart__area-left">
                    <form action="{{ route('update.cart') }}" method="POST">
                        @csrf
                        <div class="cart__area-inner">
                            <div class="cart_page_mobile">

                                <div class="dashboard__title-info change-ab">
                                    <span>Product</span>
                                    <span>Price</span>
                                    <span>Subtotal</span>
                                </div>
                                @foreach ($data as $key => $row)
                                    <x-checkout.productcart :row="$row" />
                                @endforeach

                            </div>


                    </form>
                    <div class="cart__area-footer">


                        {{-- apply coupon  --}}
                        @auth
                            <x-checkout.coupon />
                        @endauth

                    </div>

                </div>

            </div>
            <div class="cart__area-right">
                <div class="cart__area-innerright">
                    <h4>cart total</h4>
                    <div>
                        <span>subtotal</span>
                        <span>${{ Cart::subtotal() }}</span>
                    </div>
                    @if (Session::has('coupon'))
                        <div>
                            <span>Discount</span>

                            @if (Session::get('coupon')['type'] == 'Percent')
                                <span>( {{ session('coupon')['discount'] }} % )</span>
                            @else
                                <span>( $ {{ session('coupon')['discount'] }} )</span>
                            @endif
                            <span> - ${{ Session::get('coupon')['balance'] }}</span>
                        </div>
                    @endif
                    @if ($discountForMembership != null || $discountForMembership != 0)
                        <div>
                            <span>Membership product</span>
                            <span> - ${{ $discountForMembership }}</span>
                        </div>
                    @endif

                    <div>
                        <span>total</span>
                        <span>$ {{ $total }}</span>
                    </div>

                    <form action="{{ route('checkout.page') }}" method="post">
                        @csrf
                        @if ($total == '0')
                        <button class="common-btn w-100" style="border-radius: 10px;" type="submit">Place to
                            order</button>
                            @else
                            <button class="common-btn w-100" style="border-radius: 10px;" type="submit">product to
                                order</button>
                        @endif



                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>

    @push('js')
    @endpush
@endsection
