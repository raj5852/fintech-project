@extends('layouts.front')

@section('title')
    Shop |
@endsection
@section('front_content')
    @push('css')
    @endpush


    <div class="shop-page">

        <!-- breadcrumb  -->
        <div class="bredcrumb">
            <h2 class="bredcrumb__title">
                @if (request('r_category') != null)
                    {{ request('r_category') }} PRODUCT
                @else
                    Shop Page
                @endif
            </h2>
            <ul class="bredcrumb__items">
                <li> <a href="{{ route('home') }}">Home</a> <i class="bi bi-chevron-right"></i></li>
                @if (request('r_category'))
                    <li>
                        {{ request('r_category') }}
                    </li>
                    @if (request('r_sub_category'))
                        <li>
                            <i class="bi bi-chevron-right"></i>
                        </li>
                        {{ request('r_sub_category') }}
                        </li>
                    @endif
                @else
                    Shop
                @endif

                @if ($subcategory_id)
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
                                <form name="sortArts" id="sortArts">
                                    @if (request('search') != null)
                                        <input type="hidden" name="search" value="{{ request('search') }}">
                                    @endif
                                    @if (request('type') != null)
                                        <input type="hidden" name="type" value="{{ request('type') }}">
                                    @endif

                                    @if (request('search') != null)
                                        <input type="hidden" name="search" value="{{ request('search') }}">
                                    @endif

                                    @if (request('category') != null)
                                        <input type="hidden" name="category" value="{{ request('category') }}">
                                    @endif

                                    @if (request('r_category') != null)
                                        <input type="hidden" name="r_category" value="{{ request('r_category') }}">
                                    @endif

                                    @if (request('r_sub_category') != null)
                                        <input type="hidden" name="r_sub_category"
                                            value="{{ request('r_sub_category') }}">
                                    @endif


                                    @if (request('membership_id') != null)
                                        <input type="hidden" name="membership_id" value="{{ request('membership_id') }}">
                                    @endif

                                    @if (request('sub_category') != null)
                                        <input type="hidden" name="sub_category" value="{{ request('sub_category') }}">
                                    @endif

                                    @if (request('start_price') != null)
                                        <input type="hidden" name="start_price" value="{{ request('start_price') }}">
                                    @endif

                                    @if (request('end_price') != null)
                                        <input type="hidden" name="end_price" value="{{ request('end_price') }}">
                                    @endif

                                    <select style="font-size: 16px;" name="sort" id="sort"
                                        class="form-control form-select select_sort_by style_changed">

                                        <option value="">Select Please</option>

                                        <option value="product_popular"
                                            @if (isset($_GET['sort']) && $_GET['sort'] == 'product_popular') selected="" @endif>Popularity</option>
                                        <option value="product_ratting"
                                            @if (isset($_GET['sort']) && $_GET['sort'] == 'product_ratting') selected="" @endif>Top ratting</option>
                                        <option value="price_low_to_high"
                                            @if (isset($_GET['sort']) && $_GET['sort'] == 'price_low_to_high') selected="" @endif>Price low To High</option>
                                        <option value="price_high_to_low"
                                            @if (isset($_GET['sort']) && $_GET['sort'] == 'price_high_to_low') selected="" @endif>Price High To Low</option>
                                    </select>
                                </form>
                        </div>

                        <div class="categories__item mb-2">
                            <h4 class="heading mb-2">Product categories</h4>
                            <ul class="categories__list product-categories-list">
                                <a href="{{ url('shop?all_category=all_category') }}">
                                    <li class="categories__list--item active">
                                        <div class="circle"></div>
                                        <span class="text">All Category</span>
                                        <span class="item-number">{{ $all_category }}</span>
                                    </li>
                                </a>

                                @foreach ($category as $cat)
                                    <a href="{{ url('shop?category=' . $cat->id . '') }}">
                                        <li class="categories__list--item">
                                            <div class="circle"></div>
                                            <span class="text">{{ $cat->category_name }}</span>
                                            <span class="item-number">{{ $cat->product_count }}</span>
                                        </li>
                                    </a>
                                @endforeach
                        </div>

                        @if (request('type') != 'free')
                            <div class="categories__item mb-2  categories__item__filtering">
                                <h4 class="heading mb-2">Select By price</h4>
                                <form name="sortArts" id="sortArts">
                                    @if (request('category') != null)
                                        <input type="hidden" name="category" value="{{ request('category') }}">
                                    @endif

                                    @if (request('r_sub_category') != null)
                                        <input type="hidden" name="r_sub_category"
                                            value="{{ request('r_sub_category') }}">
                                    @endif

                                    @if (request('r_category') != null)
                                        <input type="hidden" name="r_category" value="{{ request('r_category') }}">
                                    @endif



                                    @if (request('search') != null)
                                        <input type="hidden" name="search" value="{{ request('search') }}">
                                    @endif

                                    @if (request('sort') != null)
                                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                                    @endif

                                    @if (request('membership_id') != null)
                                        <input type="hidden" name="membership_id" value="{{ request('membership_id') }}">
                                    @endif

                                    @if (request('sub_category') != null)
                                        <input type="hidden" name="sub_category" value="{{ request('sub_category') }}">
                                    @endif
                                    <div class="wrapper">
                                        <div class="container_range">
                                            <div class="slider-track"></div>
                                            <input type="range" min="1"
                                                max="{{ $largeProductAmount->discount_price }}"
                                                value="{{ request('start_price') ?? 1 }}" name="start_price"
                                                id="slider-1" oninput="slideOne()" />

                                            <input type="range" min="1"
                                                max="{{ $largeProductAmount->discount_price }}"
                                                value="{{ request('end_price') ?? $largeProductAmount->discount_price }}"
                                                id="slider-2" name="end_price" oninput="slideTwo()" />
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <button class="common_btn">apply</button>
                                            <div
                                                class="categories__price d-flex justify-content-between align-items-center gap-2">
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
                        @endif


                        <br>
                        <br>
                        @if (Auth::check())
                            @php
                                $userDetails = App\Models\User::where('email', Auth::user()->email)->first();
                            @endphp

                            @if ($userDetails->subscribe_id == null)
                            @else
                                <div class="categories__item ">
                                    <h4 class="heading mb-2">Member Product</h4>
                                    <div class="categories__btns shop-membership-buttons">
                                        @foreach ($members as $member)
                                            <a href="{{ url('shop?membership_id=' . $member->id . '') }}"
                                                class="common-btn active">

                                                <span> {{ $member->membership_name }}</span>

                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @else
                        @endif
                    </div>



                    <div class="shop__right">



                        <!-- search bar shop page -->

                        <div class="search-bar-shop-page">
                            <form class="from-wrap" action="">
                                <div class="search-wrap ">


                                    <div class="input-wrap">
                                        <input class="input-txt" type="text" placeholder="Adobe Effect Effect">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Select category</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>

                                    <div class="result-wrap d-none">
                                        <h1 class="title">
                                            Previous Searched
                                        </h1>
                                        <div class="items">
                                            <div class="item">
                                                <div class="img">
                                                    <a href="">
                                                        <img src="{{ asset('frontend/') }}/img/product-1.png"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <a href="#" class="name">Adobe Draw Down</a>
                                            </div>
                                            <div class="item">
                                                <div class="img">
                                                    <a href="">
                                                        <img src="{{ asset('frontend/') }}/img/product-1.png"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <a href="#" class="name">Adobe Draw Down</a>
                                            </div>
                                            <div class="item">
                                                <div class="img">
                                                    <a href="">
                                                        <img src="{{ asset('frontend/') }}/img/product-1.png"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <a href="#" class="name">Adobe Draw Down</a>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                                <div class="search-btn-shop"><button class="common-btn"><span
                                            class="t">Search</span><span class="i"><i
                                                class="fa-solid fa-magnifying-glass"></i></span></button></div>
                            </form>
                        </div>

                        <!-- search tab bar  -->

                        <div class="shop__top sidebar-mobile-control-kjslf">
                            <button class="btn-category common-btn"> Filter by
                                <i class="fa-solid fa-filter"></i>
                            </button>
                        </div>


                        <div class="shop-page-tab-bar-ab">
                            <div class="__left">
                                <p class="text">Showing 1-9 of 32 results</p>
                            </div>
                            <div class="__right">
                                <button onclick="changeTab(0,this)" class="btn-tab active"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M8.30357 13.071C8.94293 13.071 9.55611 13.325 10.0082 13.7771C10.4603 14.2292 10.7143 14.8424 10.7143 15.4817V21.3746C10.7143 22.0139 10.4603 22.6271 10.0082 23.0792C9.55611 23.5313 8.94293 23.7853 8.30357 23.7853H2.41071C1.77135 23.7853 1.15818 23.5313 0.706082 23.0792C0.253985 22.6271 0 22.0139 0 21.3746V15.4817C0 14.8424 0.253985 14.2292 0.706082 13.7771C1.15818 13.325 1.77135 13.071 2.41071 13.071H8.30357ZM21.1607 13.071C21.8001 13.071 22.4132 13.325 22.8653 13.7771C23.3174 14.2292 23.5714 14.8424 23.5714 15.4817V21.3746C23.5714 22.0139 23.3174 22.6271 22.8653 23.0792C22.4132 23.5313 21.8001 23.7853 21.1607 23.7853H15.2679C14.6285 23.7853 14.0153 23.5313 13.5632 23.0792C13.1111 22.6271 12.8571 22.0139 12.8571 21.3746V15.4817C12.8571 14.8424 13.1111 14.2292 13.5632 13.7771C14.0153 13.325 14.6285 13.071 15.2679 13.071H21.1607ZM8.30357 0.213867C8.94293 0.213867 9.55611 0.467852 10.0082 0.919949C10.4603 1.37205 10.7143 1.98522 10.7143 2.62458V8.51744C10.7143 9.1568 10.4603 9.76997 10.0082 10.2221C9.55611 10.6742 8.94293 10.9282 8.30357 10.9282H2.41071C1.77135 10.9282 1.15818 10.6742 0.706082 10.2221C0.253985 9.76997 0 9.1568 0 8.51744V2.62458C0 1.98522 0.253985 1.37205 0.706082 0.919949C1.15818 0.467852 1.77135 0.213867 2.41071 0.213867H8.30357ZM21.1607 0.213867C21.8001 0.213867 22.4132 0.467852 22.8653 0.919949C23.3174 1.37205 23.5714 1.98522 23.5714 2.62458V8.51744C23.5714 9.1568 23.3174 9.76997 22.8653 10.2221C22.4132 10.6742 21.8001 10.9282 21.1607 10.9282H15.2679C14.6285 10.9282 14.0153 10.6742 13.5632 10.2221C13.1111 9.76997 12.8571 9.1568 12.8571 8.51744V2.62458C12.8571 1.98522 13.1111 1.37205 13.5632 0.919949C14.0153 0.467852 14.6285 0.213867 15.2679 0.213867H21.1607Z"
                                            fill="#6A6A6A" />
                                    </svg>
                                </button>
                                <button onclick="changeTab(1,this)" class="btn-tab"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="20"
                                        viewBox="0 0 24 20" fill="none">
                                        <path
                                            d="M0.572266 0.625V19.375H23.0723V0.625H0.572266ZM2.44727 2.5H7.13477V6.25H2.44727V2.5ZM9.00977 2.5H21.1973V6.25H9.00977V2.5ZM2.44727 8.125H7.13477V11.875H2.44727V8.125ZM9.00977 8.125H21.1973V11.875H9.00977V8.125ZM2.44727 13.75H7.13477V17.5H2.44727V13.75ZM9.00977 13.75H21.1973V17.5H9.00977V13.75Z"
                                            fill="#6A6A6A" />
                                    </svg>
                                </button>
                                <button onclick="changeTab(2,this)" class="btn-tab"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="18" height="12"
                                        viewBox="0 0 18 12" fill="none">
                                        <path
                                            d="M17.05 5H0.95C0.42533 5 0 5.42533 0 5.95V6.05C0 6.57467 0.42533 7 0.95 7H17.05C17.5747 7 18 6.57467 18 6.05V5.95C18 5.42533 17.5747 5 17.05 5Z"
                                            fill="#6A6A6A" />
                                        <path
                                            d="M17.05 10H0.95C0.42533 10 0 10.4253 0 10.95V11.05C0 11.5747 0.42533 12 0.95 12H17.05C17.5747 12 18 11.5747 18 11.05V10.95C18 10.4253 17.5747 10 17.05 10Z"
                                            fill="#6A6A6A" />
                                        <path
                                            d="M17.05 0H0.95C0.42533 0 0 0.425329 0 0.95V1.05C0 1.57467 0.42533 2 0.95 2H17.05C17.5747 2 18 1.57467 18 1.05V0.95C18 0.425329 17.5747 0 17.05 0Z"
                                            fill="#6A6A6A" />
                                    </svg>
                                </button>
                            </div>
                        </div>


                        <div class="mb-4">
                            <!-- new cards style -1  -->
                            <div class="shop-page-tab-result active">

                                <div class="cards-wrap-ab">
                                    @forelse ($products as $product)
                                        <x-firstshopcart :product="$product" />
                                    @empty
                                        <div class="text-center">
                                            <p class="text-secondary">No Product found!!</p>
                                        </div>
                                    @endforelse




                                </div>
                            </div>

                            <!-- new cards style -2  -->

                            <div class="shop-page-tab-result">
                                <div class="cards-wrap-style-2 ">
                                    <x-secondshopcart />

                                </div>
                            </div>


                            <!-- new card style 3  -->

                            <div class="shop-page-tab-result">
                                <div class="cards-wrap-style-3  ">
                                    <div class="item">
                                        <a href="#" class="__title">Product title here asdf safdasfsf saf sa
                                            sdfsf</a>
                                        <p class="__price">$78.59</p>
                                        <div class="action">
                                            <button class="common-btn">Add To Cart</button>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <h1 class="__title">Product title here asdfs s</h1>
                                        <p class="__price">$78.59</p>
                                        <div class="action">
                                            <button class="common-btn">Add To Cart</button>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <h1 class="__title">Product </h1>
                                        <p class="__price">$78.59</p>
                                        <div class="action">
                                            <button class="common-btn">Add To Cart</button>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <h1 class="__title">Product </h1>
                                        <p class="__price">$78.59</p>
                                        <div class="action">
                                            <button class="common-btn">Add To Cart</button>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <h1 class="__title">Product </h1>
                                        <p class="__price">$78.59</p>
                                        <div class="action">
                                            <button class="common-btn">Add To Cart</button>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <h1 class="__title">Product </h1>
                                        <p class="__price">$78.59</p>
                                        <div class="action">
                                            <button class="common-btn">Add To Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- new  pagination  -->
                        <div class="pagination-wrap-ab mb-5">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- footer -->


    @push('js')
        <script>
            $(document).ready(function wishlist() {
                $.ajax({
                    type: "GET",
                    url: "get/" + {{ $cat->category_slug }} + "/cart/show",
                    dataType: 'json',
                    success: function(data) {
                        $('.wishlist-count').text(data)
                    },
                });
            });
        </script>
        <script>
            $(document).ready(function() {


                $("#sort").on("change", function() {
                    this.form.submit();
                });
            });
        </script>

        <script>
            function changeTab(tabIndex, clickedButton) {
                // Get all the tab buttons and content divs
                var tabButtons = document.getElementsByClassName("btn-tab");
                var tabContents = document.getElementsByClassName("shop-page-tab-result");

                // Remove the 'active' class from all tab buttons and content divs
                for (var i = 0; i < tabButtons.length; i++) {
                    tabButtons[i].classList.remove("active");
                    tabContents[i].classList.remove("active");
                }

                // Add the 'active' class to the selected tab button and content div
                clickedButton.classList.add("active");
                tabContents[tabIndex].classList.add("active");
            }
        </script>
    @endpush
@endsection
