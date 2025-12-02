<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class PublicMarketController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', true);

        // Filter by Category
        if ($request->filled('category')) {
            $category = \App\Models\Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Filter by Search Term
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Clone query for featured products to avoid modifying the base query for regular products if we were to chain directly
        // However, since we are calling get() and paginate() separately, we need to be careful.
        // Actually, let's apply the filters to two separate query instances to be safe and clear.
        
        // Featured Products
        $featuredQuery = clone $query;
        $featuredProducts = $featuredQuery->where('is_featured', true)
            ->inRandomOrder()
            ->take(8)
            ->get();

        // Regular Products
        // If searching, we might want to show all matching products in the "regular" list, 
        // or maybe exclude featured ones? The original code didn't exclude featured from regular.
        // Let's keep it simple and just paginate the filtered results.
        $regularProducts = $query->latest()
            ->paginate(12)
            ->withQueryString(); // Keep query params in pagination links

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
