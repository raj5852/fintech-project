<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Paypal</title>
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha256-YLGeXaapI0/5IgZopewRJcFXomhRMlYYjugPLSyNjTY=" crossorigin="anonymous" />

  <!-- Styles -->

  <style>
    html,
    body {
      background-color: #fff;
      color: #636b6f;
      font-family: 'Nunito', sans-serif;
      font-weight: 200;
      height: 100vh;
      margin: 0;
    }

    .content {
      margin-top: 100px;
      text-align: center;
    }
  </style>
</head>

<body>

  <div class="flex-center position-ref full-height">
    <div class="content">
      <table border="0" cellpadding="10" cellspacing="0" align="center">
        <tr>
          <td align="center"></td>
        </tr>
        <tr>
          <td align="center">
            <a href="https://www.paypal.com/in/webapps/mpp/paypal-popup" title="How PayPal Works"
              onclick="javascript:window.open('https://www.paypal.com/in/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;"><img
                src="https://www.paypalobjects.com/webstatic/mktg/Logo/pp-logo-200px.png" border="0"
                alt="PayPal Logo"></a>
          </td>
        </tr>
      </table>
      <form action="{{ route('processTransaction') }}" method="get">
        @csrf




        @if($type == 'payment')
          <input type="hidden" name="name" readonly value="{{ Auth::user()->name }}">

          <input type="hidden" name="email" readonly value="{{ $type == 'payment' ? $data['email'] :''  }}">
          <input type="hidden" name="phone" readonly value="{{ Auth::user()->phone }}">
          <input type="hidden" name="subscribe_id" readonly value="{{ $type == 'payment' ? $data['subscribe_id'] :''  }}">

           <input type="hidden" name="email_colleted" readonly value="{{ $type == 'payment' ? $data['email_colleted'] :''  }}">







          {{-- return condition1 ? value1 : condition2 ? value2 : condition3 ? value3 : value4; --}}

          <input type="hidden" name="qty" readonly value="{{ $type == 'payment' ? $data['qty'] :''  }}">
          {{-- <input type="hidden" name="price" readonly value="{{ $type == 'payment' ? number_format($data['price'] , 2) :''}}"> --}}
          <input type="hidden" name="price" readonly value="{{ $type == 'payment' ?  $data['price'] :'' }}">
          <input type="hidden" name="order_no" readonly value="{{ $type == 'payment' ? date('ymdhis') :'' }}">
          <input type="hidden" name="type" readonly value="payment">

          @foreach($data['product_url'] as $key=> $link)
          <input type="hidden" name="product_url[]" value="{{ $type == 'payment' ? $link :'' }}">
          <input type="hidden" name="product_name[]" value="{{ $type == 'payment' ? $data['product_name'][$key] :'' }}">
          <input type="hidden" name="product_qty[]" value="{{ $type == 'payment' ? $data['product_qty'][$key]  :''}}">
          <input type="hidden" name="unit_price[]" value="{{ $type == 'payment' ? $data['unit_price'][$key] :'' }}">
          <input type="hidden" name="product_id[]" value="{{ $type == 'payment' ? $data['product_id'][$key] :'' }}">
          @endforeach

          <button type="submit" class="btn btn-success">Pay {{ $data['price'] }} from Paypal</button>
        @elseif($type == 'recharge')
          <input type="hidden" name="amount" readonly value="{{ number_format($data['amount'] , 2) }}">
          <input type="hidden" name="type" readonly value="recharge">
          <button type="submit" class="btn btn-success">Pay ${{ number_format($data['amount'] , 2) }} from Paypal</button>
        @elseif($type == 'subscribe')

          @if($data['is_lifetime'])
          <input type="hidden" name="total_subscription_fee" value="{{ $data['total_subscription_fee'] }}" readonly>
          <input type="hidden" name="is_lifetime" value="{{ $data['is_lifetime'] }}">
          @else
          <input type="hidden" name="total_subscription_fee" value="{{ $data['total_subscription_fee'] }}" readonly >
          <input type="hidden" name="is_lifetime" value="{{ $data['is_lifetime'] }}">
          @endif

          <input type="hidden" name="total_month" value="{{ $data['total_month'] }}">
          <input type="hidden" name="subscribe_fee" value="{{ $data['subscribe_fee'] }}" readonly>
          <input type="hidden" name="monthly_charge" value="{{ $data['monthly_charge'] }}" readonly value="">
          <input type="hidden" name="subscribe_id" value="{{ $data['subscribe_id'] }}">
          <input type="hidden" name="expired" value="{{ $data['expired'] }}">
          <input type="hidden" name="type" readonly value="subscribe">
          <button type="submit" class="btn btn-success">Pay ${{ number_format($data['total_subscription_fee'] , 2) }} from Paypal</button>
        @endif

      </form>
    </div>
  </div>
  <script>
      document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
      });
  </script>
</body>

</html>
