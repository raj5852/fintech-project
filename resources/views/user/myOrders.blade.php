@extends('layouts.front')
@section('title')
    My Orders
@endsection
@section('front_content')
    @push('css')
    @endpush

    <x-profile.header />



    </div>
    <!-- dashboard  -->

    <div class="dashboard">
        <div class="container">
            {{-- profile  --}}
            <x-profile.profile :userDetails="$userDetails" />



            {{-- mobile side bar  --}}
            <x-profile.mobile-sidebar />


            <div class="mobile-show-content">

                <!-- new table start  -->

                <x-profile.orders-content />
                <!-- new table end  -->
            </div>
            <!-- end mobile version 992px -->



            {{-- <div class="dashboard-mobile d-none">
                <button class="dashboard-open">open menu <i class="bi bi-chevron-down"></i> </button>
            </div> --}}
            <div class="dashboard__main">
                <div class="row gx-5">
                    {{-- desktop side bar  --}}

                    <x-profile.large-sidebar :userDetails="$userDetails" />



                    <div class="col-xl-8">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel"
                                aria-labelledby="v-pills-profile-tab">

                                <div class="dashboard__profile-content ">
                                    <div class="dashboard__profile-order">
                                        <span class="dashboard__profile-bltitle">Order List</span>

                                        <x-profile.orders-content />

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
