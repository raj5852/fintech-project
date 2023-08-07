
<div class="mobile-version-menu">
    <ul>
        <li><a class="item common-btn   {{ request()->is('user/home')?'active':'' }} " href="{{ route('user.home') }}">My Profile</a></li>
        <li><a class="item common-btn {{ request()->is('user/my-orders')?'active':'' }} " href="{{ route('user.my-orders') }}">My Orders</a></li>
        <li><a class="item common-btn {{ request()->is('user/my-wallet')?'active':'' }}" href="{{ route('user.my-wallet') }}">My Wallet</a></li>
        <li><a class="item common-btn {{ request()->is('user/my-wishlist')?'active':'' }}" href="{{ route('user.my-wishlist') }}">My Wishlist</a></li>
        <li><a class="item common-btn {{ request()->is('user/membership-product')?'active':'' }}" href="{{ route('user.membership-product') }}">Membership Product</a></li>
        <li><a class="item common-btn {{ request()->is('user/edit-profile')?'active':'' }}" href="{{ route('user.edit-profile') }}">Edit Profile</a></li>
        <li><a class="item common-btn" href="{{ route('logout') }}">Logout</a></li>
    </ul>

</div>
