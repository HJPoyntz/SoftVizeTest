<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::all();

        $validPromoCodes = [
            'SP3CI4LCU5T0M3R' => 0.10, 
            'H1R3H477Y' => 0.99, 
        ];

        $promoCode = $request->query('promo_code');
        $discountPercent = 0;

        if ($promoCode && array_key_exists(strtoupper($promoCode), $validPromoCodes)) {
            $discountPercent = $validPromoCodes[strtoupper($promoCode)];
        } else {
            $promoCode = null; 
        }

        return view('products.index', compact('products', 'promoCode', 'discountPercent'));
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
