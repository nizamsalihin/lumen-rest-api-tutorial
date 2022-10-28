<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // in order to use factory, we have to use this trait
    use HasFactory;
    protected $guarded = ['id'];
}
