<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        checkpermission('manage-wallet');

        $users = User::query()
        ->latest()
        ->where('type', '!=', 'admin')
        ->when($request->emailSearch, fn ($q, $email) => $q->where('email', 'like', "%{$email}%"))
        ->when($request->min && $request->max, fn ($q) => $q->whereBetween('balance', [$request->min, $request->max]))
        ->paginate(10)
        ->withQueryString();


       return view('admin.balance.index', compact('users'))->with('i', (request()->input('page', 1) - 1) * 10);

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
    public function store(Request $request)
    {
        //
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
        checkpermission('manage-wallet');

        $user = User::find($id);

        return view('admin.balance.edit',compact('user'));
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
        $request->validate([
            'balance' => 'required|numeric',
        ], [
            'balance.required' => 'Please enter a balance.',
            'balance.numeric' => 'The balance must be a number.',
        ]);

        $user = User::find($id);
        $user->balance = $request->balance;
        $user->save();
        return back()->with('success','Balance added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
