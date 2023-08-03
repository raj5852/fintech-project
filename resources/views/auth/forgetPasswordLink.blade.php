@extends('layouts.front')
@section('front_content')
    <main class="login-form mt-5">
        <center>
            <div class="row justify-content-center">
                <div class="col-md-8">

                    <form action="{{ route('custom.reset.password.post') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail
                                Address</label>
                            <div class="col-md-6">
                                <input placeholder="Email" style="padding: 8px; margin: 2px; font-size: 15px;"  type="text" id="email_address" class="form-control" name="email" required
                                    autofocus>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                            <div class="col-md-6">
                                <input type="password" placeholder="Password" style="padding: 8px; margin: 2px; font-size: 15px;" id="password" class="form-control" name="password" required
                                    autofocus>
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm
                                Password</label>
                            <div class="col-md-6">
                                <input placeholder="Confirm Password" type="password" style="padding: 8px; margin: 2px; font-size: 15px;" id="password-confirm" class="form-control"
                                    name="password_confirmation" required autofocus>
                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="col-md-6 ">
                            <button type="submit" class="dashboard__header-balance">
                                Reset Password 
                            </button> 
                        </div><br>

                    </form>

                </div>
            </div>
        </center>
    </main>
@endsection
