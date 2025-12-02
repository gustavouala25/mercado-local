<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VendorProductController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('vendor.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'image' => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('products', 'public');

        Product::create([
            'vendor_id' => auth()->user()->vendor->id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . Str::random(5),
            'description' => $request->description,
            'price' => $request->price,
            'image_path' => $path,
            'is_featured' => false,
            'is_active' => true,
        ]);

        return redirect()->route('dashboard')->with('success', 'Producto publicado exitosamente.');
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        if ($product->vendor->user_id !== auth()->id()) {
            abort(403);
        }

        $categories = Category::all();
        return view('vendor.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($product->vendor->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = [
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ];

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image_path'] = $path;
        }

        $product->update($data);

        return redirect()->route('dashboard')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->vendor->user_id !== auth()->id()) {
            abort(403);
        }

        $product->delete();

        return redirect()->route('dashboard')->with('success', 'Producto eliminado exitosamente.');
    }
}
