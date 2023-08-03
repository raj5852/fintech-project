<!DOCTYPE html>
<html lang="en" class="light">
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
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

		<link rel="stylesheet" href="{{ asset('frontend/') }}/css/style.css" />
		
		<link rel="stylesheet" href="{{ asset('frontend/') }}/css/responsive.css">
		<link rel="stylesheet" href="{{ asset('/frontend/toastr/toastr.css') }}">
		@stack('cs')
	</head>
	<body>
		<main class="main">
			@include('front.partial.top_navbar')
			@include('front.partial.category_section')
			@include('alert.alert')
			@guest
			@else
			{{-- <div class="container">
				@include('alert.alert')
			</div> --}}
			@endguest
			@yield('front_content')
			<div class="copyright">
				<p>Your Site  © 2022 All Rights Reserved</p>
			</div>

			<div class="offcanvas-overlay"></div>
			<!-- Modal -->
			<div class="popup__login">
				<div class="container">
					<div class="popup__login-loginone">
						<img class="popup__icon" src="{{ asset('frontend/') }}/img/404-icon.png" alt="">
						<div class="login__area-inner border-0">
							<h4 class="login__area-title text-center">login</h4>
							<form action="{{ route('login') }}" method="post">
								@csrf
								<div class="login__area-field">
									<input type="email" placeholder="Email" name="email">
									<i class="bi bi-person login__area-icon"></i>
								</div>
								<div class="login__area-field">
									<input type="password" name="password" placeholder="password">
									<i class="bi bi-lock login__area-icon"></i>
								</div>
								<div class="login__area-submit">
									<button class="login__area-submitbtn"  type="submit">submit</button>
									<a class="login__area-lostpass" href="{{ route('password.request') }}">lost password?</a>
								</div>
								<div class="login__area-login">
									<a class="login__area-sign" href="#"><img src="{{ asset('frontend/') }}/img/google1.png" alt="">continue with google</a>
								</div>
							</form>
						</div>
						<div class="popup__login-footer">
							<span>Don’t have an acount?</span>
							<a href="#">Sign Up</a>
							<img src="{{ asset('frontend/') }}/img/fly.png" alt="fly">
						</div>
					</div>
				</div>
			</div>
			<div class="popup__register">
				<div class="container">
					<div class="popup__login-loginone">
						<img class="popup__icon" src="{{ asset('frontend/') }}/img/404-icon.png" alt="">
						<div class="login__area-right">
							<div class="login__area-inner">
								<h4 class="login__area-title text-center ">register</h4>
								<form action="#">
									<div class="login__area-field">
										<input type="text" placeholder="name">
										<i class="bi bi-person login__area-icon"></i>
									</div>
									<div class="login__area-field">
										<input type="email" placeholder="email">
										<i class="bi bi-envelope login__area-icon"></i>
									</div>
									<div class="login__area-field">
										<input type="text" placeholder="password">
										<i class="bi bi-lock login__area-icon"></i>
									</div>
									<div class="login__area-field">
										<input type="text" placeholder="Confirm password">
										<i class="bi bi-lock login__area-icon"></i>
									</div>
									<div class="login__area-submit">
										<button class="login__area-submitbtn" type="submit">register</button>
									</div>
								</form>
							</div>
						</div>
						<div class="popup__login-footer">
							<span>Don’t have an acount?</span>
							<a href="#">Sign Up</a>
							<img src="img/fly.png" alt="fly">
						</div>
					</div>
				</div>
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
		<script src="{{ asset('frontend/') }}/js/main.js"></script>
		<script src="{{ asset('/frontend/toastr/toastr.min.js') }}"></script>
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

		<script>
		    @if(Session::has('messege'))

		      toastr.options = {
		        "closeButton": true,
		        "progressBar": true,
		        "showDuration": "300",
		        "hideDuration": "1000",
		        "timeOut": "8000",
		        "extendedTimeOut": "1000",
		      }

		      var type="{{Session::get('alert-type','info')}}"
		      switch(type){
		          case 'info':
		               toastr.info("<h4>{{ Session::get('messege') }}</h4>");
		               break;
		          case 'success':
		              toastr.success("<h4>{{ Session::get('messege') }}</h4>");
		              break;
		          case 'warning':
		             toastr.warning("<h4>{{ Session::get('messege') }}</h4>");
		              break;
		          case 'error':
		              toastr.error("<h4>{{ Session::get('messege') }}</h4>");
		              break;
		            }
		    @endif
		  </script>
		@stack('js')
	</body>
</html>
