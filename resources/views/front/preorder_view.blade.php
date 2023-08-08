@extends('layouts.front')

@section('title')
    Shop Page
@endsection
@section('front_content')
    @push('css')
    @endpush

    <div class="bredcrumb">
        <h2 class="bredcrumb__title">Pre-order</h2>
        <ul class="bredcrumb__items">
            <li><a href="{{ route('home') }}">Home</a> <i class="bi bi-chevron-right"></i></li>
            <li>Pre-order</li>
        </ul>
    </div>

    <section style="max-width: 1262px;margin: 0 auto;padding: 10px;">

        <div class="shop-page-tab-bar-ab preorder">

            <div class="__right">
                <button onclick="changeTab(0,this)" class="btn-tab active"><svg xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M8.30357 13.071C8.94293 13.071 9.55611 13.325 10.0082 13.7771C10.4603 14.2292 10.7143 14.8424 10.7143 15.4817V21.3746C10.7143 22.0139 10.4603 22.6271 10.0082 23.0792C9.55611 23.5313 8.94293 23.7853 8.30357 23.7853H2.41071C1.77135 23.7853 1.15818 23.5313 0.706082 23.0792C0.253985 22.6271 0 22.0139 0 21.3746V15.4817C0 14.8424 0.253985 14.2292 0.706082 13.7771C1.15818 13.325 1.77135 13.071 2.41071 13.071H8.30357ZM21.1607 13.071C21.8001 13.071 22.4132 13.325 22.8653 13.7771C23.3174 14.2292 23.5714 14.8424 23.5714 15.4817V21.3746C23.5714 22.0139 23.3174 22.6271 22.8653 23.0792C22.4132 23.5313 21.8001 23.7853 21.1607 23.7853H15.2679C14.6285 23.7853 14.0153 23.5313 13.5632 23.0792C13.1111 22.6271 12.8571 22.0139 12.8571 21.3746V15.4817C12.8571 14.8424 13.1111 14.2292 13.5632 13.7771C14.0153 13.325 14.6285 13.071 15.2679 13.071H21.1607ZM8.30357 0.213867C8.94293 0.213867 9.55611 0.467852 10.0082 0.919949C10.4603 1.37205 10.7143 1.98522 10.7143 2.62458V8.51744C10.7143 9.1568 10.4603 9.76997 10.0082 10.2221C9.55611 10.6742 8.94293 10.9282 8.30357 10.9282H2.41071C1.77135 10.9282 1.15818 10.6742 0.706082 10.2221C0.253985 9.76997 0 9.1568 0 8.51744V2.62458C0 1.98522 0.253985 1.37205 0.706082 0.919949C1.15818 0.467852 1.77135 0.213867 2.41071 0.213867H8.30357ZM21.1607 0.213867C21.8001 0.213867 22.4132 0.467852 22.8653 0.919949C23.3174 1.37205 23.5714 1.98522 23.5714 2.62458V8.51744C23.5714 9.1568 23.3174 9.76997 22.8653 10.2221C22.4132 10.6742 21.8001 10.9282 21.1607 10.9282H15.2679C14.6285 10.9282 14.0153 10.6742 13.5632 10.2221C13.1111 9.76997 12.8571 9.1568 12.8571 8.51744V2.62458C12.8571 1.98522 13.1111 1.37205 13.5632 0.919949C14.0153 0.467852 14.6285 0.213867 15.2679 0.213867H21.1607Z"
                            fill="#6A6A6A" />
                    </svg>
                </button>

                <button onclick="changeTab(1,this)" class="btn-tab"><svg xmlns="http://www.w3.org/2000/svg" width="18"
                        height="12" viewBox="0 0 18 12" fill="none">
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
                <div class="cards-wrap-ab  pre-ord-cars">
                    @foreach ($preorders as $preorder)
                    <x-preorder :preorder="$preorder" />

                    @endforeach
                </div>
            </div>
            {{-- Delivery On The Way --}}


            <!-- new card style 3  -->

            <div class="shop-page-tab-result">
                <div class="cards-wrap-style-3  ">
                    <!-- item  -->
                    <div class="item">
                        <h1 class="__title">Product <span class="d-txt">(Delivery On The Way)</span> </h1>
                        <p class="__price">$78.59</p>
                        <div class="action">
                            <button class="common-btn">Pre-Order</button>
                        </div>
                    </div>
                    <!-- item  -->
                    <div class="item">
                        <h1 class="__title">Product </h1>
                        <p class="__price">$78.59</p>
                        <div class="action">
                            <button class="common-btn">Pre-Order</button>
                        </div>
                    </div>
                    <!-- item  -->
                    <div class="item">
                        <h1 class="__title">Product </h1>
                        <p class="__price">$78.59</p>
                        <div class="action">
                            <button class="common-btn">Pre-Order</button>
                        </div>
                    </div>
                    <!-- item  -->
                    <div class="item">
                        <h1 class="__title">Product </h1>
                        <p class="__price">$78.59</p>
                        <div class="action">
                            <button class="common-btn">Pre-Order</button>
                        </div>
                    </div>
                    <!-- item  -->
                    <div class="item">
                        <h1 class="__title">Product </h1>
                        <p class="__price">$78.59</p>
                        <div class="action">
                            <button class="common-btn">Pre-Order</button>
                        </div>
                    </div>
                    <!-- item  -->
                    <div class="item">
                        <h1 class="__title">Product </h1>
                        <p class="__price">$78.59</p>
                        <div class="action">
                            <button class="common-btn">Pre-Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

        <!-- new  pagination  -->
        <div class="pagination-wrap-ab mb-5">
            <ul class="items">
                <li>

                    <a href="#" class="common-btn"><i class="fa-solid fa-angle-left"></i></a>
                </li>
                <li>

                    <a href="#" class="common-btn active">1</a>
                </li>
                <li>
                    <a href="#" class="common-btn">2</a>

                </li>
                <li>
                    <a href="#" class="common-btn">3</a>

                </li>
                <li>
                    <a href="#" class="common-btn">4</a>

                </li>
                <li>
                    <a href="#" class="common-btn">5</a>

                </li>
                <li>

                    <a href="#" class="common-btn "><i class="fa-solid fa-ellipsis"></i></a>
                </li>
                <li>
                    <a href="#" class="common-btn">2</a>

                </li>
                <li>
                    <a href="#" class="common-btn">3</a>

                </li>
                <li>
                    <a href="#" class="common-btn">4</a>

                </li>
                <li>
                    <a href="#" class="common-btn">5</a>

                </li>
                <li>
                    <a href="#" class="common-btn"><i class="fa-solid fa-angle-right"></i></a>

                </li>


            </ul>
        </div>
    </section>


    <!-- footer -->


    @push('js')
    @endpush
@endsection
