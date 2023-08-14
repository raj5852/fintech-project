<?php

namespace App\Http\Controllers\User;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserDiscussionStore;
use App\Models\Discussion;
use App\Models\PrivatePost;
use App\Models\User;
use App\Notifications\NewProductNotification;
use App\Notifications\UserGroupNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;

class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserDiscussionStore $request)
    {
        $validateData = $request->validated();

        $privatePost = new PrivatePost();

        $image = $validateData['image'];
        if ($image) {
            $privatePost->image = Helper::upload_image($image,  930, 523, 'frontend/discussion/');
        }
        $privatePost->body = $validateData['body'];
        $privatePost->user_id = auth()->user()->id;
        $privatePost->discussion_id = $validateData['discussion_id'];

        $privatePost->save();


        $usertext =  substr($privatePost->body, 0, 30);

        $discussion = Discussion::where('id',$privatePost->discussion_id)->first();

        $user = User::where('type', 'admin')->chunk(200, function ($users) use ($discussion, $usertext) {
            foreach ($users as $user) {
                Notification::send($user, new UserGroupNotification($user, $discussion, $usertext));
            }
        });


        return  back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();
        if ($user->type == 'user') {
            return to_route('user.home');
        };

        $post = PrivatePost::where('id', $id)->first();
        if (File::exists($post->image)) {
            File::delete($post->image);
        }
        $post->delete();

        return back()->with('success', 'Post deleted successfuly!');
    }
}
