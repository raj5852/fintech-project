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
						<li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
					</ol>
				</nav>
			</div>
			<div class="ms-auto">
				<div class="btn-group">
					<button type="button" class="btn btn-sm btn-primary pull-right" data-bs-toggle="modal" data-bs-target="#createModel">Create Privacy Policy</button>
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
								<th>Heading</th>
								<th>Create Time
                                </th>
								<th width="15%">Action</th>
							</tr>
						</thead>
						<tbody>
							@forelse($datas as $data)
							<tr>
								<td>{{ $loop->index+1 }}</td>
								<td>{{ $data->heading }}</td>
								<td>
                                   {{$data->created_at}}
                                </td>
								<td>
									<button class="btn btn-sm btn-info features-edit" data-bs-toggle="modal" data-bs-target="#editModel" data-id="{{ $data->id }}" >Edit</button>
                                    <a href="{{ route('delete.features',$data->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a>
								
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

							<form action="{{ route('store.features') }}" method="post" enctype="multipart/form-data">
								@csrf
								<div class="modal-header">
									<h5 class="modal-title">Create New Create Privacy Policy</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div class="col-md-12">
										<label for="inputFirstName" class="form-label">Heading <sup class="text-danger">*</sup></label>
										<input type="text" class="form-control" name="heading" id="inputFirstName"  value="{{ old('heading') }}">

                                    {{-- <button class="btn btn-secondary" data-iconset="fontawesome5" data-icon="fas fa-wifi" role="iconpicker" name="heading"></button> --}}

                                    {{-- <button
                                    class="btn btn-secondary social-picker"
                                    name="heading"
                                    data-search="true"
                                    data-search-text="Search icon..."
                                    data-iconset="fontawesome5"
                                    role="iconpicker"
                                    data-icon="fab fa-font-awesome"> --}}
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
	      $.get("{{ url('admin/features/edit') }}/"+id,
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
