<div class="table-responsive ab-table-wrap order wish-list">
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Unit Price</th>
                <th>Add To Cart</th>
            </tr>
        </thead>
        <tbody>
            {{-- <tr>
                <td>
                    <span onclick="this.parentElement.parentElement.style.display='none';" class="delete-list-i"><i
                            class="fa-solid fa-xmark"></i></span>

                    <div class="product-rp">
                        <div class="img">
                            <img src="{{ asset('frontend/') }}/img/items-img-1.png" alt="">
                        </div>
                        <h1 class="__name">Microsoft Office Microsoft Office</h1>
                    </div>
                </td>
                <td><span class="__pp">$45.00</span></td>
                <td><a class="add-to-cart-btn" href="#">Add to cart</a></td>
            </tr> --}}
            @foreach ($wishlists as $wishlist)
            <tr>
                <td>
                    <a href="{{ route('wishlist.delete',$wishlist->id) }}"  class="delete-list-i"><i
                            class="fa-solid fa-xmark"></i></a>

                    <div class="product-rp">
                        <div class="img">
                            <img src="{{ asset($wishlist->product->thumbnail) }}" alt="">
                        </div>
                        <h1 class="__name">{{ $wishlist->product->product_name }}  </h1>
                    </div>
                </td>
                <td><span class="__pp">${{  $wishlist->product->discount_price }} </span></td>

                 <td>

                        @if (isProductPurchased($wishlist->product->id) == 1)
                            <a target="_blank" href="{{ route('user.my-orders') }}" class="common-btn">
                                Already Purchased
                            </a>
                        @else
                            <form action="{{ route('add.cart') }}" method="post" class="addCard">
                                @csrf
                                <input type="hidden" name="product_slug"
                                    value="{{ $wishlist->product->product_slug }}">
                                <button class="common-btn">Add to Cart</button>

                            </form>
                        @endif
                    </td>
            </tr>
            @endforeach


        </tbody>
    </table>
</div>
