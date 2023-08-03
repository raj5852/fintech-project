@extends('layouts.front')
@section('title')
Order View
@endsection
@section('front_content')
@push('css')

@endpush

@php
	$orders = App\Models\Admin\Order::where('user_id',Auth::id())->latest()->get();
	$wishlists = App\Models\User\WishList::join('products','wish_lists.product_id','products.id')->select('products.*','wish_lists.id','wish_lists.product_id')->where('user_id',Auth::id())->get();
	$payments = App\Models\User\Recharge::where('user_id',Auth::id())->latest()->get();
    $payment = App\Models\User\Recharge::where('user_id',Auth::id())->sum('amount');
	$subscribe = App\Models\Admin\Membership::join('subscriptions','memberships.id','subscriptions.subscribe_id')->join('coupons','membership_id','subscriptions.subscribe_id')->select('subscriptions.*','memberships.membership_name','coupons.coupon_name','coupons.coupon_type','coupons.coupon_rate')->where('subscriptions.user_id',Auth::id())->first();
	// dd($subscribe);
@endphp

@php
$userDetails= App\Models\User::where('email',Auth::user()->email)->first();

@endphp




<!-- breadcrumb  -->
<div class="bredcrumb">
	<h2 class="bredcrumb__title">my account</h2>
	<ul class="bredcrumb__items">
		<li>Home <i class="bi bi-chevron-right"></i></li>
		<li>my account</li>
	</ul>
