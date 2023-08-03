@extends('layouts.front')
@section('front_content')
    <div>
        <center>
            <div>
                <div>
                    <div>
                        <br><br>

                        <div class="row">
                            <center>
                                <div class="col-md-6">
                                    @if (session('message'))
                                        <div class="alert alert-success">{{ session('message') }}</div>
                                    @endif
                                </div>
                            </center>
                        </div>

                        <form method="POST" class="my-5 py-5 mx-4" action="{{ route('custom.password.reset') }}">
                            @csrf
                            <h1 class="text-center reset-pass-abxi">Reset Your Password</h1><br>
                            <h2 class="text-center mb-3">Enter your email address and we'll send you an email with
                                instructions to reset your password</h2><br>

                            <div class="row">

                                <center>

                                    <div class="col-md-6">

                                        <input style="padding: 20px; font-size: 17px;" id="email" type="email"
                                            class="input-control-ibx @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus
                                            placeholder="Email Address">

                                    </div>
                                </center>
                            </div>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <br>
                            <center >
                                <button style="border-radius:10px"  type="submit" class="common-btn">SEND
                                    MAIL</button>
                            </center>
                        </form>
                        <br><br>

                    </div>
                </div>
            </div>
        </center>
    </div>
@endsection
