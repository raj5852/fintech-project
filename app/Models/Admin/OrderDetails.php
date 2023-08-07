<?php

namespace App\Models\Admin;

use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    protected $table = "order_details";

    public function order()
    {
        return $this->belongsTo('App\Models\Admin\Order', 'order_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Admin\Product', 'product_id');
    }

    public function review()
    {
        return $this->hasOne('App\Models\Review', 'order_detail_id', 'id');
    }
    function membership(){
        return $this->belongsTo(User::class);
    }
}