</div>
	<div class="container">
		@if($subscribe)
			@if($subscribe->monthly_charge_date != Null)
				@if(date('Y-m-d') > date('Y-m-d', strtotime('-5 day', strtotime($subscribe->monthly_charge_date))) && date('Y-m-d') < $subscribe->monthly_charge_date)
				<div class="alert alert-warning border-0 bg-warning alert-dismissible fade show">
					<div class="text-dark"> Your <span style="font-weight: bolder;"> "{{ $subscribe->membership_name }}" </span> monthly payment date is expired soon <span style="font-weight: bolder;">( {{ date('d-m-Y',strtotime($subscribe->monthly_charge_date)) }} )</span>.Please pay <span style="font-weight: bolder;"> ${{ $subscribe->monthly_charge }} </span> monthly charge to continue service . <span><a class="badgr bg-info" style="padding:5px;" href="">For Pay</a></span> </div>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
				@endif
				@if(date('Y-m-d') > $subscribe->monthly_charge_date)
				<div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
					<div class="text-white"> Your <span style="font-weight: bolder;"> "{{ $subscribe->membership_name }}" </span>monthly payment date is expired <span style="font-weight: bolder;">( {{ date('d-m-Y',strtotime($subscribe->monthly_charge_date)) }} )</span>.  Please pay <span style="font-weight: bolder;"> ${{ $subscribe->monthly_charge }} </span> monthly charge to Reactive service . <span style="float:right;"><a class="badgr bg-info p-1 mr-1 " href="">For Pay</a></span> </div>
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
                        Normal User
                      @else
                        {{ $userDetails->member->membership_name }}

                  @endif
				</h4>
					<button   class="common_btn"><span  style="font-size :18px;" class="px-4">${{ Auth::user()->balance }}</span></button>
				</div>
			</div>
		</div>
		<div class="dashboard-mobile">
			<button class="dashboard-open">open menu <i class="bi bi-chevron-down"></i> </button>
		</div>
		<div class="dashboard__main">
			<div class="row gx-5">
				<div class="col-xl-4">
					<div class="dashboard__main-left nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"> <img src="{{ asset('frontend/') }}/img/ic1.png" alt="ic1"> my profile</button>
						<button class="nav-link justify-content-between" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"> <span><img src="{{ asset('frontend/') }}/img/ic2.png" alt="ic1"> <span>my Orders</span></span> <span class="dashboard__main-count">{{ $orders->count() }}</span></button>
						<button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"> <img src="{{ asset('frontend/') }}/img/ic3.png" alt="ic1">  My wallet</button>
						<button class="nav-link justify-content-between" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false"> <span><img src="{{ asset('frontend/') }}/img/ic4.png" alt="ic1"><span> My wishlist</span> </span><span class="dashboard__main-count">{{ $wishlists->count() }}</span></button>
                        @if ($userDetails->subscribe_id == 0)
						@else

						<button class="nav-link" id="v-pills-top-tab" data-bs-toggle="pill" data-bs-target="#v-pills-product" type="button" role="tab" aria-controls="v-pills-top" aria-selected="false"> <img class="" src="{{ asset('frontend/') }}/img/membership.png" alt="ic1"> Membership Product</button>
						@endif

						<button class="nav-link" id="v-pills-top-tab" data-bs-toggle="pill" data-bs-target="#v-pills-top" type="button" role="tab" aria-controls="v-pills-top" aria-selected="false"> <img src="{{ asset('frontend/') }}/img/ic6.png" alt="ic1"> Edit Profile</button>
						<button class="nav-link" id="v-pills-pass-tab" data-bs-toggle="pill" data-bs-target="#v-pills-pass" type="button" role="tab" aria-controls="v-pills-pass" aria-selected="false"> <img src="{{ asset('frontend/') }}/img/ic5.png" alt="ic1"> Change Password</button>

						<a class="nav-link logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <img src="{{ asset('frontend/') }}/img/power.png" alt="ic1"> Logout</span></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
					  </div>
				</div>
				<div class="col-xl-8">
					<div class="tab-content" id="v-pills-tabContent">

						<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
								<div class="dashboard__profile-content">
									<div class="dashboard__profile-header">
										<div class="dashboard__profile-thumb">
											{{-- <img src="{{ asset(Auth::user()->image) }}" alt=""> --}}
										</div>
										<div class="dashboard__profile-content">

											<a href="{{ url('user/home') }}" class="common_btn" >  Order view</a>
										</div>
									</div>
									<div class="dashboard__profile-body">

										<span class="dashboard__profile-bltitle">Order List</span>
										<table class="table table-striped table_style" style="white-space:nowrap">
											<thead>
												<tr>
													<th>Order Id</th>
													<th>Product Name</th>
													<th>Product Qty </th>
													<th>Product Price</th>
													<th>Unit Price</th>
													<th>Create At</th>
													<th>Order Review</th>
												</tr>
											</thead>
											<tbody>
												@foreach($order->orderItems as $item)
												<tr class="border-bottom">
													<td>{{ $item->id }}</td>
													<td>{{ $item->product_name }}</td>
													<td>{{ $item->product_qty }}</td>
													<td>{{ $item->product_price }}</td>
													<td>{{ $item->unit_price }}</td>




													<td>
														{{  Carbon\Carbon::parse($item->created_at)->format('d F Y')  }}
													</td>


													<td>
														<a href="{{ $item->product->product_url}}" class="common_btn" target="_blank">{{ $item->created_at <= $item->product->updated_at ? 'New Link' : "Link" }}</a>
													</td>

													<td>
														<a href="{{ url('user/review',$item->id) }}" class="common_btn" >Review</a>
													</td>
												</tr>
												@endforeach
											</tbody>
										</table>

									</div>
								</div>
						</div>

						<!-- <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
							<div class="dashboard__profile-content">
								<div class="dashboard__profile-header">
									<div class="dashboard__profile-thumb">
										{{-- <img src="{{ asset(Auth::user()->image) }}" alt=""> --}}
									</div>
									 
								</div>
								<div class="dashboard__profile-body">

									 


									<div class="dashboard__profile-body">
									<h1 class="mb-2">Deatils</h1>
									<div class="dashboard__profile-item">
										<span>Name:</span>
										<h4>{{ Auth::user()->name }}</h4>
									</div>
									<div class="dashboard__profile-item">
										<span>email:</span>
										<h4 style="text-transform: lowercase">{{ Auth::user()->email }}</h4>
									</div>
									@if($subscribe)
									<div class="bg-secondary p-2 text-white">
										<span> {{ $subscribe->coupon_rate }} @if($subscribe->coupon_type == "Percent") % @else $ @endif Discount Coupon For {{ $subscribe->membership->membership_name }} :
										<input class="form-label" value="{{ $subscribe->coupon_name }}" ></span>
									</div>
									@endif
								</div>

								</div>
							</div>
						</div> -->

						 <!-- <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
							<div class="dashboard__profile-content">
								<div class="dashboard__profile-order">
									<span class="dashboard__profile-bltitle">Order List</span>
									<table class="table table-striped  table_style">
										<thead>
											<tr>
												<th>Order No</th>
												<th>Order Date</th>
												<th>Total Price</th>
												<th>Refund</th>
												<th>Payment By</th>
												<th>View</th>
											</tr>
										</thead>
										<tbody>
											@foreach($orders as $key=>$order)
											<tr class="border-bottom">
												<td># {{ $order->order_no }}</td>
												<td>{{ $order->created_at->format('d-m-Y') }}</td>
												<td>{{ $order->total_price }}</td>
												<td>{{ $order->refund }}</td>
												<td>{{ $order->payment_method }}</td>
												<td>
													<a href="" ></a>
													<a href="{{ url('user/order/view',$order->id) }}" class="common_btn">View Order</a>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>  -->

						<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <div class="dashboard__profile-content">
                                <div class="dashboard__profile-order">
                                    <span class="dashboard__profile-bltitle">Order List</span>
                                    <div class="dashboard__title-info">
                                        <span>Order No</span>
                                        <span>Order Date</span>
                                        <span>Total Price</span>
                                        <span>Payment By</span>
                                        <span>Updated</span>
                                        <span class="text-center">Action</span>

                                    </div>
                                    @foreach($orders as $key=>$order)
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
                                            <h4>  {{ $order->created_at->format('d-m-Y') }}</h4>
                                        </div>
                                        <div class="dashboard__profile-itemm">
                                            <h4> <span>$</span>{{ $order->total_price }}</h4>
                                        </div>
                                        <div class="dashboard__profile-itemm">
                                            <h4>{{ $order->payment_method }}</h4>
                                        </div>
                                        <div class="dashboard__profile-itemm">
                                            <p>
                                                @php
                                               $productUpdatedCheck  =  $order->orderItems;
                                               foreach($productUpdatedCheck as $data){
                                                $true = $order->created_at <= $data->product->updated_at;

                                                if($true == 1){
                                                    echo "Updated";
                                                    break;
                                                }
                                               }

                                                @endphp
                                                </p>
                                        </div>
                                        <div class="dashboard__profile-itemm">



                                            <a  href="{{ url('user/order/view',$order->id) }}" class="common_btn">view</a>

                                        </div>
                                    </div>
                                    @endforeach


                                </div>
                            </div>
                        </div>

						<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
							<div class="dashboard__profile-content">
								<div class="dashboard__profile-order">
									<div class="dashboard__profile-header">
										<div class="dashboard__profile-thumb">
										  <span class="dashboard__profile-bltitle">Wallet History</span>
											<hr>
										</div>
										<div class="dashboard__profile-content">
											<a href="{{ route('recharge.page') }}" class="common_btn"> Recharge</a>
										</div>
									</div>
									<div>
									<table class="table table-striped table_style">
										<thead>
											<tr>
												<th>Date</th>
												<th>Amount</th>
												<th>Tran. Id</th>
												<th>Recharge By</th>
											</tr>
										</thead>
										<tbody>
											@foreach($payments as $key=>$payment)
											<tr class="border-bottom">
												<td>{{ $payment->created_at->format('d-m-Y') }}</td>
												<td>$ {{ $payment->amount }}</td>
												<td>{{ $payment->trans_id }}</td>
												<td><span class="payment_badge">{{ $payment->payment_method }}</span></td>
											</tr>
											@endforeach
										</tbody>
									</table>
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
							<div   class=" ">
								<span class="dashboard__profile-bltitle">My Wish List </span>
								<hr>
								<div style="overflow-x:auto" >
								<table style="min-width:650px" class="table table-striped table_style" style="min-width: 600px;">
									<thead>
										<tr>
											<th></th>
											<th>Product</th>
											<th>Unit Price</th>
											<th>Stock Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($wishlists as $key=>$wish)
										<tr class="border-bottom">
											<td>
												<a class="nav-link logout" href="{{ route('delete.wishlist',$wish->id) }}" onclick="event.preventDefault(); document.getElementById('wish-delete-form').submit();"><img class="ml-2" src="{{ asset('frontend/') }}/img/close.png" alt=""></a>
						                        <form id="wish-delete-form" action="{{ route('delete.wishlist',$wish->id) }}" method="POST" class="d-none">
						                            @csrf
						                            @method('DELETE')
						                        </form>
						                    </td>
											<td><img src="{{ asset($wish->thumbnail) }}" alt="Image" width="58" height="54">
											<br>
											{{ $wish->product_name }}</td>
											@if($wish->discount_rate == 0.00)
											<td>$ {{ $wish->product_price }}</td>
											@else
											<td>$ {{ $wish->discount_price }}</td>
											@endif
											<td>Unlimited</td>
											<td>
												<form action="{{ route('add.cart') }}" method="post" class="addCard">
													@csrf
													<input type="hidden" name="product_id" value="{{ $wish->product_id }}">
													<input type="hidden" name="product_qty" value="1">
													@if($wish->discount_rate == 0.00 )
													<input type="hidden" name="product_price" value="{{ $wish->product_price }}">
													@else
													<input type="hidden" name="product_price" value="{{ $wish->discount_price }}">
													@endif
													<button class="cart-btn-wishlist" type="submit">add to cart</button>
												</form>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							</div>
						</div>

						<div class="tab-pane fade" id="v-pills-top" role="tabpanel" aria-labelledby="v-pills-top-tab">
							<form class="edit_profile_form" action="{{ route('user.update.profile') }}" method="POST" enctype="multipart/form-data">
								@csrf
								<h1>Edit Profile</h1>
								<hr>
								<div class="form-group col-lg-6 mb-2">
									<span>Name:</span>
									<input type="name" value="{{ Auth::user()->name }}" class="form-control" name="name">
								</div>
								<div class="form-group col-lg-6 mb-2">
									<span>email:</span>
									<input type="email" value="{{ Auth::user()->email }}" readonly class="form-control" name="email">
								</div>
								<div class="form-group col-lg-6 mb-2">
									<span>Mobile:</span>
									<input type="text" value="{{ Auth::user()->mobile }}" class="form-control" name="mobile">
								</div>
								<div class="form-group col-lg-6 mb-2">
									<span>Phone:</span>
									<input type="text" value="{{ Auth::user()->phone }}" class="form-control" name="phone">
								</div>
								<div class="form-group col-lg-6 mb-2">
									<span>image:</span>
									<input type="file" class="form-control" name="image">
								</div>
								<div class="form-group col-lg-6 mb-2">
									<span>Address:</span>
									<textarea class="form-control" name="address">{{ Auth::user()->address }}</textarea>
								</div>
								<div class="form-group col-lg-6 mb-2">
									<button class="common_btn"  type="submit" >Update</button>
								</div>
							</form>
						</div>

						<div class="tab-pane fade" id="v-pills-pass" role="tabpanel" aria-labelledby="v-pills-pass-tab">
							<div class="col-lg-12">
								<form class="edit_profile_form" action="{{ route('user.password.update') }}" method="post">
									@csrf
									<h1>Password Change</h1>
									<hr>
									<div class="form-group col-lg-6">
										<label class="form-label">Old Password</label>
										<input type="text" class="form-control" name="old_password" placeholder="Enter old password">
									</div>
									<br>
									<div class="form-group col-lg-6">
										<label class="form-label">New Password</label>
										<input type="text" class="form-control" name="new_password" placeholder="Enter new password">
									</div>
									<br>
									<div class="form-group col-lg-6">
										<label class="form-label">Confirm Password</label>
										<input type="text" class="form-control" name="confirm_password" placeholder="Enter confirm password">
									</div>
									<br>
									<button class="common_btn"  type="submit">Update</button>
								</form>
							</div>
						</div>
