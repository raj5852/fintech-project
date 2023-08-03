@extends('layouts.app')

@section('admin_content')
@push('css')

@endpush


<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">Product</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Create Product</li>
					</ol>
				</nav>
			</div>
			<div class="ms-auto">
				<div class="btn-group">
					<a href="{{ route('index.membership') }}" class="btn btn-sm btn-primary pull-right">All Product</a>
				</div>
			</div>
		</div>
		<!--end breadcrumb-->
		<hr/>
		@include('alert.alert')
		<div class="card">
			<div class="card-body">
				<form class="g-3" method="POST" action="{{ route('store.membership') }}" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<label for="inputFirstName" class="form-label">Package Name</label>
							<input type="text" class="form-control" name="membership_name" id="inputFirstName" value="{{ old('membership_name') }}">
						</div>
						<div class="col-md-3">
							<label for="inputLastName" class="form-label">Package Price</label>
							<input type="number" class="form-control" name="membership_price" id="inputLastName" value="{{ old('membership_price') }}">
						</div>
						<div class="col-md-3">
							<label for="inputLastName" class="form-label">Monthly Charge</label>
							<input type="number" class="form-control" name="monthly_charge" id="inputLastName" value="{{ old('monthly_charge') }}">
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 mt-3">
							<div class="mb-3">
								<label class="form-label">Membership Expire</label>
								<select type="date" class="form-control" name="expires_at">
									<option value="" disabled selected>--Select--</option>
									<option value="1">Life Time</option>
									<option value="2">6 Months</option>
									<option value="3">1 Year</option>
									<option value="4">2 Yers</option>
								</select>
							</div>
						</div>
						<div class="col-md-6 mt-3">
							<label for="inputLastName" class="form-label">Life Time Charge</label>
							<input type="number" class="form-control" name="life_time_charge" id="inputLastName" value="{{ old('life_time_charge') }}">
						</div>
					</div>

					<div class="col-lg-12">
						<label for="inputAddress2" class="form-label">Description</label>
						<textarea class="form-control" id="summernote" name="membership_details" placeholder="Package description..." rows="3">
                            {{ old('membership_details') }}
                        </textarea>
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
