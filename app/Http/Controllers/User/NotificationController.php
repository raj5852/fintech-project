<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\Frontend\NotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    function index()
    {
        return NotificationService::index();
    }

    function productLink($id)
    {
        return NotificationService::productLink($id);
    }
}
