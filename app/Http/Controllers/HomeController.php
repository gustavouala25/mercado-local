<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $currentCategory = null;
        
        // Featured Products Query
        $featuredQuery = Product::where('is_active', true)
            ->where('is_featured', true);

        // Categories Query
        $categoriesQuery = Category::whereHas('products', function ($query) {
            $query->where('is_active', true);
        });

        // Apply Category Filter
        if ($request->filled('category')) {
            $currentCategory = Category::where('slug', $request->category)->first();
            
            if ($currentCategory) {
                $featuredQuery->where('category_id', $currentCategory->id);
                $categoriesQuery->where('slug', $request->category);
            }
        }

        // Execute Queries
        $featuredProducts = $featuredQuery->inRandomOrder()
            ->take(8)
            ->get();

        $categories = $categoriesQuery->with(['products' => function ($query) {
            $query->where('is_active', true)
                  ->latest()
                  ->take(8);
        }])->get();

        return view('welcome', compact('featuredProducts', 'categories', 'currentCategory'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->where('is_active', true)->firstOrFail();

        // Increment views
        $product->increment('views');

        return view('products.show', compact('product'));
    }
}
