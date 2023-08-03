@extends('layouts.front')
@section('title')
    Recharge Now
@endsection
@section('front_content')
    @push('css')
    @endpush
    <div class="container">
        @include('alert.alert')
    </div>
    <!-- contact form  -->
    <div class="contact__form">
        <div class="container">
            <div class="contact__form-wrapper contact__form-checkout">
                <span class="contact__form-title">Recharge</span>
                <p class="contact__form-dis">Please enter amount to confirm recharge. Recharge amount will deduct your
                    payment account !</p>
                <div class="contact__form-innerr d-flex justify-content-center">
                    <div class="contact__form-left">
                        <!-- <h4 class="checktitle">Please Choos Your Payment System </h4> -->
                        <form action="{{ route('recharge') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="contact__form-field field-2">
                                        <label>Amount</label>
                                        <input  class="input-control-ibx"  type="number" name="amount" min="5" placeholder="Enter Amount"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="contact__form-field-2 ">
                                <span class="checkout-title">payment method</span>
                                <div class="field-two-images add-custom-pay-logo recharge-abx">
                                    <span class="payment-select-disabled" data-id="2"
                                        style=" cursor: not-allowed; background:rgb(183, 183, 183) "><img
                                            src="{{ asset('frontend/') }}/img/payments/paypal1.png" alt="Paypal"></span>
                                    <span class="payment-select-disabled" data-id="3"
                                        style=" cursor: not-allowed;  background:rgb(183, 183, 183) "><img
                                            src="{{ asset('frontend/') }}/img/payments/visa.png" alt="Strip"></span>
                                    <span class="payment-select"  data-id="6" style=" cursor: pointer; "><img
                                        src="{{asset('frontend/binance.png')}}"
                                        alt="Binance" style="max-width: 120px"></span>

                                    <span class="payment-select" data-id="5" style=" cursor: pointer; "><img
                                            src="{{ asset('frontend/') }}/img/payments/crypto.png" alt="Now Payment"></span>

                                    <span class="payment-select-disabled" style=" cursor: not-allowed;  background:rgb(183, 183, 183) " data-id="4" style=" cursor: pointer; "><img
                                            src="{{ asset('frontend/') }}/img/payments/others.png"
                                            alt="EdukanPayment"></span>



                                    <input type="hidden" class="payment-method" name="payment_method">
                                </div>
                                <button class="common-btn"type="submit">Recharge</button>
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
        </script>
        <script>
            document.addEventListener('contextmenu', function(e) {
                e.preventDefault();
            });

            const quantityInput = document.querySelector('input[name="amount"]');
            quantityInput.addEventListener('input', function() {
                if (this.value < 0) {

                    toastr.error('<h4>Amount cannot be negative.</h4>');

                }
            });
        </script>
    @endpush
@endsection
