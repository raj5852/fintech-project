@extends('layouts.front')

@section('front_content')

<div class="error__page">
    <div class="container">
        <div class="error__page-inner">
            <span class="error__page-title">ooops..!</span>
            <img src="{{ asset('frontend/img/404.png') }}" alt="404">
            <h2 class="error__page-btitle">page not found</h2>
            <a class="error__page-btn" href="{{ url('/') }}">go to home</a>
        </div>
    </div>
</div>


@push('js')

@endpush

@endsection