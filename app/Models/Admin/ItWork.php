<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItWork extends Model
{
    use HasFactory;
    protected $fillable = [
        'heading',
        'description',
        'photo',
    ];
}
