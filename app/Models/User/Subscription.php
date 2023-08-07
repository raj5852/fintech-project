<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Membership;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Subscription extends Model
{
    use HasFactory;
    protected $guarded = [];

    function membership(){
        return $this->belongsTo(Membership::class,'subscribe_id','id');
    }
    function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
