@extends('layouts.front')

@section('title')
How  It Work
@endsection

@section('front_content')
<div class="bredcrumb">
    <h2 class="bredcrumb__title">How It Work</h2>
    <ul class="bredcrumb__items">
        <li><a href="{{route('home')}}">Home</a> <i class="bi bi-chevron-right"></i></li>
        <li>How It Work</li>
    </ul>
</div>

<!-- privicey content  -->

<div class="privicey__content">
    <div class="container">

        @foreach ($pages as $row)
        <div class="privicey__content-item">
            <span class="privicey__content-title">{{ $loop->index+1 }}. {{ $row->page_title }}</span>
            <p class="privicey__content-dis">
                {!! $row->page_description !!}
             </p>

        </div>
        @endforeach





    </div>
</div>

@push('js')

@endpush

@endsection
