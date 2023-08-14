@extends('layouts.front')
@section('title')
    Discussion
@endsection

@section('front_content')
    <!-- breadcrumb  -->
    <div class="bredcrumb">
        <h2 class="bredcrumb__title">Discussion</h2>
        <ul class="bredcrumb__items">
            <li><a href="{{ route('home') }}">Home</a> <i class="bi bi-chevron-right"></i></li>
            <li>Discussion</li>
        </ul>
    </div>

    <div class="discussion-main">



        <!-- upload post  -->
        <x-discussion-form :user="$user" :discussionid="$discussionid" />


        <!-- view all post  -->

        <div class="all-discussion abs-cus-dp-item">
            @foreach ($privatePosts as $post)
                <x-private-post :post="$post" />
            @endforeach
        </div>


    </div>

    <div class="discussion-pagination">


        {{ $privatePosts->links('vendor.pagination.default') }}

    </div>



    @push('js')
        <script></script>
    @endpush
@endsection
