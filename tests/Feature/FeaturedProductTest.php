<?php

use App\Models\User;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('vendor can see featured status in dashboard', function () {
    // Arrange
    $user = User::factory()->create();
    $vendor = Vendor::factory()->create(['user_id' => $user->id]);
    $category = Category::factory()->create();

    $featuredProduct = Product::factory()->create([
        'vendor_id' => $vendor->id,
        'category_id' => $category->id,
        'name' => 'Producto Destacado',
        'is_featured' => true,
    ]);

    $regularProduct = Product::factory()->create([
        'vendor_id' => $vendor->id,
        'category_id' => $category->id,
        'name' => 'Producto Normal',
        'is_featured' => false,
    ]);

    // Act
    $response = $this->actingAs($user)->get(route('dashboard'));

    // Assert
    $response->assertOk();
    $response->assertSee('Producto Destacado');
    $response->assertSee('Producto Normal');
    
    // Assert badge is visible for featured product
    $response->assertSee('Destacado');
    
    // Assert badge HTML structure is present
    $response->assertSee('bg-yellow-400');
});
