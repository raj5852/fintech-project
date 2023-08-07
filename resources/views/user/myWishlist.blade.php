@extends('layouts.front')
@section('title')
    User Wishlist
@endsection
@section('front_content')
    <!-- breadcrumb  -->
    <x-profile.header />


    <!-- dashboard  -->

    <div class="dashboard">
        <div class="container">
            <x-profile.profile :userDetails="$userDetails" />

            <!-- mobile version 992px -->
            <x-profile.mobile-sidebar />

            <div class="mobile-show-content">
                <!-- new table start  -->
                <x-profile.wishlist-content />
                <!-- new table end  -->
            </div>
            <!-- end mobile version 992px -->



            <div class="dashboard-mobile">
                <button class="dashboard-open">open menu <i class="bi bi-chevron-down"></i> </button>
            </div>
            <div class="dashboard__main">
                <div class="row gx-5">
                    <x-profile.large-sidebar :userDetails="$userDetails" />

                    <div class="col-xl-8">
                        <div class="tab-content" id="v-pills-tabContent">

                            {{-- Wish start --}}
                            <div class="tab-pane fade show active" id="v-pills-settings" role="tabpanel"
                                aria-labelledby="v-pills-settings-tab">
                                <div class="">
                                    <span class="dashboard__profile-bltitle mb-2">My Wish List </span>


                                    <!-- new table start  -->
                                    <x-profile.wishlist-content />

                                    <!-- new table end  -->
                                </div>
                            </div>

                            {{-- Wish end --}}
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
