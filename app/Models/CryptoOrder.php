<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoOrder extends Model
{
    use HasFactory;
    protected $guarded = [];
    function cryptoOrderDetails(){
        return $this->hasMany(CryptoOrderDetails::class,'crypto_order_id','id');
    }
}
