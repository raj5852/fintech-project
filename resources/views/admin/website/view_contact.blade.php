
@extends('layouts.app')

@section('admin_content')
@push('css')

@endpush


<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">View Contact</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">View Conatct Membership</li>
					</ol>
				</nav>
			</div>
			<div class="ms-auto">
				<div class="btn-group">
					<a href="{{ route('all.contact') }}" class="btn btn-sm btn-primary pull-right">Back</a>
				</div>
			</div>
		</div>
		<!--end breadcrumb-->
		<hr/>
		@include('alert.alert')
		<div class="card">
			<div class="card-body">
				<form class="g-3" method="POST" action="" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<label for="inputFirstName" class="form-label">Name</label>
							<input type="text" class="form-control" value="{{ $data->name }}" name="membership_name" id="inputFirstName" readonly>
						</div>
						<div class="col-md-6">
							<label for="inputLastName" class="form-label">Email</label>
							<input type="text" value="{{ $data->email }}" class="form-control" name="membership_price" id="inputLastName" readonly>
						</div>
						<div class="col-md-6">
							<label for="inputLastName" class="form-label">Subject</label>
							<input type="text" class="form-control" value="{{ $data->subject }}" name="subject" id="inputLastName" readonly>
						</div>
                        <div class="col-md-6">
							<label for="inputLastName" class="form-label">Address</label>
							<input type="text" class="form-control" value="{{ $data->address }}" name="subject" id="inputLastName" readonly>
						</div>


                        <div class="col-lg-12">
                            <label for="inputAddress2" class="form-label">Description</label>
                            <textarea class="form-control" id="summernote" name="membership_details" placeholder="Package description..." rows="3">{{ $data->description }}</textarea>
                        </div>


					</div>




					<br>

				</form>
			</div>
		</div>
	</div>
</div>

@push('js')


@endpush

@endsection
