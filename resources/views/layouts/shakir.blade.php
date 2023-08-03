
@php
	$setting=DB::table('settings')->first();
//  dd($setting);
$payments = App\Models\User\Recharge::where('user_id',Auth::id())->sum('amount');
@endphp
<!DOCTYPE html>
<html lang="en" class="dark">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>fintech website | home</title>

		<!-- font link -->
		<link
			href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<!-- bootstrap link -->
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx"
			crossorigin="anonymous"
		/>
		<link
			rel="stylesheet"
			href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"
		/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
		<link rel="stylesheet" href="{{ asset('frontend/css/backToTop.css') }}" />
		<link rel="stylesheet" href="{{ asset('frontend/css/meanmenu.css')}}" />
		<link rel="stylesheet" href="{{ asset('frontend/css/style.css')}}" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
		<link rel="stylesheet" href="{{ asset('frontend/css/responsive.css')}}" />
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">

	</head>
	<body>
		<main style="overflow: hidden" class="main">
			<nav class="nav">
				<div class="main-nav">
					<div class="container">
						<div class="nav__wrapper d-flex justify-content-between align-items-center gap-4">
							<div class="nav__logo d-flex align-items-center gap-3">
								<a href="{{ url('/') }}">
									<img src="{{asset('backend/setting/'.$setting->image) }}" alt="logo" /></a>
							</div>
							<div class="nav__right d-flex align-items-center">
								<div class="d-flex align-items-center gap-5">
									<span href="#" class="nav__icon wishlist">
										<i class="bi bi-heart"></i>

										<span class="wishlist__number wishlist-count">{{ Helper::countWishlist() }}</span>
										<div class="hovercart hovercart-wishlist">
											@if(Auth::check())
											
											<div class="wish_list_popup">
												{{ Helper::wishlistPopup() }}
											</div>
										    @endif
											
										</div>
									</span>

									<span href="{{ url('cart/index') }}" class="nav__icon cart">
										<i class="bi bi-basket2"></i>
										<span class="cart__number cart-count">{{ \Cart::count(); }}</span>
										<div class="hovercart">
										<div class="cart_list_popup">
									
										</div>
										</div>
							
									</span>
										
									<button class="btn btn-dark">
										<svg class="icon icon-dark">
											<use xlink:href="{{ asset('frontend/img/icons.svg#icon-dark')}}"></use>
										</svg>
									</button>
									<button class="btn btn-light">
										<svg class="icon icon-dark">
											<use xlink:href="{{ asset('frontend/img/icons.svg#icon-light')}}"></use>
										</svg>
									</button>
									@if(Auth::check())
									<a class="link logout" href="{{ route('user.home') }}" style="color:white">   {{ Auth::user()->name }}</a>
						            <button class="dashboard__header-balance">${{ $payments }}</button>
									@else
									<a href="#" class="link login">login</a>
									<a href="#" class="link login-two register">register</a>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
 @php
	$category = App\Models\Admin\Category::take(5)->with('sub_category')->get();
	$category_more = App\Models\Admin\Category::skip(5)->take(10)->get();
