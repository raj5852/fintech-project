@extends('layouts.front')

@section('front_content')

    <div class=" m-5">

        <center>
            <div class="row justify-content-center check-em-very">
                <div class="col-md-8 my-5 py-5">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    <h1 class="check-em-txt mb-2">Check Your Email</h1>

                    <i style="font-size: 150px" class="fa fa-envelope"></i>
                    <center class="mt-2">
                        Please check your inbox or spam folder for an email -  @auth <b>{{ auth()->user()->email }}</b> @endauth.

                        <p > In the email, you'll find a link to confirm your registration and activate your account.</p>

                    </center><br>
                    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="common-btn">Click here to another request </button>
                    </form>
                </div>
            </div>

        </center>
    </div>
@endsection
