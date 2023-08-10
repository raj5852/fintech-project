<div class="card-main">
    <div class="card-item">
        @if (isProductWishlist($product->id))
            <button class="_hart-icon removeWishlist" data-id="{{ $product->id }}">
                <span><i class="fa-solid fa-heart"></i></span>
            </button>
        @else
            <button class="_hart-icon addWishlist" data-id="{{ $product->id }}">
                <span><i class="fa-regular fa-heart"></i></span>
            </button>
        @endif
        <div class="image">
            <a href="{{ route('product.details', $product->product_slug) }}"><img src="{{ asset($product->thumbnail) }}"
                    alt=""></a>
        </div>
        <div class="heading-content">
            <a href="{{ route('product.details', $product->product_slug) }}"
                class="_title">{{ $product->product_name }}</a>
            <div class="price-box">
                @if ($product->discount_rate == 0.0)
                    <p class="new_price">${{ $product->product_price }}</p>
                @else
                    <p class="old_price">${{ $product->product_price }}</p>
                    <p class="new_price">${{ $product->discount_price }}</p>
                @endif
            </div>

        </div>

        <div class="sub-content">
            <p class="detail">
                {{ Str::limit($product->product_short_desc, 100) }}
            </p>
            @if (isProductPurchased($product->id) == 1)
                <a target="_blank" href="{{ route('user.my-orders') }}" class="common-btn">
                    Already Purchased
                </a>
            @else
                <form action="{{ route('add.cart') }}" method="post" class="addCard">
                    @csrf
                    <input type="hidden" name="product_slug" value="{{ $product->product_slug }}">
                    <button class="common-btn">Add to Cart</button>
                </form>
            @endif
        </div>
    </div>
</div>
