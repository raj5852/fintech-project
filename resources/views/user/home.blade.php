@extends('layouts.front')
@section('title')
    User Home
@endsection
@section('front_content')
    <x-profile.header>
        @if (session()->has('success'))
            <div class="bredcrumb">
                <h2 class="pt-5">Order Successfully Completed</h2>
                <h3>Here is your product link: </h3><br>
                <ul>
                    @foreach (session()->get('success') as $key => $successMessage)
                        <li>
                            <div>
                                @if (session()->get('successName'))
                                    <p>Name: {{ session()->get('successName')[$key] }} </p>
                                @endif
                                @if (filter_var($successMessage, FILTER_VALIDATE_URL))
                                    <a style="color: #29ffdf;font-weight:bold; text-transform: lowercase;" target="_blank"
                                        href="{{ $successMessage }}">{{ substr($successMessage, 0, 30) }}....</a>
                                @else
                                    <a style="color: #29ffdf;font-weight:bold; text-transform: lowercase;" target="_blank"
                                        href="{{ decrypt($successMessage) }}">{{ substr(decrypt($successMessage), 0, 30) }}....</a>
                                @endif

                            </div>
                        </li><br>
                    @endforeach
                </ul>
                <br><br>
            </div>
        @endif
    </x-profile.header>


    <!-- dashboard  -->

    <div class="dashboard">
        <div class="container">

            {{-- profile  --}}
            <x-profile.profile :userDetails="$userDetails" />




            {{-- mobile side bar  --}}
            <x-profile.mobile-sidebar />

            <div class="mobile-show-content">

                {{-- mobile content  --}}
                <x-profile.content :userDetails="$userDetails" />
            </div>



            {{-- <div class="dashboard-mobile d-none">
                <button class="dashboard-open">open menu <i class="bi bi-chevron-down"></i> </button>
            </div> --}}
            <div class="dashboard__main">
                <div class="row gx-5">

                    {{-- desktop side bar  --}}
                    <x-profile.large-sidebar :userDetails="$userDetails" />



                    <div class="col-md-8">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                aria-labelledby="v-pills-home-tab">

                                {{-- home content  --}}
                                <x-profile.content :userDetails="$userDetails" />
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
