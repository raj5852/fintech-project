@extends('layouts.app')

@section('admin_content')
@push('css')

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
            <div class="ms-auto">
				<div class="btn-group">
					<a href="{{ route('admin.order') }}" class="btn btn-sm btn-primary pull-right">All Order</a>
				</div>
			</div>

		</div>
		<!--end breadcrumb-->
		<hr/>

		<div class="card">
			<div class="card-body">
	               <h3>Order Information</h3>
					<div class="row">
						<div class="col-md-3">
							<label for="inputFirstName" class="form-label">Order Number</label>
							<input type="text" class="form-control"  value="{{ $order->order_no }}"  readonly>
						</div>
						<div class="col-md-3">
							<label for="inputLastName" class="form-label">Total Qty </label>
							<input type="text" class="form-control" value="{{ $order->total_qty }}"  readonly>
						</div>
						<div class="col-md-3">
							<label for="inputLastName" class="form-label">Total Price </label>
							<input type="text" class="form-control" value="{{ $order->total_price }}"  readonly>
						</div>





						<div class="col-md-3">
							<label for="inputLastName" class="form-label">Refund </label>
							<input type="text" class="form-control" value="{{ $order->refund }}"  readonly>
						</div>

						<div class="col-md-3">
							<label for="inputLastName" class="form-label">Coupon Amount </label>
							<input type="text" class="form-control" value="{{ $order->coupon_amount }}"  readonly>
						</div>

						<div class="col-md-3">
							<label for="inputLastName" class="form-label">Coupon </label>
							<input type="text" class="form-control" value="{{ $order->coupon }}"  readonly>
						</div>

						<div class="col-md-3">
							<label for="inputLastName" class="form-label">Payment Method </label>
							<input type="text" class="form-control" value="{{ $order->payment_method }}"  readonly>
						</div>





					</div>




					<br>

				</form>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="example2" class="table table-striped table-bordered">
						<thead>
							<tr>

								<th>Order Id</th>
								<th>Product Name</th>
								<th>Product Qty </th>
								<th>Product Price</th>
								<th>Unit Price</th>
								<th>Create At</th>
							</tr>
						</thead>
						<tbody>
                            @foreach($order->orderItems as $item)
							<tr>

                                <td>{{ $item->order_id }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->product_qty }}</td>
                                <td>{{ $item->product_price }}</td>
                                <td>{{ $item->unit_price }}</td>
                                <td>{{ $item->created_at }}</td>




							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th>Order Id</th>
								<th>Product Name</th>
								<th>Product Qty </th>
								<th>Product Price</th>
								<th>Unit Price</th>
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



@endpush

@endsection
