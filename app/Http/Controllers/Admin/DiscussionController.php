<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscussionCreate;
use App\Http\Requests\DiscussionUpdate;
use App\Models\Discussion;
use App\Models\DiscussionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discussions = Discussion::withCount('discussionUsers')->latest()->paginate(10);
        return view('admin.discussion.index', compact('discussions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = DB::table('users')->where('type', '!=', 'admin')->select('id', 'email')->get();
        return view('admin.discussion.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscussionCreate $request)
    {
        $validateData =  $request->validated();

        $discussion =  Discussion::create([
            'name' => $validateData['name'],
            'slug' => Str::slug($validateData['name'])
        ]);

        foreach ($validateData['user_id'] as  $id) {
            DB::table('discussion_users')->insert([
                'discussion_id' => $discussion->id,
                'user_id' => $id
            ]);
        }
        return to_route('discussion.index')->with('success', 'Created successfull!');
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
    public function edit(Discussion $discussion)
    {
        $data  = $discussion->load('discussionUsers');

        $users = DB::table('users')->where('type', '!=', 'admin')->select('id', 'email')->get();

        return view('admin.discussion.edit', compact('users', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DiscussionUpdate $request, $id)
    {
        DB::table('discussion_users')->where('discussion_id', $id)->delete();

        foreach ($request->user_id as  $userid) {
            DB::table('discussion_users')->insert([
                'discussion_id' => $id,
                'user_id' => $userid
            ]);
        }
        return back()->with('success','updated successfull.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('discussions')->where('id',$id)->delete();
        DB::table('discussion_users')->where('discussion_id',$id)->delete();

        return back();
    }
}
