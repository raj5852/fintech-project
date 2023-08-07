<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = array();
    protected $table = 'orders';



    protected $fillable = [
        'order_no',
        'user_id',
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function orderItems()
    {
        return $this->hasMany('App\Models\Admin\OrderDetails');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Admin\Product','product_id','id');
    }
    function products(){
        return $this->belongsToMany(Product::class,'order_details','order_id','product_id');
    }
    function orderDetails(){
        return $this->hasMany(OrderDetails::class,'order_id','id');
    }

}
