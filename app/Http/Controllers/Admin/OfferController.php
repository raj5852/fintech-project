<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    //
    function store(Request $request)
    {


        $status = $request->status ? $request->status : 0;

        $offer = Offer::first();


        if ($offer == null) {
            Offer::create([
                'body' => request('body'),
                'status' => $status
            ]);
            return back();

        } else {
            $offer->body = request('body');
            $offer->status = $status;
            $offer->save();

            return back();
        }
    }
}
