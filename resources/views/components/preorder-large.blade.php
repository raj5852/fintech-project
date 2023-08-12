<div class="item">
    @php
        $isProductPurchased = isProductPurchased($preorder->id);
    @endphp

    <h1 class="__title">{{ $preorder->product_name }} <span class="d-txt">
            @if ($isProductPurchased == true)
                (Delivery On The Way)
            @endif
        </span> </h1>
    <p class="__price">${{ $preorder->discount_price }}</p>
    @if ($isProductPurchased == false)
        <form action="{{ route('pre-order-payment', $preorder->product_slug) }}" method="POST">
            @csrf
            <div class="action">
                <button class="common-btn">Pre-Order</button>
            </div>
        </form>
    @endif

</div>
