<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    
    use HasFactory;

    protected $fillable = ['title', 'description', 'price', 'category'];

    public function getDiscountedPrice($promoCode = null)
    {
        $price = $this->price;

        $categoryDiscounts = [
            'electronics' => 0.05, // 5%
        ];

        $categoryDiscount = $categoryDiscounts[$this->category] ?? 0;
        $promoDiscount = is_numeric($promoCode) ? $promoCode : 0;

        $totalDiscount = $categoryDiscount + $promoDiscount;

        if ($totalDiscount >= 1) {
            $totalDiscount = 1;
        }

        return $price * (1 - $totalDiscount);
    }
}
