<div>
    <div class="dashboard__profile-wrapper change-ab">
        <div class="dashboard__profile-itemm product-order">
            <div>
                <a href="{{ route('delete.cart', $row->rowId) }}"><img class="order-close-icon"
                        src="{{ asset('frontend/') }}/img/close.png" alt=""></a>
                <img src="{{ asset($row->options->image) }}" width="40" alt="">
            </div>
            <div>
                <span>{{ $row->name }}</span>
                <h5>{{ $row->options->title }}</h5>
            </div>
        </div>
        <div class="dashboard__profile-itemm">
            <h4> <span>$</span> {{ $row->price }}</h4>
        </div>
        <div class="dashboard__profile-itemm ">
            <h4>Total<span>$</span> {{ $row->price * $row->qty }}</h4>
        </div>
    </div>
</div>
