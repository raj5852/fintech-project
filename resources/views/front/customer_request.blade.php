@php
    $setting=DB::table('web_sites')->first();
@endphp

@extends('layouts.front')
@section('title')
Customer Request
@endsection

@section('front_content')

@push('css')
@endpush


<section class="custom__area">
	<div class="container">
		<div class="row g-0">
			<div class="col-lg-7">
				<div class="custom__area-left">
					<span class="custom__area-subtitle">Get Started</span>
					<h2 class="custom__area-title">{{ $setting->contact_title }}</h2>
					<p class="custom__area-dis">{{ $setting->contact_desc }}</p>
					<div class="row align-items-center">

						<div class="col-md-3">
							<a href="{{ url('shop') }}" class="btn-one">go to shop</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-5">
				<div class="custom__area-right">
					<div class="custom__area-items">


                        @foreach ($homepages as $homepage)


						<div class="custom__area-item">
							<div class="custom__area-thumb">
								<span>{{ $loop->index+1 }}</span>
							</div>
							<div class="custom__area-content">
								<h3>{{ $homepage->title }}</h3>
								<p>{!! $homepage->details !!}</p>
							</div>
						</div>
                        @endforeach

					</div>


				</div>
			</div>
		</div>
		<div class="custom__form">
			<div class="row">
				<div class="col-lg-8">
					<h3 class="custom__form-title">Software Request Form</h3>
					<form action="{{ url('request-store') }}" method="post" enctype="multipart/form-data">
                        @csrf
						<div class="row">
							<div class="col-lg-6">
								<div class="custom__form-field">
									<label for="name">Name <span>*</span></label>
									<input type="text" class="input-control-ibx" name="customer_name" id="customer_name" >
                                    @error('customer_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
								</div>
							</div>
							<div class="col-lg-6">
								<div class="custom__form-field">
									<label for="name">Email  <span>*</span></label>
                                    <input type="email" class="input-control-ibx" name="customer_email" id="customer_email">
                                    @error('customer_email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
								</div>
							</div>
						</div>

						<div class="row">
							<h3 class="custom__form-mark">What Would You Like To Do *</h3>
                            @foreach ($requestProducts as $key => $requestProduct)
                            <div class="col-lg-4">
                                <div class="custom__form-markcheck">
                                    <input id="g{{ $key }}" type="checkbox" name="liketodo[]"
                                        value="{{ $requestProduct->name }}">
                                    <label for="g{{ $key }}">{{ $requestProduct->name }}</label>
                                </div>
                            </div>
                        @endforeach
                            <h3 class="custom__form-mark">Select Platform *</h3>
                            @foreach ($requestProducttwos as $key => $requestProducttwo)
                                    <div class="col-lg-4">
                                        <div class="custom__form-markcheck">
                                            <input id="l{{ $key }}" type="checkbox" name="platform[]"
                                                value="{{ $requestProducttwo->name }}">
                                            <label for="l{{ $key }}">{{ $requestProducttwo->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
						</div>


						<div class="custom__form-field">
							<label for="name">Software Information</label>
                            <input class="input-control-ibx" type="text" name="software_name" id="software_name" required
                            placeholder="Software Name">
                        @error('software_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
						</div>

						<div class="custom__form-field">
							<label for="name">Upload a zip file describing your EA or Indicator Strategy</label>
                            <input   type="file" class="input-file input-control-ibx" name="imageone" value="imageone">
                            @error('imageone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
						</div>
						<div class="custom__form-field">
							<label for="name">Upload EA or Indicator</label>
                            <input type="file" name="imagetwo" class="input-file input-control-ibx" value="imagetwo">
                            @error('imagetwo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
						</div>

						<!-- <div class="custom__form-field">
							<label for="name">Upload a zip file describing your EA or Indicator Strategy</label>
							<input type="file" name="imageone" id="name">
						</div>
						<div class="custom__form-field">
							<label for="name">Upload EA or Indicator</label>
							<input type="file" name="imagetwo" id="name">
						</div> -->
						<div class="custom__form-field">
							<label for="name">Anything Else we need to know?</label>
							<textarea class="input-control-ibx" name="details">

							</textarea>
                                @error('details')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
						</div>





						<div class="custom__form-field">
							<button class="custom-btn2" type="submit">submit</button>
						</div>
					</form>
				</div>
				<div class="col-lg-4">
					<aside class="custom__sidebar">
						<h3 class="custom__sidebar-title">{{ $setting->available_title }}</h3>
						<p class="custom__sidebar-dis">{!! $setting->available_desc !!}</p>

					</aside>
				</div>
			</div>
		</div>
	</div>
</section>


<!-- footer -->

@push('js')
@endpush

@endsection
