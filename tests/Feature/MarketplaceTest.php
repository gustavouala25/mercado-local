<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Category;

class MarketplaceTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_can_be_rendered()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_terms_page_can_be_rendered()
    {
        $response = $this->get('/terminos');
        $response->assertStatus(200);
    }

    public function test_privacy_page_can_be_rendered()
    {
        $response = $this->get('/privacidad');
        $response->assertStatus(200);
    }

    public function test_product_page_can_be_rendered()
    {
        $user = User::factory()->create();
        $vendor = Vendor::create([
            'user_id' => $user->id,
            'name' => 'Test Vendor',
            'slug' => 'test-vendor',
            'whatsapp_number' => '1234567890',
            'location' => 'Test Location',
        ]);
        
        $category = Category::create(['name' => 'Test Category', 'slug' => 'test-category', 'icon' => 'test-icon']);

        $product = Product::create([
            'vendor_id' => $vendor->id,
            'category_id' => $category->id,
            'name' => 'Test Product',
            'slug' => 'test-product',
            'description' => 'Test Description',
            'price' => 100,
            'image_path' => 'test-image.jpg',
        ]);

        $response = $this->get('/p/' . $product->slug);
        $response->assertStatus(200);
        $response->assertSee('Test Product');
    }
    
    public function test_public_market_product_page_can_be_rendered()
    {
        $user = User::factory()->create();
        $vendor = Vendor::create([
            'user_id' => $user->id,
            'name' => 'Test Vendor',
            'slug' => 'test-vendor',
            'whatsapp_number' => '1234567890',
            'location' => 'Test Location',
        ]);
        
        $category = Category::create(['name' => 'Test Category', 'slug' => 'test-category', 'icon' => 'test-icon']);

        $product = Product::create([
            'vendor_id' => $vendor->id,
            'category_id' => $category->id,
            'name' => 'Test Product',
            'slug' => 'test-product',
            'description' => 'Test Description',
            'price' => 100,
            'image_path' => 'test-image.jpg',
        ]);

        $response = $this->get('/product/' . $product->slug);
        $response->assertStatus(200);
        $response->assertSee('Test Product');
    }
}
