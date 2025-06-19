<?php

namespace App\Services;

use App\Services\PricingService;

class ProductService
{
    protected PricingService $pricingService;

    public function __construct(PricingService $pricingService)
    {
        $this->pricingService = $pricingService;
    }

    public function calculateProducts($products, $promoDiscount)
    {
        $updatedProducts = [];

        foreach ($products as $product) {
            $finalPrice = $this->pricingService->calculateFinalPrice($product, $promoDiscount);
            $product->final_price = $finalPrice;
            $updatedProducts[] = $product;
        }

        return $updatedProducts;
    }
}