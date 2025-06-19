<?php
    use App\Models\Product\PricingService;
?>

@extends('layouts.app')

@section('title', 'Product Inventory')

@section('content')
    <h1>Product List</h1>

    <form method="GET" action="{{ route('products.index') }}" class="mb-3">
        <label for="promo_code" class="form-label">Have a promo code?</label>
        <div class="input-group" style="max-width: 300px;">
            <input type="text" name="promo_code" id="promo_code" class="form-control" 
                   value="{{ request('promo_code') }}" placeholder="Enter promo code">
            <button class="btn btn-success rounded-end" type="submit">Apply</button>
            <small class="text-muted">Try 'SP3CI4LCU5T0M3R' or 'H1R3H477Y'</small>
        </div>
    </form>

    <p>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Create Product</a>
    </p>

    <ul class="list-group">
        @foreach($products as $product)
            <li class="list-group-item">
                <h3><span class="fw-bolder">{{ $product->title }}</span> | ({{ ucfirst($product->category) }})</h3>
                <p>{{ $product->description }}</p>
                <p>Original Price: £{{ number_format($product->price, 2) }}</p>
                <p>
                    Final Price: £{{ number_format($product->final_price, 2) }}
                    @if($product->final_price < $product->price)
                        (discounted)
                    @endif
                </p>
            </li>
        @endforeach
    </ul>
@endsection
