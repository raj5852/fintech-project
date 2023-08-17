<div class="col-md-4">
    <div class="dashboard__main-left nav flex-column nav-pills me-3 das-nav-sidebar-akkjlw" id="v-pills-tab" role="tablist"
        aria-orientation="vertical">

        <a href="{{ route('user.home') }}" class="nav-link {{ request()->is('user/home') ? 'active' : '' }}"><span
                class="side-i-style-oxiz"><i class="fa-regular fa-user"></i></span> <span class="side-text-style-oxiz">my
                profile</span></a>


        <a href="{{ route('user.my-orders') }}"
            class="nav-link justify-content-between  {{ request()->is('user/my-orders') || request()->is('user/my-order/*')  ? 'active' : '' }} "><span><span
                    class="side-i-style-oxiz"><i class="fa-solid fa-wallet"></i></span> <span
                    class="side-text-style-oxiz">my Orders</span></span> <span
                class="dashboard__main-count">{{ $userDetails->order_details_count }}</span></a>

        <a href="{{ route('user.my-wallet') }}" class="nav-link {{ request()->is('user/my-wallet') ? 'active' : '' }}">
            <span class="side-i-style-oxiz"><i class="fa-regular fa-heart  "></i></span> <span
                class="side-text-style-oxiz">my
                Wallet</span>
        </a>

        <a href="{{ route('user.my-wishlist') }}"
            class="nav-link justify-content-between {{ request()->is('user/my-wishlist') ? 'active' : '' }} "><span><span
                    class="side-i-style-oxiz"><i class="fa-solid fa-folder-plus"></i></span> <span
                    class="side-text-style-oxiz">my WishList</span>
            </span><span class="dashboard__main-count">{{ $userDetails->wishlists_count }}</span></a>

        @foreach ($userGroups as $userGroup)
            <a href="{{ url('discussion',$userGroup->slug) }}"
                class="nav-link justify-content-between  "><span><span
                        class="side-i-style-oxiz">
                        <i class="fa-solid fa-comment"></i>
                    </span> <span class="side-text-style-oxiz">{{ $userGroup->name }} </span>
                </span>
            </a>
        @endforeach

        @if ($userDetails->subscribe_id !== 0)
            <a href="{{ route('user.membership-product') }}"
                class="nav-link {{ request()->is('user/membership-product') ? 'active' : '' }}"><span
                    class="side-i-style-oxiz"><i class="fa-solid fa-box-open"></i></span>
                <span class="side-text-style-oxiz">Membership Product</span></a>
        @endif

        <a href="{{ route('user.edit-profile') }}"
            class="nav-link {{ request()->is('user/edit-profile') ? 'active' : '' }}"><span class="side-i-style-oxiz"><i
                    class="fa-solid fa-user-pen"></i></span> <span class="side-text-style-oxiz">Edit Profile</span></a>

        <a class="nav-link logout" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span
                class="side-i-style-oxiz"><i class="fa-solid fa-power-off"></i></span> <span
                class="side-text-style-oxiz">Logout</span></a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>
