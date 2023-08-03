@extends('layouts.app')

@section('admin_content')
@push('css')

@endpush


<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">Profile</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Profilep</li>
					</ol>
				</nav>
			</div>
		</div>

		<!---Alert---->

		@include('alert.alert')


		<!----End Alert--->

		<!--end breadcrumb-->
		<div class="container">
			<div class="main-body">
				<div class="row">
					<div class="col-lg-4">
						<div class="card">
							<div class="card-body">
								<div class="d-flex flex-column align-items-center text-center">
									@if(isset(Auth::user()->image))
										<img src="{{ asset(Auth::user()->image) }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
									@else
										<img src="{{ asset('backend/') }}/assets/images/insert.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
									@endif
									<div class="mt-3">
										<h4>{{ Auth::user()->name }}</h4>
										<p class="text-secondary mb-1">{{ Auth::user()->designation }}</p>
										<p class="text-muted font-size-sm">{{ Auth::user()->address }}</p>
									</div>
								</div>
								<hr class="my-4" />
							</div>
						</div>
					</div>
					<div class="col-lg-8">
						<div class="card">
							<form action="{{ route('update.profile') }}" method="post" enctype="multipart/form-data">
								@csrf
								<div class="card-body">
									<div class="row mb-3">
										<div class="col-sm-3">
											<h6 class="mb-0">Full Name</h6>
										</div>
										<div class="col-sm-9 text-secondary">
											<input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" />
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-sm-3">
											<h6 class="mb-0">Email</h6>
										</div>
										<div class="col-sm-9 text-secondary">
											<input type="email" class="form-control" placeholder="exampl@example.com" name="email" value="{{ Auth::user()->email }}" />
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-sm-3">
											<h6 class="mb-0">Phone</h6>
										</div>
										<div class="col-sm-9 text-secondary">
											<input type="number" name="phone" class="form-control" placeholder="(239) 816-9029" value="{{ Auth::user()->phone }}"  />
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-sm-3">
											<h6 class="mb-0">Mobile</h6>
										</div>
										<div class="col-sm-9 text-secondary">
											<input type="number" class="form-control" name="mobile" placeholder="(320) 380-4539" value="{{ Auth::user()->mobile }}" />
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-sm-3">
											<h6 class="mb-0">Image</h6>
										</div>
										<div class="col-sm-9 text-secondary">
											<input type="file" class="form-control" name="image" />
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-sm-3">
											<h6 class="mb-0">Address</h6>
										</div>
										<div class="col-sm-9 text-secondary">
											<input type="text" name="address" class="form-control" placeholder="Bay Area, San Francisco, CA" value="{{ Auth::user()->address }}" />
										</div>
									</div>
									<div class="row">
										<div class="col-sm-3"></div>
										<div class="col-sm-9 text-secondary">
											<input type="submit" class="btn btn-primary px-4" value="Save Changes" />
										</div>
									</div>
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

@endpush

@endsection
