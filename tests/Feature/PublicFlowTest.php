<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;

test('home page loads correctly', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('search functionality returns expected products', function () {
    $product = Product::factory()->create([
        'name' => 'Unique Searchable Product',
        'is_active' => true,
    ]);

    $response = $this->get('/?search=Unique Searchable Product');

    $response->assertStatus(200);
    $response->assertSee('Unique Searchable Product');
});

test('category filter shows only products from that category', function () {
    $category = Category::factory()->create(['name' => 'Carnicería']);
    $otherCategory = Category::factory()->create(['name' => 'Verdulería']);

    $productInCategory = Product::factory()->create([
        'category_id' => $category->id,
        'name' => 'Carne de Res',
        'is_active' => true,
    ]);

    $productOtherCategory = Product::factory()->create([
        'category_id' => $otherCategory->id,
        'name' => 'Lechuga Fresca',
        'is_active' => true,
    ]);

    $response = $this->get('/?category=' . $category->slug);

    $response->assertStatus(200);
    $response->assertSee('Carne de Res');
    $response->assertDontSee('Lechuga Fresca');
});

test('vendor profile page loads and shows products', function () {
    $vendor = Vendor::factory()->create();
    $product = Product::factory()->create([
        'vendor_id' => $vendor->id,
        'name' => 'Vendor Specific Product',
        'is_active' => true,
    ]);

    $response = $this->get(route('vendors.show', $vendor));

    $response->assertStatus(200);
    $response->assertSee($vendor->name);
    $response->assertSee('Vendor Specific Product');
});
