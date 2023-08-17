<div class="dashboard__profile-content oder-details-ov-control">
    <div class="dashboard__profile-order">
        <span class="dashboard__profile-bltitle">Order List</span>
        <!-- order details  -->
        <div class="u-order-details">
            <div class="_left">
                <div class="img">
                    <img src="{{ asset($product->thumbnail) }}" alt="">
                </div>
            </div>
            <div class="_right">
                <div class="content">
                    <h1 class="_name">{{ $product->product_name }} </h1>






                    <h1 class="__box"><span class="text">Purchase Date: </span><span class="__res">
                            {{ date_readable($userOrder->created_at)  }}</span></h1>
                    <h1 class="__box"><span class="text">Order No: </span><span
                            class="__res">#{{ $userOrder->order->id }} </span></h1>
                    <p class="__p">${{ $product->discount_price }} </p>
                </div>
                <a href="#" class="common-btn">Review</a>
            </div>
        </div>

        <div class="table-responsive ab-table-wrap wallet details-p">
            <table class="table">
                <thead>
                    <tr>
                        <th>Version</th>
                        <th>Release Date</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product->product_url as  $link=> $version)
                        <tr>

                            <td>{{$version}}</td>
                            <td> 2023 </td>

                            <td><a href="{{ asset($link) }} " class="common-btn"><i class="fa-solid fa-download"></i></a></td>
                        </tr>
                    @endforeach



                </tbody>
            </table>
        </div>
    </div>
</div>
