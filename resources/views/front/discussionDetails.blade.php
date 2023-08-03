 
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
            Adding To The Thrill And Danger Of The Performance, Reynolds Has Positioned Himself On A Table That Is Precariously Placed Over A Chimney. This Daring Setup Adds An Extra Level Of Risk, Emphasizing His Audacity And Determination To Captivate Audiences With His Death-Defying Acts. Adding To The Thrill And Danger Of The Performance, Reynolds Has Positioned Himself On A Table That Is Precariously Placed Over A Chimney. 
             </p>
            <p class="pra-content">
            Adding To The Thrill And Danger Of The Performance, Reynolds Has Positioned Himself On A Table That Is Precariously Placed Over A Chimney. This Daring Setup Adds An Extra Level Of Risk, Emphasizing His Audacity And Determination To Captivate Audiences With His Death-Defying Acts. Adding To The Thrill And Danger Of The Performance, Reynolds Has Positioned Himself On A Table That Is Precariously Placed Over A Chimney. 
             </p>
            <p class="pra-content">
            Adding To The Thrill And Danger Of The Performance, Reynolds Has Positioned Himself On A Table That Is Precariously Placed Over A Chimney. This Daring Setup Adds An Extra Level Of Risk, Emphasizing His Audacity And Determination To Captivate Audiences With His Death-Defying Acts. Adding To The Thrill And Danger Of The Performance, Reynolds Has Positioned Himself On A Table That Is Precariously Placed Over A Chimney. 
             </p>
            <div class="photo-warp">
                <img src="{{ asset('frontend/img/test1.webp') }}" alt="">
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

    <!-- comment box  -->
    <div class="dis-comment-box">
        <form class="comment-up">
            <div class="head">
                <div class="usr-photo">
                    <img src="" alt="">
                </div>
                <div class="in-box">
                    <textarea placeholder="Type your Comment here ...." name="" id="" cols="30" rows="4"></textarea>
                </div>
            </div>
            <div class='sub-button-box'>
                <button class="common-btn">Comment</button>
            </div>

        </form>
    </div>

    <!-- all comments  -->
    <div class="all-comments-wrap abs-cus-dp-item">
        <div class="comments-items">

            <!-- single comment  -->
            <div class="comment">
                <div class="__left">
                    <img src="" alt="">
                </div>
                <div class="__right">
                    <div class="__content">
                       <div class="__top">
                            <div class="info">
                                <h1 class="name">MD Rakib Shekh</h1>
                                <p class="date">02 Feb, 2023</p>
                            </div>
                            <div class="ico">
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
                       </div>
                       
                        <p class="__com">Lorem ipsum dolor sit amet consectetur. Eros mattis pulvinar ultrices quis. Eu at quis consequat ullamcorper nunc facilisis congue imperdiet. Lorem ipsum dolor sit amet consectetur. Eros mattis pulvinar ultrices quis. Eu at quis consequat ullamcorper nunc facilisis congue imperdiet.</p>
                        

                    </div>
                   
                </div>

            </div>
            <!-- single comment  -->
            <div class="comment">
                <div class="__left">
                    <img src="" alt="">
                </div>
                <div class="__right">
                    <div class="__content">
                       <div class="__top">
                            <div class="info">
                                <h1 class="name">MD Rakib Shekh</h1>
                                <p class="date">02 Feb, 2023</p>
                            </div>
                            <div class="ico">
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
                       </div>
                       
                        <p class="__com">Lorem ipsum dolor sit amet consectetur. Eros mattis pulvinar ultrices quis. Eu at quis consequat ullamcorper nunc facilisis congue imperdiet. Lorem ipsum dolor sit amet consectetur. Eros mattis pulvinar ultrices quis. Eu at quis consequat ullamcorper nunc facilisis congue imperdiet.</p>
                        

                    </div>
                   
                </div>

            </div>
            <!-- single comment  -->
            <div class="comment">
                <div class="__left">
                    <img src="" alt="">
                </div>
                <div class="__right">
                    <div class="__content">
                       <div class="__top">
                            <div class="info">
                                <h1 class="name">MD Rakib Shekh</h1>
                                <p class="date">02 Feb, 2023</p>
                            </div>
                            <div class="ico">
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
                       </div>
                       
                        <p class="__com">Lorem ipsum dolor sit amet consectetur. Eros mattis pulvinar ultrices quis. Eu at quis consequat ullamcorper nunc facilisis congue imperdiet. Lorem ipsum dolor sit amet consectetur. Eros mattis pulvinar ultrices quis. Eu at quis consequat ullamcorper nunc facilisis congue imperdiet.</p>
                        

                    </div>
                   
                </div>

            </div>
            <!-- single comment  -->
            <div class="comment">
                <div class="__left">
                    <img src="" alt="">
                </div>
                <div class="__right">
                    <div class="__content">
                       <div class="__top">
                            <div class="info">
                                <h1 class="name">MD Rakib Shekh</h1>
                                <p class="date">02 Feb, 2023</p>
                            </div>
                            <div class="ico">
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
                       </div>
                       
                        <p class="__com">Lorem ipsum dolor sit amet consectetur. Eros mattis pulvinar ultrices quis. Eu at quis consequat ullamcorper nunc facilisis congue imperdiet. Lorem ipsum dolor sit amet consectetur. Eros mattis pulvinar ultrices quis. Eu at quis consequat ullamcorper nunc facilisis congue imperdiet.</p>
                        

                    </div>
                   
                </div>

            </div>
            <!-- single comment  -->
            <div class="comment">
                <div class="__left">
                    <img src="" alt="">
                </div>
                <div class="__right">
                    <div class="__content">
                       <div class="__top">
                            <div class="info">
                                <h1 class="name">MD Rakib Shekh</h1>
                                <p class="date">02 Feb, 2023</p>
                            </div>
                            <div class="ico">
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
                       </div>
                       
                        <p class="__com">Lorem ipsum dolor sit amet consectetur. Eros mattis pulvinar ultrices quis. Eu at quis consequat ullamcorper nunc facilisis congue imperdiet. Lorem ipsum dolor sit amet consectetur. Eros mattis pulvinar ultrices quis. Eu at quis consequat ullamcorper nunc facilisis congue imperdiet.</p>
                        

                    </div>
                   
                </div>

            </div>
        </div>
    </div>

    

</div>

 

@push('js')
<script>

</script>
@endpush

@endsection
