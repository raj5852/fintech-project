<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'membership_name',
        'membership_price',
        'membership_details',
        'expires_at',
        'life_time_charge',
        'monthly_charge',
    ];

    public function Product()
    {
        return $this->hasMany('App\Models\Admin\Product');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Admin\Product')->withTimestamps();
    }

    function latestProduct(){
        return $this->belongsToMany('App\Models\Admin\Product')->latest()->withTimestamps();

    }

    function users()
    {
        return $this->belongsToMany(User::class, 'subscriptions', 'subscribe_id','user_id')->withPivot('expire_date', 'created_at', 'is_life_time', 'monthly_charge_date', 'monthly_charge');
    }



}
