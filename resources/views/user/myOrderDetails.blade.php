@extends('layouts.front')
@section('title')
    My Orders Details
@endsection
@section('front_content')
    <x-profile.header />


    <!-- dashboard  -->

    <div class="dashboard">
        <div class="container">
            <x-profile.profile :userDetails="$userDetails" />


            {{-- mobile side bar  --}}
            <x-profile.mobile-sidebar :userGroups="$userGroups" />

            <div class="mobile-show-content">
                <x-order-detail :userOrder="$userOrder" :product="$product" />
            </div>


            {{-- <div class="dashboard-mobile">
                <button class="dashboard-open">open menu <i class="bi bi-chevron-down"></i> </button>
            </div> --}}
            <div class="dashboard__main">
                <div class="row gx-5">

                    <x-profile.large-sidebar :userGroups="$userGroups" :userDetails="$userDetails" />

                    <div class="col-xl-8">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel"
                                aria-labelledby="v-pills-profile-tab">
                                <x-order-detail :userOrder="$userOrder" :product="$product" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
@endsection
