@extends('layouts.front')

@section('front_content')
@push('css')

@endpush

<!-- breadcrumb  -->
<div class="bredcrumb">
	<h2 class="bredcrumb__title">my account</h2>
	<ul class="bredcrumb__items">
		<li>Home <i class="bi bi-chevron-right"></i></li>
		<li>Edit Profile</li>
	</ul>
</div>

<!-- dashboard  -->
<div class="dashboard">
	<div class="container">
		<div class="dashboard__main">
			<div class="row gx-5">
				<div class="col-xl-4">
					<div class="dashboard__main-left nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"> <img src="{{ asset('frontend/') }}/img/ic1.png" alt="ic1"> my profile</button>
						<button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"> <img src="{{ asset('frontend/') }}/img/ic2.png" alt="ic1"> my Orders <span class="dashboard__main-count">5</span></button>
						<button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"> <img src="{{ asset('frontend/') }}/img/ic3.png" alt="ic1">  My wallet</button>
						<button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false"> <img src="{{ asset('frontend/') }}/img/ic4.png" alt="ic1"> My wishlist <span class="dashboard__main-count">5</span></button>
						<button class="nav-link" id="v-pills-top-tab" data-bs-toggle="pill" data-bs-target="#v-pills-top" type="button" role="tab" aria-controls="v-pills-top" aria-selected="false"> <img src="{{ asset('frontend/') }}/img/ic6.png" alt="ic1"> top ordered  product</button>
						<button class="nav-link" id="v-pills-pass-tab" data-bs-toggle="pill" data-bs-target="#v-pills-pass" type="button" role="tab" aria-controls="v-pills-pass" aria-selected="false"> <img src="{{ asset('frontend/') }}/img/ic5.png" alt="ic1"> Change Password</button>
						<button class="nav-link" id="v-pills-log-tab" data-bs-toggle="pill" data-bs-target="#v-pills-log" type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" role="tab" aria-controls="v-pills-log" aria-selected="false"> <img src="{{ asset('frontend/') }}/img/ic7.png" width="50" alt="ic7"> log out</button>
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
										<img src="{{ asset(Auth::user()->image) }}" alt="">
									</div>
								</div>
								<div class="dashboard__profile-body">
									<form action="{{ route('user.update.profile') }}" method="POST" enctype="multipart/form-data">
										@csrf
										<span>Edit Profile</span>
										<hr>
										<div class="dashboard__profile-item">
											<span>Name:</span>
											<input type="name" value="{{ Auth::user()->name }}" class="form-control" name="name">
										</div>
										<div class="dashboard__profile-item">
											<span>email:</span>
											<input type="email" value="{{ Auth::user()->email }}" readonly class="form-control" name="email">
										</div>
										<div class="dashboard__profile-item">
											<span>Mobile:</span>
											<input type="text" value="{{ Auth::user()->mobile }}" class="form-control" name="mobile">
										</div>
										<div class="dashboard__profile-item">
											<span>Phone:</span>
											<input type="text" value="{{ Auth::user()->phone }}" class="form-control" name="phone">
										</div>
										<div class="dashboard__profile-item">
											<span>image:</span>
											<input type="file" class="form-control" name="image">
										</div>
										<div class="dashboard__profile-item">
											<span>Address:</span>
											<textarea class="form-control" name="address">{{ Auth::user()->address }}</textarea>
										</div>
										<div class="dashboard__profile-item">
											<button class="dashboard__header-btn" type="submit" >Update</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
							<div class="dashboard__profile-content">
								<div class="dashboard__profile-order">
									<span class="dashboard__profile-bltitle">Order List</span>
									<div class="dashboard__title-info">
										<span>Product</span>
										<span>Date</span>
										<span>Price</span>
										<span>Total Price</span>
									</div>
									<div class="dashboard__profile-wrapper">
										<div class="dashboard__profile-itemm product-order">
											<div>
												<img class="order-close-icon" src="img/close.png" alt="">
												<img src="{{ asset('frontend/') }}/img/sm-p.png" alt="">
											</div>
											<div>
												<span>Microsoft Office</span>
												<h4>Operating Systems & Mac <br>
													Software
													</h4>
											</div>
										</div>
										<div class="dashboard__profile-itemm">
											<h4> <span>$</span> 45.00</h4>
										</div>
										<div class="dashboard__profile-itemm">
											<h4> <span>$</span> 45.00</h4>
										</div>
										<div class="dashboard__profile-itemm">
											<h4>Total<span>$</span> 45.00</h4>
										</div>
									</div>
									<div class="dashboard__profile-wrapper">
										<div class="dashboard__profile-itemm product-order">
											<div>
												<img class="order-close-icon" src="img/close.png" alt="">
												<img src="{{ asset('frontend/') }}/img/sm-p.png" alt="">
											</div>
											<div>
												<span>Microsoft Office</span>
												<h4>Operating Systems & Mac <br>
													Software
													</h4>
											</div>
										</div>
										<div class="dashboard__profile-itemm">
											<h4> <span>$</span> 45.00</h4>
										</div>
										<div class="dashboard__profile-itemm">
											<h4> <span>$</span> 45.00</h4>
										</div>
										<div class="dashboard__profile-itemm">
											<h4>Total<span>$</span> 45.00</h4>
										</div>
									</div>
									<div class="dashboard__profile-wrapper">
										<div class="dashboard__profile-itemm product-order">
											<div>
												<img class="order-close-icon" src="{{ asset('frontend/') }}/img/close.png" alt="">
												<img src="img/sm-p.png" alt="">
											</div>
											<div>
												<span>Microsoft Office</span>
												<h4>Operating Systems & Mac <br>
													Software
													</h4>
											</div>
										</div>
										<div class="dashboard__profile-itemm">
											<h4> <span>$</span> 45.00</h4>
										</div>
										<div class="dashboard__profile-itemm">
											<h4> <span>$</span> 45.00</h4>
										</div>
										<div class="dashboard__profile-itemm">
											<h4>Total<span>$</span> 45.00</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
							<div class="dashboard__profile-content">
								<div class="dashboard__profile-order">
									<span class="dashboard__profile-bltitle">Wallet History</span>
									<div class="dashboard__title-info2">
										<span>Product</span>
										<span>Date</span>
										<span>Product Name</span>
										<span>Total Price</span>
									</div>
									<div class="dashboard__profile-wrapper2">
										<div class="dashboard__profile-itemm">
											<h4> <span>$</span> 45.00</h4>
										</div>
										<div class="dashboard__profile-itemm">
											<h4> Nov 27</h4>
										</div>
										<div class="dashboard__profile-itemm">
											<h4> Operating Systems & Mac <br>
												Software
												</h4>
										</div>
										<div class="dashboard__profile-itemm">
											<h4>Total<span>$</span> 45.00</h4>
										</div>
									</div>
									<div class="dashboard__profile-wrapper2">
										<div class="dashboard__profile-itemm">
											<h4> <span>$</span> 45.00</h4>
										</div>
										<div class="dashboard__profile-itemm">
											<h4> Nov 27</h4>
										</div>
										<div class="dashboard__profile-itemm">
											<h4> Operating Systems & Mac <br>
												Software
												</h4>
										</div>
										<div class="dashboard__profile-itemm">
											<h4>Total<span>$</span> 45.00</h4>
										</div>
									</div>
									<div class="dashboard__profile-wrapper2">
										<div class="dashboard__profile-itemm">
											<h4> <span>$</span> 45.00</h4>
										</div>
										<div class="dashboard__profile-itemm">
											<h4> Nov 27</h4>
										</div>
										<div class="dashboard__profile-itemm">
											<h4> Operating Systems & Mac <br>
												Software
												</h4>
										</div>
										<div class="dashboard__profile-itemm">
											<h4>Total<span>$</span> 45.00</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
							<div class="dashboard__profile-order">
								<span class="dashboard__profile-bltitle">My Wish List </span>
								<div class="dashboard__title-info3">
									<span>Product</span>
									<span>Unit Price</span>
									<span>Stock Status</span>
								</div>
								<div class="dashboard__profile-wrapper3">
									<div class="dashboard__profile-itemm product-order">
										<div>
											<img class="order-close-icon" src="img/close.png" alt="">
											<img src="{{ asset('frontend/') }}/img/sm-p.png" alt="">
										</div>
										<div>
											<span>Microsoft Office</span>
											<h4>Operating Systems & Mac <br>
												Software
												</h4>
										</div>
									</div>
									<div class="dashboard__profile-itemm">
										<h4> <span>$</span> 45.00</h4>
									</div>
									<div class="dashboard__profile-itemm wishlist-total">
										<h4> <span>$</span> 45.00</h4>
										<a class="cart-btn-wishlist" href="#">add to cart</a>
									</div>
								</div>
								<div class="dashboard__profile-wrapper3">
									<div class="dashboard__profile-itemm product-order">
										<div>
											<img class="order-close-icon" src="img/close.png" alt="">
											<img src="{{ asset('frontend/') }}/img/sm-p.png" alt="">
										</div>
										<div>
											<span>Microsoft Office</span>
											<h4>Operating Systems & Mac <br>
												Software
												</h4>
										</div>
									</div>
									<div class="dashboard__profile-itemm">
										<h4> <span>$</span> 45.00</h4>
									</div>
									<div class="dashboard__profile-itemm wishlist-total">
										<h4> <span>$</span> 45.00</h4>
										<a class="cart-btn-wishlist" href="#">add to cart</a>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="v-pills-top" role="tabpanel" aria-labelledby="v-pills-top-tab">

						</div>
						<div class="tab-pane fade" id="v-pills-pass" role="tabpanel" aria-labelledby="v-pills-pass-tab">...</div>
						<div class="tab-pane fade" id="v-pills-log" role="tabpanel" aria-labelledby="v-pills-log-tab">...</div>
					  </div>
				</div>
			</div>
		</div>
	</div>
</div>


@push('js')
@endpush
@endsection
