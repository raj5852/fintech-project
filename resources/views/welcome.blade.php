{{-- <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                            <div class="dashboard__profile-content">
                                <div class="dashboard__profile-order">
                                    <div class="dashboard__profile-header">
                                        <div class="dashboard__profile-thumb">
                                          <span class="dashboard__profile-bltitle">Wallet History</span>
                                            <hr>
                                        </div>
                                        <div class="dashboard__profile-content">
                                            <a href="{{ route('recharge.page') }}" class="dashboard__header-btn text-white"> Recharge</a>
                                        </div>
                                    </div>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Tran. Id</th>
                                                <th>Recharge By</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($payments as $key=>$payment)
                                            <tr class="border-bottom">
                                                <td>{{ $payment->created_at->format('d-m-Y') }}</td>
                                                <td>$ {{ $payment->amount }}</td>
                                                <td>{{ $payment->trans_id }}</td>
                                                <td>{{ $payment->payment_method }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> --}}

                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                            <div class="dashboard__profile-order">
                                <span class="dashboard__profile-bltitle">My Wish List </span>
                                <hr>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Product</th>
                                            <th>Unit Price</th>
                                            <th>Stock Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($wishlists as $key=>$wish)
                                        <tr class="border-bottom">
                                            <td>
                                                <a class="nav-link logout" href="{{ route('delete.wishlist',$wish->id) }}" onclick="event.preventDefault(); document.getElementById('wish-delete-form').submit();"><img class="ml-2" src="{{ asset('frontend/') }}/img/close.png" alt=""></a>
                                                <form id="wish-delete-form" action="{{ route('delete.wishlist',$wish->id) }}" method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                            <td>
                                                <img src="{{ asset($wish->thumbnail) }}" alt="Image" width="58" height="54">
                                            <br>
                                            {{ $wish->product_name }}</td>
                                            @if($wish->discount_rate == 0.00)
                                            <td>$ {{ $wish->product_price }}</td>
                                            @else
                                            <td>$ {{ $wish->discount_price }}</td>
                                            @endif
                                            <td>Unlimited</td>
                                            <td>
                                                <form action="{{ route('add.cart') }}" method="post" class="addCard">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $wish->product_id }}">
                                                    <input type="hidden" name="product_qty" value="1">
                                                    @if($wish->discount_rate == 0.00 )
                                                    <input type="hidden" name="product_price" value="{{ $wish->product_price }}">
                                                    @else
                                                    <input type="hidden" name="product_price" value="{{ $wish->discount_price }}">
                                                    @endif
                                                    <button class="cart-btn-wishlist" type="submit">add to cart</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="items__item">
                                <a href="{{ URL::to('product/details/'.$product->product_slug) }}">
                                    <img src="{{ asset($product->thumbnail) }}" alt="Product" class="items__img" />
                                </a>


                                <h5 class="heading name">{{ $product->product_title }}</h5>
                                <h5 class="heading title"><a href="{{ URL::to('product/details/'.$product->product_slug) }}">{{ $product->product_name }}</a></h5>
                                <div class="price-list d-flex justify-content-center align-items-center gap-2 mb-1">
                                    @if($product->discount_rate == 0.00)
                                <p class="price newprice">${{ $product->product_price }}</p>
                                @else
                                <p class="price newprice">${{ $product->discount_price }}</p>
                                @endif

                                @if($product->discount_rate == 0.00)
                                @else
                                <span class="discount">- @if($product->discount_type == "Flat") $@endif{{ intval($product->discount_rate) }} @if($product->discount_type == "Percent") % @endif</span>
                                @endif

                                @if($product->discount_rate == 0.00)
                                @else
                                <span class="price">${{ $product->product_price }}</span>
                                @endif
                                </div>

                                <div class="items__bottom">
                                    <p class="text mb-2 text-center">
                                        {{ Str::limit($product->product_short_desc, 100, '') }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <form action="{{ route('add.cart') }}" method="post" class="d-flex justify-content-center align-items-center mx-auto addCard">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="product_qty" value="1">
                                            @if($product->discount_rate == 0.00 )
                                            <input type="hidden" name="product_price" value="{{ $product->product_price }}">
                                            @else
                                            <input type="hidden" name="product_price" value="{{ $product->discount_price }}">
                                            @endif
                                            <button class="btn btn-cart" type="submit">Add to cart</button>
                                        </form>
                                        <button class="btn btn-wishlist addWishlist" data-id="{{ $product->id }}">
                                            <i class="bi bi-heart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
