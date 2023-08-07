@extends('layouts.front')
@section('title')
    Subscription Plan
@endsection
@section('front_content')
    @push('css')
    @endpush



    <div class="bredcrumb">
        <h2 class="bredcrumb__title">Subscription Plan</h2>
        <ul class="bredcrumb__items">
            <li><a href="{{ route('home') }}">Home</a> <i class="bi bi-chevron-right"></i></li>
            <li>Subscription Plan</li>
        </ul>
    </div>


    <!-- pricing area  -->
    <section class="section membership-section membership-section-bottom">
        <div class="container">
            <h2 class="heading center mb-1 text-center">FinTech Membership</h2>
            <p class="text mb-4 text-center">
                Enjoy millions of expert advisors, indicators & more with FinTech
            </p>
            @if (session('error'))
                @push('js')
                    <script>
                        toastr.error('{{ session('error') }}');
                    </script>
                @endpush
            @endif

            <div class="membership membership-plan row g-5">
                @foreach ($memberships as $key => $member)
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                        <div class="membership__item Reseller">
                            <div class="membership__top">
                                <img src="{{ asset('frontend/') }}/img/elite.png"
                                    class="membership__icon membership__icon-1" alt="" />
                                <img src="{{ asset('frontend/') }}/img/elite.png"
                                    class="membership__icon membership__icon-2" alt="" />
                                <h2 class="heading mb-1">{{ $member->membership_name }}</h2>
                                <h3 class="heading d-flex flex-column align-items-center">
                                    {{-- <span class="price">Subscription</span> --}}
                                    <span class="price">$ {{ $member->membership_price }}</span>
                                    <span class="month">Per Month</span>
                                    <span class="month">$ {{ $member->monthly_charge }}</span>
                                </h3>
                            </div>

                            @if ($key == 0)
                                <ul class="membership__list">
                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        @if ($member->expires_at == 1)
                                            <span class="text">Lifetime Membership</span>
                                        @elseif($member->expires_at == 2)
                                            <span class="text">6 Months Membership</span>
                                        @elseif($member->expires_at == 3)
                                            <span class="text">1 Year Membership</span>
                                        @elseif($member->expires_at == 4)
                                            <span class="text">2 Years Membership</span>
                                        @endif
                                    </li>
                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        <span class="text">{{ $member->short }}</span>
                                    </li>


                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        <span class="text">


                                            {{ $member->membership_details }}
                                        </span>

                                    </li>
                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        <span class="text">{{ $member->long }}</span>
                                    </li>



                                </ul>
                            @elseif($key == 3)
                                <ul class="membership__list">
                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        @if ($member->expires_at == 1)
                                            <span class="text">Lifetime Membership</span>
                                        @elseif($member->expires_at == 2)
                                            <span class="text">6 Months Membership</span>
                                        @elseif($member->expires_at == 3)
                                            <span class="text">1 Year Membership</span>
                                        @elseif($member->expires_at == 4)
                                            <span class="text">2 Years Membership</span>
                                        @endif
                                    </li>
                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        <span class="text">{{ $member->short }}</span>
                                    </li>

                                    <li>

                                        <i class="bi bi-check-lg"></i>
                                        <span class="text">


                                            {{ $member->membership_details }}
                                        </span>
                                    </li>
                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        <span class="text">{{ $member->long }}</span>
                                    </li>

                                </ul>
                            @elseif($key == 1)
                                <ul class="membership__list">
                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        @if ($member->expires_at == 1)
                                            <span class="text">Lifetime Membership</span>
                                        @elseif($member->expires_at == 2)
                                            <span class="text">6 Months Membership</span>
                                        @elseif($member->expires_at == 3)
                                            <span class="text">1 Year Membership</span>
                                        @elseif($member->expires_at == 4)
                                            <span class="text">2 Years Membership</span>
                                        @endif
                                    </li>
                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        <span class="text">{{ $member->short }}</span>
                                    </li>
                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        <span class="text">


                                            {{ $member->membership_details }}
                                        </span>


                                    </li>
                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        <span class="text">{{ $member->long }}</span>
                                    </li>
                                </ul>
                            @elseif($key == 2)
                                <ul class="membership__list">
                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        @if ($member->expires_at == 1)
                                            <span class="text">Lifetime Membership</span>
                                        @elseif($member->expires_at == 2)
                                            <span class="text">6 Months Membership</span>
                                        @elseif($member->expires_at == 3)
                                            <span class="text">1 Year Membership</span>
                                        @elseif($member->expires_at == 4)
                                            <span class="text">2 Years Membership</span>
                                        @endif
                                    </li>
                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        <span class="text">{{ $member->short }}</span>
                                    </li>

                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        <span class="text">


                                            {{ $member->membership_details }}
                                        </span>


                                    </li>
                                    <li>
                                        <i class="bi bi-check-lg"></i>
                                        <span class="text">{{ $member->long }}</span>
                                    </li>
                                </ul>
                            @endif
                            <form action="{{ route('subscription.page') }}" method="get">


                                @if ($member->life_time_charge > 0)
                                    <ul class="membership__list">
                                        <li>
                                            <input type="checkbox" name="is_lifetime" value="1">
                                            <span class="text"><b> Lifetime : ${{ $member->life_time_charge }}</b></span>
                                        </li>
                                    </ul>
                                @else
                                    <input type="hidden" name="is_lifetime" value="0">
                                @endif
                                <input type="hidden" name="membershipid" value="{{ $member->id }}">
                                <button type="submit" class="btn btn-membershipt">Purchase</button>
                            </form>

                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>


    @push('js')
    @endpush
@endsection
