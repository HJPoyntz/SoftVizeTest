<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\PromoService;
use App\Services\PricingService;

class ProductController extends Controller
{
    public function index(Request $request, PromoService $promoService, PricingService $pricingService)
    {
        $products = Product::all();

        $promoCode = $request->query('promo_code');
        $promoDiscount = $promoService->getDiscountFromCode($promoCode);

        $products->each(function ($product) use ($promoDiscount, $pricingService) {
            $product->final_price = $pricingService->calculateFinalPrice($product, $promoDiscount);
        });

        return view('products.index', compact('products', 'promoCode', 'promoDiscount'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:100',
        ]);

        Product::create($validated);

        return redirect('/products')->with('success', 'Product created!');
    }
}
