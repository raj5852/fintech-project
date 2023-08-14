<form action="{{ route('userdiscussion.store') }}"  method="POST" enctype="multipart/form-data">
    @csrf
    <div class="wrapper-post-form">
         <div class="dis-form-wrap-ab">
            <div class="_left">
                <div class="user-img">
                    <img src="{{ asset($user->image) }}" alt="">
                </div>
            </div>
            <div class="_right">
                <input name="body" class="search-input" placeholder="Share or ask something to everyone " type="text">
                <div class="handler">
                    <div class="file-input">
                        <input type="hidden" name="discussion_id" readonly value="{{ $discussionid }}">
                        <input type="file" name="image" id="post-file">
                        <label for="post-file"><span><i class="fa-regular fa-images"></i></span> <span>Images</span></label>
                    </div>
                    <button class="common-btn" type="submit">Post</button>
                </div>
            </div>


        </div>
    </div>
</form>
