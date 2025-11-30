<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Featured Products (Random 4 active & featured)
        $featuredProducts = Product::where('is_active', true)
            ->where('is_featured', true)
            ->inRandomOrder()
            ->take(4)
            ->get();

        // Regular Products Query
        $query = Product::where('is_active', true);

        // Filter by Search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by Category
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Get Results (Latest first, Paginated)
        $regularProducts = $query->latest()->paginate(12)->withQueryString();

        // Get Categories for Filter
        $categories = Category::orderBy('name')->get();

        return view('welcome', compact('featuredProducts', 'regularProducts', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->where('is_active', true)->firstOrFail();

        // Increment views
        $product->increment('views');

        return view('products.show', compact('product'));
    }
}
