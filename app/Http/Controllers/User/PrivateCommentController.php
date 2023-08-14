<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PrivateCommentStore;
use App\Models\DiscussionUser;
use App\Models\PrivateComment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PrivateCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrivateCommentStore $request)
    {
        $validateData = $request->validated();
        $user = auth()->user();

        PrivateComment::create([
            'private_post_id' => $validateData['private_post_id'],
            'user_id' => auth()->user()->id,
            'body' => $validateData['body']
        ]);
        // $user = User::where('type', 'admin')->chunk(200, function ($users) use ($discussion, $usertext) {
        //     foreach ($users as $user) {
        //         Notification::send($user, new UserGroupNotification($user, $discussion, $usertext));
        //     }
        // });

        return back();
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
        $privateComment = PrivateComment::find($id);
        $privateComment->delete();
        return back();
    }
}
