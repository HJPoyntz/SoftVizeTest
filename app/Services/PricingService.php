<?php

namespace App\Services;

use App\Models\Product;

class PricingService
{
    protected array $categoryDiscounts = [
        'electronics' => 0.05,
    ];

    public function calculateFinalPrice(Product $product, float $promoDiscount = 0): float
    {
        $basePrice = $product->price;

        $categoryDiscount = $this->categoryDiscounts[$product->category] ?? 0;
        $totalDiscount = $categoryDiscount + $promoDiscount;

        if ($totalDiscount > 1) {
            $totalDiscount = 1;
        }

        return round($basePrice * (1 - $totalDiscount), 2);
    }
}
