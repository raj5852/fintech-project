@extends('layouts.app')

@section('admin_content')
@push('css')

@endpush


<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">Testimonial</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Testimonial</li>
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
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="example2" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th width="5%">SL</th>
								<th>Name</th>
								<th>Image</th>
								<th>Designation</th>
								<th>Description</th>
								<th width="10%">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $key=>$row)
							<tr>
								<td>{{ ++$key }}</td>
								<td>{{ $row->name }}</td>
								<td>
									<img src="{{ asset($row->image) }}" width="40">
								</td>
								<td>{{ $row->designation }}</td>
								<td>
									{{-- {{ $row->description }} --}}
									{{ Str::limit($row->description, 100, '') }}
								</td>
								<td>
									<button class="btn btn-sm btn-info edit" data-bs-toggle="modal" data-bs-target="#editModel" data-id="{{ $row->id }}" >Edit</button>
                                    <a href="{{ route('delete.testimonial',$row->id) }}" class="btn btn-danger" id="delete" >Delete</a>


                                    
								</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th>SL</th>
								<th>Name</th>
								<th>Image</th>
								<th>Designation</th>
								<th>Description</th>
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
							<form action="{{ route('store.testimonial') }}" method="post" enctype="multipart/form-data">
								@csrf
								<div class="modal-header">
									<h5 class="modal-title">Create New Testimonial</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<div class="col-md-12">
											<label for="inputFirstName" class="form-label">Name <sup class="text-danger">*</sup></label>
											<input type="text" class="form-control" placeholder="Enter name" name="name" id="inputFirstName" value="{{ old('name') }}">
										</div>
										<br>
										<div class="col-md-12">
											<label for="inputFirstName" class="form-label">Designation <sup class="text-danger">*</sup></label>
											<input type="text" class="form-control" placeholder="Enter designation" name="designation" id="inputFirstName" value="{{ old('designation') }}">
										</div>
										<br>
										<div class="mb-3 col-md-12">
											<label for="formFile" class="form-label">Image</label>
											<input class="form-control" name="image" type="file" id="formFile" required>
										</div>
										<br>
										<div class="mb-3 col-md-12">
											<label for="formFile" class="form-label">Description <sup class="text-danger">*</sup></label>
											<textarea class="form-control" name="description" placeholder="Enter description...." rows="6" id="formFile">
                                                {{ old('designation') }}
                                            </textarea>
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
	      $.get("{{ url('admin/testimonial/edit') }}/"+id,
	      function (data) {
	           $('#edit_section').html(data);
	        })
	    });
</script>

@endpush

@endsection
