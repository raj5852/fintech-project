<?php

namespace App\Models;

use App\Models\Admin\Order;
use App\Models\Admin\OrderDetails;
use App\Models\User\Subscription;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'image',
        'phone',
        'mobile',
        'designation',
        'address',
        'google_id',
        'email_verified_at',
    ];




    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function member()
    {
        return $this->belongsTo('App\Models\Admin\Membership', 'subscribe_id');
    }

    function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'user_id', 'id');
    }
    function hasOneSub()
    {
        return $this->hasOne(Subscription::class, 'user_id', 'id');
    }







    function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    function orderDetails()
    {
        return $this->hasManyThrough(OrderDetails::class, Order::class, 'user_id', 'order_id')->latest();
    }
}
