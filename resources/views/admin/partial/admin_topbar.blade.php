<!--start header -->
@php
    $orders=App\Models\Admin\Order::latest()->limit(50)->with('user')->where('notification_status','0')->get();
    $notification_count =App\Models\Admin\Order::where('notification_status','0')->count();

@endphp
    <header>
        <div class="topbar d-flex align-items-center">
            <nav class="navbar navbar-expand">
                <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                </div>
                {{-- <div class="search-bar flex-grow-1">
                    <div class="position-relative search-bar-box">
                        <input type="text" class="form-control search-control" placeholder="Type to search..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
                        <span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
                    </div>
                </div> --}}
                <div class="top-menu ms-auto">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item mobile-search-icon">
                            <a class="nav-link" href="#">   <i class='bx bx-search'></i>
                            </a>
                        </li>

                        <li class="nav-item dropdown dropdown-large">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">{{$notification_count}}</span>
                                <i class='bx bx-bell'></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:;">
                                    <div class="msg-header">
                                        <p class="msg-header-title">Notifications </p>
                                        <a href="{{ url('admin/notification-clear') }}" class="msg-header-clear ms-auto">Clear All</a>
                                    </div>
                                </a>
                                <div class="header-notifications-list">

                                      @foreach ($orders as $order)
                                      <a class="dropdown-item" href="{{ url('admin/order/view',$order->id) }}">
                                        <div class="d-flex align-items-center">
                                            <div class="notify bg-light-primary text-primary"><i class="bx bx-group"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">{{ $order->user->name  }}<span class="msg-time float-end">{{ $order->created_at->diffForHumans(['short' => true]) }} </span></h6>
                                                <p class="msg-info">{{ $order->order_no  }}d</p>
                                            </div>
                                        </div>
                                    </a>
                                      @endforeach






                                </div>

                            </div>
                        </li>
                        @if (is_access('notification'))
                        <li style="display: none" class="nav-item dropdown dropdown-large">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">8</span>
                                <i class='bx bx-comment'></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:;">
                                    <div class="msg-header">
                                        <p class="msg-header-title">Messages</p>
                                        <p class="msg-header-clear ms-auto">Marks all as read</p>
                                    </div>
                                </a>

                                <div class="header-message-list">
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="user-online">
                                                <img src="{{ asset('backend/') }}/assets/images/avatars/avatar-1.png" class="msg-avatar" alt="user avatar">
                                            </div>
                                            <div class="flex-grow-1">


                                            </div>
                                        </div>
                                    </a>
                                </div>


                            </div>
                        </li>
                        @endif



                    </ul>
                </div>
                <div class="user-box dropdown">
                    <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(isset(Auth::user()->image))
                            <img src="{{ asset(Auth::user()->image) }}" alt="Admin" class="user-img" alt="user avatar">
                        @else
                        <img src="{{ asset('backend/') }}/assets/images/avatars/avatar-2.png" class="user-img" alt="user avatar">
                        @endif
                        <div class="user-info ps-3">
                            <p class="user-name mb-0">{{ Auth::user()->name }}</p>
                            {{-- <p class="designattion mb-0">Web Designer</p> --}}
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="bx bx-user"></i><span>Profile</span></a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('password.change') }}"><i class="bx bx-cog"></i><span>Settings</span></a>
                        </li>
                        <li>
                            <div class="dropdown-divider mb-0"></div>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!--end header -->
