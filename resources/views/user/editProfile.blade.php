@extends('layouts.front')
@section('title')
    Edit Prfoile
@endsection
@section('front_content')
    <x-profile.header />
    <!-- dashboard  -->

    <div class="dashboard">
        <div class="container">
            <x-profile.profile :userDetails="$userDetails" />

            <!-- mobile version 992px -->
            <x-profile.mobile-sidebar />

            <div class="mobile-show-content">
                <x-profile.edit-profile-content />

            </div>
            <!-- end mobile version 992px -->



            <!-- <div class="dashboard-mobile">
                            <button class="dashboard-open">open menu <i class="bi bi-chevron-down"></i> </button>
                        </div> -->
            <div class="dashboard__main">
                <div class="row gx-5">
                    <x-profile.large-sidebar :userDetails="$userDetails" />

                    <div class="col-xl-8">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-top" role="tabpanel"
                                aria-labelledby="v-pills-top-tab">
                                <x-profile.edit-profile-content />

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
