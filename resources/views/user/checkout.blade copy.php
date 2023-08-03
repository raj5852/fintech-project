@php
  $userDetails= App\Models\User::where('email',Auth::user()->email)->first();
@endphp
@extends('layouts.front')

@section('front_content')
@push('css')

@endpush
<div class="container">
	@include('alert.alert')
</div>




<div class="contact__form">
    <div class="container">
        <div class="contact__form-wrapper contact__form-checkout">
            <span class="contact__form-title">checkout</span>
            <p class="contact__form-dis">Please enter your details below to complete your purchase</p>
            <form action="{{ route('checkout') }}" method="post">
            <div class="contact__form-innerr">
                <div class="contact__form-left">
                    <h4 class="checktitle">your details</h4>

                        @csrf
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="contact__form-field field-2">
                                    <label>Name<span>*</span></label>
                                    <input type="email" name="name" value="{{ Auth::user()->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="contact__form-field field-2">
                                    <label>Email here*<span>*</span></label>
                                    <input type="email" name="email" value="{{ Auth::user()->email }}">
                                </div>
                            </div>
                        </div>
                        <div class="contact__form-field field-2">
                            <label>customer type <span>*</span> </label>



                            <input type="text" name="subscribe_id" @if(!empty($userDetails->subscribe_id)) value="{{$userDetails->member->membership_name}}" @else value="General  Member" @endif>
                        </div>

                        <div class="col-md-6">
                            <div class="form-check form-switch">
                               <input class="form-input invisible" type="text"  name="email_colleted" value="0" id="invisible_filed">

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-check form-switch">
                               <input class="form-check-input" type="checkbox"  id="on_off" value="0" >
                                <p style="text-align:left">Would like to recive exclusive emails with discounts and product information (Optional) </p>
                            </div>
                        </div>

                </div>
                <script>
                    const value = document.querySelector('#on_off')
                    const invisible_filed = document.querySelector('#invisible_filed')

                    value.addEventListener('click',()=>{
                        const result =value.checked
                        if (result===true) {
                            value.setAttribute("value",1)
                            invisible_filed.setAttribute("value",1)


                        }else{
                            value.setAttribute("value",0)
                            invisible_filed.setAttribute("value",0)


                        }

                    })
                </script>


                {{-- <input type="hidden" name="price" readonly value="{{ number_format($data['price'] , 2) }}"> --}}
                <input type="hidden" name="price" readonly value="{{ $data['price'] , 2 }}">
                <input type="hidden" name="qty" readonly value="{{ $data['qty'] }}">
                <input type="hidden" name="order_no" readonly value="{{ date('ymdhis') }}">
                @foreach($data['url'] as $key=> $product)

                <input type="hidden" name="product_url[]" value="{{ $product }}">
                <input type="hidden" name="product_name[]" value="{{ $data['product_name'][$key] }}">
                <input type="hidden" name="product_qty[]" value="{{ $data['product_qty'][$key] }}">
                <input type="hidden" name="unit_price[]" value="{{ $data['unit_price'][$key] }}">
                <input type="hidden" name="product_id[]" value="{{ $data['product_id'][$key]}}">
                @endforeach


                <div class="contact__form-right">
                    <div class="cart__area-right add-shadow">
                        <div class="cart__area-innerright">
                            <h4 class="text-capitalize">cart total</h4>
                        <div class="checkout_subtotal">
                            <span>subtotal</span>

                            <span>

                                ${{$data['price'] , 2}}
                            </span>



                        </div>
                        <div class="checkout_total">
                            <span>total</span>

                            <span>${{$data['price'] , 2}}</span>
                        </div>
                        <p class="payment-select-title">Select your payment method</p>
                        </div>
                        <div class="payment-logos">
                            <label class="img-btn" for="payment-input">
                            	<span class="payment-select" data-id="2" style=" cursor: pointer; "><img src="{{ asset('frontend/') }}/img/paypal1.png" alt="Payal"></span>
                            </label>
                            <input type="radio" id="payment-input" name="method" value="2" >
                            <div class="selected-bg"></div>
                        </div>

                        <div class="payment-logos">
                            <label style="overflow: hidden;" class="img-btn" for="payment-input3">

                                <span class="payment-select" data-id="3" style=" cursor: pointer; ">
                                    <img src="{{ asset('frontend/') }}/2.png"  alt="Strip" style="height: 30px;"></span>
                            </label>
                            <input type="radio" id="payment-input3" name="method" value="3">
                            <div class="selected-bg"></div>
                        </div>

                        <div class="payment-logos">
                            <label class="img-btn" for="payment-input6">
                                <span class="payment-select" data-id="6" style=" cursor: pointer; "><img src="{{ asset('frontend/') }}/payment/others.png" alt="edokanpay" style="height: 30px;"></span>
                            </label>
                            <input type="radio" id="payment-input6" name="method" style="visibility:hidden" value="6">
                            <div class="selected-bg"></div>
                        </div>

                        <div class="payment-logos">
                            <label class="img-btn" for="payment-input7">
                                <span class="payment-select" data-id="7" style=" cursor: pointer; "><img src="{{ asset('frontend/') }}/payment/crypto.png" alt="Nowpayment" style="height: 30px;"></span>
                            </label>
                            <input type="radio" id="payment-input7" name="method" style="visibility:hidden" value="7">
                            <div class="selected-bg"></div>
                        </div>



                        <div class="payment-logos">
                            <label class="img-btn" for="payment-input5">
                                <span class="payment-select" data-id="1" style=" cursor: pointer; "><img src="{{ asset('frontend/') }}/5.png" style="height: 30px;" alt="Wallate"></span>
                            </label>
                            <input type="radio" id="payment-input1" style="visibility:hidden" name="method" value="1">
                            <div class="selected-bg"></div>
                        </div>
                        <input type="hidden" class="payment-method" name="payment_method">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center my-4">
            <button class="common_btn " type="submit"><span class="px-4">Order Place</span></button>
            </div>
        </div>
    </form>
    </div>
</div>
@push('js')
<script>
	$(".payment-select").click(function(){
		var id = $(this).data('id');
        console.log(id);
		$(this).addClass('bg-info');
		$('.payment-select').not(this).removeClass('bg-info');
		$(".payment-method").val(id);
	});
</script>
<script>
    document.addEventListener('contextmenu', function(e) {
      e.preventDefault();
    });
</script>
@endpush
@endsection
