<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivatePost extends Model
{
    use HasFactory;
    protected $guarded = [];

    function user(){
        return $this->belongsTo(User::class);
    }

    function privatecomments(){
        return $this->hasMany(PrivateComment::class);
    }

}
