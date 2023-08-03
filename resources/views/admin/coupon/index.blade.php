@extends('layouts.app')

@section('admin_content')
@push('css')

@endpush


<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">Coupon</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Coupon</li>
					</ol>
				</nav>
			</div>
			<div class="ms-auto">
				<div class="btn-group">
					<button type="button" class="btn btn-sm btn-primary pull-right" data-bs-toggle="modal" data-bs-target="#createModel">Create New</button>
				</div>
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
								<th>Coupon Name</th>
								<th>Coupon Type</th>
								<th>Coupon Rate</th>
								<th>Max Use</th>
								<th>Minmum Use Amount</th>
								<th>Coupon Status</th>
								<th width="15%">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $key=>$row)
							<tr>
								<td>{{ ++$key }}</td>
								<td>{{ $row->coupon_name }}</td>
								<td>{{ $row->coupon_type }}</td>
								@if($row->coupon_type == 'Flat')
								<td>{{ $row->coupon_rate }}</td>
								@else
								<td>{{ $row->coupon_rate }} %</td>
								@endif
								@if($key > 4)
								<td>{{ $row->coupon_use }}</td>
								@else
								<td>{{ $row->coupon_use }}</td>
								@endif
								<td>{{ $row->use_amount }}</td>
								<td><span class="badge @if($row->coupon_status == 'Active') bg-success @else bg-danger @endif">{{ $row->coupon_status }}</span></td>
								<td>

									<button class="btn btn-sm btn-info edit" data-bs-toggle="modal" data-bs-target="#editModel" data-id="{{ $row->id }}" >Edit</button>
									{{-- @if($key > 4) --}}
									{{-- <form action="{{ route('delete.coupon',$row->id) }}" style="display: inline-block;" method="POST" id="delete_form">
									    @csrf
									    @method('DELETE')
									    <button class="btn btn-sm btn-danger" id="delete" type="submit">Delete</button>
									</form> --}}
									{{-- @endif --}}
                                    <a href="{{ route('delete.coupon',$row->id) }}" class="btn btn-danger" id="delete" >Delete</a>
								</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th>SL</th>
								<th>Coupon Name</th>
								<th>Coupon Type</th>
								<th>Coupon Rate</th>
								<th>Max Use</th>
								<th>Minmum Use Amount</th>
								<th>Coupon Status</th>
								<th>Action</th>
							</tr>
						</tfoot>
					</table>
				</div>

				<!--Edit Modal -->
				<div class="modal fade" id="editModel" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content" id="edit_section">

						</div>
					</div>
				</div>

				<!--Create Modal -->
				<div class="modal fade" id="createModel" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<form action="{{ route('store.coupon') }}" method="post" enctype="multipart/form-data">
								@csrf
								<div class="modal-header">
									<h5 class="modal-title">Create New Coupon</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div class="form-group row">
										<div class="col-md-6">
											<label for="inputFirstName" class="form-label">Coupon Code<sup class="text-danger">*</sup></label>
											<input type="text" class="form-control" placeholder="Enter coupon code" name="coupon_name" value="{{ Helper::coupon_code() }}" id="inputFirstName">
										</div>
										<div class="col-md-6">
											<label for="inputFirstName" class="form-label">Coupon Type <sup class="text-danger">*</sup></label>
											<select class="form-control" name="coupon_type" id="inputFirstName">
												<option value="" disabled selected>---Select--</option>
												<option value="Flat" >Flat</option>
												<option value="Percent" >Percent</option>
											</select>
										</div>
										<div class="col-md-6 mt-3">
											<label for="inputFirstName" class="form-label">Coupon Rate <sup class="text-danger">*</sup></label>
											<input type="number" class="form-control" placeholder="Enter coupon rate" name="coupon_rate" id="inputFirstName" value="{{ old('coupon_rate') }}">
										</div>
										<div class="col-md-6 mt-3">
											<label for="inputFirstName" class="form-label">Max Use <sup class="text-danger">*</sup></label>
											<input type="number" class="form-control" placeholder="Enter maximum use name" name="coupon_use" id="inputFirstName" value="{{ old('coupon_use') }}">
										</div>
										<div class="col-md-6 mt-3">
											<label for="inputFirstName" class="form-label">Minimum Use Amount<sup class="text-danger">*</sup></label>
											<input type="text" placeholder="Enter minimum use amount" class="form-control" name="use_amount" id="inputFirstName" value="{{ old('use_amount') }}">
										</div>
										<div class="col-md-6 mt-3">
											<label for="inputFirstName" class="form-label">Coupon Status<sup class="text-danger">*</sup></label>
											<select class="form-control" name="coupon_status" id="inputFirstName">
												<option value="Active" >Active</option>
												<option value="Deactive" >Deactive</option>
											</select>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@push('js')

<script>

		//edit modal show and after submit
	    $('body').on('click', '.edit', function () {
	      var id = $(this).data('id'); //i or 2 categoryid
	      $.get("{{ url('admin/coupon/edit') }}/"+id,
	      function (data) {
	           $('#edit_section').html(data);
	        })
	    });
</script>

@endpush

@endsection
