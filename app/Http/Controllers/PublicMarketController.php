<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class PublicMarketController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)
            ->where('is_active', true)
            ->inRandomOrder()
            ->take(8)
            ->get();

        $regularProducts = Product::where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('welcome', compact('featuredProducts', 'regularProducts'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('market.show', compact('product'));
    }
}
