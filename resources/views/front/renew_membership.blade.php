@extends('layouts.front')
@section('title')
    Subscription Plan
@endsection
@section('front_content')
    @push('css')
    @endpush
    <div class="container">
        @include('alert.alert')
    </div>

    <div class="bredcrumb">
        <h2 class="bredcrumb__title">Subscription Plan</h2>
        <ul class="bredcrumb__items">
            <li><a href="{{ route('home') }}">Home</a> <i class="bi bi-chevron-right"></i></li>
            <li>Subscription Plan</li>
        </ul>
    </div>

    <section class="renew-membership-wrap">
        <div class="content">
            <h1 class="__title">Renew Membership</h1>
            <p class="__sub-title">Please enter your details below to complete your purchase. Please enter your details below
                to complete your purchase</p>
            <form method="post" action="{{ route('user.renew-store') }}">
                    @csrf
                <div class="from-picker">
                    <div class="date-month">
                        <div class="_left">
                            <label for="amount">Amount</label>
                            @php
                              $payable =    $membership->monthly_charge == 00 ? $membership->membership_price : $membership->monthly_charge ;
                            @endphp
                            <input class="fields" id="amount" type="number" value="{{ $payable  }}" placeholder="$200" disabled>
                        </div>
                        <div class="_right">
                            <label for="month">{{ $membership->monthly_charge == 0 ? 'Select Year' : 'Select Month' }}
                            </label>
                            <select class="fields" id="month" class="form-select form-select-lg mb-3"
                                aria-label=".form-select-lg example" name="time">

                                <option selected value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>

                        </div>
                    </div>
                    <div class="pic-pay-method">
                        <h1 class="__text">Select Your Payment Method</h1>

                        <div class="contact__form-field-2">
                            <div class="field-two-images add-custom-pay-logo">
                                <span class="payment-select-disabled" data-id="2"
                                    style=" cursor: not-allowed; background:rgb(183, 183, 183) "><img
                                        src="{{ asset('frontend/') }}/img/payments/paypal1.png" alt="Paypal"></span>
                                <span class="payment-select-disabled" data-id="3"
                                    style=" cursor: not-allowed;  background:rgb(183, 183, 183) "><img
                                        src="{{ asset('frontend/') }}/img/payments/visa.png" alt="Strip"></span>
                                <span class="payment-select" data-id="6" style=" cursor: pointer; "><img
                                        src="{{ asset('frontend/binance.png') }}" alt="Binance"
                                        style="max-width: 120px"></span>

                                <span class="payment-select" data-id="5" style=" cursor: pointer; "><img
                                        src="{{ asset('frontend/') }}/img/payments/crypto.png" alt="Now Payment"></span>

                                <span class="payment-select-disabled"
                                    style=" cursor: not-allowed;  background:rgb(183, 183, 183) " data-id="4"
                                    style=" cursor: pointer; "><img src="{{ asset('frontend/') }}/img/payments/others.png"
                                        alt="EdukanPayment"></span>
                                <input type="hidden" class="payment-method" name="payment_method">
                            </div>
                            <button class="common-btn" type="submit">Confirm</button>
                        </div>
                    </div>
            </form>
        </div>

    </section>


    @push('js')
        <script>
            $(".payment-select").click(function() {
                var id = $(this).data('id');
                $(this).addClass('bg-info');
                $('.payment-select').not(this).removeClass('bg-info');
                $(".payment-method").val(id);
            });
            $(".payment-select-disabled").click(function() {
                toastr.error('<h4>The payment method is presently inactive.</h4>');
            });


            $(document).ready(function() {
                $("#month").change(function() {
                    var selectedMonth = $(this).val();
                    var amount = selectedMonth * {{ $payable }};
                    $("#amount").val(amount);
                });
            });
        </script>
        <script>
            document.addEventListener('contextmenu', function(e) {
                e.preventDefault();
            });
        </script>
    @endpush
@endsection
