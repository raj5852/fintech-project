@extends('layouts.front')

@section('front_content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

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
                            <input type="email" placeholder="Enter email" name="email" value="{{ old('email') }}">
                            <i class="bi bi-person login__area-icon"></i>
                        </div>
                        <div class="login__area-field">
                            <input type="password" placeholder="password" name="password">
                            <i class="bi bi-lock login__area-icon"></i>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input  class="" type="checkbox" name="remember" >
                                <label class="form-check-label">Remember me</label>
                            </div>
                        </div>
                        <div class="login__area-submit">
                            <button class="login__area-submitbtn"  type="submit">submit</button>
                            <a class="login__area-lostpass" href="{{ url('password/reset') }}">lost password?</a>
                        </div>
                    </form>
                </div>
                <div class="login__area-login">
                    <a class="login__area-sign" href="{{ route('auth.google') }}"><img src="img/google1.png" alt="">continue with google</a>
                </div>
            </div>
            <div class="login__area-right">
                <div class="login__area-inner">
                    <h4 class="login__area-title">register</h4>
                    <form action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="login__area-field">
                            <input type="text" placeholder="Name" name="name" class="@error('name') is-invalid @enderror">
                            <i class="bi bi-person login__area-icon"></i>
                        </div>
                        <div class="login__area-field">
                            <input type="email" name="email" placeholder="Email" class="@error('email') is-invalid @enderror">
                            <i class="bi bi-envelope login__area-icon"></i>
                        </div>
                        <div class="login__area-field">
                            <input type="password" placeholder="Password" name="password" class="@error('password') is-invalid @enderror">
                            <i class="bi bi-lock login__area-icon"></i>
                        </div>
                        <div class="login__area-field">
                            <input type="password" placeholder="Confirm password" name="password_confirmation" autocomplete="new-password">
                            <i class="bi bi-lock login__area-icon"></i>
                        </div>
                        <div class="login__area-submit">
                            <button class="login__area-submitbtn"  type="submit">register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
