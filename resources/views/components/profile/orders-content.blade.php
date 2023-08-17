<div class="table-responsive ab-table-wrap order">
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Order Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>
                        <div class="product-rp">
                            <div class="img">
                                <img src="{{ asset($order->thumbnail) }}" alt="">
                            </div>
                            <h1 class="__name"> {{ $order->product_name }} </h1>
                        </div>
                    </td>
                    <td><span class="__pp"> {{ $order->discount_price }} </span></td>
                    <td><a class="common-btn" href="{{ route('user.my-order.details',$order->id) }}">Details</a></td>
                </tr>
            @endforeach




        </tbody>
    </table>
    {{ $orders->links('vendor.pagination.default') }}
</div>
