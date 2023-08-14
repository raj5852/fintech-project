<div class="comment">
    <div class="__left">
        <img src="{{ asset($privatecomment->user->image) }}" alt="">
    </div>
    <div class="__right">
        <div class="__content">
            <div class="__top">
                <div class="info">
                    <h1 class="name">{{ $privatecomment->user->name }} </h1>
                    <p class="date">{{ $privatecomment->created_at->diffForHumans() }} </p>
                </div>
                @if ($privatecomment->user_id == auth()->user()->id || auth()->user()->type == 'admin')
                    <div class="ico">
                        <div class="dropdown">
                            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <form action="{{ route('privatecomment.destroy',$privatecomment->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="dropdown-item" href="#">
                                            <span><i class="fa-solid fa-trash-can"></i></span>
                                            <span>Delete Comment</span>
                                        </button>
                                    </form>

                                </li>
                            </ul>
                        </div>
                    </div>
                @endif

            </div>
            <p class="__com">{{ $privatecomment->body }} </p>
        </div>
    </div>

</div>
