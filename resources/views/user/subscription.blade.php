@extends('layouts.front')
@section('title')
    Subscription Checkout
@endsection
@section('front_content')
    @push('css')
    @endpush
    <div class="container">
        @include('alert.alert')
    </div>
    @php
        $membership = App\Models\Admin\Membership::find($data['membershipid']);
    @endphp
    <!-- contact form  -->
    <div class="contact__form">
        <div class="container">
            {{-- // code  --}}

            <div class="contact__form-wrapper contact__form-checkout">
                <span class="contact__form-title">Subscription checkout</span>
                <p class="contact__form-dis">Please confirm your details below to complete your subscription</p>
                <div class="contact__form-innerr add_custom_design">
                    <div class="contact__form-left">
                        <h4 class="checktitle text-center mt-2">Please Choos Your Payment System </h4>
                        <form action="{{ route('subscription') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col contact__form-field field-2">

                                            <label>Amount</label>
                                            @if ($data['is_lifetime'] ?? 0 == 1)
                                                <input type="number" style="font-size: 16px" name="total_subscription_fee"
                                                    id="total_subscription_fee" value="{{ $membership->life_time_charge }}"
                                                    readonly>
                                            @else
                                                <input type="number" style="font-size: 16px" name="total_subscription_fee"
                                                    id="total_subscription_fee"
                                                    value="{{ $membership->membership_price + $membership->monthly_charge }}"
                                                    readonly>
                                            @endif
                                            <input type="hidden" value="{{ $membership->monthly_charge }}"
                                                id="monthly_charge">
                                            <input type="hidden" name="membership_id"
                                                value="{{ ($membership->id) }}">
                                            <input type="hidden" name="is_lifetime"
                                                value="{{ $data['is_lifetime'] ?? 0 }}">
                                        </div>


                                        @if ($membership->monthly_charge > 0)
                                            @if ($data['is_lifetime'] ?? 0 == 1)
                                            @else
                                                <div class="col contact__form-field field-2">
                                                    <label>Select Month</label>
                                                    <div class="d-flex">
                                                        <button id="decrement" type="button" class="common_btn">-</button>
                                                        <input style="font-size: 16px" id="monthValue" class="form-control"
                                                            type="number" value="1" readonly name="total_month">
                                                        <button id="increment" class="common_btn" type="button">+</button>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif


                                    </div>


                                </div>
                            </div>


                            <div class="contact__form-field-2">
                                <span class="checkout-title">payment method</span>
                                <div class="field-two-images">
                                    {{-- <span class="payment-select" data-id="1" style=" cursor: pointer; "><img src="{{ asset('frontend/') }}/img/bank.png" width="40" alt=""></span> --}}
                                    <span class="payment-select-disabled" data-id="2"
                                        style=" cursor: not-allowed; background:rgb(183, 183, 183) "><img
                                            src="{{ asset('frontend/') }}/img/paypal1.png" alt="Paypal"></span>
                                    <span class="payment-select-disabled" data-id="3"
                                        style=" cursor: not-allowed; background:rgb(183, 183, 183) "><img
                                            src="{{ asset('frontend/') }}/2.png" width="80" alt="Strip"></span>

                                    <span class="payment-select" data-id="8" style=" cursor: pointer; "><img
                                            src="{{ asset('frontend/binance.png') }}" style="max-width: 120px"
                                            alt="Binance"></span>

                                    <span class="payment-select" data-id="7" style=" cursor: pointer; "><img
                                            src="{{ asset('frontend/') }}/payment/crypto.png" height="50px;" width="100px;"
                                            alt="NowPayment"></span>
                                    <span class="payment-select" data-id="1" style=" cursor: pointer; "><img
                                            src="{{ asset('frontend/') }}/5.png" height="50px;" width="100px;"
                                            alt=""></span>

                                    <span class="payment-select-disabled" data-id="6"
                                        style=" cursor: not-allowed; background:rgb(183, 183, 183) "><img
                                            src="{{ asset('frontend/') }}/payment/others.png" height="50px;" width="100px;"
                                            alt="EdokanPayment"></span>
                                    <input type="hidden" class="payment-method" name="payment_method">
                                </div>
                                <div class="d-flex justify-content-center"><button class="common_btn"
                                        type="submit">Confirm</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



        </div>

    </div>

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


            $("#increment").click(function() {
                var total_subscription_fee = parseInt($("#total_subscription_fee").val());

                var monthly_charge = parseInt($("#monthly_charge").val());

                $("#total_subscription_fee").val(total_subscription_fee + monthly_charge)

                var currentValue = parseInt($('#monthValue').val());
                $('#monthValue').val(currentValue + 1);

            });
            $("#decrement").click(function() {

                if (parseInt($('#monthValue').val()) != 1) {

                    var total_subscription_fee = parseInt($("#total_subscription_fee").val());
                    var monthly_charge = parseInt($("#monthly_charge").val());

                    $("#total_subscription_fee").val(total_subscription_fee - monthly_charge)


                    var currentValue = parseInt($('#monthValue').val());
                    $('#monthValue').val(currentValue - 1);
                }

            });
        </script>
        <script>
            document.addEventListener('contextmenu', function(e) {
                e.preventDefault();
            });
        </script>
    @endpush
@endsection
