<!--sidebar wrapper -->
@php
    $setting = DB::table('settings')->first();
@endphp
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/setting/' . $setting->image) }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">{{ Auth::user()->name }}</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        @if (is_access('dashboard'))
            <li>
                <a href="{{ route('admin.home') }}" class="">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
        @endif

        @if (is_access('pending-user'))
            <li>
                <a href="{{ route('admin.pending.user') }}" class="">
                    <div class="parent-icon"><i class='bx bx-user'></i>
                    </div>
                    <div class="menu-title">Pending Users</div>
                </a>
            </li>
        @endif

        @if (is_access('category'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title">Category</div>
                </a>
                <ul>
                    <li> <a href="{{ route('index.category') }}"><i class="bx bx-right-arrow-alt"></i>Category</a>
                    </li>
                    <li> <a href="{{ route('index.sub_category') }}"><i class="bx bx-right-arrow-alt"></i>Sub
                            Category</a>
                    </li>
                </ul>
            </li>
        @endif


        @if (is_access('discussion'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title">Discussions</div>
                </a>
                <ul>
                    <li> <a href="{{ url('admin/discussion/create') }}"><i class="bx bx-right-arrow-alt"></i>Create
                            Discussion</a>
                    </li>

                    <li> <a href="{{ url('admin/discussion') }}"><i class="bx bx-right-arrow-alt"></i>All Discussion
                            channels</a>
                    </li>

                </ul>
            </li>
        @endif



        @if (is_access('discussion'))
        @endif

        <li class="menu-label">Manage Products</li>
        @if (is_access('brands'))
            <li>
                <a href="{{ route('index.brand') }}">
                    <div class="parent-icon"><i class='bx bx-donate-blood'></i>
                    </div>
                    <div class="menu-title">Brands</div>
                </a>
            </li>
        @endif

        @if (is_access('products'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-cart'></i>
                    </div>
                    <div class="menu-title">Products</div>
                </a>
                <ul>
                    <li> <a href="{{ route('create.product') }}"><i class="bx bx-right-arrow-alt"></i>Add New
                            Product</a>
                    </li>
                    <li> <a href="{{ route('index.product') }}"><i class="bx bx-right-arrow-alt"></i>All Product</a>
                    </li>
                    <li> <a href="{{ route('product.preorders') }}"><i class="bx bx-right-arrow-alt"></i>Preorders</a>
                    </li>
                    <li> <a href="{{ route('specification.index') }}"><i class="bx bx-right-arrow-alt"></i>Fixed
                            Specifications</a>
                    </li>

                </ul>
            </li>
        @endif

        @if (is_access('orders'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-cart'></i>
                    </div>
                    <div class="menu-title">Orders</div>
                </a>
                <ul>
                    <li> <a href="{{ url('admin/order') }}"><i class="bx bx-right-arrow-alt"></i>All Orders</a></li>
                    <li> <a href="{{ url('admin/order/pre-orders') }}"><i
                                class="bx bx-right-arrow-alt"></i>Preorders</a>
                    </li>
                    <li> <a href="{{ url('admin/order/email') }}"><i class="bx bx-right-arrow-alt"></i>Orders Email</a>
                    <li>
                        <a href="{{ url('admin/order/addorder/create') }}"><i class="bx bx-right-arrow-alt"></i>Add
                            order
                            for user</a>
                    </li>
                </ul>
            </li>
        @endif

        @if (is_access('memberships'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-cart'></i>
                    </div>
                    <div class="menu-title">Manage Membership</div>
                </a>
                <ul>
                    <li> <a href="{{ route('index.membership') }}"><i class="bx bx-right-arrow-alt"></i>Add
                            Membership</a>
                    </li>
                    <li> <a href="{{ route('admin.all-user') }}"><i class="bx bx-right-arrow-alt"></i>All Users</a>
                    </li>

                    <li> <a href="{{ route('admin.genarel-members') }}"><i class="bx bx-right-arrow-alt"></i>Genarel
                            Member</a></li>
                    <li> <a href="{{ route('admin.vip-members') }}"><i class="bx bx-right-arrow-alt"></i>VIP Member</a>
                    </li>
                    <li> <a href="{{ route('admin.premium-members') }}"><i class="bx bx-right-arrow-alt"></i>Premium
                            Member</a></li>
                    <li> <a href="{{ route('admin.elite-members') }}"><i class="bx bx-right-arrow-alt"></i>Elite
                            Member</a>
                    </li>
                    <li> <a href="{{ route('admin.reseller-members') }}"><i class="bx bx-right-arrow-alt"></i>Reseller
                            Member</a></li>
                </ul>
            </li>
        @endif

        @if (is_access('manage-wallet'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-cart'></i>
                    </div>
                    <div class="menu-title">Manage wallet</div>
                </a>
                <ul>
                    <li> <a href="{{ route('balance.index') }}"><i class="bx bx-right-arrow-alt"></i>All Users</a></li>
                </ul>
            </li>
        @endif
        @if (is_access('request-product'))
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                    </div>
                    <div class="menu-title">Request Product</div>
                </a>
                <ul>


                    <li> <a href="{{ route('index.productrequest') }}"><i class="bx bx-right-arrow-alt"></i>What
                            Would
                            You
                            Like To Do</a>
                    </li>

                    <li> <a href="{{ route('addrequest') }}"><i class="bx bx-right-arrow-alt"></i>Add Request </a>
                    </li>
                    <li> <a href="{{ route('index.productrequesttwo') }}"><i class="bx bx-right-arrow-alt"></i>Select
                            Platform</a>
                    </li>


                    {{-- <li> <a href="{{ route('index.request.product') }}"><i class="bx bx-right-arrow-alt"></i>New Request</a>
                    </li> --}}


                    <li> <a href="{{ route('index.request.product') }}"><i class="bx bx-right-arrow-alt"></i> Request
                            Customer</a>
                    </li>
                    {{-- <li> <a href="{{ route('old.request.product') }}"><i class="bx bx-right-arrow-alt"></i>Old Request Customer</a>
                    </li> --}}
                </ul>
            </li>
        @endif
        @if (is_access('coupon'))
            <li>
                <a href="{{ route('index.coupon') }}">
                    <div class="parent-icon"><i class='bx bx-lock'></i>
                    </div>
                    <div class="menu-title">Coupon</div>
                </a>
            </li>
        @endif

        @if (is_access('testimonial'))
            <li>
                <a href="{{ route('index.testimonial') }}">
                    <div class="parent-icon"><i class='bx bx-cookie'></i>
                    </div>
                    <div class="menu-title">Testimonial</div>
                </a>
            </li>
        @endif


        @if (is_access('subscriber'))
            <li>
                <a href="{{ route('index.subscriber') }}">
                    <div class="parent-icon"><i class='bx bx-user-circle'></i>
                    </div>
                    <div class="menu-title">Subscriber List</div>
                </a>
            </li>
        @endif


        <li class="menu-label">Manage Site</li>
        @if (is_access('home-page-setting'))
            <li>


                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bx bx-repeat"></i>
                    </div>
                    <div class="menu-title">Home Page</div>
                </a>

                <ul>

                    <li>
                        <a href="{{ route('index.social') }}">
                            <div class="parent-icon"><i class="bx bx-right-arrow-alt"></i>
                            </div>
                            <div class="menu-title">Socials</div>
                        </a>
                    </li>
                    <li> <a href="{{ route('website.setting') }}"><i class="bx bx-right-arrow-alt"></i>Web
                            Setting</a>
                    </li>

                    <li> <a href="{{ route('index.homepage') }}"><i class="bx bx-right-arrow-alt"></i>Home Page</a>
                    </li>

                    <li> <a href="{{ route('index.market') }}"><i class="bx bx-right-arrow-alt"></i>Market Place</a>
                    </li>


                </ul>
            </li>
        @endif
        @if (is_access('manage-api'))
            <li>
                <a href="{{ route('index.api') }}">
                    <div class="parent-icon">
                    </div>
                    <div class="menu-title">Manage API Key</div>
                </a>
            </li>
        @endif

        <li class="menu-label">Privacy Policy</li>
        @if (is_access('privacy-policy'))
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bx bx-repeat"></i>
                    </div>
                    <div class="menu-title">Privacy Policy</div>
                </a>
                <ul>
                    <li> <a href="{{ route('index.features') }}"><i class="bx bx-right-arrow-alt"></i>Privacy
                            Policy</a>
                    </li>
                    <li> <a href="{{ route('index.afeature') }}"><i class="bx bx-right-arrow-alt"></i>Terms Of
                            Service
                        </a>
                    </li>
                    <li> <a href="{{ route('index.page') }}"><i class="bx bx-right-arrow-alt"></i>It Work</a>
                    </li>
            </li>
        @endif
    </ul>
    </li>

    <li class="menu-label">About Page</li>
    @if (is_access('about-page'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-repeat"></i>
                </div>
                <div class="menu-title">About Page</div>
            </a>
            <ul>
                <li> <a href="{{ route('about.us') }}"><i class="bx bx-right-arrow-alt"></i>About Us</a>
                </li>
                <li> <a href="{{ route('index.aboutone') }}"><i class="bx bx-right-arrow-alt"></i>About Section One
                    </a>
                </li>
                <li> <a href="{{ route('index.abouttwo') }}"><i class="bx bx-right-arrow-alt"></i>About Section Two
                    </a>
                </li>
        </li>
    @endif

    </ul>
    </li>
    @if (is_access('all-contact'))
        <li>
            <a href="{{ route('all.contact') }}" class="">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">All Conatct</div>
            </a>
        </li>
    @endif

    @if (is_access('database-backup'))
        <li>
            <a href="{{ route('admin.databse-backup') }}" class="">
                <div class="parent-icon"><i class='bx bx-download'></i>
                </div>
                <div class="menu-title">Database Backup</div>
            </a>
        </li>
    @endif
    @if (auth()->user()->type == 'admin')
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title"> Role Permission</div>
            </a>
            <ul>
                <li> <a href="{{ route('role.create') }}"><i class="bx bx-right-arrow-alt"></i>Create Role</a></li>
                <li> <a href="{{ route('create-user.create') }}"><i class="bx bx-right-arrow-alt"></i>Create User</a></li>
            </ul>
        </li>
    @endif



    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