@endphp
				<div class="nav__links header-sticky">
					<div class="container">
						<ul class="nav__list d-flex justify-content-center align-items-center gap-5" id="mobile-menu">
							


							@foreach($category as $cat)
								<li class="nav__item">
									<a href="{{ URL::to('get/'.$cat->category_slug.'/product/') }}" class="nav__link"> {{ $cat->category_name }} @if($cat->sub_category->count() > 0)<i class="bi bi-chevron-down"></i>@endif</a>
									@if($cat->sub_category->count() > 0)
									<ul class="nav__dropdown">
										@foreach($cat->sub_category as $sub_cat)
										<li><a href="{{ URL::to('get/'.$cat->category_slug.'/'.$sub_cat->subcategory_slug . '/product/') }}">{{ $sub_cat->subcategory_name }}</a></li>
										@endforeach
									</ul>
									@endif
								</li>
								@endforeach

								@if($category_more->count() > 0)
								<li class="nav__item">
									<a href="#" class="nav__link"> More <i class="bi bi-chevron-down"></i></a>
									<ul class="nav__dropdown">
										@foreach($category_more as $cat_more)
										<li><a href="{{ URL::to('get/'.$cat_more->category_slug.'/product/') }}">{{ $cat_more->category_name }}</a></li>
										@endforeach
									</ul>
								</li>
								@endif


							<li class="nav__item">
								<a href="{{ url('/membership') }}" class="nav__link">Membership</a>
							</li>
							<li class="nav__item">
								<a href="{{ url('free-product') }}" class="nav__link">Free product</a>
							</li>
							<li class="nav__item">
								<a href="{{ url('shop') }}" class="nav__link">Shop</a>
							</li>
							<li class="nav__item">
								<a href="{{ url('customer-request') }}" class="nav__link">Custom Request</a>
							</li>
							{{-- <li class="nav__item mobile-dropdown">
								<a href="#" class="nav__link"> Pages <i class="bi bi-chevron-down"></i></a>
								<ul class="nav__dropdown">
									<li><a href="shop.html">All Products</a></li>
									<li><a href="single.html">product details</a></li>
									<li><a href="cart.html">shopping cart</a></li>
									<li><a href="checkout.html">billing & checkout</a></li>
									<li><a href="checkout.html">billing & checkout</a></li>
									<li><a href="contact.html">contact us</a></li>
									<li><a href="#">how it works</a></li>
									<li><a href="login.html">login</a></li>
									<li><a href="login.html">register</a></li>
									<li><a href="plan.html">subscription plan</a></li>
									<li><a href="404.html">404 Error</a></li>
									<li><a href="dashboard.html">my Orders</a></li>
									<li><a href="{{ url('user/home') }}">my account</a></li>
								</ul>
							</li> --}}
						</ul>
					</div>
				</div>
			</nav>

			<div class="responsive_mobile_menu">
				<div class="container">
					<div class="mobile_wrapper">
						<div class="mobile_left">
							<div class="logo">
								<img src="{{asset('backend/setting/'.$setting->image) }}" alt="logo">
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
							<img src="{{asset('backend/setting/'.$setting->image) }}" alt="">
						</div>
						<div class="icon">
							<i class="bi bi-x close_info"></i>
						</div>
					</div>
					<div class="mobile_body">
						<div class="mobile-menu"></div>
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
								<img src="{{asset('backend/setting/'.$setting->image) }}" alt="" class="logo logo-black mb-3" />
								<img src="{{asset('backend/setting/'.$setting->image) }}" alt="" class="logo logo-white mb-3" />
								<p class="text text-white mb-3">
									{{$setting->about}}
								</p>
								<ul class="social d-flex align-items-center gap-2">
									<li class="social__item">
										<a href="{{$setting->facebook}}" target="_blank" class="social__link">
											<i class="bi bi-facebook"></i>
										</a>
									</li>
									<li class="social__item">
										<a href="{{$setting->instagram}}" target="_blank" class="social__link">
											<i class="bi bi-instagram"></i>
										</a>
									</li>
									<li class="social__item">
										<a href="{{$setting->youtube}}" target="_blank" class="social__link">
											<i class="bi bi-youtube"></i>
										</a>
									</li>
									<li class="social__item">
										<a href="{{$setting->twitter}}" target="_blank" class="social__link">
											<i class="bi bi-twitter"></i>
										</a>
									</li>
								</ul>
							</div>
						</div>
