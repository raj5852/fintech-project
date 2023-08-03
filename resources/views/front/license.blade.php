 
@extends('layouts.front')
@section('title')
Discussion
@endsection

@section('front_content')
    <!-- breadcrumb  -->
<div class="bredcrumb">
    <h2 class="bredcrumb__title">License</h2>
    <ul class="bredcrumb__items">
        <li><a href="{{route('home')}}">Home</a> <i class="bi bi-chevron-right"></i></li>
        <li>License</li>
    </ul>
</div>

<section class="license-page">
    <div class="license-wrap">
        <h1 class="__text">Company Activation & License</h1>
        <p class="__sub-text">Lorem ipsum dolor sit amet consectetur. Eros nec ac eget blandit in. Eleifend non massa viverra etiam faucibus enim porttitor. Leo amet sit ultrices egestas sit ultricies adipiscing pellentesque morbi. Lorem ipsum dolor sit amet consectetur. Dui turpis in turpis duis malesuada. Amet pretium id gravida aenean egestas dui diam aliquet enim. Ut risus velit felis blandit amet. Neque consequat commodo id at congue in luctus orci. Nisl in odio bibendum ipsum sem duis magna. Sed nunc nulla orci velit id posuere eget. Ultrices at erat enim malesuada tristique facilisis dignissim et sed. Lacus ultrices mauris pharetra nunc. Lorem ipsum dolor sit amet consectetur. Dui turpis in turpis duis malesuada. Amet pretium id gravida aenean egestas dui diam aliquet enim. Ut risus velit felis blandit amet. Neque consequat commodo id at congue in luctus orci. Nisl in odio bibendum ipsum sem duis magna. Sed nunc nulla orci velit id posuere eget. Ultrices at erat enim malesuada tristique facilisis dignissim et sed. Lacus ultrices mauris pharetra nunc.</p>
        <ul class="__items">
            <li><a href="#"><span class="i"><i class="fa-solid fa-file-pdf"></i></span><span class="__name">PDF Document</span></a></li>
            <li><a href="#"><span class="i"><i class="fa-solid fa-file-pdf"></i></span><span class="__name">PDF Document</span></a></li>
            <li><a href="#"><span class="i"><i class="fa-solid fa-file-pdf"></i></span><span class="__name">PDF Document</span></a></li>
            <li><a href="#"><span class="i"><i class="fa-solid fa-file-pdf"></i></span><span class="__name">PDF Document</span></a></li>
        </ul>
    </div>
</section>


   
 
 
@push('js')
<script>

</script>
@endpush

@endsection
