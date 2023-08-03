<?php

namespace App\Models\Admin;

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





}
