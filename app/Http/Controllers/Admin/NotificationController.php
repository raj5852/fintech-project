<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    //
    function clear(){
        $order = DB::table('orders')->where('notification_status',0)->update([
            'notification_status'=>1
        ]);
        return redirect('admin/home');
    }
}
