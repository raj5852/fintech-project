@extends('layouts.front')
@section('title')
Privacy Policy
@endsection

@section('front_content')
<div class="bredcrumb">
    <h2 class="bredcrumb__title">privacy policy</h2>
    <ul class="bredcrumb__items">
        <li><a href="{{route('home')}}">Home</a> <i class="bi bi-chevron-right"></i></li>
        <li>privacy policy</li>
    </ul>
</div>

<!-- privicey content  -->

<div class="privicey__content">
    <div class="container">

        @foreach ($privacy_policy as $row)
        <div class="privicey__content-item">
            <span class="privicey__content-title">{{ $loop->index+1 }}. {{ $row->heading }}</span>
            <p class="privicey__content-dis">
                {!! $row->description !!}
             </p>

        </div>
        @endforeach





    </div>
</div>

@push('js')

@endpush

@endsection
