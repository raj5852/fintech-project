@extends('layouts.app')

@section('admin_content')
    @php
        use Carbon\Carbon;
        $order = App\Models\Admin\Order::all();
        $product = App\Models\Admin\Product::all();
        $orders = App\Models\Admin\Order::latest()
            ->limit(10)
            ->get();
        $product_price = App\Models\Admin\Product::sum('product_price');
        $buying_price = App\Models\Admin\Product::sum('buying_price');
        $order_payment = App\Models\Admin\Order::sum('total_price');

        $data = App\Models\Admin\Order::select('*')
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('total_price');

        $year = App\Models\Admin\Order::select('*')
            ->whereMonth('created_at', Carbon::now()->year)
            ->sum('total_price');

    @endphp
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Total Order</p>
                                        <h4 class="my-1">{{ count($order) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Total Order Price</p>
                                        <h4 class="my-1">$ {{ $order_payment }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Total Product</p>
                                        <h4 class="my-1">{{ count($product) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Total Product Price</p>
                                        <h4 class="my-1">${{ $product_price }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Total Paid Membership</p>
                                        <h4 class="my-1">{{ $totalMemberShip }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">This Month Order</p>
                                        <h4 class="my-1">${{ $data }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">This Year</p>
                                    <h4 class="my-1">${{ $year }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}



                    {{-- <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">This Year Earning</p>
                                    <h4 class="my-1">$40</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}



                </div>
                <!--end row-->

                <!--end row-->

                <!--end row-->

                <!--end row-->

                <!--end row-->
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h5 class="mb-0">Orders Summary</h5>
                            </div>
                            <div class="font-22 ms-auto"><i class='bx bx-dots-horizontal-rounded'></i>
                            </div>
                        </div>
                        <hr />
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>User Name</th>
                                        <th>Order NO</th>
                                        <th>Total Qty</th>
                                        <th>Total Price</th>
                                        <th>Payment Method </th>
                                        <th>Refund </th>
                                        <th>Coupon Amount </th>
                                        <th>Coupon Name</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->user->name }}</td>
                                            <td>{{ $order->order_no }}</td>
                                            <td>{{ $order->total_qty }}</td>
                                            <td>{{ $order->total_price }}</td>
                                            <td>{{ $order->payment_method }}</td>
                                            <td>{{ $order->refund }}</td>
                                            <td>{{ $order->coupon_amount }}</td>
                                            <td>{{ $order->coupon }}</td>
                                            <td>
                                                <a href="{{ url('admin/order/view', $order->id) }}"
                                                    class="btn btn-primary">Order View</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--end page wrapper -->
    </div>
    <!--end wrapper-->
    <!--start switcher-->

@endsection
