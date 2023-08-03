 
@extends('layouts.front')
@section('title')
Discussion
@endsection

@section('front_content')
<!-- breadcrumb  -->
<div class="bredcrumb">
    <h2 class="bredcrumb__title">Discussion</h2>
    <ul class="bredcrumb__items">
        <li><a href="{{route('home')}}">Home</a> <i class="bi bi-chevron-right"></i></li>
        <li>Discussion</li>
    </ul>
</div>

<div class="discussion-main">
     

 
<!-- upload post  -->
    <form action="#">
        <div class="wrapper-post-form">
             <div class="dis-form-wrap-ab">
                <div class="_left">
                    <div class="user-img">
                        <img src="" alt="">
                    </div>
                </div>
                <div class="_right">
                    <input class="search-input" placeholder="Share or ask something to everyone " type="text">
                    <div class="handler">
                        <div class="file-input">
                            <input type="file" id="post-file">
                            <label for="post-file"><span><i class="fa-regular fa-images"></i></span> <span>Images</span></label>
                        </div>
                        <button class="common-btn" type="submit">Post</button>
                    </div>
                </div>


            </div>
        </div>
    </form>
    
    <!-- view all post  -->

    <div class="all-discussion abs-cus-dp-item">
        <div class="item">
            <div class="header">
                <div class="user-box">
                    <div class="img">
                        <img src="" alt="">
                    </div>
                    <div class="user">
                        <h1 class="name">Sirin Fenquline</h1>
                        <p class="date">Jan 12, 2023</p>
                    </div>


                </div>
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
 
            </div>
            <p class="pra-content">
                 Adding to the thrill and danger of the performance, Reynolds has positioned himself on a table that is precariously placed over a chimney. This daring setup adds an extra level of risk, emphasizing his audacity and determination to captivate audiences with his death-defying acts. Adding to the thrill and danger of the performance, Reynolds has positioned himself on a table that is precariously placed over a chimney.... <a  href="#" class="__more">Show More</a>
            </p>
            <div class="photo-warp">
                <img src="{{ asset('frontend/img/items-img-2.png') }}" alt="">
            </div>

            <div class="bottom">
                <div class="comment">
                    <span><i class="fa-regular fa-comment"></i></span>
                    <a class="l-comm" href="#" >Leave a comment</a>
                </div>
                <p class="res-comment">2K Comments</p>
            </div>
        </div>
        <div class="item">
            <div class="header">
                <div class="user-box">
                    <div class="img">
                        <img src="" alt="">
                    </div>
                    <div class="user">
                        <h1 class="name">Sirin Fenquline</h1>
                        <p class="date">Jan 12, 2023</p>
                    </div>


                </div>
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
 
            </div>
            <p class="pra-content">
                 Adding to the thrill and danger of the performance, Reynolds has positioned himself on a table that is precariously placed over a chimney. This daring setup adds an extra level of risk, emphasizing his audacity and determination to captivate audiences with his death-defying acts. Adding to the thrill and danger of the performance, Reynolds has positioned himself on a table that is precariously placed over a chimney.... <a  href="#" class="__more">Show More</a>
            </p>
            <div class="photo-warp">
                <img src="{{ asset('frontend/img/items-img-1.png') }}" alt="">
            </div>

            <div class="bottom">
                <div class="comment">
                    <span><i class="fa-regular fa-comment"></i></span>
                    <a class="l-comm" href="#" >Leave a comment</a>
                </div>
                <p class="res-comment">2K Comments</p>
            </div>
        </div>
        <div class="item">
            <div class="header">
                <div class="user-box">
                    <div class="img">
                        <img src="{{ asset('frontend/img/items-img-1.png') }}" alt="">
                    </div>
                    <div class="user">
                        <h1 class="name">Sirin Fenquline</h1>
                        <p class="date">Jan 12, 2023</p>
                    </div>


                </div>
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
 
            </div>
            <p class="pra-content">
                 Adding to the thrill and danger of the performance, Reynolds has positioned himself on a table that is precariously placed over a chimney. This daring setup adds an extra level of risk, emphasizing his audacity and determination to captivate audiences with his death-defying acts. Adding to the thrill and danger of the performance, Reynolds has positioned himself on a table that is precariously placed over a chimney.... <a  href="#" class="__more">Show More</a>
            </p>
            <div class="photo-warp">
                <img src="{{ asset('frontend/img/telegram.svg') }}" alt="">
            </div>

            <div class="bottom">
                <div class="comment">
                    <span><i class="fa-regular fa-comment"></i></span>
                    <a class="l-comm" href="#" >Leave a comment</a>
                </div>
                <p class="res-comment">2K Comments</p>
            </div>
        </div>
    </div>
    

</div>

<div class="discussion-pagination">
         <!-- new  pagination  -->
         <div class="pagination-wrap-ab mb-5">
                        <ul class="items">
                            <li>
                                
                                <a href="#" class="common-btn"><i class="fa-solid fa-angle-left"></i></a>
                            </li>
                            <li>

                                <a href="#" class="common-btn active">1</a>
                            </li>
                            <li>
                                <a href="#" class="common-btn">2</a>

                            </li>
                            <li>
                                <a href="#" class="common-btn">3</a>

                            </li>
                            <li>
                                <a href="#" class="common-btn">4</a>

                            </li>
                            <li>
                                <a href="#" class="common-btn">5</a>

                            </li>
                            <li>

                                <a href="#" class="common-btn "><i class="fa-solid fa-ellipsis"></i></a>
                            </li>
                            <li>
                                <a href="#" class="common-btn">2</a>

                            </li>
                            <li>
                                <a href="#" class="common-btn">3</a>

                            </li>
                            <li>
                                <a href="#" class="common-btn">4</a>

                            </li>
                            <li>
                                <a href="#" class="common-btn">5</a>

                            </li>
                            <li>
                                <a href="#" class="common-btn"><i class="fa-solid fa-angle-right"></i></a>

                            </li>
                                
                             
                        </ul>
                    </div>
</div>

 

@push('js')
<script>

</script>
@endpush

@endsection
