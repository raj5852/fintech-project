@extends('layouts.front')
@section('title')
Member  Product
@endsection
@section('front_content')
@push('css')
@endpush

<div class="shop-page">

	<!-- breadcrumb  -->
	<div class="bredcrumb">
		<h2 class="bredcrumb__title">@if($category_id) {{ $category_id->category_slug }} Product @else Shop Page @endif</h2>
		<ul class="bredcrumb__items">
			<li>Home <i class="bi bi-chevron-right"></i></li>
			<li>@if($category_id) {{ $category_id->category_name }} @else Shop Page @endif</li>
			@if($subcategory_id)
			<li> <i class="bi bi-chevron-right"></i></li> {{ $subcategory_id->subcategory_name }}</li>
			@endif
		</ul>
	</div>


	<div class="page__shop">
		<div class="container">
			<div class="shop">
				<div class="categories">
					<button class="btn-close-categories"><i class="bi bi-x"></i></button>

					<div class="categories__item mb-2">
						<h4 class="heading mb-2">SORT BY</h4>
						<ul class="categories__list">
						<form  name="sortArts" id="sortArts">
					<select style="font-size: 16px;" name="sort" id="sort"  class="form-control form-select select_sort_by style_changed">
							<option value="">Select Please</option>
							<option value="product_popular" @if(isset($_GET['sort']) && $_GET['sort']=="product_popular") selected="" @endif >Popularity</option>
							<option value="product_ratting" @if(isset($_GET['sort']) && $_GET['sort']=="product_ratting") selected="" @endif>Average ratting</option>
							<option value="product_news" @if(isset($_GET['sort']) && $_GET['sort']=="product_news") selected="" @endif>Newness</option>
							<option value="price_low_to_high" @if(isset($_GET['sort']) && $_GET['sort']=="price_low_to_high") selected="" @endif>Price low To High</option>
							<option value="price_high_to_low" @if(isset($_GET['sort']) && $_GET['sort']=="price_high_to_low") selected="" @endif>Price High To Low</option>
							</select>
						</form>
					</div>

					<div class="categories__item mb-2">
						<h4 class="heading mb-2">Product categories</h4>
						<ul class="categories__list">
							@foreach($category as $cat)
							<a href="{{ URL::to('get/'.$cat->category_slug.'/product') }}">
								<li class="categories__list--item">
									<div class="circle"></div>
									<span class="text">{{ $cat->category_name }}</span>
									<span class="item-number">{{ $cat->product->count() }}</span>
								</li>
							</a>
							@endforeach
					</div>

					<div class="categories__item mb-2  categories__item__filtering">
                        <h4 class="heading mb-2">Select By price</h4>
                        <form action="{{ route('price.range.product') }}" method="get">

                        <div class="wrapper">
                             <div class="container_range">
                                <div class="slider-track"></div>
                                <input
                                    type="range"
                                    min="1"
                                    max="1000"
                                    value="1"
                                    name="start_price"
                                    id="slider-1"

                                    oninput="slideOne()"
                                />
                                <input
                                    type="range"
                                    min="1"
                                    max="1000"
                                    value="{{ $end_price ? $end_price : ''  }}"
                                    id="slider-2"
                                    name="end_price"
                                    oninput="slideTwo()"
                                />
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <button class="common_btn">apply</button>
                                <div
                                    class="categories__price d-flex justify-content-between align-items-center gap-2"
                                >
                                <span>$<span id="range1" class="min-price">0 </span>
                                </span>
                                    <span class="minus">-</span>
                                    <span>$<span id="range2" class="min-price">100</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>


					<br>
					<br>

                    @php
                    $userDetails= App\Models\User::where('email',Auth::user()->email)->first();
                    @endphp

                       @if ($userDetails->subscribe_id == NULL)
                       @else
                    <div class="categories__item">
                        <h4 class="heading mb-2">Member Product</h4>
                        <div class="categories__btns">
                            @foreach($members as $member)
                            <a href="{{ url('member/product',$member->id) }}" class="common_btn">
                                <span > {{ $member->membership_name }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                @endif

				</div>

				<div class="shop__right">
					<div class="shop__top mb-2">
						<button class="btn-category">
							<svg class="icon"><use xlink:href="{{ asset('frontend/') }}/img/icons.svg#icon-bars"></use></svg>
						</button>

					</div>
					<div class="items row g-5 mb-4">
						@if($products->count() > 0)
						@foreach($products as $product)

							<div class="col-12 col-sm-6 col-xl-4 col-xxl-3">
								<a href="{{ URL::to('product/details/'.$product->product_slug) }}">
								<div class="items__item">
									<img src="{{ asset($product->thumbnail) }}" alt="" class="items__img" />
									<h5 class="heading name">{{ $product->product_name }}</h5>
									<h5 class="heading title">{{ $product->product_title }}</h5>
									<div class="price-list d-flex justify-content-center align-items-center gap-2 mb-1">
                                        @if($product->discount_rate == 0.00)
                                        <span class="price newprice">${{ $product->product_price }}</span>
                                        @else

                                        <p class="price">${{ $product->product_price }}</p>
                                        <span class="price newprice"">${{ $product->discount_price }}</span>
                                        @endif
									</div>

									<div class="items__bottom">
										<p class="text mb-2 text-center">
											{{ Str::limit($product->product_short_desc, 100, '') }}
										</p>
									</a>
										<div class="d-flex justify-content-between align-items-center">
											<button class="btn btn-search">
												<i class="bi bi-search"></i>
											</button>
											<form action="{{ route('add.cart') }}" method="post" class="mx-auto addCard">
												@csrf
												<input type="hidden" name="product_id" value="{{ encrypt($product->id) }}">
												<input type="hidden" name="product_qty" value="1">
												@if($product->discount_rate == 0.00 )
												<input type="hidden" name="product_price" value="{{ encrypt($product->product_price) }}">
												@else
												<input type="hidden" name="product_price" value="{{ encrypt($product->discount_price) }}">
												@endif
												<button class="btn btn-cart" type="submit">Add to cart</button>
											</form>
											<button class="btn btn-wishlist">
												<i class="bi bi-heart"></i>
											</button>
										</div>
									</div>
								</div>

							</div>
						@endforeach
						@else
						<div class="text-center">
							<p class="text-secondary"> Product Not Fond In  !  </p>
						</div>
						@endif
					</div>
				</div>
			</div>

			<!-- pagination -->

			<div class="pagination">



			</div>
		</div>
	</div>
</div>

<!-- footer -->


@push('js')
<script>
	$(document).ready(function wishlist()  {
	    $.ajax({
	      type: "GET",
	      url: "/get/"+{{ $cat->category_slug }}+"/cart/show",
	      dataType: 'json',
	      success: function (data) {
	          $('.wishlist-count').text(data)
	      },
	   	});
	});
</script>

<script>
	$(document).ready(function()  {


		$("#sort").on("change",function(){
			this.form.submit();
		});
	});
	</script>


@endpush
@endsection
