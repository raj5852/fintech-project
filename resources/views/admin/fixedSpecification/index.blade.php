@extends('layouts.app')

@section('admin_content')
@push('css')

@endpush


<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">Fixed Specifications</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Fixed Specification</li>
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
								<th>Question</th>
								<th>Answer</th>
								<th width="15%">Action</th>
							</tr>
						</thead>
						<tbody>
							{{-- @foreach($datas as $data)
							@endforeach --}}
                            @forelse ($datas as $data)

							<tr>
								<td>{{ $loop->index+1 }}</td>
								<td>{{ $data->question }}</td>
								<td>{{ Str::limit($data->answer, 20) }}</td>
								<td>
									<button class="btn btn-sm btn-info edit" data-bs-toggle="modal" data-bs-target="#editModel" data-id="{{ $data->id }}" >Edit</button>
                                    <a href="{{ route('specification.delete',$data->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a>
								</td>
							</tr>
                            @empty
                            <tr>
                                <td colspan="50" class="text-center text-warning">No data found</td>
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
							<form action="{{ route('specification.store') }}" method="post">
								@csrf
								<div class="modal-header">
									<h5 class="modal-title">Create New specification</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<div class="col-md-12">
											<label for="inputFirstName" class="form-label">Question <sup class="text-danger">*</sup></label>
											<input type="text" class="form-control" name="question" id="inputFirstName" value="{{ old('question') }}">
										</div>
										<br>
										<div class="col-md-12">
											<label for="inputFirstName" class="form-label">Answer <sup class="text-danger">*</sup></label>
                                            <textarea name="answer" rows="4" class="form-control">{{ old('answer') }}</textarea>
										</div>
										<br>
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
	      $.get("{{ url('admin/fixed/specification/edit') }}/"+id,
	      function (data) {
	           $('#edit_section').html(data);
	        })
	    });
</script>

@endpush

@endsection
