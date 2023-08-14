@extends('layouts.app')

@section('admin_content')
    @push('css')
        <!-- Datatable CSS -->
        <link href="{{ asset('backend/') }}/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    @endpush


    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">All Order</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Order</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!--end breadcrumb-->
            <hr />
            @include('alert.alert')
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th>Prodcut Price</th>
                                    <th>User Name</th>
                                    <th>User Email</th>
                                    <th>Order NO</th>
                                    <th>Product Price</th>
                                    <th>Payment Method </th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($preOrders as $key => $order)
                                    <tr>
                                        <td width="5%">{{ ++$key }}</td>
                                        <td>{{ $order->product_name }} </td>
                                        <td>{{ $order->order->name }}</td>
                                        <td>{{ $order->order->email }}</td>
                                        <td>{{ $order->order->order_no }}</td>
                                        <td>{{ $order->product_price }}</td>
                                        <td>{{ $order->order->payment_method }}</td>
                                        <td>{{ $order->created_at }}</td>



                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th>Prodcut Price</th>
                                    <th>User Name</th>
                                    <th>User Email</th>
                                    <th>Order NO</th>
                                    <th>Product Price</th>
                                    <th>Payment Method </th>
                                    <th>Created At</th>
                                </tr>
                            </tfoot>
                        </table>
                        {{ $preOrders->links() }}
                    </div>


                    <!--View Modal -->

                </div>
            </div>
        </div>
    </div>

    @push('js')
        <!--Datatable JS-->
        {{-- <script src="{{ asset('backend/') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('backend/') }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
        <script src="{{ asset('backend/') }}/assets/js/table-datatable.js"></script> --}}
    @endpush
@endsection