@php
$category_more = App\Models\Admin\Category::take(5)->get();
@endphp						
						<div class="col-12 col-sm-6 col-lg-3">
							<div class="footer__item service">
								<h3 class="heading mb-2">Service</h3>
								<ul class="list">
									@foreach ( $category_more as $cat_more )
									<li class="item">
										<a href="{{ URL::to('get/'.$cat_more->category_slug.'/product/') }}" class="link text-uppercase">{{ $cat_more->category_name }}</a>
									</li>
									@endforeach
									

								
									

									<li class="item">
										<a href="{{ url('/membership') }}" class="link text-uppercase">Membership</a>
									</li>
									<li class="item">
										<a href=" {{ url('/free-product') }}" class="link text-uppercase">Free product</a>
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
								
								</ul>
							</div>
						</div>
						
					</div>
				</div>
			</footer>
			<div class="copyright">
				<p>Your Site  © 2023 All Rights Reserved</p>
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
									<input type="email" placeholder="Enter Your Email" name="email">
									<i class="bi bi-person login__area-icon"></i>
								</div>
								<div class="login__area-field">
									<input type="password"  name="password" placeholder="password">
									<i class="bi bi-lock login__area-icon"></i>
								</div>

								<div class="col-md-6">
									<div class="form-check form-switch">
										<input class="form-check-input" type="checkbox" name="remember" id="flexSwitchCheckChecked" {{ old('remember') ? 'checked' : '' }}>
										<label class="form-check-label" for="flexSwitchCheckChecked">Remember me</label>
									</div>
								</div>

								<div class="login__area-submit">
									<button class="login__area-submitbtn"  type="submit">submit</button>
									<a class="login__area-lostpass" href="{{ route('password.request') }}">lost password?</a>
								</div>
								<div class="login__area-login">
									<a class="login__area-sign" href="{{ route('auth.google') }}"><img src="{{ asset('frontend/img/google1.png')}}" alt="">continue with google</a>
								</div>
							</form>
						</div>
						<div class="popup__login-footer">
							<span>Don’t have an acount?</span>
							<a href="#">Sign Up</a>
							<img src="{{ asset('frontend/img/fly.png')}}" alt="fly">
						</div>
					</div>
				</div>
			</div>
			<div class="popup__register">
				<div class="container">
					<div class="popup__login-loginone">
						<img class="popup__icon" src="img/404-icon.png" alt="">
						<div class="login__area-right">
							<div class="login__area-inner">
								<h4 class="login__area-title text-center ">register</h4>

								<form action="{{ route('register') }}" method="post">
									@csrf
									<div class="login__area-field">
										<input type="text" placeholder="name" name="name" class="@error('name') is-invalid @enderror" required>
										<i class="bi bi-person login__area-icon"></i>
									</div>
									<div class="login__area-field">
										<input type="email"  name="email" placeholder="email" class="@error('email') is-invalid @enderror">
										<i class="bi bi-envelope login__area-icon"></i>
									</div>
									<div class="login__area-field">
										<input type="password" placeholder="password" name="password" class="@error('password') is-invalid @enderror">
										<i class="bi bi-lock login__area-icon"></i>
									</div>
									<div class="login__area-field">
										<input type="password" placeholder="Confirm password" name="password_confirmation" autocomplete="new-password">
										<i class="bi bi-lock login__area-icon"></i>
									</div>
									<div class="login__area-submit">
										<button class="login__area-submitbtn" type="submit">register</button>
									</div>

									<div class="login__area-login">
										<a class="login__area-sign" href="{{ route('auth.google') }}"><img src="{{ asset('frontend/img/google1.png')}}" alt="">continue with google</a>
									</div>

								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="progress-wrap active-progress">
				<svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
					<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 267.568;">
					</path>
				</svg>
			</div>


		</main>
		<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
		
		<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
		<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
			crossorigin="anonymous"
		></script>
		<script
			src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"
			integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g=="
			crossorigin="anonymous"
			referrerpolicy="no-referrer"
		></script>
		<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
		<script src="{{ asset('frontend/js/backToTop.js')}}"></script>
		<script src="{{ asset('frontend/js/jquery.meanmenu.min.js')}}"></script>
		<script src="{{ asset('frontend/js/main.js')}}"></script>

		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   
		<script>
		 @if(Session::has('messege'))
		   var type="{{Session::get('alert-type','info')}}"
		   switch(type){
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
	  

		<script>
			
			let dbtn = document.querySelector('.dashboard-open');
			let dashboard = document.querySelector('.dashboard__main');
			
			if(dbtn){
				dbtn.addEventListener('click',()=>{
					dashboard.classList.toggle('show-hide')
				})
			}
		</script>
		<script>
		     $(document).ready(function() {
		        $('.addWishlist').on('click', function(){
		              var id = $(this).data('id');
		              if(id) {
		                 $.ajax({
		                     url: "{{ url('user/add/wish-list/') }}/"+id,
		                     type:"GET",
		                     dataType:"json",
		                     success:function(data) { 
		                        if (data.success) {
		                            toastr.success(data.success)
		                            $.ajax({
		                                type: "GET",
		                                url: "user/count/wishlist",
		                                dataType: 'json',
		                                success: function (data) {
		                                      $('.wishlist-count').text(data);
		                                },
		                             });

		                             $.ajax({
		                               type: "GET",
		                               url: "user/show/wishlist",
		                               success: function (data) {
		                                  $('.wish_list_popup').html(data)	
		                               },
		                            });
		                        }else{
		                            toastr.error(data.error)
		                        }
		                        
		                     },
		                     error:function(data){
		                     	toastr.error('<h3>Please Login Your Account</h3>');
		                     }    
		                 });
		             } else {
		                 
		             }
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
						success:function(data){
							toastr.options = {
							  "closeButton": true,
							  "progressBar": true,
							}
							toastr.success(data);

							 $.ajax({
							   type: "GET",
							   url: "cart/show",
							   success: function (data) {
							      $('.cart_list_popup').html(data)	
							   },
							});
							
							 $.ajax({
							   type: "GET",
							   url: "cart/count",
							   success: function (data) {
							      $('.cart-count').text(data)	
							   },
							});
						},
					});
				});
		</script>
		<script>
			$(document).ready(function wishlist($)  {
			    $.ajax({
			      type: "GET",
			      url: "user/count/wishlist",
			      dataType: 'json',
			      success: function (data) {
			          $('.wishlist-count').text(data)
			      },
			   	});
			});
		</script>
		<script>
			$(document).ready(function show(){
				 $.ajax({
				   type: "GET",
				   url: "user/show/wishlist",
				   success: function (data) {
				      $('.wish_list_popup').html(data)	
				   },
				});
			})
		</script>

		<script>
			$(document).ready(function(){
				 $.ajax({
				   type: "GET",
				   url: "cart/show",
				   success: function (data) {
				      $('.cart_list_popup').html(data)	
				   },
				});
			})
		</script>

		
		@stack('js')
	</body>
</html>
