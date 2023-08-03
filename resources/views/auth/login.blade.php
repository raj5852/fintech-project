@extends('layouts.front')

@section('front_content')
@push('css')

@endpush

<!--wrapper-->
{{-- <div class="wrapper">
    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                <div class="col mx-auto">
                    <div class="mb-4 text-center">
                        <img src="{{ asset('backend/') }}/assets/images/logo-img.png" width="180" alt="" />
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="login-separater text-center mb-4"> <span> SIGN IN WITH EMAIL</span>
                                    <hr/>
                                </div>
                                <div class="form-body">
                                    @include('alert.alert')
                                    <form class="row g-3" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="col-12">
                                            <label for="inputEmailAddress" class="form-label">Email Address</label>
                                            <input type="email" class="form-control" id="inputEmailAddress" placeholder="Email Address" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputChoosePassword" class="form-label">Enter Password</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" class="form-control border-end-0" id="inputChoosePassword" name="password" required autocomplete="current-password" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="remember" id="flexSwitchCheckChecked" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Remember me</label>
                                            </div>




                                        </div>
                                        <div class="col-md-6 text-end"> <a href="{{ route('password.request') }}">Forgot Password ?</a>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Sign in</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
</div> --}}

<!-- breadcrumb  -->
<div class="bredcrumb">
    <h2 class="bredcrumb__title">login&amp;register</h2>
    <ul class="bredcrumb__items">
        <li>Home <i class="bi bi-chevron-right"></i></li>
        <li>login&amp;register</li>
    </ul>
</div>
<!-- login form  -->
<div class="login__area">
    <div class="container">
        @include('alert.alert')
        <div class="login__area-wrapper">
            <div class="login__area-left">
                <div class="login__area-inner">
                    <h4 class="login__area-title">login</h4>
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="login__area-field">
                            <input  class="input-control-ibx" type="email" placeholder="Enter email" name="email" value="{{ old('email') }}">
                            <i class="bi bi-person login__area-icon"></i>
                        </div>
                        <div class="login__area-field">
                            <input  class="input-control-ibx" id="password-field" type="password" placeholder="password" name="password">
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            <i class="bi bi-lock login__area-icon"></i>
                        </div>


                        <div class="col-md-6 login-page">
                        <div class="form-check form-switch custom_change_switch">
									<input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
									<label class="form-check-label" for="flexSwitchCheckDefault">Remember me </label>
								</div>
                        </div>

                        <div class="login__area-submit">
                            <button class="login__area-submitbtn"  type="submit">submit</button>
                            <a class="login__area-lostpass" href="{{ url('password/reset') }}">lost password?</a>
                        </div>
                    </form>
                </div>
                <div class="login__area-login">
                    <a class="login__area-sign" href="{{ route('auth.google') }}"><img src="{{ asset('frontend/') }}/img/google1.png" alt="">continue with google</a>
                </div>
            </div>
            <div class="login__area-right">
                <div class="login__area-inner">
                    <h4 class="login__area-title">register</h4>
                    <form action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="login__area-field">
                            <input type="text"  class="input-control-ibx" placeholder="Name" name="name" class="@error('name') is-invalid @enderror">
                            <i class="bi bi-person login__area-icon"></i>
                        </div>
                        <div class="login__area-field">
                            <input type="email"  class="input-control-ibx" name="email" placeholder="Email" class="@error('email') is-invalid @enderror">
                            <i class="bi bi-envelope login__area-icon"></i>
                        </div>
                        <div class="login__area-field">
                            <input  id="password-register-field"  class="input-control-ibx" type="password" placeholder="Password" name="password" class="@error('password') is-invalid @enderror">
                            <span toggle="#password-register-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            <i class="bi bi-lock login__area-icon"></i>
                        </div>
                        <div class="login__area-field">
                            <input id="password-confirm-field"  class="input-control-ibx" type="password" placeholder="Confirm password" name="password_confirmation" autocomplete="new-password">
                            <span toggle="#password-confirm-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            <i class="bi bi-lock login__area-icon"></i>
                        </div>
                        <div class="login__area-submit">
                            <button class="login__area-submitbtn"  type="submit">register</button>
                        </div>

                        <div class="login__area-login">
                            <a class="login__area-sign" href="{{ route('auth.google') }}"><img src="{{ asset('frontend/') }}/img/google1.png" alt="">continue with google</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end wrapper-->
@push('js')
<script>
    $(document).ready(function () {
        $("#show_hide_password a").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("bx-hide");
                $('#show_hide_password i').removeClass("bx-show");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("bx-hide");
                $('#show_hide_password i').addClass("bx-show");
            }
        });
    });
</script>
@endpush
@endsection
