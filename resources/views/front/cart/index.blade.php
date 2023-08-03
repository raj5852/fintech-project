@extends('layouts.front')
@section('title')
Cart  List
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
								{{-- <span>quantity</span> --}}
								<span>Subtotal</span>
							</div>
							@foreach($data as $key=> $row)
							<div class="dashboard__profile-wrapper change-ab">
								<div class="dashboard__profile-itemm product-order">
									<div>
										<a href="{{ route('delete.cart',$row->rowId) }}"><img class="order-close-icon" src="{{ asset('frontend/') }}/img/close.png" alt=""></a>
										<img src="{{ asset($row->options->image) }}" width="40" alt="">
									</div>
									<div>
										<span>{{ $row->name }}</span>
										{{-- <strong>{{ $row->id }}</strong> --}}
										<h5>{{ $row->options->title }}</h5>
									</div>
								</div>
								<div class="dashboard__profile-itemm">
									<h4> <span>$</span> {{ $row->price }}</h4>
								</div>
								{{-- <div class="dashboard__profile-itemm ">
									<div class="increment">
										<span class="dash_{{ $key }}">-</span>
										<span class="qty_{{ $key }}">{{ $row->qty }}</span>
										<span class="plus_{{ $key }}">+</span>
									</div>
									<script>
										$(".plus_{{ $key }}").on('click',function(){
											var qty = $(".qty_{{ $key }}").text();
											var qty_plus = ++qty;
											$(".qty_{{ $key }}").text(qty_plus);
											$(".product_qty_{{ $key }}").val(qty_plus);
										})

										$(".dash_{{ $key }}").on('click',function(){
											var qty = $(".qty_{{ $key }}").text();
											var qty_substr = qty-1;
											$(".qty_{{ $key }}").text(qty_substr);
											$(".product_qty_{{ $key }}").val(qty_substr);
										})
									</script>
									<input type="hidden" name="rowId[]" value="{{ $row->rowId }}">
									<input min="1" max="100" name="qty[]" class="product_qty_{{ $key }}"  type="hidden" value="{{ $row->qty }}">
								</div> --}}
								<div class="dashboard__profile-itemm ">
									<h4>Total<span>$</span> {{ $row->price * $row->qty }}</h4>
								</div>
							</div>
							@endforeach

							</div>

							{{-- <div class="mt-2">
								<button class="common_btn" type="submit">update cart</button>
							</div> --}}
							</form>
							<div class="cart__area-footer">
								@if(Auth::check())
								<form action="{{ route('apply.coupon') }}" method="post">
									@csrf
									<input class="input-control-ibx" style="border-radius: 0;margin-top: 0;" type="text" name="coupon" required placeholder="Have any coupon? Enter the coupon code">
									<button class="common-btn" style="border-radius: 0; margin-left: 8px;padding: 13px 60px;" type="submit">apply coupon</button>
								</form>
								@endif

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
					@if(Session::has('coupon'))
					<div>
						<span>Discount</span>


						@if(Session::get('coupon')['coupon_type'] == 1)

						<span>( $ {{ session('coupon')['coupon_rate'] }} )</span>
						@else
						<span>( {{ session('coupon')['coupon_rate'] }} % )</span>
						@endif
						<span> - ${{ Session::get('coupon')['discount'] }}</span>
					</div>
					@endif
                    @if ($productPrice > 0 && user_month_expires() == 0)
                        <div>
                            <span>Membership product</span>
                            <span> - ${{ $productPrice }}</span>
                        </div>
                    @endif

                    <div>

						<span>total</span>
						@if(Session::has('coupon'))
						<span class="totalValue">$

                            {{ Session::get('coupon')['balance']-$productPrice }}
                            @php
                                $totalValue = Session::get('coupon')['balance']-$productPrice;

                            @endphp

                        </span>
						@else

						<span class="totalValue">$
                            {{ Cart::subtotal() - $productPrice  }}
                            @php
                                $totalValue = Cart::subtotal() - $productPrice;

                            @endphp
                        </span>
						@endif
					</div>
					<form action="{{ route('checkout.page') }}" method="post">
						@csrf
						@if(Session::has('coupon'))
							<input type="hidden" name="price" value="{{ encrypt( Session::get('coupon')['balance'] -$productPrice )}}">
							<input type="hidden" name="qty" value="{{ encrypt(Cart::count()) }}">

							@foreach($data as $url=>$row)
							<input type="hidden" name="url[]" value="{{encrypt($row->options->url)  }}">
							<input type="hidden" name="product_name[]" value="{{ encrypt($row->name) }}">
							<input type="hidden" name="product_qty[]" value="{{ $row->qty }}">
							<input type="hidden" name="unit_price[]" value="{{ encrypt($row->price) }}">
							<input type="hidden" name="product_id[]" value="{{ encrypt($row->id) }}">
							@endforeach

							@else
							<input type="hidden" name="price" value="{{ encrypt(Cart::subtotal() -$productPrice) }}">
							<input type="hidden" name="qty" value="{{ encrypt(Cart::count()) }}">

							@foreach($data as $url=>$row)
							<input type="hidden" name="url[]" value="{{ encrypt($row->options->url) }}">
							<input type="hidden" name="product_name[]" value="{{ encrypt($row->name) }}">
							<input type="hidden" name="product_qty[]" value="{{ $row->qty }}">
							<input type="hidden" name="unit_price[]" value="{{ encrypt($row->price) }}">
							<input type="hidden" name="product_id[]" value="{{ encrypt($row->id) }}">
							@endforeach



						@endif

                        <input type="hidden" name="balance" value="{{ encrypt($totalValue) }}">
                        @if ($totalValue>0)
                        <input type="hidden" name="place_to_order" value="0">
                          <button class="common-btn w-100" style="border-radius: 10px;" type="submit">product to checkout</button>

                            @else
                            <input type="hidden" name="place_to_order" value="1">
                            <button class="common-btn w-100" style="border-radius: 10px;" type="submit">Place to order</button>

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
