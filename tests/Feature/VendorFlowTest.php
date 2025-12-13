<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->vendor = Vendor::factory()->create(['user_id' => $this->user->id]);
    $this->actingAs($this->user);
});

test('logged in vendor can access dashboard', function () {
    $response = $this->get('/dashboard');

    $response->assertStatus(200);
});

test('vendor can create a new product', function () {
    $category = Category::factory()->create();

    $productData = [
        'name' => 'New Product',
        'description' => 'Product Description',
        'price' => 100.50,
        'category_id' => $category->id,
        'is_active' => true,
    ];

    $response = $this->post(route('products.store'), $productData);

    $response->assertRedirect(route('dashboard'));
    $this->assertDatabaseHas('products', [
        'name' => 'New Product',
        'vendor_id' => $this->vendor->id,
    ]);
});

test('vendor can update their own product', function () {
    $product = Product::factory()->create([
        'vendor_id' => $this->vendor->id,
        'name' => 'Old Name',
        'price' => 50.00,
    ]);

    $updatedData = [
        'name' => 'Updated Name',
        'description' => $product->description,
        'price' => 75.00,
        'category_id' => $product->category_id,
        'is_active' => true,
    ];

    $response = $this->put(route('products.update', $product), $updatedData);

    $response->assertRedirect(route('dashboard'));
    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'name' => 'Updated Name',
        'price' => 75.00,
    ]);
});

test('vendor can delete their own product', function () {
    $product = Product::factory()->create([
        'vendor_id' => $this->vendor->id,
    ]);

    $response = $this->delete(route('products.destroy', $product));

    $response->assertRedirect(route('dashboard'));
    $this->assertDatabaseMissing('products', ['id' => $product->id]);
});
