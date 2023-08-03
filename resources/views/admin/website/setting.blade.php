@extends('layouts.app')

@section('admin_content')
@push('css')

@endpush


<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">Web Site Setting</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Web Site Setting</li>
					</ol>
				</nav>
			</div>

		</div>
		<!--end breadcrumb-->
		<hr/>
		@include('alert.alert')
		<div class="card">
			<div class="card-body">
				<form class="g-3" method="POST" action="{{route('update.setting',$setting->id)}}" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<label for="inputFirstName" class="form-label">title </label>
							<input type="text" class="form-control" name="title" value="{{ $setting->title }}" id="inputFirstName">
						</div>

                        <div class="col-md-6">
							<label for="inputFirstName" class="form-label">Description </label>
							<input type="text" class="form-control" name="details" value="{{ $setting->details }}" id="inputFirstName">
						</div>

                        <div class="col-md-6">
							<label for="inputFirstName" class="form-label">Marketplace Title </label>
							<input type="text" class="form-control" name="market_title" value="{{ $setting->market_title }}" id="inputFirstName">
						</div>

                        <div class="col-md-6">
							<label for="inputFirstName" class="form-label">Marketplace Description </label>
							<input type="text" class="form-control" name="market_details" value="{{ $setting->market_details }}" id="inputFirstName">
						</div>




						<div class="col-md-6">
							<label for="inputLastName" class="form-label">Web Site Logo</label>
							<input type="file" class="form-control" name="image" id="inputLastName">


                            <img src="{{asset('backend/setting/'.$setting->image) }}" class="rounded border" width="50" alt="">
						</div>


                        <div class="col-md-6">
							<label for="inputFirstName" class="form-label">Latest Product Title </label>
							<input type="text" class="form-control" name="latest_product_title" value="{{ $setting->latest_product_title }}" id="inputFirstName">
						</div>

                        <div class="col-md-6">
							<label for="inputFirstName" class="form-label">Latest Product Description </label>
							<input type="text" class="form-control" name="latest_product_des" value="{{ $setting->latest_product_des }}" id="inputFirstName">
						</div>

                        <div class="col-md-6">
							<label for="inputFirstName" class="form-label">Free Product Title </label>
							<input type="text" class="form-control" name="free_product_title" value="{{ $setting->free_product_title }}" id="inputFirstName">
						</div>

                        <div class="col-md-6">
							<label for="inputFirstName" class="form-label">Free Product Description </label>
							<input type="text" class="form-control" name="free_product_des" value="{{ $setting->free_product_des }}" id="inputFirstName">
						</div>

                        <div class="col-md-6">
							<label for="inputFirstName" class="form-label">Membership Title </label>
							<input type="text" class="form-control" name="member_title" value="{{ $setting->member_title }}" id="inputFirstName">
						</div>

                        <div class="col-md-6">
							<label for="inputFirstName" class="form-label">Membership Description </label>
							<input type="text" class="form-control" name="member_des" value="{{ $setting->member_des }}" id="inputFirstName">
						</div>

                        <div class="col-md-6">
							<label for="inputFirstName" class="form-label">Request  Customer Title </label>
							<input type="text" class="form-control" name="software_title" value="{{ $setting->software_title }}" id="inputFirstName">
						</div>

                        <div class="col-md-6">
							<label for="inputFirstName" class="form-label">Request Customer  Description </label>
							<input type="text" class="form-control" name="software_des" value="{{ $setting->software_des }}" id="inputFirstName">
						</div>


                        <div class="col-md-6">
							<label for="inputFirstName" class="form-label">Client  Say  Title </label>
							<input type="text" class="form-control" name="tesmonial" value="{{ $setting->tesmonial }}" id="inputFirstName">
						</div>

                        <div class="col-md-6">
							<label for="inputFirstName" class="form-label">Conatct Page Title </label>
							<input type="text" class="form-control" name="contact_title" value="{{ $setting->contact_title }}" id="inputFirstName">
						</div>

                        <div class="col-md-6">
							<label for="inputFirstName" class="form-label">Conatct Page Description </label>
							<input type="text" class="form-control" name="contact_desc" value="{{ $setting->contact_desc }}" id="inputFirstName">
						</div>

                        <div class="col-md-6">
							<label for="inputFirstName" class="form-label">Availble Title </label>
							<input type="text" class="form-control" name="available_title" value="{{ $setting->available_title }}" id="inputFirstName">
						</div>

                        <div class="col-md-6">

                            <label for="inputFirstName" class="form-label">Availble Description </label>
                            <textarea class="form-control" name="available_desc" placeholder="Enter description...." rows="6" id="summernote">
                                {!! $setting->available_desc !!}
                            </textarea>
						</div>

                        <div class="col-md-6">
							<label for="inputFirstName" class="form-label">Subcription title </label>
							<input type="text" class="form-control" name="test_title" value="{{ $setting->test_title }}" id="inputFirstName">
						</div>


                        <div class="col-md-6">
							<label for="inputFirstName" class="form-label">Subcription Details </label>
							<input type="text" class="form-control" name="test_desc" value="{{ $setting->test_desc }}" id="inputFirstName">
						</div>

                        <div class="col-md-6">
							<label for="inputFirstName" class="form-label">About Software title </label>
							<input type="text" class="form-control" name="software_title_about" value="{{ $setting->software_title_about }}" id="inputFirstName">
						</div>


                        <div class="col-md-6">
							<label for="inputFirstName" class="form-label">About Software Description </label>
							<input type="text" class="form-control" name="software_description_about" value="{{ $setting->software_description_about }}" id="inputFirstName">
						</div>

                        <div class="col-md-6">
							<label for="inputFirstName" class="form-label">Contact  Page title </label>
							<input type="text" class="form-control" name="contact_page" value="{{ $setting->contact_page }}" id="inputFirstName">
						</div>


                        <div class="col-md-6">
							<label for="inputFirstName" class="form-label">Contact Page  Description </label>
                            <textarea name="contact_description" id="summernotetwo" cols="30" rows="10">
                                {!! $setting->contact_description !!}
                            </textarea>
						</div>


                        <div class="col-md-6">
							<label for="inputFirstName" class="form-label">Email </label>
							<input type="text" class="form-control" name="email" value="{{ $setting->email }}" id="inputFirstName">
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


@endpush

@endsection
