<div>
    @php
        $requirementFulfil = $preorder->minimum_orders == $preorder->orders_count ? true : false;
    @endphp
    <div class="card-main">
        <div class="card-item">

            <div class="image">
                <a href="{{ $requirementFulfil == true ? '#' : route('preorder_details', $preorder->product_slug) }}"><img
                        src="{{ asset($preorder->thumbnail) }} " alt=""></a>
            </div>
            <div class="heading-content">
                <a href="{{ $requirementFulfil == true ? '#' : route('preorder_details', $preorder->product_slug) }}"
                    class="_title">{{ $preorder->product_name }} </a>
                <div class="price-box">
                    <p class="old_price">{{ $preorder->product_price }} </p>
                    <p class="new_price">{{ $preorder->discount_price }} </p>
                </div>

            </div>

            <div class="progress-bar-wrap-pre">
                <div class="-box"><span class="__title">Ordered: {{ $preorder->orders_count }} </span><span
                        class="__title">Item Available:
                        {{ $preorder->minimum_orders }} </span></div>

                @if ($requirementFulfil == false)
                    <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                        aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar"
                            style="width: {{ ($preorder->orders_count / $preorder->minimum_orders) * 100 }}%"></div>
                    </div>
                @else
                    <p class="deliver-txt">Delivery On The Way</p>
                @endif

            </div>


            <div class="sub-content">
                @if ($requirementFulfil == false)
                    @if (isProductPurchased($preorder->id) == false)
                        <form action="{{ route('pre-order-payment', $preorder->product_slug) }}" method="POST">
                            @csrf
                            <button class="common-btn">Pre-Order</a>
                        </form>
                    @else
                        <p class="deliver-txt">Delivery On The Way</p>
                    @endif

                @endif

            </div>
        </div>
    </div>

</div>
