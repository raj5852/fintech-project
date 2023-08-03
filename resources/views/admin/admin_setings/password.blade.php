@extends('layouts.app')

@section('admin_content')
@push('css')

@endpush


<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">Password</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Password Change</li>
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
					<div class="col-lg-12">
						<div class="card">
							<form action="{{ route('admin.password.update') }}" method="post">
								@csrf
								<div class="card-body">
									<div class="row">
										<div class="col-4">
	                                        <label for="inputChoosePassword" class="form-label">Enter Password</label>
	                                        <div class="input-group" id="show_hide_password_old">
	                                            <input type="password" class="form-control border-end-0" id="inputChoosePassword" name="old_password" required autocomplete="current-password" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
	                                        </div>
	                                    </div>
										<div class="col-4">
	                                        <label for="inputChoosePassword" class="form-label">Enter Password</label>
	                                        <div class="input-group" id="show_hide_password_new">
	                                            <input type="password" class="form-control border-end-0" id="inputChoosePassword" name="new_password" required autocomplete="current-password" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
	                                        </div>
	                                    </div>
										<div class="col-4">
	                                        <label for="inputChoosePassword" class="form-label">Enter Password</label>
	                                        <div class="input-group" id="show_hide_password_confirm">
	                                            <input type="password" class="form-control border-end-0" id="inputChoosePassword" name="confirm_password" required autocomplete="current-password" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
	                                        </div>
	                                    </div>
									</div>
									<br>
									<br>
									<div class="row">
										<div class="col-sm-12 text-secondary">
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

	<script>
	    $(document).ready(function () {
	        $("#show_hide_password_new a").on('click', function (event) {
	            event.preventDefault();
	            if ($('#show_hide_password_new input').attr("type") == "text") {
	                $('#show_hide_password_new input').attr('type', 'password');
	                $('#show_hide_password_new i').addClass("bx-hide");
	                $('#show_hide_password_new i').removeClass("bx-show");
	            } else if ($('#show_hide_password_new input').attr("type") == "password") {
	                $('#show_hide_password_new input').attr('type', 'text');
	                $('#show_hide_password_new i').removeClass("bx-hide");
	                $('#show_hide_password_new i').addClass("bx-show");
	            }
	        });
	    });

	    $(document).ready(function () {
	        $("#show_hide_password_old a").on('click', function (event) {
	            event.preventDefault();
	            if ($('#show_hide_password_old input').attr("type") == "text") {
	                $('#show_hide_password_old input').attr('type', 'password');
	                $('#show_hide_password_old i').addClass("bx-hide");
	                $('#show_hide_password_old i').removeClass("bx-show");
	            } else if ($('#show_hide_password_old input').attr("type") == "password") {
	                $('#show_hide_password_old input').attr('type', 'text');
	                $('#show_hide_password_old i').removeClass("bx-hide");
	                $('#show_hide_password_old i').addClass("bx-show");
	            }
	        });
	    });

	    $(document).ready(function () {
	        $("#show_hide_password_confirm a").on('click', function (event) {
	            event.preventDefault();
	            if ($('#show_hide_password_confirm input').attr("type") == "text") {
	                $('#show_hide_password_confirm input').attr('type', 'password');
	                $('#show_hide_password_confirm i').addClass("bx-hide");
	                $('#show_hide_password_confirm i').removeClass("bx-show");
	            } else if ($('#show_hide_password_confirm input').attr("type") == "password") {
	                $('#show_hide_password_confirm input').attr('type', 'text');
	                $('#show_hide_password_confirm i').removeClass("bx-hide");
	                $('#show_hide_password_confirm i').addClass("bx-show");
	            }
	        });
	    });
	</script>

@endpush

@endsection
