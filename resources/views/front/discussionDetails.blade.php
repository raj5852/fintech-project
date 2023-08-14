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
            <li>Discussion Details</li>
        </ul>
    </div>

    <div class="discussion-main">
        <!-- view all post  -->

        <div class="all-discussion details abs-cus-dp-item">
            <div class="item">
                <div class="header">
                    <div class="user-box">
                        <div class="img">
                            <img src="{{ asset($privatepost->user->image) }}" alt="">
                        </div>
                        <div class="user">
                            <h1 class="name">{{ $privatepost->user->name }} </h1>
                            <p class="date">{{ $privatepost->created_at->diffForHumans() }} </p>
                        </div>
                    </div>

                    @if ($privatepost->user_id == auth()->user()->id || auth()->user()->type == 'admin')
                        <div class="dropdown">
                            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><button class="dropdown-item" href="#">
                                        <span><i class="fa-solid fa-trash-can"></i></span>
                                        <span>Delete Comment</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    @endif


                </div>
                <p class="pra-content">
                    {{ $privatepost->body }}
                </p>

                <div class="photo-warp">
                    <img src="{{ asset($privatepost->image) }}" alt="">
                </div>

                <div class="bottom">
                    <div class="comment">
                    </div>
                    <p class="res-comment">{{$commentCount}} Comments</p>
                </div>
            </div>
        </div>

        <!-- comment box  -->
        <div class="dis-comment-box" id="dis-comment-box">
            <form class="comment-up" method="POST" action="{{ route('privatecomment.store') }}">
                @csrf
                <div class="head">
                    <div class="usr-photo">
                        <img src="{{ asset(auth()->user()->image) }}" alt="">
                    </div>
                    <input type="hidden" readonly name="private_post_id" value="{{ $privatepost->id }}">
                    <div class="in-box">
                        <textarea name="body" placeholder="Type your Comment here ...." cols="30" rows="4"></textarea>
                    </div>
                </div>
                <div class='sub-button-box'>
                    <button class="common-btn">Comment</button>
                </div>

            </form>
        </div>

        <!-- all comments  -->
        <div class="all-comments-wrap abs-cus-dp-item">
            <div class="comments-items comments-container">
                @foreach ($privateComments as $privatecomment)
                    <x-private-comment :privatecomment="$privatecomment" />
                @endforeach
                <!-- single comment  -->


            </div>
        </div>



    </div>



    @push('js')
    @endpush
@endsection
