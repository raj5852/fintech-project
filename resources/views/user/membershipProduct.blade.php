@extends('layouts.front')
@section('title')
    User Membership Products
@endsection
@section('front_content')
    <!-- breadcrumb  -->
    <x-profile.header />


    <!-- dashboard  -->

    <div class="dashboard">
        <div class="container">
            <x-profile.profile :userDetails="$userDetails"/>


            <x-profile.mobile-sidebar />

            <div class="mobile-show-content">
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
            </div>




            <div class="dashboard-mobile">
                <button class="dashboard-open">open menu <i class="bi bi-chevron-down"></i> </button>
            </div>
            <div class="dashboard__main">
                <div class="row gx-5">
                    <x-profile.large-sidebar :userDetails="$userDetails"/>
                    <div class="col-xl-8">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-product" role="tabpanel"
                                aria-labelledby="v-pills-top-product">
                                <div class="items row" id="dashboard-member-product">


                                    {{-- @forelse ($memberShipProducts as $latest)
                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <a href="{{ URL::to('product/details/' . $latest->product_slug) }}">
                                                <div class="items__item">
                                                    <img src="{{ asset($latest->thumbnail) }}" alt=""
                                                        class="items__img" />
                                                    <h5 class="heading name">

                                                        {{ Str::limit($latest->product_name, 25, '') }}

                                                    </h5>
                                                    <h5 class="heading title">

                                                        {{ Str::limit($latest->product_title, 20, '') }}

                                                    </h5>
                                                    <div
                                                        class="price-list d-flex justify-content-center align-items-center gap-2 mb-1">
                                                        @if ($latest->discount_rate == 0.0)
                                                            <p class="price newprice">${{ $latest->product_price }}</p>
                                                        @else
                                                            <p class="price">${{ $latest->product_price }}</p>

                                                            <p class="price newprice">${{ $latest->discount_price }}</p>
                                                        @endif
                                                    </div>

                                                    <div class="items__bottom mx-auto">
                                                        <p class="text mb-2 text-center">
                                                            {{ Str::limit($latest->product_short_desc, 80, '') }}
                                                        </p>
                                                        <div class="d-flex justify-content-center align-items-center">

                                                            <form action="{{ route('add.cart') }}" method="post"
                                                                class="d-flex w-full justify-content-center align-items-center mx-auto addCard">
                                                                @csrf
                                                                <input type="hidden" name="product_id"
                                                                    value="{{ encrypt($latest->id) }}">
                                                                <input type="hidden" name="product_qty" value="1">
                                                                @if ($latest->discount_rate == 0.0)
                                                                    <input type="hidden" name="product_price"
                                                                        value="{{ encrypt($latest->product_price) }}">
                                                                @else
                                                                    <input type="hidden" name="product_price"
                                                                        value="{{ encrypt($latest->discount_price) }}">
                                                                @endif

                                                                <div
                                                                    class="d-flex  justify-content-center align-items-center mx-auto">
                                                                    <button class="btn btn-cart mx-auto"
                                                                        type="submit">Add to cart</button>
                                                                </div>


                                                            </form>

                                                            <a href="#" class="btn btn-wishlist addWishlist"
                                                                data-id="{{ $latest->id }}">
                                                                <i class="bi bi-heart"></i>
                                                            </a>

                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @empty
                                        <span class="text-center text-danger">No Product Found</span>
                                    @endforelse --}}



                                    <div class="pagination pagination-sm justify-content-center">


                                    </div>
                                    <!-- new  pagination  -->
                                    <div class="pagination-wrap-ab mb-5">
                                        <ul class="items">
                                            <li>

                                                <a href="#" class="common-btn"><i
                                                        class="fa-solid fa-angle-left"></i></a>
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

                                                <a href="#" class="common-btn "><i
                                                        class="fa-solid fa-ellipsis"></i></a>
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
                                                <a href="#" class="common-btn"><i
                                                        class="fa-solid fa-angle-right"></i></a>

                                            </li>


                                        </ul>
                                    </div>

                                </div>
                            </div>
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
