<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Attributes:
    // id (int)
    // title (string)
    // description (text)
    // price (decimal)
    // category (string)
    // created_at (timestamp)
    // updated_at (timestamp)
    
    protected $fillable = ['title', 'description', 'price', 'category'];
}
