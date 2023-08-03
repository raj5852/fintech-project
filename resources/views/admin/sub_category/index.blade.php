@extends('layouts.app')

@section('admin_content')
@push('css')

@endpush


<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">Sub Category</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Sub Category</li>
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
								<th width="10%">SL</th>
								<th>Category Name</th>
								<th>Sub Category Name</th>
								<th width="15%">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $key=>$row)
							<tr>
								<td>{{ ++$key }}</td>
								<td>{{ $row->category->category_name }}</td>
								<td>{{ $row->subcategory_name }}</td>
								<td>
									<button class="btn btn-sm btn-info edit" data-bs-toggle="modal" data-bs-target="#editModel" data-id="{{ $row->id }}" >Edit</button>
{{--
									<form action="{{ route('delete.sub_category',$row->id) }}" style="display: inline-block;" method="POST" id="delete_form">
									    @csrf
									    @method('DELETE')
									    <button class="btn btn-sm btn-danger" id="delete" type="submit">Delete</button>
									</form> --}}

                                    <a href="{{ route('delete.sub_category',$row->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a>
								</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th>SL</th>
								<th>Sub Category Name</th>
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
							<form action="{{ route('store.sub_category') }}" method="post">
								@csrf
								<div class="modal-header">
									<h5 class="modal-title">Create New Sub Category</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div class="col-md-12">
										<label for="inputFirstName" class="form-label">Category <sup class="text-danger">*</sup></label>
										<select type="text" class="form-control" name="category_id" id="inputFirstName">
											<option value="" selected>--Select--</option>
											@foreach($category as $cat)
											<option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="modal-body">
									<div class="col-md-12">
										<label for="inputFirstName" class="form-label">Sub-category Name <sup class="text-danger">*</sup></label>
										<input type="text" class="form-control" name="subcategory_name" id="inputFirstName" value="{{ old('subcategory_name') }}">
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
	      var id = $(this).data('id'); //i or 2 Sub categoryid
	      $.get("{{ url('admin/sub-category/edit') }}/"+id,
	      function (data) {
	           $('#edit_section').html(data);
	        })
	    });
</script>

@endpush

@endsection
