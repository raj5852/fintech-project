@extends('layouts.app')

@section('admin_content')
@push('css')

@endpush


<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">About Us</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">About Us</li>
					</ol>
				</nav>
			</div>

		</div>
		<!--end breadcrumb-->
		<hr/>
		@include('alert.alert')
		<div class="card">
			<div class="card-body">
				<form class="g-3" method="POST" action="{{route('update.about',$about->id)}}" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<label for="inputFirstName" class="form-label">About Us </label>
							<input type="text" class="form-control" name="about_us" value="{{ $about->about_us }}" id="inputFirstName">
						</div>

                        <div class="col-md-6">
							<label for="inputFirstName" class="form-label">About Title </label>
							<input type="text" class="form-control" name="about_title" value="{{ $about->about_title }}" id="inputFirstName">
						</div>

                        <div class="mb-3 col-md-12">
                            <label for="formFile" class="form-label">Description <sup class="text-danger">*</sup></label>
                            <textarea class="form-control" name="description" placeholder="Enter description...." rows="6" id="summernote">
                                {!! $about->description !!}
                            </textarea>
                        </div>

                        {{-- <div class="mb-3 col-md-12">
                            <label for="formFile" class="form-label">Description <sup class="text-danger">*</sup></label>
                            <textarea class="form-control" name="page_description" placeholder="Enter description...." rows="6" id="summernote"></textarea>
                        </div> --}}

						<div class="col-md-6">
							<label for="inputLastName" class="form-label">About Image</label>
							<input type="file" class="form-control" name="image" id="inputLastName">


                            <img src="{{asset('backend/about/'.$about->image) }}" class="rounded border" width="50" alt="">


						</div>




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

<script>
     $(document).ready(function() {
	      $('#summernote').summernote({
	      	height: 280,
	      });
	    });

</script>
@endpush

@endsection
