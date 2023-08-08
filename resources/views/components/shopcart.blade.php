<div>
    <div class="card-main">
        <div class="card-item">
            @if (isProductWishlist($product->id))
                <button class="_hart-icon removeWishlist"
                    data-id="{{ $product->id }}">
                    <span><i class="fa-solid fa-heart"></i></span>
                </button>
            @else
                <button class="_hart-icon addWishlist" data-id="{{ $product->id }}">
                    <span><i class="fa-regular fa-heart"></i></span>
                </button>
            @endif
            <div class="image">
                <a href="{{ route('product.details', $product->product_slug) }}"><img
                        src="{{ asset($product->thumbnail) }}" alt=""></a>
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
                @if (isProductPurchased($product->id))
                    @php
                        $data = $product->product_url;

                        if ($data !== null) {
                            $keyLink = array_keys($data);
                        } else {
                            $keyLink = ['https://fintechforexea.com/user/home'];
                        }

                        $downloadUrl = end($keyLink);

                    @endphp
                    <a target="_blank" href="{{ $downloadUrl }}"
                        class="common-btn">Download
                        now</a>
                @else
                    <form action="{{ route('add.cart') }}" method="post"
                        class="addCard">
                        @csrf
                        <input type="hidden" name="product_id"
                            value="{{ encrypt($product->id) }}">
                        <input type="hidden" name="product_qty" value="1">
                        @if ($product->discount_rate == 0.0)
                            <input type="hidden" name="product_price"
                                value="{{ encrypt($product->product_price) }}">
                        @else
                            <input type="hidden" name="product_price"
                                value="{{ encrypt($product->discount_price) }}">
                        @endif
                        <button class="common-btn">Add to Cart</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
