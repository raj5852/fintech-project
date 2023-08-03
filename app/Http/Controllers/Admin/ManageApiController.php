<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ManageAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\CodeCleaner\ReturnTypePass;

class ManageApiController extends Controller
{
    function index()
    {
        $datas = ManageAPI::all();
        return view('admin.api-manage.index', compact('datas'));
    }
    function edit($id)
    {
        $data = ManageAPI::find($id);
        return view('admin.api-manage.edit', compact('data'));
    }
    function update(Request $request, $id)
    {

        if ($request->method_type == 'mail') {
            DB::table('manage_a_p_i_s')->where('id', $id)
                ->update(
                    [
                        'details' => json_encode([
                            'MAIL_MAILER' => $request->MAIL_MAILER,
                            'MAIL_HOST' => $request->MAIL_HOST,
                            'MAIL_PORT' => $request->MAIL_PORT,
                            'MAIL_USERNAME' => $request->MAIL_USERNAME,
                            'MAIL_PASSWORD' => $request->MAIL_PASSWORD,
                            'MAIL_ENCRYPTION' => $request->MAIL_ENCRYPTION,
                            'MAIL_FROM_ADDRESS' => $request->MAIL_FROM_ADDRESS,
                            'MAIL_FROM_NAME' => $request->MAIL_FROM_NAME
                        ])
                    ]
                );
            return redirect()->back()->with('success','Updated successfully');
        }

        if ($request->method_type == 'paypal') {
            DB::table('manage_a_p_i_s')->where('id', $id)
                ->update(
                    [
                        'details' => json_encode([
                            'PAYPAL_MODE'=>$request->PAYPAL_MODE,
                            'PAYPAL_SANDBOX_CLIENT_ID'=>$request->PAYPAL_SANDBOX_CLIENT_ID,
                            'PAYPAL_SANDBOX_CLIENT_SECRET'=>$request->PAYPAL_SANDBOX_CLIENT_SECRET
                        ])
                    ]
                );
            return redirect()->back()->with('success','Updated successfully');
        }

        if ($request->method_type == 'paypal') {
            DB::table('manage_a_p_i_s')->where('id', $id)
                ->update(
                    [
                        'details' => json_encode([
                            'PAYPAL_MODE'=>$request->PAYPAL_MODE,
                            'PAYPAL_SANDBOX_CLIENT_ID'=>$request->PAYPAL_SANDBOX_CLIENT_ID,
                            'PAYPAL_SANDBOX_CLIENT_SECRET'=>$request->PAYPAL_SANDBOX_CLIENT_SECRET
                        ])
                    ]
                );
            return redirect()->back()->with('success','Updated successfully');
        }
        if ($request->method_type == 'google_clint') {
            DB::table('manage_a_p_i_s')->where('id', $id)
                ->update(
                    [
                        'details' => json_encode([
                            'GOOGLE_CLIENT_ID'=>$request->GOOGLE_CLIENT_ID,
                            'GOOGLE_CLIENT_SECRET'=>$request->GOOGLE_CLIENT_SECRET,
                        ])
                    ]
                );
            return redirect()->back()->with('success','Updated successfully');
        }
        if ($request->method_type == 'stripe') {
            DB::table('manage_a_p_i_s')->where('id', $id)
                ->update(
                    [
                        'details' => json_encode([
                            'STRIPE_KEY'=>$request->STRIPE_KEY,
                            'STRIPE_SECRET'=>$request->STRIPE_SECRET,
                        ])
                    ]
                );
            return redirect()->back()->with('success','Updated successfully');
        }

        if ($request->method_type == 'edokan_pay') {
            DB::table('manage_a_p_i_s')->where('id', $id)
                ->update(
                    [
                        'details' => json_encode([
                            'API_KEY'=>$request->API_KEY,
                            'CLIENT_KEY'=>$request->CLIENT_KEY,
                            'SECRET_KEY'=>$request->SECRET_KEY,
                        ])
                    ]
                );
            return redirect()->back()->with('success','Updated successfully');
        }
        if ($request->method_type == 'nowpayments') {
            DB::table('manage_a_p_i_s')->where('id', $id)
                ->update(
                    [
                        'details' => json_encode([
                            'API_KEY'=>$request->API_KEY,
                            'IPN_SECRET_KEY'=>$request->IPN_SECRET_KEY,
                            'IPN_CALLBACK_URL'=>$request->IPN_CALLBACK_URL,
                        ])
                    ]
                );
            return redirect()->back()->with('success','Updated successfully');
        }
        if ($request->method_type == 'crisp') {
            // dd($id);
            DB::table('manage_a_p_i_s')->where('id', $id)
                ->update(
                    [
                        'details' => json_encode([
                            'website_id'=>$request->website_id,
                        ])
                    ]
                );
            return redirect()->back()->with('success','Updated successfully');
        }
        if ($request->method_type == 'tawk') {
            // dd($id);
            DB::table('manage_a_p_i_s')->where('id', $id)
                ->update(
                    [
                        'details' => json_encode([
                            'WIDGET_ID'=>$request->WIDGET_ID,
                            'PROPERTY_ID'=>$request->PROPERTY_ID,
                        ])
                    ]
                );
            return redirect()->back()->with('success','Updated successfully');
        }

        if ($request->method_type == 'binance') {
            DB::table('manage_a_p_i_s')->where('id', $id)
                ->update(
                    [
                        'details' => json_encode([
                            'key'=>$request->key,
                            'secret'=>$request->secret,
                        ])
                    ]
                );
            return redirect()->back()->with('success','Updated successfully');
        }
    }
}
