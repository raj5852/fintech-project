@extends('layouts.front')
@section('title')
    User Wallet
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
                <x-profile.mywallet-content />
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

                            {{-- wallet start --}}
                            <div class="tab-pane fade show active" id="v-pills-messages" role="tabpanel"
                                aria-labelledby="v-pills-messages-tab">
                                <x-profile.mywallet-content />

                            </div>
                            {{-- wallte end --}}
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
