<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NowPayment </title>
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
    <div class="container">

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <center>
                    <div class="card">
                        <div class="card-body">
                           <div>
                            <img style="width: 220px" src="{{ asset('frontend/payment/crypto.png') }}"
                            alt="">
                           </div>

                           <p>Payable USD: <b> {{ $data['total_subscription_fee']}} $</b></p>

                           <br>


                           <img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl={{$data['total_subscription_fee']}}&choe=UTF-8" alt="">
                           <div>

                           </div>

                        </div>
                    </div>
                </center>
            </div>
        </div>



    </div>


</body>

</html>

