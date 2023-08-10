@extends('layouts.front')
@section('title')
    Product Details |
@endsection
@section('front_content')
    @push('css')
        <style>
            .swiper {
                width: 100%;
                height: 100%;
            }

            .swiper-slide {
                text-align: center;
                font-size: 18px;
                background: #fff;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .swiper-slide img {
                display: block;
                width: 100%;
                height: 100%;
                object-fit: cover;
            }



            .swiper {
                width: 100%;
                height: 300px;
                margin-left: auto;
                margin-right: auto;
            }

            .swiper-slide {
                background-size: cover;
                background-position: center;
            }

            .mySwiper2 {
                height: 80%;
                width: 100%;
            }

            .mySwiper {
                height: 20%;
                box-sizing: border-box;
                padding: 10px 0;
            }

            .mySwiper .swiper-slide {
                width: 25%;
                height: 100%;
                opacity: 0.4;
            }

            .mySwiper .swiper-slide-thumb-active {
                opacity: 1;
            }

            .swiper-slide img {
                display: block;
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            #social-links ul {
                list-style: none;
                display: flex;
            }
        </style>
    @endpush

    <!-- breadcrumb  -->
    <div class="bredcrumb">
        <h2 class="bredcrumb__title">Product Details</h2>
        <ul class="bredcrumb__items">
            <li><a href="{{ route('home') }}">Home</a> <i class="bi bi-chevron-right"></i></li>
            <li>Product Details</li>
        </ul>
    </div>

    @php
        $images = json_decode($product->images, true);
        $specifiactions = json_decode($product->specification, true);
        $tags = explode(',', $product->tag);
    @endphp

    <!-- single product  -->
    <div class="single__product">
        <div class="container">
            <div class="row g-5">
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="single__product-left">

                        <div class="slider-main-pro">
                            <p class="cashback-p">Cashback</p>
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
                                <li class="breadcrumb-item"><a href="#">{{ $product->category->category_name }}</a>
                                </li>
                                @if ($product->subcategory_id)
                                    <li class="breadcrumb-item"><a
                                            href="#">{{ $product->subcategory->subcategory_name }}</a></li>
                                @endif
                                <li class="breadcrumb-item active" aria-current="page">{{ $product->product_name }}</li>
                            </ol>
                        </nav>
                        <h2 class="single__product-title border-bottom-0">{{ $product->product_title }}</h2>
                        <div class="s-price pt-30 mb-30">
                            @if ($product->discount_rate == 0.0)
                                <span class="single__product-pricebtn">${{ $product->product_price }}</span>
                            @else
                                <span class="single__product-pricebtn line-through">${{ $product->product_price }}</span>
                                <span class="single__product-pricebtn">${{ $product->discount_price }}</span>
                            @endif
                        </div>
                        @php

                            $avgrating = 0;

                        @endphp

                        @foreach ($product->orderItems->where('rstatus', 1) as $orderItem)
                            @php

                                if ($orderItem->review) {
                                    $avgrating = $avgrating + $orderItem->review->rating;
                                }

                            @endphp
                        @endforeach

                        <div class="single__product-star">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $avgrating)
                                    <span><i class="bi bi-star-fill "></i></span>
                                @else
                                    <span><i class="far fa-star "></i></span>
                                @endif
                            @endfor



                            <span class="single__product-reviewtitle">
                                ({{ $product->orderItems->where('rstatus', 1)->count() }} customer review)


                            </span>
                        </div>
                        <div class="single__product-feature">
                            <p>{{ $product->product_short_desc }}</p>

                        </div>

                        <div class="d-flex add-to-cart-by-now-ab">



                            @if (user_product($product->id) == 1)
                                @php
                                    $productlinks = $product->product_url;

                                    $keyLink = array_keys($productlinks);

                                    $downloadUrl = end($keyLink);
                                @endphp

                                <a class="add-to-cart common-btn" style="margin-left: 0px; " href="{{ $downloadUrl }}"
                                    type="submit">Download
                                    Now</a>
                            @elseif (isProductPurchased($product->id) == 1)
                                <a class="add-to-cart common-btn" href="{{ route('user.my-orders') }}"
                                    style="margin-left: 0px; " type="submit">Download
                                    Now</a>
                            @else
                                <form action="{{ route('add.cart') }}" method="post" class="addCard">
                                    @csrf
                                    <div class="viewcontent__action single_action pt-30">

                                        <button class="add-to-cart common-btn" style="margin-left: 0px; " type="submit">ADD
                                            TO CART</button>
                                        <input type="hidden" name="product_slug" value="{{ $product->product_slug }}">
                                    </div>
                                </form>
                                <button class="add-to-wish addWishlist common-btn" data-id="{{ $product->id }}"><i
                                        class="bi bi-heart"></i></button>


                                <form action="{{ route('add.buy') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_slug" value="{{ $product->product_slug }}">
                                    <button class="add-to-buy common-btn" href="#">BUY NOW</button>
                                </form>
                            @endif



                        </div>




                        <div class="single__product-categories">
                            <ul class="single__product-cat">
                                <li>SKU:</li>
                                <li>categories :</li>
                                <li>Tags:</li>
                                <li>Brands :</li>
                            </ul>
                            <ul class="single__product-catname">
                                <li>{{ $product->product_code }}</li>
                                <li>{{ $product->category->category_name }}</li>
                                <li>
                                    @foreach ($tags as $key => $tag)
                                        {{ $tag }},
                                    @endforeach
                                </li>
                                <li>{{ $product->brand->brand_name }}</li>

                            </ul>
                        </div>
                        <div class="single__product-social d-flex align-items-center">
                            <span class="f-title edit-f-title">Share</span>
                            {!! $shareComponent !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- latest  -->

    <div class="single__additional">
        <div class="container">
            <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                        type="button" role="tab" aria-controls="pills-home" aria-selected="true">Discription
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                        type="button" role="tab" aria-controls="pills-profile"
                        aria-selected="false">specefications</button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-Reviews-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-Reviews" type="button" role="tab" aria-controls="pills-Reviews"
                        aria-selected="false">Reviews</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-Discussion-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-Discussion" type="button" role="tab"
                        aria-controls="pills-Discussion" aria-selected="false">Discussion</button>
                </li>

            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                    tabindex="0">
                    <div class="single__additional-content">
                        <div class="single__additional-wrapper">
                            <div class="single__additional-left">
                                {{-- <h2 class="single__additional-title">{{ $product->product_title }}</h2> --}}
                                <p class="single__additional-dis1"> {{ $product->product_short_desc }} </p>

                                <p>{!! $product->description !!}</p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                    tabindex="0">
                    <div class="specefications">
                        <ul class="specefications__list for-shop">
                            <li>
                                <span> Specifications</span>
                                <span>Discription</span>
                            </li>
                            @foreach ($fixeds as $fixed)
                                <li>
                                    <span>{{ $fixed->question }}</span>
                                    <span>{{ $fixed->answer }}</span>
                                </li>
                            @endforeach
                            @foreach ($specifiactions as $key => $specific)
                                <li>
                                    <span>{{ $specific }}</span>
                                    <span>{{ json_decode($product->specification_ans, true)[$key] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-Reviews" role="tabpanel" aria-labelledby="pills-Reviews-tab"
                    tabindex="0">
                    <div class="reviews__area">
                        <div class="reviews__area-header">
                            <h2 class="reviews__area-title">Reviews </h2>
                        </div>


                        <div class="row">
                            @if ($product->orderItems->where('rstatus', 1)->count() > 0)
                                @foreach ($product->orderItems->where('rstatus', 1) as $orderItem)
                                    @if ($orderItem->review)
                                        <div class="col-lg-6">
                                            <div class="reviews__area-body">
                                                <div class="reviews__area-items">
                                                    <div class="reviews__area-item">
                                                        <div class="thumb">
                                                            <img src="{{ asset($orderItem->order->user->image) }}"
                                                                alt="">
                                                            {{-- <img src="{{asset('backend/images')}}/{{$orderItem->order->user->image}}" alt=""> --}}
                                                        </div>
                                                        <div class="content">
                                                            <h3>{{ $orderItem->order->user->name }}</h3>
                                                            @if ($orderItem->review)
                                                                <span>{{ Carbon\Carbon::parse($orderItem->review->created_at)->format('d F Y') }}</span>
                                                                <p>{{ $orderItem->review->comment }}</p>
                                                            @endif
                                                        </div>
                                                        <div class="star">

                                                            {{-- {{ $orderItem->review->rating }} --}}

                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= $avgrating)
                                                                    <span><i class="bi bi-star-fill "></i></span>
                                                                @else
                                                                    <span><i class="far fa-star "></i></span>
                                                                @endif
                                                            @endfor
                                                            {{-- <i class="fa-solid fa-star {{ $orderItem->review->rating }} "></i> --}}

                                                        </div>
                                                        {{-- {{ $orderItem->review->rating }} --}}
                                                    </div>


                                                </div>
                                            </div>
                                            <div class="reviews__area-footer"></div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="col-lg-6">
                                    <p class="text-secondary" style="color:white"> Not Review This Product</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-Discussion" role="tabpanel" aria-labelledby="pills-Discussion-tab"
                    tabindex="0">
                    <div class="reviews__area">
                        <div class="reviews__area-header">
                            <h2 class="reviews__area-title">Discussion </h2>
                        </div>


                        <div class="discussion-wrap">
                            <!-- all comments  -->
                            <div class="all-comments-wrap abs-cus-dp-item">
                                <div class="comments-items" id="comments">



                                </div>
                            </div>

                            <div class="discussion-comment-ab">
                                <form class="boxs-ab" id="comment-form" action="{{ route('comment-to-product') }}"
                                    method="post">
                                    @csrf
                                    <label for="comment-dis-i">Leave your Comment</label>
                                    <input type="hidden" name="productId" value="{{ $product->id }}">
                                    <textarea name="comment" id="comment-dis-i" placeholder="Type Your Comment here ..." cols="30" rows="8"></textarea>
                                    <button class="common-btn" type="submit">Submit</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- new related product  -->

    <h2 class="related__products-title mt-5">Latest products</h2>
    <div class="container">
        <div class="cards-wrap-ab">
            @foreach ($latest_product as $r_product)
                <div class="card-main">
                    <div class="card-item">
                        @if (isProductWishlist($r_product->id))
                            <button class="_hart-icon removeWishlist" data-id="{{ $r_product->id }}">
                                <span><i class="fa-solid fa-heart"></i></span>
                            </button>
                        @else
                            <button class="_hart-icon addWishlist" data-id="{{ $r_product->id }}">
                                <span><i class="fa-regular fa-heart"></i></span>
                            </button>
                        @endif
                        <div class="image">
                            <a href="{{ route('product.details', $r_product->product_slug) }}"><img
                                    src="{{ asset($r_product->thumbnail) }}" alt=""></a>
                        </div>
                        <div class="heading-content">
                            <a href="{{ route('product.details', $r_product->product_slug) }}"
                                class="_title">{{ $r_product->product_name }}</a>
                            <div class="price-box">
                                @if ($r_product->discount_rate == 0.0)
                                    <p class="new_price">${{ $r_product->product_price }}</p>
                                @else
                                    <p class="old_price">${{ $r_product->product_price }}</p>
                                    <p class="new_price">${{ $r_product->discount_price }}</p>
                                @endif
                            </div>

                        </div>

                        <div class="sub-content">
                            <p class="detail">{{ Str::limit($r_product->product_short_desc, 100) }}</p>
                            @if (isProductPurchased($r_product->id))
                                @php
                                    $data = $r_product->product_url;

                                    if ($data !== null) {
                                        $keyLink = array_keys($data);
                                    } else {
                                        $keyLink = ['https://fintechforexea.com/user/home'];
                                    }

                                    $downloadUrl = end($keyLink);

                                @endphp
                                <a target="_blank" href="{{ $downloadUrl }}" class="common-btn">Download
                                    now</a>
                            @else
                                <form action="{{ route('add.cart') }}" method="post" class="addCard">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ encrypt($r_product->id) }}">
                                    <input type="hidden" name="product_qty" value="1">
                                    @if ($r_product->discount_rate == 0.0)
                                        <input type="hidden" name="product_price"
                                            value="{{ encrypt($r_product->product_price) }}">
                                    @else
                                        <input type="hidden" name="product_price"
                                            value="{{ encrypt($r_product->discount_price) }}">
                                    @endif
                                    <button class="common-btn">Add to Cart</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="items__btn">
        <!-- <a href="#" class="btn btn-more">view more</a> -->
        <a href="{{ url('latest-product') }}" class="btn-one">view more</a>
    </div>

    </div>
    </div>


    @push('js')
        <script>
            $(".bi-plus").on('click', function() {
                var qty = $(".qty").text();
                var qty_plus = ++qty;
                $(".qty").text(qty_plus);
                $(".product_qty").val(qty_plus);
            })

            $(".bi-dash").on('click', function() {
                var qty = $(".qty").text();
                if (qty == 1) {

                } else {
                    var qty_substr = qty - 1;
                    $(".qty").text(qty_substr);
                    $(".product_qty").val(qty_substr);
                }

            })
        </script>

        <script>
            $(document).ready(function() {
                $.ajax({
                    type: "GET",
                    url: "cart/show",
                    success: function(data) {
                        $('.cart_list_popup').html(data)
                    },
                });


                // Delete comment
                $(document).on('click', '.delete-comment', function() {
                    var commentId = $(this).data('id');
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        url: '{{ route('comment.delete') }}',
                        method: 'POST',
                        data: {
                            commentId: commentId
                        },
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                        },
                        success: function(response) {
                            fetchComments();
                            toastr.success('Comment Deleted!', 'Success');

                        }
                    });
                });

                fetchComments();



                function fetchComments() {


                    var productId = {{ $product->id }};



                    $.ajax({
                            url: '{{ route('product.commnets') }}', // Update with your actual route
                            method: 'GET',
                            data: {
                                product_id: productId
                            }, // Pass the product ID as a parameter
                            success: function(response) {
                                var commentsHtml = '';

                                response.forEach(function(comment) {
                                        var deleteButton = '';

                                        // Check if the user is authenticated
                                        @auth
                                        // Check if the user is an admin or the owner of the comment
                                        if ('{{ auth()->check() }}' && (
                                                '{{ auth()->user()->type }}' === 'admin' || comment
                                                .user_id === {{ auth()->user()->id }})) {
                                            deleteButton =
                                                `
                                                <div class="ico">
                                                        <div class="dropdown">
                                                            <button class="dropdown-toggle" type="button"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><button class="dropdown-item delete-comment" href="#"  data-id="${comment.id}">
                                                                        <span><i class="fa-solid fa-trash-can"></i></span>
                                                                        <span>Delete Comment</span>
                                                                    </button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    `;
                                        }
                                    @endauth

                                    commentsHtml += `
                                    <div class="comment">
                                        <div class="__left">
                                            <img src="{{ asset('${comment.user.image}') }}" alt="">
                                        </div>
                                        <div class="__right">
                                            <div class="__content">
                                                <div class="__top">
                                                    <div class="info">
                                                        <h1 class="name">${comment.user.name}</h1>
                                                        <p class="date">${comment.formatted_date}</p>
                                                    </div>
                                                    ${deleteButton}
                                                </div>

                                                <p class="__com"> ${comment.comment} .</p>


                                            </div>

                                        </div>

                                    </div>
                                `;
                                });

                            $('#comments').html(commentsHtml);
                        },

                        error: function(error) {

                        }
                    });
            }


            $('#comment-form').submit(function(event) {
                event.preventDefault();
                var auth = {{ authcheck() }}
                if (auth != 1) {
                    toastr.warning('Login to continue!', 'Alert');

                }


                var csrfToken = $('[name=csrfmiddlewaretoken]')
                    .val(); // Get CSRF token from the hidden input field
                var formData = $(this).serialize();

                $.ajax({
                    url: '{{ route('comment-to-product') }}',
                    method: 'POST',
                    headers: {
                        "X-CSRFToken": csrfToken
                    }, // Include the CSRF token in the request headers
                    data: formData,
                    success: function(response) {
                        $('#comment-dis-i').val('');

                        fetchComments();
                        toastr.success('Comment added successfully!', 'Success');
                    },
                    error: function(error) {
                        // Handle error
                    }
                });
            });



            })
        </script>


        <!-- Go to www.addthis.com/dashboard to customize your tools -->
    @endpush

@endsection
