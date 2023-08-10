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
                                    <input type="email" name="name" class="input-control-ibx" value="{{ Auth::user()->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="contact__form-field field-2">
                                    <label>Email here*<span>*</span></label>
                                    <input  class="input-control-ibx"  type="email" name="email" value="{{ Auth::user()->email }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="contact__form-field field-2">
                            <label>customer type <span>*</span> </label>



                            <input type="text"  class="input-control-ibx"  name="subscribe_id" @if(!empty($userDetails->subscribe_id)) value="{{$userDetails->member->membership_name}}" @else value="General  Member" @endif readonly>
                        </div>

                        <div class="col-md-6">
                            <div class="form-check form-switch">
                               <input class="form-input invisible" type="text"  name="email_colleted" value="0" id="invisible_filed">

                            </div>
                        </div>

                        <div class="col-md-12 login-page">
                            <div class="form-check form-switch custom_change_switch">
                                <input class="form-check-input" type="checkbox" id="on_off" value="0">
                                <label class="form-check-label" for="on_off">Would like to recive exclusive emails with discounts and product information (Optional)  </label>
                            </div>
                        </div>

                        <!-- <div class="col-md-12">
                            <div class="form-check form-switch">
                               <input class="form-check-input" type="checkbox"  id="on_off" value="0" >
                                <p style="text-align:left">Would like to recive exclusive emails with discounts and product information (Optional) </p>
                            </div>
                        </div> -->

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

                <div class="contact__form-right">
                    <div class="cart__area-right add-shadow">
                        <div class="cart__area-innerright">
                            <h4 class="text-capitalize">cart total</h4>
                        <div class="checkout_subtotal x">
                            <span class="__tx">subtotal</span>

                            <span class="__tx">

                                ${{$totalProductAmount }}
                            </span>



                        </div>
                        <div class="checkout_total">
                            <span class="__tx">total</span>

                            <span class="__tx">$ {{$totalProductAmount}} </span>
                        </div>
                        </div>


                        <div>
                            <div class="items-dp">
                                <div class="dropdown">
                                    <button
                                        id="db-filter-button-A1-Admin-das"
                                        class="dropdown-toggle dropdown-btn-change-text"
                                        type="button"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                    >
                                        <!-- <span class="icon-left"></span> -->
                                        <span class="btn-text">Select your payment method</span>
                                        <span class="icon-right"><i class="fa-solid fa-angle-down"></i></span>
                                    </button>
                                    <ul
                                        class="dropdown-menu"
                                        id="db-filter-items-A1-Admin-das"
                                    >

                                        <li class="list-pay-drop">
                                            <span class="dropdown-item ab-x">Select your payment method</span>
                                        </li>
                                        <li class="list-pay-drop">
                                            <div class="payment-logos">
                                                <label class="img-btn" for="payment-input2" style=" border:none">
                                                    <span class="payment-select-disabled" data-id="2" style=" cursor: not-allowed; background:rgb(183, 183, 183); display:flex; width: 100%; justify-content: center; align-items: center; height: 100%; border-radius: 10px;"> <span class="dropdown-item">Paypal</span><img src="{{ asset('frontend/') }}/checkoutImage/paypal1.png" alt="Paypal" style="height: 30px;"></span>
                                                </label>
                                                <input type="radio" id="payment-input2" name="method" style="visibility:hidden" value="2">
                                                <div class="selected-bg"></div>
                                            </div>
                                         </li>
                                        <li class="list-pay-drop">
                                            <div class="payment-logos">
                                                <label class="img-btn" for="payment-input2" style=" border:none">
                                                    <span class="payment-select-disabled" data-id="3" style=" cursor: not-allowed; background:rgb(183, 183, 183); display:flex; width: 100%; justify-content: center; align-items: center; height: 100%; border-radius: 10px;">
                                                    <span class="dropdown-item">Visa</span>
                                                        <img src="{{ asset('frontend/') }}/checkoutImage/visa.png" alt="visa">
                                                    </span>
                                                </label>
                                                <input type="radio" id="payment-input" name="method" value="3" >
                                                <div class="selected-bg"></div>
                                            </div>
                                         </li>
                                        <li class="list-pay-drop">
                                            <div class="payment-logos">
                                                <label class="img-btn" for="payment-input8" style=" border:none">
                                                    <span class="payment-select" data-id="8" style=" cursor: pointer; display:flex; width: 100%; justify-content: center; align-items: center; height: 100%; border-radius: 10px;"><span class="dropdown-item">Binance</span><img src="{{asset('frontend/binance.png')}}" alt="Nowpayment" style="height: 30px;"></span>
                                                </label>
                                                <input type="radio" id="payment-inpu8" name="method" style="visibility:hidden" value="8">
                                                <div class="selected-bg"></div>
                                            </div>
                                         </li>
                                        <li class="list-pay-drop">
                                            <div class="payment-logos">
                                                <label class="img-btn" for="payment-input7" style=" border:none">
                                                    <span class="payment-select" data-id="7" style=" cursor: pointer; display:flex; width: 100%; justify-content: center; align-items: center; height: 100%; border-radius: 10px;"><span class="dropdown-item">Crypto</span><img src="{{ asset('frontend/') }}/checkoutImage/crypto.png" alt="Nowpayment" style="height: 30px;"></span>
                                                </label>
                                                <input type="radio" id="payment-input7" name="method" style="visibility:hidden" value="7">
                                                <div class="selected-bg"></div>
                                            </div>
                                         </li>
                                        <li class="list-pay-drop">
                                            <div class="payment-logos">
                                                <label class="img-btn" for="payment-input5" style=" border:none">
                                                    <span class="payment-select" data-id="1" style=" cursor: pointer; display:flex; width: 100%; justify-content: center; align-items: center; height: 100%; border-radius: 10px;"><span class="dropdown-item">My-Wallet</span><img src="{{ asset('frontend/') }}/checkoutImage/my-wallet.png" style="height: 30px;" alt="Wallate"></span>
                                                </label>
                                                <input type="radio" id="payment-input1" style="visibility:hidden" name="method" value="1">
                                                <div class="selected-bg"></div>
                                            </div>
                                         </li>
                                        <li class="list-pay-drop">
                                            <div class="payment-logos">
                                                <label class="img-btn" for="payment-input6" style=" border:none">
                                                    <span class="payment-select-disabled"   data-id="6" style="cursor: not-allowed; background:rgb(183, 183, 183); cursor: pointer; display:flex; width: 100%; justify-content: center; align-items: center; height: 100%; border-radius: 10px;"><span class="dropdown-item">Other</span><img src="{{ asset('frontend/') }}/checkoutImage/othres.png" alt="edokanpay" style="height: 30px;"></span>
                                                </label>
                                                <input type="radio" id="payment-input6" name="method" style="visibility:hidden" value="6">
                                                <div class="selected-bg"></div>
                                            </div>
                                         </li>




                                    </ul>
                                </div>
                            </div>

                            <script>
                                const dropdownButtons = document.querySelectorAll('.dropdown-toggle');
                                const dropdownItems = document.querySelectorAll(
                                    '.dropdown-menu .dropdown-item'
                                );

                                // Add click event listeners to each dropdown item
                                dropdownItems.forEach((item) => {
                                    item.addEventListener('click', () => {
                                        // Get the selected value
                                        const selectedValue = item.textContent;

                                        // Get the corresponding dropdown button
                                        const buttonId = item
                                            .closest('.dropdown-menu')
                                            .id.replace('db-filter-items-', 'db-filter-button-');
                                        const button = document.getElementById(buttonId);

                                        // Set the button text to the selected value
                                        button.querySelector('.btn-text').textContent = selectedValue;
                                    });
                                });
                            </script>
                        </div>





                        <div style="display:none !important" class="payment-logos">
                            <label class="img-btn" for="payment-input2" style=" border:none">
                                <span class="payment-select-disabled" data-id="2" style=" cursor: not-allowed; background:rgb(183, 183, 183); display:flex; width: 100%; justify-content: center; align-items: center; height: 100%; border-radius: 10px;"><img src="{{ asset('frontend/') }}/checkoutImage/paypal1.png" alt="Paypal" style="height: 30px;"></span>
                            </label>
                            <input type="radio" id="payment-input2" name="method" style="visibility:hidden" value="2">
                            <div class="selected-bg"></div>
                        </div>


                        <div style="display:none !important" class="payment-logos">
                            <label class="img-btn" for="payment-input2" style=" border:none">
                            	<span class="payment-select-disabled" data-id="3" style=" cursor: not-allowed; background:rgb(183, 183, 183); display:flex; width: 100%; justify-content: center; align-items: center; height: 100%; border-radius: 10px;">
                                    <img src="{{ asset('frontend/') }}/checkoutImage/visa.png" alt="visa">
                                </span>
                            </label>
                            <input type="radio" id="payment-input" name="method" value="3" >
                            <div class="selected-bg"></div>
                        </div>


                        <div style="display:none !important" class="payment-logos">
                            <label class="img-btn" for="payment-input8" style=" border:none">
                                <span class="payment-select" data-id="8" style=" cursor: pointer; display:flex; width: 100%; justify-content: center; align-items: center; height: 100%; border-radius: 10px;"><img src="{{asset('frontend/binance.png')}}" alt="Nowpayment" style="height: 30px;"></span>
                            </label>
                            <input type="radio" id="payment-inpu8" name="method" style="visibility:hidden" value="8">
                            <div class="selected-bg"></div>
                        </div>

                        <div style="display:none !important" class="payment-logos">
                            <label class="img-btn" for="payment-input7" style=" border:none">
                                <span class="payment-select" data-id="7" style=" cursor: pointer; display:flex; width: 100%; justify-content: center; align-items: center; height: 100%; border-radius: 10px;"><img src="{{ asset('frontend/') }}/checkoutImage/crypto.png" alt="Nowpayment" style="height: 30px;"></span>
                            </label>
                            <input type="radio" id="payment-input7" name="method" style="visibility:hidden" value="7">
                            <div class="selected-bg"></div>
                        </div>

                        <div style="display:none !important" class="payment-logos">
                            <label class="img-btn" for="payment-input5" style=" border:none">
                                <span class="payment-select" data-id="1" style=" cursor: pointer; display:flex; width: 100%; justify-content: center; align-items: center; height: 100%; border-radius: 10px;"><img src="{{ asset('frontend/') }}/checkoutImage/my-wallet.png" style="height: 30px;" alt="Wallate"></span>
                            </label>
                            <input type="radio" id="payment-input1" style="visibility:hidden" name="method" value="1">
                            <div class="selected-bg"></div>
                        </div>

                        <div style="display:none !important" class="payment-logos">
                            <label class="img-btn" for="payment-input6" style=" border:none">
                                <span class="payment-select-disabled"   data-id="6" style="cursor: not-allowed; background:rgb(183, 183, 183); cursor: pointer; display:flex; width: 100%; justify-content: center; align-items: center; height: 100%; border-radius: 10px;"><img src="{{ asset('frontend/') }}/checkoutImage/othres.png" alt="edokanpay" style="height: 30px;"></span>
                            </label>
                            <input type="radio" id="payment-input6" name="method" style="visibility:hidden" value="6">
                            <div class="selected-bg"></div>
                        </div>

                        <input type="hidden" class="payment-method" name="payment_method">
                    </div>
                </div>
            </div>
            <div class="order-place-sub-btn">
            <button class="common-btn " type="submit"><span class="px-4">Order Place</span></button>
            </div>
        </div>
    </form>
    </div>
</div>
@push('js')
<script>
	$(".payment-select").click(function(){
		var id = $(this).data('id');
        // console.log(id);
		$(this).addClass('bg-info');
		$('.payment-select').not(this).removeClass('bg-info');
		$(".payment-method").val(id);
	});
    $(".payment-select-disabled").click(function(){
		toastr.error('<h4>The payment method is presently inactive.</h4>');
	});

</script>
<script>
    document.addEventListener('contextmenu', function(e) {
      e.preventDefault();
    });
</script>
@endpush
@endsection
