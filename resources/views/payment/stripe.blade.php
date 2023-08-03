<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

<div class="container">

    <h1 class="text-center">Stripe @if($type == "payment") Payment
                                   @elseif($type == "subscribe") Subscription
                                   @else Recharge
                                   @endif</h1>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table" >
                        <h3 class="panel-title" ><img style="float:right;" src="{{ asset('frontend/') }}//2.png" height="30"> Payment Details</h3>
                </div>
                <div class="panel-body">

                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif

                    <form role="form" action="{{ route('stripe.payment') }}" method="post" >
                        @csrf
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Name on Card</label> <input
                                    class='form-control' required name="fullName" size='4' type='text'>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>Card Number</label> <input
                                    autocomplete='off' required name="cardNumber" class='form-control card-number' size='20'
                                    type='text'>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVC</label> <input autocomplete='off'
                                    class='form-control card-cvc' required name="cvc" placeholder='ex. 311' size='4'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Month</label> <input
                                    class='form-control card-expiry-month' required name="month" placeholder='MM' size='2'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Year</label> <input
                                    class='form-control card-expiry-year' required placeholder='YYYY' size='4'
                                    type='text' name="year">
                            </div>
                        </div>
                        <input type="hidden" name="qty" readonly value="{{ $type == 'payment' ? $data['qty'] :''  }}">
                        <div class='form-row row'>
                            <div class='col-md-12 error form-group hide'>
                                <div class='alert-danger alert'>Please correct the errors and try
                                    again.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                @if($type == 'payment')
                                    <input type="hidden" name="name" readonly value="{{ Auth::user()->name }}">
                                    <input type="hidden" name="email" readonly value="{{ Auth::user()->email }}">
                                    <input type="hidden" name="phone" readonly value="{{ Auth::user()->phone }}">
                                    <input type="hidden" name="qty" readonly value="{{ $type == 'payment' ? $data['qty'] :''  }}">
                                    {{-- <input type="hidden" name="price" readonly value="{{ $type == 'payment' ? number_format($data['price'] , 2) :''}}"> --}}
                                    <input type="hidden" name="price" readonly value="{{ $type == 'payment' ?  $data['price'] :'' }}">
                                    <input type="hidden" name="order_no" readonly value="{{ $type == 'payment' ? date('ymdhis') :'' }}">
                                    <input type="hidden" name="type" readonly value="payment">

                                    <input type="hidden" name="subscribe_id" readonly value="{{ $type == 'payment' ? $data['subscribe_id'] :''  }}">

                                    @foreach($data['product_url'] as $key=> $link)
                                    <input type="hidden" name="product_url[]" value="{{ $type == 'payment' ? $link :'' }}">
                                    <input type="hidden" name="product_name[]" value="{{ $type == 'payment' ? $data['product_name'][$key] :'' }}">
                                    <input type="hidden" name="product_qty[]" value="{{ $type == 'payment' ? $data['product_qty'][$key]  :''}}">
                                    <input type="hidden" name="unit_price[]" value="{{ $type == 'payment' ? $data['unit_price'][$key] :'' }}">
                                    <input type="hidden" name="product_id[]" value="{{ $type == 'payment' ? $data['product_id'][$key] :'' }}">
                                    @endforeach
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now (${{ $data['price'] }})</button>
                                @elseif($type == 'recharge')
                                    <input type="hidden" name="amount" readonly value="{{ number_format($data['amount'] , 2) }}">
                                    <input type="hidden" name="type" readonly value="recharge">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Recharge Now (${{ $data['amount'] }})</button>
                                @elseif($type == 'subscribe')
                                    @if($data['is_lifetime'])
                                    <input type="hidden" name="total_subscription_fee" value="{{ $data['total_subscription_fee'] }}" readonly>
                                    <input type="hidden" name="is_lifetime" value="{{ $data['is_lifetime'] }}">
                                    @else
                                    <input type="hidden" name="total_subscription_fee" value="{{ $data['total_subscription_fee'] }}" readonly >
                                    <input type="hidden" name="is_lifetime" value="{{ $data['is_lifetime'] }}">
                                    @endif
                                    <input type="hidden" name="total_month" value="{{ $data['total_month']   }}">
                                    <input type="hidden" name="subscribe_fee" value="{{ $data['subscribe_fee'] }}" readonly>
                                    <input type="hidden" name="monthly_charge" value="{{ $data['monthly_charge'] }}" readonly value="">
                                    <input type="hidden" name="subscribe_id" value="{{ $data['subscribe_id'] }}">
                                    <input type="hidden" name="expired" value="{{ $data['expired'] }}">
                                    <input type="hidden" name="type" readonly value="subscribe">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now (${{ $data['total_subscription_fee'] }})</button>


                                @elseif ($type=='requestbooking')


                                <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now (${{ $data['customer_price'] }}) </button>

                                @endif
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <img src="{{ asset('frontend/') }}/2.png">
        <img src="{{ asset('frontend/') }}/2.png">
    </div>

</div>

<script>
    document.addEventListener('contextmenu', function(e) {
      e.preventDefault();
    });
</script>

</body>

</html>
