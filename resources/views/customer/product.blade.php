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
<!-- contact form  -->
<div class="contact__form">
	<div class="container">
		<div class="contact__form-wrapper contact__form-checkout">
			<span class="contact__form-title">Customer  Request Product</span>
			<p class="contact__form-dis">Please confirm your details below to complete your Customer  Request Product</p>
			<div class="contact__form-innerr add_custom_design">
				<div class="contact__form-left">
					<h4 class="checktitle text-center mt-2">Please Choos Your Payment System </h4>
					<form action="{{ url('request-done') }}" method="post">
						@csrf
						<div class="row">
							<div class="col-lg-12">
								<div class="contact__form-field field-2">
									<label>Amount</label>
                                    <input type="hidden" name="orderid" value="{{ encrypt($data->id) }}">
									<input type="number" name="customer_price" min="1"  required>


								</div>
							</div>
						</div>
						<div class="contact__form-field-2">
							<span class="checkout-title">payment method</span>
							<div class="field-two-images">
								<span class="payment-select-disabled" data-id="2" style=" cursor: not-allowed; background:rgb(183, 183, 183) "><img src="{{ asset('frontend/') }}/img/paypal1.png" alt=""></span>
								<span class="payment-select-disabled" data-id="3" style=" cursor: not-allowed; background:rgb(183, 183, 183) "><img src="{{ asset('frontend/') }}/2.png" width="80" alt=""></span>
								<span class="payment-select" data-id="1" style=" cursor: pointer; "><img src="{{ asset('frontend/') }}/5.png" height="50px;" width="100px;" alt=""></span>
                                <span class="payment-select" data-id="8" style=" cursor: pointer; "><img src="{{asset('frontend/binance.png')}}" style="max-width: 120px" alt="Binance"></span>

								<span class="payment-select" data-id="7" style=" cursor: pointer; "><img src="{{ asset('frontend/') }}/checkoutImage/crypto.png" height="50px;" width="100px;" alt="NowPayment"></span>
								<span class="payment-select-disabled" data-id="6" style=" cursor: not-allowed; background:rgb(183, 183, 183);  "><img src="{{ asset('frontend/') }}/checkoutImage/othres.png" height="50px;" width="100px;" alt="EdokanPayment"></span>
								<input type="hidden" class="payment-method" name="payment_method">
							</div>
							<div class="d-flex justify-content-center"><button class="common_btn" type="submit">Confirm</button></div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@push('js')
<script>
	$(".payment-select").click(function(){
		var id = $(this).data('id');
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


    const quantityInput = document.querySelector('input[name="customer_price"]');
            quantityInput.addEventListener('input', function() {
                if (this.value < 0) {

                    toastr.error('<h4>Amount cannot be negative.</h4>');

                }
            });

</script>
@endpush
@endsection