@php

$products = App\Models\Admin\Product::where('is_free',1)->get();
@endphp
                        <div class="tab-pane fade" id="v-pills-product" role="tabpanel" aria-labelledby="v-pills-top-product">

                            <div class="items row" id="dashboard-member-product">



                                @foreach ($products as $product )


                               <div class="col-12 col-sm-6 col-lg-4">
                                   <div class="items__item">
                                       <a href="{{ URL::to('product/details/'.$product->product_slug) }}">
                                           <img src="{{ asset($product->thumbnail) }}" alt="Product" class="items__img" />
                                       </a>


                                       <h5 class="heading name">  {{ Str::limit($product->product_title, 25, '') }}</h5>
                                       <h5 class="heading title"><a href="{{ URL::to('product/details/'.$product->product_slug) }}">    {{ Str::limit($product->product_name, 25, '') }}</a></h5>
                                       <div class="price-list d-flex justify-content-center align-items-center gap-2 mb-1">
                                           @if($product->discount_rate == 0.00)
                                       <p class="price newprice">${{ $product->product_price }}</p>
                                       @else
                                       <p class="price newprice">${{ $product->discount_price }}</p>
                                       @endif

                                       @if($product->discount_rate == 0.00)
                                       @else
                                       <span class="discount">- @if($product->discount_type == "Flat") $@endif{{ intval($product->discount_rate) }} @if($product->discount_type == "Percent") % @endif</span>
                                       @endif

                                       @if($product->discount_rate == 0.00)
                                       @else
                                       <span class="price">${{ $product->product_price }}</span>
                                       @endif
                                       </div>

                                       <div class="items__bottom">
                                           <p class="text mb-2 text-center">
                                               {{ Str::limit($product->product_short_desc, 100, '') }}
                                           </p>
                                           <div class="d-flex justify-content-between align-items-center">
                                               <form action="{{ route('add.cart') }}" method="post" class="d-flex justify-content-center align-items-center mx-auto addCard">
                                                   @csrf
                                                   <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                   <input type="hidden" name="product_qty" value="1">
                                                   @if($product->discount_rate == 0.00 )
                                                   <input type="hidden" name="product_price" value="{{ $product->product_price }}">
                                                   @else
                                                   <input type="hidden" name="product_price" value="{{ $product->discount_price }}">
                                                   @endif
                                                   <button class="common_btn" type="submit">Add to cart</button>
                                               </form>
                                               <button class="btn btn-wishlist addWishlist" data-id="{{ $product->id }}">
                                                   <i class="bi bi-heart"></i>
                                               </button>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               @endforeach


                           </div>




						</div>
						<div class="tab-pane fade" id="v-pills-log" role="tabpanel" aria-labelledby="v-pills-log-tab">...</div>
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
