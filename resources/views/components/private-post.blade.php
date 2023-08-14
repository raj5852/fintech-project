<div class="item">
    <div class="header">
        <div class="user-box">
            <div class="img">
                <img src="{{ asset($post->user->image) }}" alt="">
            </div>
            <div class="user">
                <h1 class="name">{{ $post->user->name }} </h1>
                <p class="date">{{ $post->created_at->diffForHumans() }} </p>
            </div>


        </div>



        @if ($post->user_id == auth()->user()->id || auth()->user()->type == 'admin')
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <ul class="dropdown-menu">
                    <li>

                        <form action="{{ route('userdiscussion.destroy', $post->id) }}" method="POST">
                            <p class="dropdown-item">
                                @method('delete')
                                @csrf
                                <span><i class="fa-solid fa-trash-can"></i></span>
                                <span>
                                    <button type="submit">Delete Comment</button>
                                </span>
                            </p>
                        </form>

                    </li>
                </ul>
            </div>
        @endif


    </div>
    <p class="pra-content">
        {{-- {{ $post->body }} --}}
        @php
            $characterLimit = 826;
        @endphp

        {{ substr($post->body, 0, $characterLimit) }}
        @if (strlen($post->body) > $characterLimit)
            <a href="{{ route('discussionDetails', $post->id) }}" class="__more">Show More</a>
        @endif

    </p>
    <div class="photo-warp">
        <a href="{{ route('discussionDetails', $post->id) }}">
            <img src="{{ asset($post->image) }}" alt="">
        </a>
    </div>

    <div class="bottom">
        <div class="comment">
            <span><i class="fa-regular fa-comment"></i></span>
            <a class="l-comm" href="{{ route('discussionDetails', $post->id) }}">Leave a comment</a>
        </div>
        <p class="res-comment">{{ $post->privatecomments_count }} Comments</p>
    </div>
</div>
