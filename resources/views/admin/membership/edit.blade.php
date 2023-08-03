@extends('layouts.app')

@section('admin_content')
@push('css')

@endpush


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
						<li class="breadcrumb-item active" aria-current="page">Edit Membership</li>
					</ol>
				</nav>
			</div>
			<div class="ms-auto">
				<div class="btn-group">
					<a href="{{ route('index.membership') }}" class="btn btn-sm btn-primary pull-right">Back</a>
				</div>
			</div>
		</div>
		<!--end breadcrumb-->
		<hr/>
		@include('alert.alert')
		<div class="card">
			<div class="card-body">
				<form class="g-3" method="POST" action="{{ route('update.membership',$data->id) }}" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<label for="inputFirstName" class="form-label">Package Name</label>
							<input type="text" class="form-control" value="{{ $data->membership_name }}" name="membership_name" id="inputFirstName">
						</div>
						<div class="col-md-3">
							<label for="inputLastName" class="form-label">Package Price</label>
							<input type="number" value="{{ $data->membership_price }}" class="form-control" name="membership_price" id="inputLastName">
						</div>
						<div class="col-md-3">
							<label for="inputLastName" class="form-label">Monthly Charge</label>
							<input type="number" class="form-control" value="{{ $data->monthly_charge }}" name="monthly_charge" id="inputLastName">
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 mt-3">
							<div class="mb-3">
								<label class="form-label">Membership Expire</label>
								<select type="date" class="form-control" name="expires_at">
									<option value="" disabled selected>--Select--</option>
									<option value="1" @if($data->expires_at == 1) selected @endif>Life Time</option>
									<option value="2" @if($data->expires_at == 2) selected @endif>6 Months</option>
									<option value="3" @if($data->expires_at == 3) selected @endif>1 Year</option>
									<option value="4" @if($data->expires_at == 4) selected @endif>2 Yers</option>
								</select>
							</div>
						</div>
						<div class="col-md-6 mt-3">
							<label for="inputLastName" class="form-label">Life Time Charge</label>
							<input type="number" class="form-control" value="{{ $data->life_time_charge }}" name="life_time_charge" id="inputLastName">
						</div>
					</div>

                    <div class="col-lg-12">
						<label for="inputAddress2" class="form-label">Short </label>
						<textarea class="form-control"  name="short" placeholder="Package Short..." rows="3">{{ $data->short }}</textarea>
					</div>

                    <div class="col-lg-12">
						<label for="inputAddress2" class="form-label">Long </label>
						<textarea class="form-control" name="long" placeholder="Package Long..." rows="3">{{ $data->long }}</textarea>
					</div>

					<div class="col-lg-12">
						<label for="inputAddress2" class="form-label">Main Description</label>
						<textarea class="form-control" id="summernote" name="membership_details" placeholder="Package description..." rows="3">{{ $data->membership_details }}</textarea>
					</div>

					<br>
					<div class="col-12">
						<button type="submit" class="btn btn-primary px-5">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@push('js')


@endpush

@endsection
