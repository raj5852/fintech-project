@extends('layouts.app')

@section('admin_content')



<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">Membership</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Membership</li>
					</ol>
				</nav>
			</div>
			{{-- <div class="ms-auto">
				<div class="btn-group">
					<a href="{{ route('create.membership') }}" class="btn btn-sm btn-primary pull-right">Create New</a>
				</div>
			</div> --}}
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
								<th>Package Name</th>
								<th>Package Price</th>
								<th>Monthly Charge</th>
								<th>Life Time Chrg.</th>
								<th>expire</th>
								<th width="5%">Action</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
						<tfoot>
							<tr>
								<th width="5%">SL</th>
								<th>Package Name</th>
								<th>Package Price</th>
								<th>Monthly Charge</th>
								<th>Life Time Chrg.</th>
								<th>expire</th>
								<th width="5%">Action</th>
							</tr>
						</tfoot>
					</table>
				</div>


				<!--View Modal -->
				<div class="modal fade" id="viewModel" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog modal-xl">
						<div class="modal-content" id="view_part">

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
	</script>

@endpush

@endsection
