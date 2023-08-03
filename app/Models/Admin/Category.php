<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_name',
        'category_slug'
    ];

    /**
     * Get the user that owns the phone.
     */
    public function sub_category()
    {
        return $this->hasMany(SubCategory::class);
    }


    /**
     * Get the user that owns the phone.
     */
    public function product()
    {
        return $this->hasMany(Product::class);
    }



}
