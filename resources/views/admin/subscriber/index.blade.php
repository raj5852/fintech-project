@extends('layouts.app')

@section('admin_content')
@push('css')

@endpush


<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">Subscriber</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Subscriber</li>
					</ol>
				</nav>
			</div>
			<div class="ms-auto">
				<div class="btn-group">
					{{-- <a href="" class="btn btn-sm btn-primary pull-right">Send Promotion Email</a> --}}
					<button type="button" class="btn btn-sm btn-primary pull-right" data-bs-toggle="modal" data-bs-target="#emailModel">Send Promotion</button>
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
								<th>Email</th>
								<th>Date</th>
								<th width="5%">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $key=>$row)
							<tr>
								<td width="5%">{{ ++$key }}</td>
								<td>{{ $row->email }}</td>
								<td>{{ $row->created_at->format('d-m-Y') }}</td>
								<td>

                                    <a href="{{ route('delete.subscriber',$row->id) }}" class="btn btn-danger" id="delete" >Delete</a>
									{{-- <form action="{{ route('delete.subscriber',$row->id) }}" style="display: inline-block;" method="POST" id="delete_form">
									    @csrf
									    @method('DELETE')
									    <button class="btn btn-sm btn-danger" id="delete" type="submit">Delete</button>
									</form> --}}
								</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th width="5%">SL</th>
								<th>Email</th>
								<th>Date</th>
								<th width="5%">Action</th>
							</tr>
						</tfoot>
					</table>
				</div>


				<!--Email Modal -->
				<div class="modal fade" id="emailModel" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog modal-xl">
						<div class="modal-content">
							<form action="{{ route('send.promotion.email') }}" method="post">
								@csrf
								<div class="modal-body">
									<div class="col-md-12">
										<label for="inputFirstName" class="form-label">Subject <sup class="text-danger">*</sup></label>
										<input type="text" class="form-control" name="email_subject" id="inputFirstName">
									</div>
								</div>
								<div class="modal-body">
									<div class="col-md-12">
										<label for="inputFirstName" class="form-label">Compos email<sup class="text-danger">*</sup></label>
										<textarea type="text" class="form-control" name="email_description" id="summernote"></textarea>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Send</button>
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
		    $('body').on('click', '.view', function () {
		      var id = $(this).data('id'); //i or 2 categoryid
		      $.get("{{ url('admin/product/view') }}/"+id,
		      function (data) {
		           $('#view_part').html(data);
		        })
		    });

		    $(document).ready(function() {
		      $('#summernote').summernote({
		      	height: 280,
		      });
		    });
	</script>

@endpush

@endsection
