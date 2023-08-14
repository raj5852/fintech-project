<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function discussionUsers(){
        return $this->hasMany(DiscussionUser::class,'discussion_id','id');
    }
}
