<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Subscriber;
use Mail;
use App\Mail\SubscriberEmail;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Subscriber::latest()->get();
        return view('admin.subscriber.index',compact('data'));
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
        Subscriber::find($id)->delete();

        $notification=array(
            'messege'=>'Successfully Deleted !',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
  
    }


    /**
     * Send promotion email to all subscriber from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendPromotionEmail(Request $request)
    {
        $emailContent = [
                "email_subject" => $request->email_subject,
                "email_description" => $request->email_description,
                "date" => date('d/m/Y'),
            ];

            Mail::to("hello@example.com")->send(new SubscriberEmail($emailContent));

            $notification=array(
                'messege'=>'Successfully Promotion  Send !',
                'alert-type'=>'success'
                 );
               return Redirect()->back()->with($notification);
   
    }
}
