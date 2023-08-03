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
		<hr/>
		@include('alert.alert')
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="example2" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th width="5%">SL</th>
								<th>User  Name</th>
								<th>User  Email</th>
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
							@foreach($orders as $key=>$order)
							<tr>
								<td width="5%">{{ ++$key }}</td>
								<td>{{ $order->user->name  }}</td>
								<td>{{ $order->user->email  }}</td>
                                <td>{{ $order->order_no  }}</td>
                                <td>{{ $order->total_qty  }}</td>
                                <td>{{ $order->total_price  }}</td>
                                <td>{{ $order->payment_method  }}</td>
                                <td>{{ $order->refund  }}</td>
                                <td>{{ $order->coupon_amount  }}</td>
                                <td>{{ $order->coupon  }}</td>
                               <td>
                                <a href="{{ url('admin/order/view',$order->id) }}" class="btn btn-primary">Order View</a>
                               </td>

							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th>SL</th>
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
						</tfoot>
					</table>
				</div>


				<!--View Modal -->

			</div>
		</div>
	</div>
</div>

@push('js')

    <!--Datatable JS-->
    <script src="{{ asset('backend/') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend/') }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('backend/') }}/assets/js/table-datatable.js"></script>

@endpush

@endsection
