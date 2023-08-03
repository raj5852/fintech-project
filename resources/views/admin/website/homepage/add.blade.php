@extends('layouts.app')

@section('admin_content')
@push('css')

@endpush


<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">HoemPage </div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Create HoemPage</li>
					</ol>
				</nav>
			</div>
			<div class="ms-auto">
				<div class="btn-group">
					<a href="{{ route('index.homepage') }}" class="btn btn-sm btn-primary pull-right">All HoemPage</a>
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
				<form class="g-3" method="POST" action="{{ route('store.homepage') }}" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<label for="inputFirstName" class="form-label">Title </label>
							<input type="text" class="form-control" name="title" id="inputFirstName" value="{{ old('title') }}"  placeholder="Enter Title" required>
						</div>





                        <div class="col-md-6">
							<label for="inputLastName" class="form-label">Description </label>
							<textarea class="form-control" id="summernote" name="details" placeholder=" description..." rows="3">
                               {{ old('details') }}
                            </textarea>
						</div>



					</div>




					<br>
					<div class="col-12">
						<button type="submit" class="btn btn-primary px-5">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@push('js')


@endpush

@endsection
