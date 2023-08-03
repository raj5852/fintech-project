@extends('layouts.app')

@section('admin_content')

<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3"></div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">About Features</li>
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
								<th width="10%">SL</th>
								<th>Title</th>
								<th>Photo
                                </th>
								<th width="15%">Action</th>
							</tr>
						</thead>
						<tbody>
							@forelse($datas as $data)
							<tr>
								<td>{{ $loop->index+1 }}</td>
								<td>{{ $data->title }}</td>
								<td>

                                </td>
								<td>
									<button class="btn btn-sm btn-info features-edit" data-bs-toggle="modal" data-bs-target="#editModel" data-id="{{ $data->id }}" >Edit</button>
                                    <a href="{{ route('delete.afeature',$data->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a>

								</td>
							</tr>
                            @empty
                            <tr>
                                <td colspan="50" class="text-warning text-center">No data found!</td>
                            </tr>
                            @endforelse
						</tbody>
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

							<form action="{{ route('store.afeature') }}" method="post" enctype="multipart/form-data">
								@csrf
								<div class="modal-header">
									<h5 class="modal-title">Create New Feature</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div class="col-md-12">
										<label for="inputFirstName" class="form-label">Title <sup class="text-danger">*</sup></label>
										<input type="text" class="form-control" name="title" id="inputFirstName"  value="{{ old('title') }}">
                                </button>
									</div>
								</div>
								<div class="modal-body">
									<div class="col-md-12">
										<label for="inputFirstName" class="form-label">Description <sup class="text-danger">*</sup></label>
                                        <textarea name="description" rows="6" class="form-control" id="summernote">
                                            {{ old('description') }}
                                        </textarea>
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
	    $('body').on('click', '.features-edit', function () {
	      var id = $(this).data('id'); //i or 2 categoryid
	      $.get("{{ url('admin/afeatures/edit') }}/"+id,
	      function (data) {
	           $('#edit_section').html(data);
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
