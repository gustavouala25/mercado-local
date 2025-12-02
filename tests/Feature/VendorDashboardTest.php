<?php

use App\Models\User;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Category;

test('vendor can see dashboard', function () {
    $user = User::factory()->create();
    $vendor = Vendor::factory()->create(['user_id' => $user->id]);

    $response = $this->actingAs($user)->get(route('dashboard'));

    $response->assertStatus(200);
    $response->assertSee('Panel de Vendedor');
});

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('vendor can create a product', function () {
    Storage::fake('public');
    $user = User::factory()->create();
    $vendor = Vendor::factory()->create(['user_id' => $user->id]);
    $category = Category::factory()->create();

    $productData = [
        'name' => 'New Product',
        'description' => 'Description',
        'price' => 100,
        'category_id' => $category->id,
        'image' => UploadedFile::fake()->create('product.jpg', 100),
    ];

    $response = $this->actingAs($user)->post(route('vendor.products.store'), $productData);

    $response->assertRedirect();
    $this->assertDatabaseHas('products', [
        'name' => 'New Product',
        'vendor_id' => $vendor->id,
    ]);
});

test('vendor cannot update another vendors product', function () {
    $userA = User::factory()->create();
    $vendorA = Vendor::factory()->create(['user_id' => $userA->id]);

    $userB = User::factory()->create();
    $vendorB = Vendor::factory()->create(['user_id' => $userB->id]);

    $productB = Product::factory()->create([
        'vendor_id' => $vendorB->id,
        'name' => 'Product B',
    ]);

    $response = $this->actingAs($userA)->put(route('vendor.products.update', $productB), [
        'name' => 'Hacked Product',
        'price' => 0,
        'category_id' => $productB->category_id,
    ]);

    $response->assertStatus(403);
    
    $this->assertDatabaseHas('products', [
        'id' => $productB->id,
        'name' => 'Product B',
    ]);
});
