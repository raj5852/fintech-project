<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Product;

class WishList extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the phone.
     */
    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
