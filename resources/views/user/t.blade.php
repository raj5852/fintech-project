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
                                @if ($data['is_lifetime'])
                                    <input type="number" name="total_subscription_fee"
                                        value="{{ $data['life_time_charge'] }}" readonly>
                                    <input type="hidden" name="is_lifetime" value="{{ $data['is_lifetime'] }}">
                                @else
                                    <input type="number" name="total_subscription_fee"
                                        value="{{ $data['total_subscription_fee'] }}"
                                        id="total_subscription_fee" readonly>
                                    <input type="hidden" name="is_lifetime" value="{{ $data['is_lifetime'] }}">
                                @endif
                            </div>
                            @if ($data['is_lifetime'] > 0)
                                <input id="monthValue" class="form-control" type="hidden" value="1"
                                    readonly name="total_month">
                            @endif

                            @if ($data['is_lifetime'] == 0)
                                @if ($data['monthly_charge'] > 0)
                                    <div class="col contact__form-field field-2">
                                        <label>Select Month</label>
                                        <div class="d-flex">
                                            <button id="decrement" type="button" class="common_btn">-</button>

                                            <input id="monthValue" class="form-control" type="number"
                                                value="1" readonly name="total_month">
                                            <button id="increment" class="common_btn" type="button">+</button>
                                        </div>
                                    </div>
                                @else
                                    <input id="monthValue" class="form-control" type="hidden" value="1000"
                                        readonly name="total_month">
                                @endif
                            @endif

                        </div>

                        <input type="hidden" name="subscribe_fee" value="{{ $data['subscription_fee'] }}"
                            readonly>
                        <input type="hidden" name="monthly_charge" id="monthly_charge"
                            value="{{ $data['monthly_charge'] }}" readonly>
                        <input type="hidden" name="subscribe_id" value="{{ $data['subscribe_id'] }}">
                        <input type="hidden" name="expired" value="{{ $data['expired'] }}"><br><br>

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
                        {{-- <span class="payment-select" data-id="4" style=" cursor: pointer; "><img src="{{ asset('frontend/') }}/img/bitcoin1.png" alt=""></span> --}}

                        <span class="payment-select" data-id="7" style=" cursor: pointer; "><img
                                src="{{ asset('frontend/') }}/payment/crypto.png" height="50px;" width="100px;"
                                alt="NowPayment"></span>
                        <span class="payment-select" data-id="1" style=" cursor: pointer; "><img
                                src="{{ asset('frontend/') }}/5.png" height="50px;" width="100px;"
                                alt=""></span>

                        <span class="payment-select" data-id="6" style=" cursor: pointer; "><img
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
