<form action="{{ route('apply.coupon') }}" method="post">
    @csrf
    <input class="input-control-ibx" style="border-radius: 0;margin-top: 0;" type="text"
        name="coupon" required placeholder="Have any coupon? Enter the coupon code">
    <button class="common-btn" style="border-radius: 0; margin-left: 8px;padding: 13px 60px;"
        type="submit">apply coupon</button>
</form>
