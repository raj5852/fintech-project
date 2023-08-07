<?php

namespace App\Models\Admin;

use App\Models\Comment;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_name',
        'product_slug',
        'category_id',
        'subcategory_id',
        'brand_id',
        'product_code',
        'product_price',
        'buying_price',
        'discount_rate',
        'discount_price',
        'thumbnail',
        'images',
        'specification',
        'description',
        'tag',
        'is_admin',
    ];

    protected $casts = [
        'commissions' => 'array',
        'product_url' => 'array'
    ];

    /**
     * Get the user that owns the phone.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the user that owns the phone.
     */
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    /**
     * Get the user that owns the phone.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


    /**
     * Get the user that owns the phone.
     */
    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }

    /**
     * Get the user that owns the phone.
     */
    public function wishlist()
    {
        return $this->belongsTo(WishList::class);
    }


    public function orderItems()
    {

        return $this->hasMany('App\Models\Admin\OrderDetails', 'product_id');
    }


    public function memberships()
    {
        return $this->belongsToMany('App\Models\Admin\Membership')->withTimestamps();
    }

    public static function search($query, $category_id = null)
    {
        $q = self::query()
            ->where('product_name', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%");

        if ($category_id) {
            $q->where('category_id', $category_id);
        }
    }
    function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'id');
    }


    function orders(){
        return $this->belongsToMany(Order::class,'order_details','product_id','order_id');
    }

    function comments(){
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

}
