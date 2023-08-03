<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoAddress extends Model
{
    use HasFactory;
    protected $guarded = [];

    function cryptoOrder(){
        return $this->hasOne(CryptoOrder::class,'crypto_addresses_id','id');
    }
}
